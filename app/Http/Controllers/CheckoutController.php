<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class CheckoutController extends Controller
{
    /**
     * Display checkout page
     */
    public function index()
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Silakan login terlebih dahulu untuk melanjutkan checkout.');
        }

        // Get cart items
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Keranjang Anda kosong. Silakan tambahkan produk terlebih dahulu.');
        }

        // Calculate totals
        $subtotal = $this->calculateSubtotal($cart);
        $shippingCost = Session::get('shipping_cost', 0);
        $discount = Session::get('applied_coupon.discount', 0);
        $total = $subtotal + $shippingCost - $discount;

        // Get user data
        $user = Auth::user();

        // Available payment methods
        $paymentMethods = [
            'bank_transfer' => [
                'name' => 'Transfer Bank',
                'description' => 'Transfer ke rekening bank kami',
                'icon' => 'fa-university',
                'banks' => [
                    'bca' => ['name' => 'BCA', 'account' => '1234567890', 'holder' => 'PT Avflowril'],
                    'mandiri' => ['name' => 'Mandiri', 'account' => '0987654321', 'holder' => 'PT Avflowril'],
                    'bni' => ['name' => 'BNI', 'account' => '1122334455', 'holder' => 'PT Avflowril'],
                ]
            ],
            'e_wallet' => [
                'name' => 'E-Wallet',
                'description' => 'Bayar dengan dompet digital',
                'icon' => 'fa-mobile-alt',
                'wallets' => [
                    'gopay' => ['name' => 'GoPay', 'number' => '081384303654'],
                    'ovo' => ['name' => 'OVO', 'number' => '081384303654'],
                    'dana' => ['name' => 'DANA', 'number' => '081384303654'],
                ]
            ],
            'cod' => [
                'name' => 'Cash on Delivery (COD)',
                'description' => 'Bayar saat barang diterima',
                'icon' => 'fa-money-bill-wave',
                'fee' => 5000
            ]
        ];

        return view('checkout.index', compact('cart', 'subtotal', 'shippingCost', 'discount', 'total', 'user', 'paymentMethods'));
    }

    /**
     * Process checkout
     */
    public function process(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Validate delivery method first
        $request->validate([
            'delivery_method' => 'required|in:shipping,pickup',
            'payment_method' => 'required|string',
            'notes' => 'nullable|string|max:500'
        ]);

        // Conditional validation based on delivery method
        if ($request->delivery_method === 'shipping') {
            $request->validate([
                'shipping_name' => 'required|string|max:255',
                'shipping_phone' => 'required|string|max:20',
                'shipping_address' => 'required|string',
                'shipping_city' => 'required|string|max:100',
                'shipping_postal_code' => 'required|string|max:10',
            ]);
        } else if ($request->delivery_method === 'pickup') {
            $request->validate([
                'pickup_name' => 'required|string|max:255',
                'pickup_phone' => 'required|string|max:20',
            ]);
        }

        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Keranjang Anda kosong.');
        }

        try {
            DB::beginTransaction();

            // Calculate totals
            $subtotal = $this->calculateSubtotal($cart);
            $shippingCost = $request->delivery_method === 'pickup' ? 0 : Session::get('shipping_cost', 0);
            $discount = Session::get('applied_coupon.discount', 0);
            $total = $subtotal + $shippingCost - $discount;

            // Add COD fee if applicable
            if ($request->payment_method === 'cod') {
                $total += 5000; // COD fee
            }

            // Prepare address data based on delivery method
            if ($request->delivery_method === 'shipping') {
                $shippingAddress = [
                    'name' => $request->shipping_name,
                    'phone' => $request->shipping_phone,
                    'address' => $request->shipping_address,
                    'city' => $request->shipping_city,
                    'postal_code' => $request->shipping_postal_code,
                    'delivery_method' => 'shipping'
                ];
                $billingAddress = $shippingAddress;
            } else {
                // For pickup, use store address but keep customer info
                $shippingAddress = [
                    'name' => $request->pickup_name,
                    'phone' => $request->pickup_phone,
                    'address' => 'Jl. Raya Bogor No. 123, Cibinong',
                    'city' => 'Bogor',
                    'postal_code' => '16911',
                    'delivery_method' => 'pickup'
                ];
                $billingAddress = [
                    'name' => $request->pickup_name,
                    'phone' => $request->pickup_phone,
                    'address' => 'Pickup at Store',
                    'city' => 'Bogor',
                    'postal_code' => '16911',
                    'delivery_method' => 'pickup'
                ];
            }

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => $this->generateOrderNumber(),
                'status' => 'pending',
                'total_amount' => $total,
                'subtotal' => $subtotal,
                'shipping_amount' => $shippingCost,
                'discount_amount' => $discount,
                'payment_status' => 'pending',
                'payment_method' => $request->payment_method,
                'shipping_address' => $shippingAddress,
                'billing_address' => $billingAddress,
                'notes' => $request->notes,
            ]);

            // Create order items
            foreach ($cart as $item) {
                // Get product details
                $product = Product::find($item['id']);
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'product_name' => $product ? $product->name : $item['name'],
                    'product_sku' => $product ? $product->sku : null,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['price'] * $item['quantity'],
                ]);

                // Update product stock
                if ($product) {
                    $product->decrement('stock_quantity', $item['quantity']);
                }
            }

            // Add initial tracking
            $trackingMessage = $request->delivery_method === 'pickup' 
                ? 'Pesanan Anda telah diterima dan menunggu konfirmasi pembayaran. Pesanan akan siap diambil di toko setelah pembayaran dikonfirmasi.'
                : 'Pesanan Anda telah diterima dan menunggu konfirmasi pembayaran.';
            
            $order->addTracking('pending', 'Pesanan Diterima', $trackingMessage);

            DB::commit();

            // Clear cart and related sessions
            Session::forget(['cart', 'cart_count', 'shipping_cost', 'applied_coupon']);

            // Redirect to payment page
            return redirect()->route('checkout.payment', $order->order_number);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Checkout Error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Display payment page
     */
    public function payment($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
                     ->where('user_id', Auth::id())
                     ->with('orderItems.product')
                     ->first();

        if (!$order) {
            return redirect()->route('home')->with('error', 'Pesanan tidak ditemukan.');
        }

        if ($order->payment_status !== 'pending') {
            return redirect()->route('orders.details', $order->id)->with('info', 'Pembayaran untuk pesanan ini sudah diproses.');
        }

        // Get payment method details
        $paymentDetails = $this->getPaymentDetails($order->payment_method);

        return view('checkout.payment', compact('order', 'paymentDetails'));
    }

    /**
     * Process payment confirmation
     */
    public function confirmPayment(Request $request, $orderNumber)
    {
        // Debug: Log the request
        Log::info('Payment confirmation request started', [
            'order_number' => $orderNumber,
            'user_id' => Auth::id(),
            'has_file' => $request->hasFile('payment_proof'),
            'request_data' => $request->except(['payment_proof']),
            'files' => $request->allFiles(),
        ]);

        $order = Order::where('order_number', $orderNumber)
                     ->where('user_id', Auth::id())
                     ->first();

        if (!$order) {
            Log::warning('Order not found', ['order_number' => $orderNumber, 'user_id' => Auth::id()]);
            return redirect()->route('home')->with('error', 'Pesanan tidak ditemukan.');
        }

        if ($order->payment_method === 'cod') {
            // For COD, just confirm the order
            $order->updateStatus('confirmed', 'Pesanan Dikonfirmasi', 'Pesanan Anda telah dikonfirmasi dan akan segera diproses.');
            
            return redirect()->route('checkout.success', $order->order_number);
        }

        // Validate the request
        try {
            $request->validate([
                'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'sender_name' => 'required|string|max:255',
                'transfer_amount' => 'required|numeric',
            ]);
            
            Log::info('Validation passed');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed', ['errors' => $e->errors()]);
            return back()->withErrors($e->errors())->withInput();
        }

        try {
            // Handle file upload
            if ($request->hasFile('payment_proof')) {
                $file = $request->file('payment_proof');
                
                // Debug: Log file info
                Log::info('File upload info', [
                    'original_name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                    'extension' => $file->getClientOriginalExtension(),
                    'is_valid' => $file->isValid(),
                ]);
                
                if (!$file->isValid()) {
                    Log::error('File is not valid');
                    return back()->with('error', 'File yang diunggah tidak valid.');
                }
                
                $filename = 'payment_' . $order->order_number . '_' . time() . '.' . $file->getClientOriginalExtension();
                
                // Store file in storage/app/public/payment-proofs
                $path = $file->storeAs('payment-proofs', $filename, 'public');

                // Debug: Log storage path
                Log::info('File stored successfully', ['path' => $path, 'filename' => $filename]);

                // Update order with payment info - use 'paid' status since verification is manual
                $order->update([
                    'payment_status' => 'paid',
                    'payment_proof' => $path,
                ]);

                Log::info('Order updated with payment proof', ['order_id' => $order->id, 'path' => $path]);

                // Add tracking for payment upload
                $order->addTracking(
                    'payment_uploaded',
                    'Bukti Pembayaran Diunggah',
                    'Bukti pembayaran telah diunggah dan pembayaran dikonfirmasi.',
                    null,
                    [
                        'payment_proof' => $filename,
                        'sender_name' => $request->sender_name,
                        'transfer_amount' => $request->transfer_amount,
                        'uploaded_at' => now(),
                    ]
                );

                Log::info('Payment confirmation completed successfully');

                return redirect()->route('checkout.success', $order->order_number)
                    ->with('success', 'Bukti pembayaran berhasil diunggah dan pembayaran telah dikonfirmasi.');
            } else {
                Log::error('No file found in request');
                return back()->with('error', 'File bukti pembayaran tidak ditemukan.');
            }

        } catch (\Exception $e) {
            Log::error('Payment upload error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat mengunggah bukti pembayaran: ' . $e->getMessage());
        }
    }

    /**
     * Display success page
     */
    public function success($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
                     ->where('user_id', Auth::id())
                     ->with('orderItems.product')
                     ->first();

        if (!$order) {
            return redirect()->route('home')->with('error', 'Pesanan tidak ditemukan.');
        }

        return view('checkout.success', compact('order'));
    }

    /**
     * Calculate subtotal from cart
     */
    private function calculateSubtotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    /**
     * Generate unique order number
     */
    private function generateOrderNumber()
    {
        do {
            $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
        } while (Order::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }

    /**
     * Get payment method details
     */
    private function getPaymentDetails($paymentMethod)
    {
        $details = [
            'bank_transfer' => [
                'name' => 'Transfer Bank',
                'instructions' => [
                    'Pilih salah satu rekening bank di bawah ini',
                    'Transfer sesuai dengan total pembayaran',
                    'Simpan bukti transfer',
                    'Upload bukti transfer pada form di bawah',
                    'Tunggu konfirmasi dari tim kami'
                ],
                'banks' => [
                    'bca' => ['name' => 'BCA', 'account' => '1234567890', 'holder' => 'PT Avflowril'],
                    'mandiri' => ['name' => 'Mandiri', 'account' => '0987654321', 'holder' => 'PT Avflowril'],
                    'bni' => ['name' => 'BNI', 'account' => '1122334455', 'holder' => 'PT Avflowril'],
                ]
            ],
            'e_wallet' => [
                'name' => 'E-Wallet',
                'instructions' => [
                    'Pilih salah satu e-wallet di bawah ini',
                    'Transfer sesuai dengan total pembayaran',
                    'Simpan bukti transfer',
                    'Upload bukti transfer pada form di bawah',
                    'Tunggu konfirmasi dari tim kami'
                ],
                'wallets' => [
                    'gopay' => ['name' => 'GoPay', 'number' => '081384303654'],
                    'ovo' => ['name' => 'OVO', 'number' => '081384303654'],
                    'dana' => ['name' => 'DANA', 'number' => '081384303654'],
                ]
            ],
            'cod' => [
                'name' => 'Cash on Delivery (COD)',
                'instructions' => [
                    'Pesanan Anda akan dikirim terlebih dahulu',
                    'Pembayaran dilakukan saat barang diterima',
                    'Siapkan uang pas sesuai total pembayaran',
                    'Periksa kondisi barang sebelum pembayaran'
                ],
                'fee' => 5000
            ]
        ];

        return $details[$paymentMethod] ?? null;
    }
}

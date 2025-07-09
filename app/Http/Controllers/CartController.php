<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display the shopping cart
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        $cartTotal = $this->calculateCartTotal($cart);
        $cartCount = $this->getCartCount($cart);
        
        return view('cart.index', compact('cart', 'cartTotal', 'cartCount'));
    }

    /**
     * Add item to cart
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|string',
            'quantity' => 'integer|min:1'
        ]);

        $cart = Session::get('cart', []);
        $productId = $request->product_id;
        $quantity = $request->quantity ?? 1;

        if (isset($cart[$productId])) {
            // If product already exists, increase quantity
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Add new product to cart
            $cart[$productId] = [
                'id' => $productId,
                'name' => $request->name,
                'price' => $request->price,
                'image' => $request->image,
                'quantity' => $quantity,
                'category' => $request->category ?? 'Bucket Bunga'
            ];
        }

        Session::put('cart', $cart);
        Session::put('cart_count', $this->getCartCount($cart));

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke keranjang',
            'cart_count' => $this->getCartCount($cart),
            'cart_total' => $this->calculateCartTotal($cart)
        ]);
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Session::get('cart', []);
        $productId = $request->product_id;

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $request->quantity;
            Session::put('cart', $cart);
            Session::put('cart_count', $this->getCartCount($cart));

            return response()->json([
                'success' => true,
                'message' => 'Keranjang berhasil diperbarui',
                'cart_count' => $this->getCartCount($cart),
                'cart_total' => $this->calculateCartTotal($cart),
                'item_total' => $cart[$productId]['price'] * $cart[$productId]['quantity']
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Produk tidak ditemukan di keranjang'
        ], 404);
    }

    /**
     * Remove item from cart
     */
    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer'
        ]);

        $cart = Session::get('cart', []);
        $productId = $request->product_id;

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
            Session::put('cart_count', $this->getCartCount($cart));

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil dihapus dari keranjang',
                'cart_count' => $this->getCartCount($cart),
                'cart_total' => $this->calculateCartTotal($cart)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Produk tidak ditemukan di keranjang'
        ], 404);
    }

    /**
     * Clear entire cart
     */
    public function clear()
    {
        Session::forget('cart');
        Session::put('cart_count', 0);

        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil dikosongkan',
            'cart_count' => 0,
            'cart_total' => 0
        ]);
    }

    /**
     * Get cart contents for AJAX requests
     */
    public function getCart()
    {
        $cart = Session::get('cart', []);
        
        return response()->json([
            'success' => true,
            'cart' => $cart,
            'cart_count' => $this->getCartCount($cart),
            'cart_total' => $this->calculateCartTotal($cart)
        ]);
    }

    /**
     * Apply coupon code
     */
    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string'
        ]);

        $couponCode = strtoupper($request->coupon_code);
        $cart = Session::get('cart', []);
        $cartTotal = $this->calculateCartTotal($cart);
        
        // Define available coupons
        $coupons = [
            'WELCOME10' => ['type' => 'percentage', 'value' => 10, 'min_amount' => 100000],
            'SAVE20K' => ['type' => 'fixed', 'value' => 20000, 'min_amount' => 200000],
            'NEWUSER' => ['type' => 'percentage', 'value' => 15, 'min_amount' => 150000],
            'BUCKET50' => ['type' => 'fixed', 'value' => 50000, 'min_amount' => 300000]
        ];

        if (!isset($coupons[$couponCode])) {
            return response()->json([
                'success' => false,
                'message' => 'Kode kupon tidak valid'
            ]);
        }

        $coupon = $coupons[$couponCode];
        
        if ($cartTotal < $coupon['min_amount']) {
            return response()->json([
                'success' => false,
                'message' => 'Minimum pembelian Rp ' . number_format($coupon['min_amount'], 0, ',', '.') . ' untuk menggunakan kupon ini'
            ]);
        }

        // Calculate discount
        if ($coupon['type'] === 'percentage') {
            $discount = ($cartTotal * $coupon['value']) / 100;
        } else {
            $discount = $coupon['value'];
        }

        // Store coupon in session
        Session::put('applied_coupon', [
            'code' => $couponCode,
            'discount' => $discount,
            'type' => $coupon['type'],
            'value' => $coupon['value']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kupon berhasil diterapkan',
            'discount' => $discount,
            'final_total' => $cartTotal - $discount
        ]);
    }

    /**
     * Remove applied coupon
     */
    public function removeCoupon()
    {
        Session::forget('applied_coupon');
        
        return response()->json([
            'success' => true,
            'message' => 'Kupon berhasil dihapus'
        ]);
    }

    /**
     * Calculate cart total
     */
    private function calculateCartTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    /**
     * Get cart item count
     */
    private function getCartCount($cart)
    {
        $count = 0;
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }
        return $count;
    }

    /**
     * Get shipping cost
     */
    public function getShippingCost(Request $request)
    {
        $request->validate([
            'city' => 'required|string'
        ]);

        $city = strtolower($request->city);
        
        // Define shipping costs by city
        $shippingCosts = [
            'jakarta' => 15000,
            'bogor' => 25000,
            'depok' => 20000,
            'tangerang' => 25000,
            'bekasi' => 25000,
            'bandung' => 35000,
            'surabaya' => 45000,
            'yogyakarta' => 40000,
            'semarang' => 40000,
            'medan' => 50000
        ];

        $shippingCost = $shippingCosts[$city] ?? 30000; // Default shipping cost

        return response()->json([
            'success' => true,
            'shipping_cost' => $shippingCost,
            'city' => ucfirst($city)
        ]);
    }
}
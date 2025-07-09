<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderTracking;
use App\Services\OrderTrackingService;
use Illuminate\Support\Facades\Auth;

class OrderTrackingController extends Controller
{
    protected $trackingService;

    public function __construct(OrderTrackingService $trackingService)
    {
        $this->trackingService = $trackingService;
    }

    /**
     * Display tracking page for a specific order
     */
    public function show($orderNumber)
    {
        // Find order by order number
        $order = Order::where('order_number', $orderNumber)
                     ->with(['orderItems.product', 'tracking', 'user'])
                     ->first();

        if (!$order) {
            return redirect()->route('home')->with('error', 'Pesanan tidak ditemukan.');
        }

        // Check if user is authorized to view this order
        if (Auth::check() && $order->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'Anda tidak memiliki akses untuk melihat pesanan ini.');
        }

        // Auto-update tracking if order is not delivered or cancelled
        if (!in_array($order->status, ['delivered', 'cancelled'])) {
            $this->trackingService->autoUpdateTracking($order);
            // Refresh order data after potential updates
            $order = $order->fresh(['orderItems.product', 'tracking', 'user']);
        }

        $trackingHistory = $order->tracking()->orderBy('tracked_at', 'asc')->get();

        return view('orders.tracking', compact('order', 'trackingHistory'));
    }

    /**
     * Track order by order number (public access)
     */
    public function track(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'order_number' => 'required|string'
            ]);

            $orderNumber = strtoupper(trim($request->order_number));
            
            $order = Order::where('order_number', $orderNumber)->first();

            if (!$order) {
                return back()->with('error', 'Nomor pesanan tidak ditemukan. Pastikan nomor pesanan yang Anda masukkan benar.');
            }

            return redirect()->route('orders.tracking', $orderNumber);
        }

        return view('orders.track');
    }

    /**
     * Display user's order history
     */
    public function myOrders()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Silakan login untuk melihat riwayat pesanan Anda.');
        }

        $orders = Order::where('user_id', Auth::id())
                      ->with(['orderItems.product', 'latestTracking'])
                      ->orderBy('created_at', 'desc')
                      ->paginate(10);

        return view('orders.my-orders', compact('orders'));
    }

    /**
     * Display specific order details for authenticated user
     */
    public function orderDetails($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $order = Order::where('id', $id)
                     ->where('user_id', Auth::id())
                     ->with(['orderItems.product', 'tracking'])
                     ->first();

        if (!$order) {
            return redirect()->route('orders.my-orders')->with('error', 'Pesanan tidak ditemukan.');
        }

        $trackingHistory = $order->tracking()->orderBy('tracked_at', 'asc')->get();

        return view('orders.details', compact('order', 'trackingHistory'));
    }

    /**
     * Cancel order (if allowed)
     */
    public function cancel($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $order = Order::where('id', $id)
                     ->where('user_id', Auth::id())
                     ->first();

        if (!$order) {
            return back()->with('error', 'Pesanan tidak ditemukan.');
        }

        // Only allow cancellation for pending or confirmed orders
        if (!in_array($order->status, ['pending', 'confirmed'])) {
            return back()->with('error', 'Pesanan tidak dapat dibatalkan karena sudah diproses.');
        }

        $order->updateStatus('cancelled', 'Pesanan Dibatalkan', 'Pesanan dibatalkan oleh pelanggan.');

        return back()->with('success', 'Pesanan berhasil dibatalkan.');
    }

    /**
     * API endpoint to get tracking data
     */
    public function trackingApi($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
                     ->with(['tracking' => function($query) {
                         $query->orderBy('tracked_at', 'asc');
                     }])
                     ->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        // Auto-update tracking if order is not delivered or cancelled
        if (!in_array($order->status, ['delivered', 'cancelled'])) {
            $this->trackingService->autoUpdateTracking($order);
            // Refresh order data after potential updates
            $order = $order->fresh(['tracking']);
        }

        return response()->json([
            'order_number' => $order->order_number,
            'status' => $order->status,
            'status_label' => $order->status_label,
            'total_amount' => $order->formatted_total,
            'created_at' => $order->created_at->format('d M Y, H:i'),
            'tracking' => $order->tracking->map(function($track) {
                return [
                    'status' => $track->status,
                    'title' => $track->title,
                    'description' => $track->description,
                    'location' => $track->location,
                    'tracked_at' => $track->formatted_date,
                    'icon' => $track->status_icon,
                    'color' => $track->status_color,
                    'metadata' => $track->metadata
                ];
            })
        ]);
    }
}
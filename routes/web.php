<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Home page
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Shop page
Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index'])->name('shop');

// About page
Route::get('/about', function () {
    return view('about');
})->name('about');

// Contact page
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Cart routes
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [App\Http\Controllers\CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/get', [App\Http\Controllers\CartController::class, 'getCart'])->name('cart.get');
Route::post('/cart/apply-coupon', [App\Http\Controllers\CartController::class, 'applyCoupon'])->name('cart.apply-coupon');
Route::post('/cart/remove-coupon', [App\Http\Controllers\CartController::class, 'removeCoupon'])->name('cart.remove-coupon');
Route::post('/cart/shipping', [App\Http\Controllers\CartController::class, 'getShippingCost'])->name('cart.shipping');

// Product details page
Route::get('/product/{id}', [App\Http\Controllers\ShopController::class, 'show'])->name('product.details');

// Order Tracking Routes (Public)
Route::get('/track-order', [App\Http\Controllers\OrderTrackingController::class, 'track'])->name('orders.track');
Route::post('/track-order', [App\Http\Controllers\OrderTrackingController::class, 'track']);
Route::get('/tracking/{orderNumber}', [App\Http\Controllers\OrderTrackingController::class, 'show'])->name('orders.tracking');

// API route for product quick view
Route::get('/api/product/{id}', function ($id) {
    $product = App\Models\Product::findOrFail($id);
    
    return response()->json([
        'id' => $product->id,
        'name' => $product->name,
        'category' => match($product->category) {
            'satin' => 'Bucket Satin',
            'money' => 'Bucket Money',
            'kawat' => 'Bucket Kawat',
            'glitter' => 'Bucket Glitter',
            'custom' => 'Bucket Custom',
            'special' => 'Bucket Special',
            default => ucfirst($product->category)
        },
        'currentPrice' => $product->sale_price ?: $product->price,
        'oldPrice' => $product->sale_price ? $product->price : null,
        'discount' => $product->discount_percentage,
        'rating' => 5,
        'reviewCount' => rand(10, 50),
        'description' => $product->description ?: $product->short_description,
        'images' => $product->images ?: ['/assets/images/product/default.jpg'],
        'specifications' => [
            'size' => $product->dimensions ?: 'Medium (25cm x 30cm)',
            'weight' => $product->weight ? $product->weight . ' gram' : '500 gram',
            'material' => match($product->category) {
                'satin' => 'Satin Premium',
                'money' => 'Mixed Premium Materials',
                'kawat' => 'Kawat Premium + Bulu Sintetis',
                'glitter' => 'Satin Premium + Glitter',
                'custom' => 'Custom Materials',
                'special' => 'Premium Mixed Materials',
                default => 'Premium Materials'
            },
            'color' => 'Berbagai Pilihan'
        ],
        'badge' => $product->is_on_sale ? 'discount' : ($product->featured ? 'popular' : null),
        'stock' => $product->stock_quantity
    ]);
});

// API route for tracking data
Route::get('/api/tracking/{orderNumber}', [App\Http\Controllers\OrderTrackingController::class, 'trackingApi'])->name('api.tracking');

// Test route for manual tracking update
Route::get('/test/update-tracking/{orderNumber}', function($orderNumber) {
    $order = App\Models\Order::where('order_number', $orderNumber)->first();
    
    if (!$order) {
        return response()->json(['error' => 'Order not found'], 404);
    }
    
    $trackingService = new App\Services\OrderTrackingService();
    $result = $trackingService->autoUpdateTracking($order);
    
    return response()->json([
        'success' => $result,
        'order_number' => $order->order_number,
        'status' => $order->fresh()->status,
        'tracking_count' => $order->fresh()->tracking()->count()
    ]);
})->name('test.update-tracking');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Debug Routes (for testing)
Route::get('/checkout/debug', function() {
    return view('checkout.debug');
})->name('checkout.debug');

Route::get('/test/add-to-cart', function() {
    $cart = Session::get('cart', []);
    
    // Add multiple test products to cart
    $cart[1] = [
        'id' => 1,
        'name' => 'Bucket Bunga Satin Pink / Medium',
        'price' => 250000,
        'image' => 'assets/images/product/small-size/1.jpg',
        'quantity' => 1,
        'category' => 'Bucket Satin'
    ];
    
    $cart[2] = [
        'id' => 2,
        'name' => 'Bucket Satin with Glitter Gold',
        'price' => 370000,
        'image' => 'assets/images/product/small-size/2.jpg',
        'quantity' => 1,
        'category' => 'Bucket Glitter'
    ];
    
    $cart[3] = [
        'id' => 3,
        'name' => 'Bunga Kawat Bulu Multicolor',
        'price' => 270000,
        'image' => 'assets/images/product/small-size/3.jpg',
        'quantity' => 1,
        'category' => 'Bucket Kawat'
    ];
    
    $cart[4] = [
        'id' => 4,
        'name' => 'Bucket Money Special Edition',
        'price' => 310000,
        'image' => 'assets/images/product/small-size/4.jpg',
        'quantity' => 2,
        'category' => 'Bucket Money'
    ];
    
    Session::put('cart', $cart);
    Session::put('cart_count', 5); // Total quantity
    
    return redirect()->route('cart')->with('success', 'Test items added to cart');
})->name('test.add-cart');

// Protected Routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    
    // Checkout Routes
    Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/payment/{orderNumber}', [App\Http\Controllers\CheckoutController::class, 'payment'])->name('checkout.payment');
    Route::post('/checkout/payment/{orderNumber}', [App\Http\Controllers\CheckoutController::class, 'confirmPayment'])->name('checkout.confirm-payment');
    Route::get('/checkout/success/{orderNumber}', [App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');
    
    // User Order Routes
    Route::get('/my-orders', [App\Http\Controllers\OrderTrackingController::class, 'myOrders'])->name('orders.my-orders');
    Route::get('/order/{id}', [App\Http\Controllers\OrderTrackingController::class, 'orderDetails'])->name('orders.details');
    Route::post('/order/{id}/cancel', [App\Http\Controllers\OrderTrackingController::class, 'cancel'])->name('orders.cancel');
});
@extends('layouts.app')

@section('title', 'Keranjang Belanja - Avflowril')
@section('description', 'Keranjang belanja Anda di Avflowril - Review dan checkout bucket bunga pilihan Anda')

@section('content')
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-title">Checkout</h1>
                    <div class="breadcrumb-nav">
                        <a href="{{ route('home') }}">Home</a>
                        <i class="fa fa-chevron-right"></i>
                        <span>Keranjang</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->

<!-- Cart Area Start -->
<div class="cart-area">
    <div class="container">
        @if(count($cart) > 0)
            <!-- Cart Items Section -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-items-section">
                        <div class="section-header">
                            <h3>Item di Keranjang ({{ $cartCount }})</h3>
                            <button class="clear-cart-btn" onclick="clearCart()">
                                <i class="fa fa-trash me-2"></i>Kosongkan Keranjang
                            </button>
                        </div>

                        <div class="cart-items">
                            @foreach($cart as $item)
                                <div class="cart-item" data-product-id="{{ $item['id'] }}">
                                    <div class="item-image">
                                        <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="img-fluid">
                                    </div>
                                    
                                    <div class="item-details">
                                        <div class="item-info">
                                            <h5 class="item-name">{{ $item['name'] }}</h5>
                                            <p class="item-category">{{ $item['category'] ?? 'Bucket Bunga' }}</p>
                                            <div class="item-price">
                                                <span class="price">Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="item-actions">
                                            <div class="quantity-controls">
                                                <button class="qty-btn minus" onclick="changeQuantity({{ $item['id'] }}, -1)">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                                <input type="number" class="qty-input" value="{{ $item['quantity'] }}" min="1" 
                                                       onchange="updateQuantity({{ $item['id'] }}, this.value)" 
                                                       data-product-id="{{ $item['id'] }}">
                                                <button class="qty-btn plus" onclick="changeQuantity({{ $item['id'] }}, 1)">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                            
                                            <div class="item-total">
                                                <span class="total-price">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                                            </div>
                                            
                                            <button class="remove-btn" onclick="removeFromCart({{ $item['id'] }})" title="Hapus item">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Continue Shopping -->
                        <div class="continue-shopping">
                            <a href="{{ route('shop') }}" class="continue-btn">
                                <i class="fa fa-arrow-left me-2"></i>Lanjut Belanja
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Cart Summary Section -->
                <div class="col-lg-4">
                    <div class="cart-summary">
                        <h4 class="summary-title">Ringkasan Pesanan</h4>
                        
                        
                        <!-- Shipping Calculator -->
                        <div class="shipping-section">
                            <h6>Estimasi Ongkir</h6>
                            <div class="shipping-form">
                                <select id="shippingCity" class="form-control" onchange="calculateShipping()">
                                    <option value="">Pilih Kota</option>
                                    <option value="jakarta">Jakarta</option>
                                    <option value="bogor">Bogor</option>
                                    <option value="depok">Depok</option>
                                    <option value="tangerang">Tangerang</option>
                                    <option value="bekasi">Bekasi</option>
                                    <option value="bandung">Bandung</option>
                                    <option value="surabaya">Surabaya</option>
                                    <option value="yogyakarta">Yogyakarta</option>
                                    <option value="semarang">Semarang</option>
                                    <option value="medan">Medan</option>
                                </select>
                            </div>
                            <div id="shippingCost" class="shipping-cost"></div>
                        </div>

                        <!-- Order Summary -->
                        <div class="order-summary">
                            <div class="summary-row">
                                <span>Subtotal ({{ $cartCount }} item)</span>
                                <span id="subtotal">Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
                            </div>
                            
                            <div class="summary-row" id="shippingRow" style="display: none;">
                                <span>Ongkos Kirim</span>
                                <span id="shippingAmount">Rp 0</span>
                            </div>
                            
                            <div class="summary-divider"></div>
                            
                            <div class="summary-row total">
                                <span>Total</span>
                                <span id="finalTotal">Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Checkout Button -->
                        <div class="checkout-section">
                            <button class="checkout-btn" onclick="proceedToCheckout()">
                                <i class="fa fa-credit-card me-2"></i>Lanjut ke Pembayaran
                            </button>
                            
                            <div class="payment-methods">
                                <p>Metode Pembayaran:</p>
                                <div class="payment-icons">
                                    <img src="{{ asset('assets/images/payment/bca.svg') }}" alt="BCA" class="payment-icon">
                                    <img src="{{ asset('assets/images/payment/mandiri.svg') }}" alt="Mandiri" class="payment-icon">
                                    <img src="{{ asset('assets/images/payment/bni.svg') }}" alt="BNI" class="payment-icon">
                                    <img src="{{ asset('assets/images/payment/gopay.svg') }}" alt="GoPay" class="payment-icon">
                                    <img src="{{ asset('assets/images/payment/ovo.svg') }}" alt="OVO" class="payment-icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="row">
                <div class="col-12">
                    <div class="empty-cart">
                        <div class="empty-cart-icon">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <h3>Keranjang Anda Kosong</h3>
                        <p>Belum ada produk di keranjang belanja Anda. Yuk, mulai berbelanja bucket bunga terbaik!</p>
                        <a href="{{ route('shop') }}" class="shop-now-btn">
                            <i class="fa fa-shopping-bag me-2"></i>Mulai Belanja
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
<!-- Cart Area End -->



@push('styles')
<style>
/* Breadcrumb */
.breadcrumb-area {
    background: linear-gradient(135deg, #ffeef0 0%, #fff5f6 100%);
    padding: 60px 0;
}

.breadcrumb-title {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 15px;
}

.breadcrumb a {
    color: #e74c3c;
    text-decoration: none;
}

.breadcrumb a:hover {
    color: #c0392b;
}

/* Cart Area */
.cart-area {
    padding: 60px 0;
    background: #f8f9fa;
}

/* Cart Items Section */
.cart-items-section {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    margin-bottom: 30px;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f8f9fa;
}

.section-header h3 {
    color: #2c3e50;
    font-weight: 600;
    margin: 0;
}

.clear-cart-btn {
    background: #dc3545;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.clear-cart-btn:hover {
    background: #c82333;
    transform: translateY(-2px);
}

/* Cart Item */
.cart-item {
    display: flex;
    gap: 20px;
    padding: 25px 0;
    border-bottom: 1px solid #f0f0f0;
    transition: all 0.3s ease;
}

.cart-item:last-child {
    border-bottom: none;
}

.cart-item:hover {
    background: #fafafa;
    border-radius: 10px;
    padding: 25px 15px;
}

.item-image {
    width: 120px;
    height: 120px;
    border-radius: 10px;
    overflow: hidden;
    flex-shrink: 0;
}

.item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.item-details {
    flex: 1;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.item-info h5 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 8px;
}

.item-category {
    color: #e74c3c;
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 10px;
}

.item-price .price {
    font-size: 1.2rem;
    font-weight: 700;
    color: #e74c3c;
}

.item-actions {
    display: flex;
    align-items: center;
    gap: 20px;
}

/* Quantity Controls */
.quantity-controls {
    display: flex;
    align-items: center;
    background: #f8f9fa;
    border-radius: 8px;
    padding: 5px;
}

.qty-btn {
    width: 35px;
    height: 35px;
    background: white;
    border: none;
    border-radius: 6px;
    color: #666;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    cursor: pointer;
}

.qty-btn:hover {
    background: #e74c3c;
    color: white;
}

.qty-input {
    width: 60px;
    height: 35px;
    border: none;
    background: transparent;
    text-align: center;
    font-weight: 600;
    color: #2c3e50;
}

.item-total .total-price {
    font-size: 1.1rem;
    font-weight: 700;
    color: #2c3e50;
}

.remove-btn {
    width: 40px;
    height: 40px;
    background: #dc3545;
    color: white;
    border: none;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    cursor: pointer;
}

.remove-btn:hover {
    background: #c82333;
    transform: scale(1.1);
}

/* Continue Shopping */
.continue-shopping {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 2px solid #f8f9fa;
}

.continue-btn {
    background: linear-gradient(135deg, #27ae60, #229954);
    color: white;
    padding: 12px 25px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.continue-btn:hover {
    background: linear-gradient(135deg, #229954, #1e8449);
    color: white;
    transform: translateY(-2px);
}

/* Cart Summary */
.cart-summary {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    position: sticky;
    top: 20px;
}

.summary-title {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f8f9fa;
}


/* Shipping Section */
.shipping-section {
    margin-bottom: 25px;
}

.shipping-section h6 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 15px;
}

.shipping-form select {
    width: 100%;
    padding: 10px 15px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 14px;
}

.shipping-form select:focus {
    border-color: #e74c3c;
    outline: none;
}

.shipping-cost {
    margin-top: 10px;
    padding: 10px;
    background: #e3f2fd;
    color: #1565c0;
    border-radius: 6px;
    font-weight: 600;
    display: none;
}

/* Order Summary */
.order-summary {
    margin-bottom: 25px;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    color: #666;
}

.summary-row.discount {
    color: #27ae60;
}

.summary-row.total {
    color: #2c3e50;
    font-weight: 700;
    font-size: 1.2rem;
    padding-top: 15px;
}

.summary-divider {
    height: 2px;
    background: #f8f9fa;
    margin: 15px 0;
}

/* Checkout Section */
.checkout-btn {
    width: 100%;
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    border: none;
    padding: 15px 20px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    margin-bottom: 20px;
}

.checkout-btn:hover {
    background: linear-gradient(135deg, #c0392b, #a93226);
    transform: translateY(-2px);
}

.payment-methods p {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 10px;
}

.payment-icons {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.payment-icon {
    width: 90px;
    height: 65px;
    object-fit: contain;
    background: white;
    padding: 3px;
    border-radius: 4px;
    border: 1px solid #e9ecef;
}

/* Empty Cart */
.empty-cart {
    text-align: center;
    padding: 80px 20px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.empty-cart-icon {
    font-size: 5rem;
    color: #ddd;
    margin-bottom: 30px;
}

.empty-cart h3 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 15px;
}

.empty-cart p {
    color: #666;
    margin-bottom: 30px;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

.shop-now-btn {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    padding: 15px 30px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.shop-now-btn:hover {
    background: linear-gradient(135deg, #c0392b, #a93226);
    color: white;
    transform: translateY(-2px);
}

/* Recommended Products */
.recommended-section {
    padding: 60px 0;
    background: white;
}

.section-title {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 40px;
    text-align: center;
}

.recommended-item {
    background: #f8f9fa;
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.recommended-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.recommended-item .item-image {
    position: relative;
    height: 200px;
}

.quick-add-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 35px;
    height: 35px;
    background: #e74c3c;
    color: white;
    border: none;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
}

.recommended-item:hover .quick-add-btn {
    opacity: 1;
}

.recommended-item .item-info {
    padding: 15px;
}

.recommended-item h6 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 8px;
}

.recommended-item .price {
    color: #e74c3c;
    font-weight: 700;
}

/* Responsive Design */
@media (max-width: 768px) {
    .cart-item {
        flex-direction: column;
        gap: 15px;
    }
    
    .item-details {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .item-actions {
        width: 100%;
        justify-content: space-between;
    }
    
    .section-header {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .coupon-form {
        flex-direction: column;
    }
    
    .payment-icons {
        justify-content: center;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Change quantity (for +/- buttons)
function changeQuantity(productId, change) {
    const input = document.querySelector(`input[data-product-id="${productId}"]`);
    const currentQuantity = parseInt(input.value);
    const newQuantity = currentQuantity + change;
    
    if (newQuantity < 1) {
        removeFromCart(productId);
        return;
    }
    
    input.value = newQuantity;
    updateQuantity(productId, newQuantity);
}

// Update quantity
function updateQuantity(productId, quantity) {
    if (quantity < 1) {
        removeFromCart(productId);
        return;
    }
    
    fetch('{{ route("cart.update") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: quantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update cart count in header
            updateCartCount(data.cart_count);
            
            // Update item total
            const cartItem = document.querySelector(`[data-product-id="${productId}"]`);
            cartItem.querySelector('.total-price').textContent = 'Rp ' + data.item_total.toLocaleString('id-ID');
            
            // Update summary
            updateCartSummary();
            
            showNotification(data.message, 'success');
        } else {
            showNotification(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan', 'error');
    });
}

// Remove from cart
function removeFromCart(productId) {
    if (!confirm('Apakah Anda yakin ingin menghapus item ini?')) {
        return;
    }
    
    fetch('{{ route("cart.remove") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_id: productId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove item from DOM
            const cartItem = document.querySelector(`[data-product-id="${productId}"]`);
            cartItem.remove();
            
            // Update cart count
            updateCartCount(data.cart_count);
            
            // Check if cart is empty
            if (data.cart_count === 0) {
                location.reload();
            } else {
                updateCartSummary();
            }
            
            showNotification(data.message, 'success');
        } else {
            showNotification(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan', 'error');
    });
}

// Clear cart
function clearCart() {
    if (!confirm('Apakah Anda yakin ingin mengosongkan keranjang?')) {
        return;
    }
    
    fetch('{{ route("cart.clear") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan', 'error');
    });
}


// Calculate shipping
function calculateShipping() {
    const city = document.getElementById('shippingCity').value;
    
    if (!city) {
        document.getElementById('shippingCost').style.display = 'none';
        document.getElementById('shippingRow').style.display = 'none';
        return;
    }
    
    fetch('{{ route("cart.shipping") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            city: city
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('shippingCost').innerHTML = 
                `Ongkir ke ${data.city}: <strong>Rp ${data.shipping_cost.toLocaleString('id-ID')}</strong>`;
            document.getElementById('shippingCost').style.display = 'block';
            
            document.getElementById('shippingAmount').textContent = 'Rp ' + data.shipping_cost.toLocaleString('id-ID');
            document.getElementById('shippingRow').style.display = 'flex';
            
            updateCartSummary();
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Quick add to cart
function quickAddToCart(productId) {
    // This would typically make an AJAX call to add the product
    showNotification('Produk ditambahkan ke keranjang', 'success');
}

// Proceed to checkout
function proceedToCheckout() {
    @auth
        // Redirect to checkout page
        window.location.href = '/checkout';
    @else
        // Redirect to login page
        if (confirm('Anda harus login terlebih dahulu. Login sekarang?')) {
            window.location.href = '{{ route("login") }}';
        }
    @endauth
}

// Update cart count in header
function updateCartCount(count) {
    const cartCountElement = document.querySelector('.cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = count;
    }
}

// Update cart summary
function updateCartSummary() {
    fetch('{{ route("cart.get") }}')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('subtotal').textContent = 'Rp ' + data.cart_total.toLocaleString('id-ID');
            // Update final total considering discount and shipping
            // This would need more complex calculation
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


// Show notification
function showNotification(message, type) {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fa fa-${type === 'success' ? 'check' : 'exclamation'}-circle"></i>
            <span>${message}</span>
        </div>
    `;
    
    // Add to page
    document.body.appendChild(notification);
    
    // Show notification
    setTimeout(() => {
        notification.classList.add('show');
    }, 100);
    
    // Hide notification
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Add notification styles
const notificationStyles = `
<style>
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: white;
    padding: 15px 20px;
    border-radius: 8px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    z-index: 9999;
    transform: translateX(400px);
    transition: transform 0.3s ease;
}

.notification.show {
    transform: translateX(0);
}

.notification.success {
    border-left: 4px solid #27ae60;
}

.notification.error {
    border-left: 4px solid #e74c3c;
}

.notification-content {
    display: flex;
    align-items: center;
    gap: 10px;
}

.notification.success .fa-check-circle {
    color: #27ae60;
}

.notification.error .fa-exclamation-circle {
    color: #e74c3c;
}
</style>
`;

document.head.insertAdjacentHTML('beforeend', notificationStyles);
</script>
@endpush
@endsection
@extends('layouts.app')

@section('title', 'Checkout - Avflowril')
@section('description', 'Checkout pesanan Anda di Avflowril - Proses pembayaran yang aman dan mudah')

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
                        <a href="{{ route('cart') }}">Keranjang</a>
                        <i class="fa fa-chevron-right"></i>
                        <span>Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->

<!-- Checkout Area Start -->
<div class="checkout-area">
    <div class="container">
        <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
            @csrf
            <div class="row">
                <!-- Checkout Form -->
                <div class="col-lg-8">
                    <div class="checkout-form">
                        <!-- Delivery Method -->
                        <div class="checkout-section">
                            <h4 class="section-title">
                                <i class="fa fa-truck me-2"></i>Metode Pengiriman
                            </h4>
                            
                            <div class="delivery-methods">
                                <div class="delivery-method">
                                    <input type="radio" id="delivery_shipping" name="delivery_method" value="shipping" 
                                           {{ old('delivery_method', 'shipping') == 'shipping' ? 'checked' : '' }} required>
                                    <label for="delivery_shipping" class="delivery-label">
                                        <div class="delivery-info">
                                            <div class="delivery-header">
                                                <i class="fa fa-shipping-fast delivery-icon"></i>
                                                <span class="delivery-name">Kirim ke Alamat</span>
                                                <span class="delivery-desc">Dikirim langsung ke alamat Anda</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                
                                <div class="delivery-method">
                                    <input type="radio" id="delivery_pickup" name="delivery_method" value="pickup" 
                                           {{ old('delivery_method') == 'pickup' ? 'checked' : '' }} required>
                                    <label for="delivery_pickup" class="delivery-label">
                                        <div class="delivery-info">
                                            <div class="delivery-header">
                                                <i class="fa fa-store delivery-icon"></i>
                                                <span class="delivery-name">Ambil di Toko</span>
                                                <span class="delivery-desc">Ambil langsung di toko kami</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            @error('delivery_method')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Shipping Information -->
                        <div class="checkout-section" id="shipping-section">
                            <h4 class="section-title">
                                <i class="fa fa-shipping-fast me-2"></i>Informasi Pengiriman
                            </h4>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="shipping_name" class="form-label">Nama Lengkap *</label>
                                    <input type="text" class="form-control" id="shipping_name" name="shipping_name" 
                                           value="{{ old('shipping_name', $user->name ?? '') }}">
                                    @error('shipping_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="shipping_phone" class="form-label">Nomor Telepon *</label>
                                    <input type="tel" class="form-control" id="shipping_phone" name="shipping_phone" 
                                           value="{{ old('shipping_phone', $user->phone ?? '') }}">
                                    @error('shipping_phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="shipping_address" class="form-label">Alamat Lengkap *</label>
                                <textarea class="form-control" id="shipping_address" name="shipping_address" 
                                          rows="3">{{ old('shipping_address', $user->address ?? '') }}</textarea>
                                @error('shipping_address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="shipping_city" class="form-label">Kota *</label>
                                    <select class="form-control" id="shipping_city" name="shipping_city">
                                        <option value="">Pilih Kota</option>
                                        <option value="jakarta" {{ old('shipping_city') == 'jakarta' ? 'selected' : '' }}>Jakarta</option>
                                        <option value="bogor" {{ old('shipping_city') == 'bogor' ? 'selected' : '' }}>Bogor</option>
                                        <option value="depok" {{ old('shipping_city') == 'depok' ? 'selected' : '' }}>Depok</option>
                                        <option value="tangerang" {{ old('shipping_city') == 'tangerang' ? 'selected' : '' }}>Tangerang</option>
                                        <option value="bekasi" {{ old('shipping_city') == 'bekasi' ? 'selected' : '' }}>Bekasi</option>
                                        <option value="bandung" {{ old('shipping_city') == 'bandung' ? 'selected' : '' }}>Bandung</option>
                                        <option value="surabaya" {{ old('shipping_city') == 'surabaya' ? 'selected' : '' }}>Surabaya</option>
                                        <option value="yogyakarta" {{ old('shipping_city') == 'yogyakarta' ? 'selected' : '' }}>Yogyakarta</option>
                                        <option value="semarang" {{ old('shipping_city') == 'semarang' ? 'selected' : '' }}>Semarang</option>
                                        <option value="medan" {{ old('shipping_city') == 'medan' ? 'selected' : '' }}>Medan</option>
                                    </select>
                                    @error('shipping_city')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="shipping_postal_code" class="form-label">Kode Pos *</label>
                                    <input type="text" class="form-control" id="shipping_postal_code" name="shipping_postal_code" 
                                           value="{{ old('shipping_postal_code') }}">
                                    @error('shipping_postal_code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Pickup Information -->
                        <div class="checkout-section" id="pickup-section" style="display: none;">
                            <h4 class="section-title">
                                <i class="fa fa-store me-2"></i>Informasi Pengambilan
                            </h4>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="pickup_name" class="form-label">Nama Pengambil *</label>
                                    <input type="text" class="form-control" id="pickup_name" name="pickup_name" 
                                           value="{{ old('pickup_name', $user->name ?? '') }}">
                                    @error('pickup_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="pickup_phone" class="form-label">Nomor Telepon *</label>
                                    <input type="tel" class="form-control" id="pickup_phone" name="pickup_phone" 
                                           value="{{ old('pickup_phone', $user->phone ?? '') }}">
                                    @error('pickup_phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Store Information -->
                            <div class="store-info-card">
                                <div class="store-header">
                                    <h5><i class="fa fa-map-marker-alt me-2"></i>Lokasi Toko Avflowril</h5>
                                </div>
                                <div class="store-details">
                                    <div class="store-address">
                                        <strong>Alamat:</strong><br>
                                        Jl. Raya Bogor No. 123, Cibinong<br>
                                        Bogor, Jawa Barat 16911
                                    </div>
                                    <div class="store-hours">
                                        <strong>Jam Operasional:</strong><br>
                                        Senin - Sabtu: 09:00 - 18:00<br>
                                        Minggu: 10:00 - 16:00
                                    </div>
                                    <div class="store-contact">
                                        <strong>Kontak:</strong><br>
                                        Telepon: (021) 8765-4321<br>
                                        WhatsApp: 0812 3456 7890
                                    </div>
                                </div>
                                <div class="store-map">
                                    <a href="https://maps.google.com/?q=Jl.+Raya+Bogor+No.+123+Cibinong+Bogor" 
                                       target="_blank" class="btn btn-outline-primary btn-sm">
                                        <i class="fa fa-map me-1"></i>Lihat di Google Maps
                                    </a>
                                </div>
                            </div>
                            
                            <div class="pickup-notes">
                                <div class="alert alert-info">
                                    <h6><i class="fa fa-info-circle me-2"></i>Informasi Penting:</h6>
                                    <ul class="mb-0">
                                        <li>Pesanan akan siap diambil dalam 1-2 hari kerja setelah pembayaran dikonfirmasi</li>
                                        <li>Bawa bukti pembayaran dan identitas diri saat pengambilan</li>
                                        <li>Jika yang mengambil bukan pemesan, bawa surat kuasa dan fotokopi identitas pemesan</li>
                                        <li>Barang yang sudah diambil tidak dapat dikembalikan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="checkout-section">
                            <h4 class="section-title">
                                <i class="fa fa-credit-card me-2"></i>Metode Pembayaran
                            </h4>
                            
                            <div class="payment-methods">
                                <div class="payment-method">
                                    <input type="radio" id="payment_bank_transfer" name="payment_method" value="bank_transfer" 
                                           {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }} required>
                                    <label for="payment_bank_transfer" class="payment-label">
                                        <div class="payment-info">
                                            <div class="payment-header">
                                                <i class="fa fa-university payment-icon"></i>
                                                <span class="payment-name">Transfer Bank</span>
                                            </div>
                                            <p class="payment-description">Transfer melalui rekening bank</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="payment-method">
                                    <input type="radio" id="payment_cod" name="payment_method" value="cod" 
                                           {{ old('payment_method') == 'cod' ? 'checked' : '' }} required>
                                    <label for="payment_cod" class="payment-label">
                                        <div class="payment-info">
                                            <div class="payment-header">
                                                <i class="fa fa-money-bill payment-icon"></i>
                                                <span class="payment-name">Bayar di Tempat (COD)</span>
                                                <span class="payment-fee">+Rp 5.000</span>
                                            </div>
                                            <p class="payment-description">Bayar saat barang diterima</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            @error('payment_method')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Order Notes -->
                        <div class="checkout-section">
                            <h4 class="section-title">
                                <i class="fa fa-sticky-note me-2"></i>Catatan Pesanan
                            </h4>
                            
                            <div class="mb-3">
                                <label for="notes" class="form-label">Catatan untuk pesanan (opsional)</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3" 
                                          placeholder="Catatan khusus untuk pesanan Anda...">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="checkout-summary">
                        <h4 class="summary-title">Ringkasan Pesanan</h4>
                        
                        <!-- Order Items -->
                        <div class="order-items">
                            <div class="order-item">
                                <div class="item-image">
                                    <img src="{{ asset('assets/images/product/small-size/1.jpg') }}" alt="Product">
                                </div>
                                <div class="item-details">
                                    <h6 class="item-name">Bucket Bunga Satin Pink</h6>
                                    <p class="item-category">Medium</p>
                                    <div class="item-price">
                                        <span class="quantity">1x</span>
                                        <span class="price">Rp 250.000</span>
                                    </div>
                                </div>
                                <div class="item-total">
                                    Rp 250.000
                                </div>
                            </div>
                        </div>

                        <!-- Order Totals -->
                        <div class="order-totals">
                            <div class="total-row">
                                <span>Subtotal</span>
                                <span>Rp 250.000</span>
                            </div>
                            
                            <div class="total-row shipping-cost-row">
                                <span>Ongkos Kirim</span>
                                <span id="shippingCostDisplay">Rp 50.000</span>
                            </div>
                            
                            <div class="total-row cod-fee" style="display: none;">
                                <span>Biaya COD</span>
                                <span>Rp 5.000</span>
                            </div>
                            
                            <div class="total-divider"></div>
                            
                            <div class="total-row final-total">
                                <span>Total</span>
                                <span id="finalTotal">Rp 300.000</span>
                            </div>
                        </div>

                        <!-- Place Order Button -->
                        <button type="submit" class="place-order-btn">
                            <i class="fa fa-lock me-2"></i>Buat Pesanan
                        </button>

                        <!-- Security Info -->
                        <div class="security-info">
                            <div class="security-item">
                                <i class="fa fa-shield-alt text-success me-2"></i>
                                <span>Transaksi Aman & Terpercaya</span>
                            </div>
                            <div class="security-item">
                                <i class="fa fa-truck text-primary me-2"></i>
                                <span>Pengiriman Cepat & Terjamin</span>
                            </div>
                            <div class="security-item">
                                <i class="fa fa-undo text-info me-2"></i>
                                <span>Garansi Uang Kembali</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Checkout Area End -->

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

.breadcrumb-nav {
    display: flex;
    align-items: center;
    gap: 8px;
    justify-content: center;
    font-size: 14px;
}

.breadcrumb-nav a {
    color: #e74c3c;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.breadcrumb-nav a:hover {
    color: #c0392b;
    text-decoration: none;
}

.breadcrumb-nav i {
    font-size: 12px;
    opacity: 0.6;
    color: #999;
}

.breadcrumb-nav span {
    color: #666;
    font-weight: 600;
}

/* Checkout Area */
.checkout-area {
    padding: 60px 0;
    background: #f8f9fa;
}

/* Checkout Form */
.checkout-form {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    margin-bottom: 30px;
}

.checkout-section {
    margin-bottom: 40px;
    padding-bottom: 30px;
    border-bottom: 2px solid #f8f9fa;
}

.checkout-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.section-title {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 25px;
    font-size: 1.3rem;
}

.form-label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 12px 15px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #e74c3c;
    box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.25);
}

/* Delivery Methods */
.delivery-methods {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}

.delivery-method {
    position: relative;
}

.delivery-method input[type="radio"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.delivery-label {
    display: block;
    background: white;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin: 0;
    height: 100%;
}

.delivery-label:hover {
    border-color: #e74c3c;
    background: #fafafa;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.delivery-method input[type="radio"]:checked + .delivery-label {
    border-color: #e74c3c;
    background: #fff5f5;
    box-shadow: 0 4px 15px rgba(231, 76, 60, 0.15);
}

.delivery-header {
    text-align: center;
}

.delivery-icon {
    font-size: 2.5rem;
    color: #e74c3c;
    margin-bottom: 15px;
    display: block;
}

.delivery-name {
    font-weight: 700;
    color: #2c3e50;
    font-size: 1.1rem;
    display: block;
    margin-bottom: 8px;
}

.delivery-desc {
    color: #666;
    font-size: 0.9rem;
    display: block;
}

/* Store Info Card */
.store-info-card {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 20px;
}

.store-header {
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e9ecef;
}

.store-header h5 {
    color: #2c3e50;
    font-weight: 600;
    margin: 0;
}

.store-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}

.store-address,
.store-hours,
.store-contact {
    background: white;
    padding: 15px;
    border-radius: 8px;
    border-left: 4px solid #e74c3c;
}

.store-address strong,
.store-hours strong,
.store-contact strong {
    color: #e74c3c;
    display: block;
    margin-bottom: 8px;
}

.store-map {
    text-align: center;
}

.pickup-notes {
    margin-top: 20px;
}

.pickup-notes .alert {
    border-left: 4px solid #17a2b8;
    background: #e3f2fd;
    border-color: #17a2b8;
}

.pickup-notes .alert h6 {
    color: #17a2b8;
    font-weight: 600;
}

.pickup-notes .alert ul {
    padding-left: 20px;
}

.pickup-notes .alert li {
    margin-bottom: 5px;
    color: #2c3e50;
}

/* Payment Methods */
.payment-methods {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.payment-method {
    position: relative;
}

.payment-method input[type="radio"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.payment-label {
    display: block;
    background: white;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin: 0;
}

.payment-label:hover {
    border-color: #e74c3c;
    background: #fafafa;
}

.payment-method input[type="radio"]:checked + .payment-label {
    border-color: #e74c3c;
    background: #fff5f5;
}

.payment-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 8px;
}

.payment-icon {
    font-size: 1.5rem;
    color: #e74c3c;
    width: 30px;
}

.payment-name {
    font-weight: 600;
    color: #2c3e50;
    flex: 1;
}

.payment-fee {
    background: #e74c3c;
    color: white;
    padding: 4px 8px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
}

.payment-description {
    color: #666;
    margin: 0;
    font-size: 0.9rem;
}

/* Checkout Summary */
.checkout-summary {
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

/* Order Items */
.order-items {
    margin-bottom: 25px;
}

.order-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px 0;
    border-bottom: 1px solid #f0f0f0;
}

.order-item:last-child {
    border-bottom: none;
}

.item-image {
    width: 60px;
    height: 60px;
    border-radius: 8px;
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
}

.item-name {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 4px;
    font-size: 0.9rem;
}

.item-category {
    color: #e74c3c;
    font-size: 0.8rem;
    margin-bottom: 8px;
}

.item-price {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.9rem;
}

.quantity {
    color: #666;
}

.price {
    color: #2c3e50;
    font-weight: 600;
}

.item-total {
    font-weight: 700;
    color: #e74c3c;
    font-size: 0.9rem;
}

/* Order Totals */
.order-totals {
    margin-bottom: 25px;
}

.total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    color: #666;
}

.total-row.discount {
    color: #27ae60;
}

.total-row.final-total {
    color: #2c3e50;
    font-weight: 700;
    font-size: 1.2rem;
    padding-top: 15px;
}

.total-divider {
    height: 2px;
    background: #f8f9fa;
    margin: 15px 0;
}

/* Place Order Button */
.place-order-btn {
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

.place-order-btn:hover {
    background: linear-gradient(135deg, #c0392b, #a93226);
    transform: translateY(-2px);
}

/* Security Info */
.security-info {
    padding-top: 20px;
    border-top: 1px solid #f0f0f0;
}

.security-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    font-size: 0.9rem;
    color: #666;
}

.security-item:last-child {
    margin-bottom: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .checkout-area {
        padding: 40px 0;
    }
    
    .checkout-form,
    .checkout-summary {
        padding: 20px;
    }
    
    .delivery-methods {
        grid-template-columns: 1fr;
    }
    
    .store-details {
        grid-template-columns: 1fr;
    }
    
    .order-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .item-details {
        width: 100%;
    }
    
    .payment-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .delivery-icon {
        font-size: 2rem;
    }
    
    .store-info-card {
        padding: 20px;
    }
}

@media (max-width: 576px) {
    .delivery-label {
        padding: 15px;
    }
    
    .delivery-name {
        font-size: 1rem;
    }
    
    .delivery-desc {
        font-size: 0.8rem;
    }
    
    .store-address,
    .store-hours,
    .store-contact {
        padding: 12px;
    }
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Handle delivery method change
    $('input[name="delivery_method"]').change(function() {
        const selectedMethod = $(this).val();
        const shippingSection = $('#shipping-section');
        const pickupSection = $('#pickup-section');
        const shippingCostRow = $('.shipping-cost-row');
        const shippingCostDisplay = $('#shippingCostDisplay');
        
        if (selectedMethod === 'shipping') {
            shippingSection.show();
            pickupSection.hide();
            shippingCostRow.show();
            
            // Make shipping fields required
            $('#shipping_name, #shipping_phone, #shipping_address, #shipping_city, #shipping_postal_code').attr('required', true);
            $('#pickup_name, #pickup_phone').attr('required', false);
            
            // Update shipping cost
            shippingCostDisplay.text('Rp 50.000');
        } else if (selectedMethod === 'pickup') {
            shippingSection.hide();
            pickupSection.show();
            shippingCostRow.hide();
            
            // Make pickup fields required
            $('#pickup_name, #pickup_phone').attr('required', true);
            $('#shipping_name, #shipping_phone, #shipping_address, #shipping_city, #shipping_postal_code').attr('required', false);
            
            // Set shipping cost to 0
            shippingCostDisplay.text('Rp 0');
        }
        
        updateTotal();
    });
    
    // Handle payment method change
    $('input[name="payment_method"]').change(function() {
        updateTotal();
    });
    
    // Function to update total
    function updateTotal() {
        const selectedDelivery = $('input[name="delivery_method"]:checked').val();
        const selectedPayment = $('input[name="payment_method"]:checked').val();
        const codFeeRow = $('.cod-fee');
        const finalTotalElement = $('#finalTotal');
        
        // Get base total
        let baseTotal = 250000;
        let shippingCost = 0;
        
        // Add shipping cost if delivery method is shipping
        if (selectedDelivery === 'shipping') {
            shippingCost = 50000;
        }
        
        // Calculate total
        let total = baseTotal + shippingCost;
        
        // Add COD fee if applicable
        if (selectedPayment === 'cod') {
            codFeeRow.show();
            total += 5000;
        } else {
            codFeeRow.hide();
        }
        
        // Update final total
        finalTotalElement.text('Rp ' + total.toLocaleString('id-ID'));
    }
    
    // Handle city change for shipping cost
    $('#shipping_city').change(function() {
        const city = $(this).val();
        
        if (city) {
            // You can add AJAX call here to calculate shipping cost
            // For now, we'll use the existing shipping cost
        }
    });
    
    // Form validation
    $('#checkoutForm').submit(function(e) {
        let isValid = true;
        const selectedDelivery = $('input[name="delivery_method"]:checked').val();
        
        // Check delivery method specific required fields
        if (selectedDelivery === 'shipping') {
            const shippingFields = ['#shipping_name', '#shipping_phone', '#shipping_address', '#shipping_city', '#shipping_postal_code'];
            shippingFields.forEach(function(field) {
                if (!$(field).val()) {
                    isValid = false;
                    $(field).addClass('is-invalid');
                } else {
                    $(field).removeClass('is-invalid');
                }
            });
        } else if (selectedDelivery === 'pickup') {
            const pickupFields = ['#pickup_name', '#pickup_phone'];
            pickupFields.forEach(function(field) {
                if (!$(field).val()) {
                    isValid = false;
                    $(field).addClass('is-invalid');
                } else {
                    $(field).removeClass('is-invalid');
                }
            });
        }
        
        // Check other required fields
        $(this).find('[required]').each(function() {
            if (!$(this).val()) {
                isValid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang wajib diisi.');
            
            // Scroll to first invalid field
            const firstInvalid = $('.is-invalid').first();
            if (firstInvalid.length) {
                $('html, body').animate({
                    scrollTop: firstInvalid.offset().top - 100
                }, 500);
            }
        }
    });
    
    // Initialize on page load
    $('input[name="delivery_method"]:checked').trigger('change');
});
</script>
@endpush
@endsection
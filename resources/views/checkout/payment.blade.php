@extends('layouts.app')

@section('title', 'Pembayaran - Avflowril')
@section('description', 'Halaman pembayaran untuk pesanan Anda di Avflowril')

@section('content')
<!-- Payment Header -->
<div class="payment-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="header-content">
                    <div class="breadcrumb-nav">
                        <a href="{{ route('home') }}">Home</a>
                        <i class="fa fa-chevron-right"></i>
                        <a href="{{ route('checkout') }}">Checkout</a>
                        <i class="fa fa-chevron-right"></i>
                        <span>Pembayaran</span>
                    </div>
                    <h1 class="page-title">
                        <i class="fa fa-credit-card me-3"></i>Pembayaran
                    </h1>
                    <p class="page-subtitle">Selesaikan pembayaran untuk pesanan #{{ $order->order_number }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="payment-status-card">
                    <div class="status-icon">
                        <i class="fa fa-clock"></i>
                    </div>
                    <div class="status-info">
                        <h6>Status Pembayaran</h6>
                        <span class="status-badge pending">Menunggu Pembayaran</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Area Start -->
<div class="payment-area">
    <div class="container">
        <!-- Payment Timer Alert -->
        <div class="payment-timer-alert">
            <div class="timer-content">
                <div class="timer-icon">
                    <i class="fa fa-hourglass-half"></i>
                </div>
                <div class="timer-info">
                    <h6>Selesaikan pembayaran dalam:</h6>
                    <div class="timer-display" id="paymentTimer">24:00:00</div>
                </div>
                <div class="timer-note">
                    <small>Pesanan akan dibatalkan otomatis jika pembayaran tidak diselesaikan</small>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Payment Form Section -->
            <div class="col-lg-8">
                <!-- Order Summary Card -->
                <div class="payment-form-section">
                    <div class="order-summary-card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <i class="fa fa-receipt me-2"></i>Ringkasan Pesanan
                            </h4>
                            <span class="order-number">{{ $order->order_number }}</span>
                        </div>
                        <div class="card-body">
                            <div class="order-info-grid">
                                <div class="info-item">
                                    <div class="info-label">Total Pembayaran</div>
                                    <div class="info-value total-amount">{{ $order->formatted_total }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Metode Pembayaran</div>
                                    <div class="info-value">{{ $paymentDetails['name'] }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Status</div>
                                    <div class="info-value">
                                        <span class="status-badge pending">Menunggu Pembayaran</span>
                                    </div>
                                </div>
                                @if(isset($order->shipping_address['delivery_method']) && $order->shipping_address['delivery_method'] === 'pickup')
                                    <div class="info-item">
                                        <div class="info-label">Metode Pengiriman</div>
                                        <div class="info-value">
                                            <span class="delivery-badge pickup">
                                                <i class="fa fa-store me-1"></i>Ambil di Toko
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <div class="info-item">
                                        <div class="info-label">Metode Pengiriman</div>
                                        <div class="info-value">
                                            <span class="delivery-badge shipping">
                                                <i class="fa fa-shipping-fast me-1"></i>Kirim ke Alamat
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($order->payment_method !== 'cod')
                    <!-- Payment Instructions Card -->
                    <div class="payment-instructions-card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <i class="fa fa-info-circle me-2"></i>Cara Pembayaran
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="instruction-steps">
                                @foreach($paymentDetails['instructions'] as $index => $instruction)
                                    <div class="step-item">
                                        <div class="step-number">{{ $index + 1 }}</div>
                                        <div class="step-content">{{ $instruction }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Payment Accounts Card -->
                    <div class="payment-accounts-card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <i class="fa fa-university me-2"></i>
                                @if(isset($paymentDetails['banks']))
                                    Rekening Bank
                                @else
                                    E-Wallet
                                @endif
                            </h4>
                            <span class="account-note">Pilih salah satu untuk transfer</span>
                        </div>
                        <div class="card-body">
                            @if(isset($paymentDetails['banks']))
                                <div class="accounts-grid">
                                    @foreach($paymentDetails['banks'] as $bank)
                                        <div class="account-card bank-account">
                                            <div class="account-header">
                                                <div class="bank-logo">
                                                    <i class="fa fa-university"></i>
                                                </div>
                                                <div class="bank-name">{{ $bank['name'] }}</div>
                                            </div>
                                            <div class="account-details">
                                                <div class="account-number">{{ $bank['account'] }}</div>
                                                <div class="account-holder">a.n {{ $bank['holder'] }}</div>
                                            </div>
                                            <button class="copy-btn" onclick="copyToClipboard('{{ $bank['account'] }}', 'Nomor rekening {{ $bank['name'] }} berhasil disalin!')">
                                                <i class="fa fa-copy"></i>
                                                <span>Salin</span>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if(isset($paymentDetails['wallets']))
                                <div class="accounts-grid">
                                    @foreach($paymentDetails['wallets'] as $wallet)
                                        <div class="account-card wallet-account">
                                            <div class="account-header">
                                                <div class="wallet-logo">
                                                    <i class="fa fa-mobile-alt"></i>
                                                </div>
                                                <div class="wallet-name">{{ $wallet['name'] }}</div>
                                            </div>
                                            <div class="account-details">
                                                <div class="wallet-number">{{ $wallet['number'] }}</div>
                                            </div>
                                            <button class="copy-btn" onclick="copyToClipboard('{{ $wallet['number'] }}', 'Nomor {{ $wallet['name'] }} berhasil disalin!')">
                                                <i class="fa fa-copy"></i>
                                                <span>Salin</span>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                        <!-- Payment Confirmation Form -->
                    <div class="payment-confirmation-card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <i class="fa fa-upload me-2"></i>Konfirmasi Pembayaran
                            </h4>
                            <span class="form-note">Upload bukti transfer Anda</span>
                        </div>
                        <div class="card-body">
                            <!-- Display any errors -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <div class="alert-icon">
                                        <i class="fa fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="alert-content">
                                        <h6>Terjadi Kesalahan:</h6>
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <!-- Display success message -->
                            @if (session('success'))
                                <div class="alert alert-success">
                                    <div class="alert-icon">
                                        <i class="fa fa-check-circle"></i>
                                    </div>
                                    <div class="alert-content">
                                        {{ session('success') }}
                                    </div>
                                </div>
                            @endif

                            <!-- Display error message -->
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    <div class="alert-icon">
                                        <i class="fa fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="alert-content">
                                        {{ session('error') }}
                                    </div>
                                </div>
                            @endif
                            
                            <form action="{{ route('checkout.confirm-payment', $order->order_number) }}" method="POST" enctype="multipart/form-data" class="payment-form">
                                @csrf
                                
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label for="sender_name" class="form-label">
                                            <i class="fa fa-user me-2"></i>Nama Pengirim
                                        </label>
                                        <input type="text" class="form-control" id="sender_name" name="sender_name" 
                                               value="{{ old('sender_name', $order->user->name) }}" required>
                                        @error('sender_name')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="transfer_amount" class="form-label">
                                            <i class="fa fa-money-bill me-2"></i>Jumlah Transfer
                                        </label>
                                        <input type="number" class="form-control" id="transfer_amount" name="transfer_amount" 
                                               value="{{ old('transfer_amount', $order->total_amount) }}" required>
                                        @error('transfer_amount')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="payment_proof" class="form-label">
                                        <i class="fa fa-image me-2"></i>Bukti Pembayaran
                                    </label>
                                    <div class="file-upload-area" id="file-upload-area">
                                        <input type="file" class="form-control" id="payment_proof" name="payment_proof" 
                                               accept="image/*" required>
                                        <div class="upload-placeholder" id="upload-placeholder">
                                            <i class="fa fa-cloud-upload-alt"></i>
                                            <span>Pilih file atau drag & drop di sini</span>
                                            <small>JPG, PNG, GIF (Max 2MB)</small>
                                        </div>
                                        
                                        <!-- File Preview Area -->
                                        <div class="file-preview" id="file-preview" style="display: none;">
                                            <div class="preview-header">
                                                <i class="fa fa-check-circle text-success me-2"></i>
                                                <span>File berhasil dipilih</span>
                                                <button type="button" class="remove-file-btn" id="remove-file-btn">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                            <div class="preview-content">
                                                <div class="preview-image">
                                                    <img id="preview-img" src="" alt="Preview">
                                                </div>
                                                <div class="file-info">
                                                    <div class="file-name" id="file-name"></div>
                                                    <div class="file-size" id="file-size"></div>
                                                    <div class="file-type" id="file-type"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @error('payment_proof')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                    
                                    <!-- Success Alert -->
                                    <div id="upload-success-alert" class="upload-alert success-alert" style="display: none;">
                                        <div class="alert-icon">
                                            <i class="fa fa-check-circle"></i>
                                        </div>
                                        <div class="alert-content">
                                            <strong>Berhasil!</strong> Bukti pembayaran telah dipilih. Klik "Konfirmasi Pembayaran" untuk melanjutkan.
                                        </div>
                                    </div>
                                    
                                    <!-- Error Alert -->
                                    <div id="upload-error-alert" class="upload-alert error-alert" style="display: none;">
                                        <div class="alert-icon">
                                            <i class="fa fa-exclamation-triangle"></i>
                                        </div>
                                        <div class="alert-content">
                                            <strong>Error!</strong> <span id="error-message"></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="submit" class="confirm-payment-btn">
                                    <i class="fa fa-check me-2"></i>
                                    <span>Konfirmasi Pembayaran</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                        <!-- COD Instructions -->
                        <div class="cod-instructions">
                            <h4 class="section-title">
                                <i class="fa fa-money-bill-wave me-2"></i>Pembayaran COD (Cash on Delivery)
                            </h4>
                            
                            <div class="instructions">
                                <ol class="instruction-list">
                                    @foreach($paymentDetails['instructions'] as $instruction)
                                        <li>{{ $instruction }}</li>
                                    @endforeach
                                </ol>
                            </div>
                            
                            <div class="cod-info">
                                <div class="info-card">
                                    <i class="fa fa-info-circle text-info"></i>
                                    <div>
                                        <h6>Informasi Penting:</h6>
                                        <p>Pesanan Anda akan diproses dan dikirim. Pembayaran dilakukan saat barang diterima dengan biaya tambahan COD sebesar Rp 5.000.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <a href="{{ route('checkout.success', $order->order_number) }}" class="confirm-payment-btn">
                                <i class="fa fa-check me-2"></i>Konfirmasi Pesanan COD
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Payment Summary Sidebar -->
            <div class="col-lg-4">
                <div class="payment-summary">
                <!-- Order Items Card -->
                <div class="sidebar-card order-items-card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="fa fa-shopping-bag me-2"></i>Item Pesanan
                        </h4>
                        <span class="items-count">{{ $order->orderItems->count() }} item</span>
                    </div>
                    <div class="card-body">
                        <div class="order-items">
                            @foreach($order->orderItems as $item)
                                <div class="order-item">
                                    <div class="item-image">
                                        <img src="{{ asset($item->product->main_image ?? 'assets/images/product/default.jpg') }}" 
                                             alt="{{ $item->product->name }}">
                                    </div>
                                    <div class="item-details">
                                        <h6 class="item-name">{{ $item->product->name }}</h6>
                                        <div class="item-meta">
                                            <span class="quantity">{{ $item->quantity }}x</span>
                                            <span class="price">{{ $item->formatted_price }}</span>
                                        </div>
                                    </div>
                                    <div class="item-total">
                                        {{ $item->formatted_total }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Order Totals Card -->
                <div class="sidebar-card order-totals-card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="fa fa-calculator me-2"></i>Rincian Pembayaran
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="order-totals">
                            <div class="total-row">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                            </div>
                            
                            @if($order->shipping_amount > 0)
                                <div class="total-row">
                                    <span>Ongkos Kirim</span>
                                    <span>Rp {{ number_format($order->shipping_amount, 0, ',', '.') }}</span>
                                </div>
                            @endif
                            
                            @if($order->discount_amount > 0)
                                <div class="total-row discount">
                                    <span>Diskon</span>
                                    <span>-Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                                </div>
                            @endif
                            
                            @if($order->payment_method === 'cod')
                                <div class="total-row">
                                    <span>Biaya COD</span>
                                    <span>Rp 5.000</span>
                                </div>
                            @endif
                            
                            <div class="total-divider"></div>
                            
                            <div class="total-row final-total">
                                <span>Total Pembayaran</span>
                                <span>{{ $order->formatted_total }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- WhatsApp Support Card -->
                <div class="sidebar-card whatsapp-card">
                    <div class="card-body">
                        <div class="whatsapp-content">
                            <div class="whatsapp-icon">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div class="whatsapp-text">
                                <h5>Butuh Bantuan?</h5>
                                <p>Hubungi customer service kami untuk bantuan pembayaran</p>
                            </div>
                        </div>
                        <button class="whatsapp-btn" onclick="sendWhatsAppMessage()">
                            <i class="fab fa-whatsapp me-2"></i>
                            <span>Chat WhatsApp</span>
                        </button>
                        <div class="whatsapp-note">
                            <small>
                                <i class="fa fa-info-circle me-1"></i>
                                Pesan otomatis akan dikirim dengan detail pesanan
                            </small>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Payment Area End -->

@push('styles')
<style>
/* Modern Payment Page Styles */
:root {
    --primary-color: #e74c3c;
    --primary-dark: #c0392b;
    --secondary-color: #2c3e50;
    --success-color: #27ae60;
    --warning-color: #f39c12;
    --info-color: #3498db;
    --light-bg: #f8f9fa;
    --white: #ffffff;
    --border-color: #e9ecef;
    --text-muted: #6c757d;
    --shadow: 0 4px 20px rgba(0,0,0,0.08);
    --shadow-hover: 0 8px 30px rgba(0,0,0,0.12);
    --border-radius: 12px;
    --transition: all 0.3s ease;
}

/* Payment Header */
.payment-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 40px 0;
    color: white;
}

.header-content {
    margin-bottom: 0;
}

.breadcrumb-nav {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 15px;
    font-size: 0.9rem;
}

.breadcrumb-nav a {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
    transition: var(--transition);
}

.breadcrumb-nav a:hover {
    color: white;
}

.breadcrumb-nav i {
    font-size: 0.7rem;
    opacity: 0.6;
}

.breadcrumb-nav span {
    color: white;
    font-weight: 500;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 10px;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.page-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 0;
}

.payment-status-card {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: var(--border-radius);
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
}

.status-icon {
    width: 50px;
    height: 50px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.status-info h6 {
    margin: 0 0 5px 0;
    font-weight: 600;
    opacity: 0.9;
}

.status-badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
}

.status-badge.pending {
    background: rgba(243, 156, 18, 0.2);
    color: #f39c12;
    border: 1px solid rgba(243, 156, 18, 0.3);
}

.delivery-badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    display: inline-flex;
    align-items: center;
}

.delivery-badge.pickup {
    background: rgba(52, 152, 219, 0.2);
    color: #3498db;
    border: 1px solid rgba(52, 152, 219, 0.3);
}

.delivery-badge.shipping {
    background: rgba(39, 174, 96, 0.2);
    color: #27ae60;
    border: 1px solid rgba(39, 174, 96, 0.3);
}

/* Payment Area */
.payment-area {
    padding: 40px 0 80px;
    background: var(--light-bg);
    min-height: 100vh;
}

/* Payment Timer Alert */
.payment-timer-alert {
    background: linear-gradient(135deg, #fff3cd, #ffeaa7);
    border: 1px solid #ffd93d;
    border-radius: var(--border-radius);
    padding: 20px;
    margin-bottom: 30px;
    box-shadow: var(--shadow);
}

.timer-content {
    display: flex;
    align-items: center;
    gap: 20px;
}

.timer-icon {
    width: 60px;
    height: 60px;
    background: var(--warning-color);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.timer-info {
    flex: 1;
}

.timer-info h6 {
    margin: 0 0 5px 0;
    color: #856404;
    font-weight: 600;
}

.timer-display {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--primary-color);
    font-family: 'Courier New', monospace;
}

.timer-note {
    margin-left: auto;
    text-align: right;
    color: #856404;
}

/* Payment Form Section */
.payment-form-section {
    background: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    padding: 30px;
    margin-bottom: 30px;
}

.payment-summary {
    position: sticky;
    top: 20px;
}

/* Section Styles */
.payment-section {
    margin-bottom: 30px;
    padding-bottom: 25px;
    border-bottom: 2px solid var(--light-bg);
}

.payment-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.section-title {
    color: var(--secondary-color);
    font-weight: 600;
    margin-bottom: 20px;
    font-size: 1.2rem;
    display: flex;
    align-items: center;
}

.section-title i {
    color: var(--primary-color);
    margin-right: 10px;
}

/* Card Styles */
.order-summary-card,
.payment-instructions-card,
.payment-accounts-card,
.payment-confirmation-card,
.sidebar-card {
    background: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    margin-bottom: 25px;
    overflow: hidden;
    transition: var(--transition);
}

.order-summary-card:hover,
.payment-instructions-card:hover,
.payment-accounts-card:hover,
.payment-confirmation-card:hover,
.sidebar-card:hover {
    box-shadow: var(--shadow-hover);
    transform: translateY(-2px);
}

.card-header {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: white;
    padding: 20px 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-title {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 600;
}

.order-number,
.items-count,
.account-note,
.form-note {
    background: rgba(255,255,255,0.2);
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.card-body {
    padding: 25px;
}

/* Order Info Grid */
.order-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 15px;
}

.info-item {
    text-align: center;
    padding: 20px;
    background: var(--light-bg);
    border-radius: var(--border-radius);
    border: 2px solid transparent;
    transition: var(--transition);
}

.info-item:hover {
    border-color: var(--primary-color);
    background: #fff5f5;
}

.info-label {
    font-size: 0.9rem;
    color: var(--text-muted);
    font-weight: 500;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-value {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--secondary-color);
}

.info-value.total-amount {
    color: var(--primary-color);
    font-size: 1.3rem;
}

/* Instruction Steps */
.instruction-steps {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.step-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: var(--border-radius);
    border-left: 4px solid var(--primary-color);
}

.step-number {
    width: 30px;
    height: 30px;
    background: var(--primary-color);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.9rem;
    flex-shrink: 0;
}

.step-content {
    color: var(--secondary-color);
    line-height: 1.6;
}

/* Account Cards */
.accounts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
}

.account-card {
    border: 2px solid var(--border-color);
    border-radius: var(--border-radius);
    padding: 20px;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.account-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
}

.account-card:hover {
    border-color: var(--primary-color);
    background: #fff5f5;
    transform: translateY(-2px);
    box-shadow: var(--shadow);
}

.account-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
}

.bank-logo,
.wallet-logo {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.bank-name,
.wallet-name {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--secondary-color);
}

.account-details {
    margin-bottom: 15px;
}

.account-number,
.wallet-number {
    font-family: 'Courier New', monospace;
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 5px;
    letter-spacing: 1px;
}

.account-holder {
    color: var(--text-muted);
    font-size: 0.9rem;
}

.copy-btn {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: white;
    border: none;
    border-radius: 25px;
    padding: 8px 16px;
    font-size: 0.9rem;
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: 8px;
    width: 100%;
    justify-content: center;
}

.copy-btn:hover {
    background: linear-gradient(135deg, var(--primary-dark), #a93226);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
}

/* Payment Form */
.payment-form {
    margin-top: 20px;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: flex;
    align-items: center;
    font-weight: 600;
    color: var(--secondary-color);
    margin-bottom: 8px;
    font-size: 0.95rem;
}

.form-label i {
    color: var(--primary-color);
    width: 20px;
}

.form-control {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid var(--border-color);
    border-radius: var(--border-radius);
    font-size: 0.95rem;
    transition: var(--transition);
    background: white;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1);
}

.form-error {
    color: #dc3545;
    font-size: 0.85rem;
    margin-top: 5px;
}

/* File Upload */
.file-upload-area {
    position: relative;
    border: 2px dashed var(--border-color);
    border-radius: var(--border-radius);
    padding: 30px;
    text-align: center;
    transition: var(--transition);
    background: #fafafa;
    cursor: pointer;
}

.file-upload-area:hover {
    border-color: var(--primary-color);
    background: #fff5f5;
}

.file-upload-area input[type="file"] {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 2;
}

.upload-placeholder {
    pointer-events: none;
}

.upload-placeholder i {
    font-size: 2rem;
    color: var(--primary-color);
    margin-bottom: 10px;
    display: block;
}

.upload-placeholder span {
    display: block;
    font-weight: 600;
    color: var(--secondary-color);
    margin-bottom: 5px;
}

.upload-placeholder small {
    color: var(--text-muted);
}

/* File Preview Styles */
.file-preview {
    background: #f8f9fa;
    border: 2px solid var(--success-color);
    border-radius: var(--border-radius);
    padding: 20px;
    margin-top: 15px;
}

.preview-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 1px solid #dee2e6;
}

.preview-header span {
    font-weight: 600;
    color: var(--success-color);
}

.remove-file-btn {
    background: #dc3545;
    color: white;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition);
}

.remove-file-btn:hover {
    background: #c82333;
    transform: scale(1.1);
}

.preview-content {
    display: flex;
    gap: 20px;
    align-items: center;
}

.preview-image {
    width: 100px;
    height: 100px;
    border-radius: var(--border-radius);
    overflow: hidden;
    border: 2px solid #dee2e6;
    flex-shrink: 0;
}

.preview-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.file-info {
    flex: 1;
}

.file-name {
    font-weight: 600;
    color: var(--secondary-color);
    margin-bottom: 5px;
    font-size: 1rem;
}

.file-size {
    color: var(--text-muted);
    font-size: 0.9rem;
    margin-bottom: 3px;
}

.file-type {
    color: var(--primary-color);
    font-size: 0.85rem;
    font-weight: 500;
    text-transform: uppercase;
}

/* Upload Alert Styles */
.upload-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 16px;
    border-radius: var(--border-radius);
    margin-top: 15px;
    animation: slideIn 0.3s ease-out;
}

.success-alert {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
}

.error-alert {
    background: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}

.upload-alert .alert-icon {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 1.2rem;
}

.upload-alert .alert-content {
    flex: 1;
    line-height: 1.5;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* File upload area states */
.file-upload-area.dragover {
    border-color: var(--primary-color);
    background: #fff5f5;
    transform: scale(1.02);
}

.file-upload-area.has-file {
    border-color: var(--success-color);
    background: #f8fff8;
}


/* Confirm Button */
.confirm-payment-btn {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: white;
    border: none;
    border-radius: var(--border-radius);
    padding: 16px 32px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    text-decoration: none;
    margin-top: 20px;
}

.confirm-payment-btn:hover {
    background: linear-gradient(135deg, var(--primary-dark), #a93226);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(231, 76, 60, 0.3);
    color: white;
}

/* Sidebar Cards */
.sidebar-card {
    position: sticky;
    top: 20px;
}

.order-items {
    max-height: 300px;
    overflow-y: auto;
}

.order-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #f0f0f0;
}

.order-item:last-child {
    border-bottom: none;
}

.item-image {
    width: 50px;
    height: 50px;
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
    min-width: 0;
}

.item-name {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--secondary-color);
    margin-bottom: 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.item-meta {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.8rem;
}

.quantity {
    color: var(--text-muted);
}

.price {
    color: var(--secondary-color);
    font-weight: 600;
}

.item-total {
    font-weight: 700;
    color: var(--primary-color);
    font-size: 0.9rem;
}

/* Order Totals */
.total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    font-size: 0.95rem;
}

.total-row.discount {
    color: var(--success-color);
}

.total-row.final-total {
    border-top: 2px solid var(--border-color);
    padding-top: 15px;
    margin-top: 10px;
    font-weight: 700;
    font-size: 1.1rem;
    color: var(--primary-color);
}

.total-divider {
    height: 1px;
    background: var(--border-color);
    margin: 15px 0;
}

/* WhatsApp Card */
.whatsapp-card {
    background: linear-gradient(135deg, #e8f5e8, #f0f8f0);
    border: 2px solid #25d366;
}

.whatsapp-content {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.whatsapp-icon {
    width: 60px;
    height: 60px;
    background: #25d366;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.whatsapp-text h5 {
    margin: 0 0 5px 0;
    color: #25d366;
    font-weight: 700;
}

.whatsapp-text p {
    margin: 0;
    color: var(--secondary-color);
    font-size: 0.9rem;
    line-height: 1.4;
}

.whatsapp-btn {
    background: linear-gradient(135deg, #25d366, #128c7e);
    color: white;
    border: none;
    border-radius: 25px;
    padding: 12px 20px;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-bottom: 10px;
}

.whatsapp-btn:hover {
    background: linear-gradient(135deg, #128c7e, #075e54);
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
}

.whatsapp-note {
    text-align: center;
    color: var(--text-muted);
    font-size: 0.8rem;
}

/* Alert Styles */
.alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 16px;
    border-radius: var(--border-radius);
    margin-bottom: 20px;
}

.alert-icon {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.alert-content {
    flex: 1;
}

.alert-content h6 {
    margin: 0 0 8px 0;
    font-weight: 600;
}

.alert-content ul {
    margin: 0;
    padding-left: 20px;
}

.alert-success {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
}

.alert-danger {
    background: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}

/* Toast Notification */
.copy-toast {
    position: fixed;
    top: 20px;
    right: 20px;
    background: var(--success-color);
    color: white;
    padding: 12px 20px;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    z-index: 9999;
    transform: translateX(400px);
    transition: var(--transition);
    font-weight: 500;
}

.copy-toast.show {
    transform: translateX(0);
}

/* Responsive Design */
@media (max-width: 768px) {
    .payment-header {
        padding: 30px 0;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .payment-status-card {
        margin-top: 20px;
    }
    
    .timer-content {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .timer-note {
        margin-left: 0;
        text-align: center;
    }
    
    .order-info-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    
    .accounts-grid {
        grid-template-columns: 1fr;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .whatsapp-content {
        flex-direction: column;
        text-align: center;
    }
    
    .payment-summary {
        position: static;
        margin-top: 30px;
    }
    
    .payment-form-section {
        padding: 20px;
    }
}

@media (max-width: 576px) {
    .payment-area {
        padding: 20px 0 60px;
    }
    
    .card-body {
        padding: 20px;
    }
    
    .payment-form-section {
        padding: 15px;
    }
    
    .timer-display {
        font-size: 1.5rem;
    }
    
    .account-card {
        padding: 15px;
    }
    
    .order-info-grid {
        grid-template-columns: 1fr;
        gap: 10px;
    }
    
    .info-item {
        padding: 15px;
    }
    
    /* Mobile file upload styles */
    .file-upload-area {
        padding: 20px;
    }
    
    .preview-content {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .preview-image {
        width: 80px;
        height: 80px;
        margin: 0 auto;
    }
    
    .upload-alert {
        padding: 12px;
        font-size: 0.9rem;
    }
    
    .upload-alert .alert-content {
        font-size: 0.85rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    console.log('Document ready, initializing file upload');
    
    // File upload functionality
    const fileInput = $('#payment_proof');
    const fileUploadArea = $('#file-upload-area');
    const uploadPlaceholder = $('#upload-placeholder');
    const filePreview = $('#file-preview');
    const successAlert = $('#upload-success-alert');
    const errorAlert = $('#upload-error-alert');
    const removeFileBtn = $('#remove-file-btn');
    
    // Check if elements exist
    console.log('Elements found:', {
        fileInput: fileInput.length,
        fileUploadArea: fileUploadArea.length,
        uploadPlaceholder: uploadPlaceholder.length,
        filePreview: filePreview.length,
        successAlert: successAlert.length,
        errorAlert: errorAlert.length,
        removeFileBtn: removeFileBtn.length
    });
    
    // If elements don't exist, try alternative selectors
    if (fileInput.length === 0) {
        console.error('File input not found!');
        return;
    }
    
    // Test file input functionality
    console.log('Testing file input click...');
    fileInput.on('click', function() {
        console.log('File input clicked');
    });
    
    // Make upload area clickable
    if (fileUploadArea.length > 0) {
        fileUploadArea.on('click', function(e) {
            // Only trigger if not clicking on the file input itself
            if (e.target !== fileInput[0]) {
                console.log('Upload area clicked, triggering file input');
                fileInput.trigger('click');
            }
        });
    }

    // File input change handler
    fileInput.on('change', function() {
        console.log('File input changed');
        const file = this.files[0];
        console.log('Selected file:', file);
        handleFileSelection(file);
    });

    // Remove file button handler
    if (removeFileBtn.length > 0) {
        removeFileBtn.on('click', function() {
            clearFileSelection();
        });
    }
    
    // Also handle dynamically created remove buttons
    $(document).on('click', '.remove-file-btn', function() {
        clearFileSelection();
    });

    // Drag and drop handlers
    if (fileUploadArea.length > 0) {
        fileUploadArea.on('dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).addClass('dragover');
        });

        fileUploadArea.on('dragleave', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('dragover');
        });

        fileUploadArea.on('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('dragover');
            
            const files = e.originalEvent.dataTransfer.files;
            if (files.length > 0) {
                const file = files[0];
                // Set the file to the input
                try {
                    const dt = new DataTransfer();
                    dt.items.add(file);
                    fileInput[0].files = dt.files;
                    handleFileSelection(file);
                } catch (e) {
                    console.log('DataTransfer not supported, handling file directly');
                    handleFileSelection(file);
                }
            }
        });
    }

    function handleFileSelection(file) {
        console.log('handleFileSelection called with:', file);
        
        // Hide all alerts first
        hideAllAlerts();

        if (!file) {
            console.log('No file selected, clearing selection');
            clearFileSelection();
            return;
        }

        console.log('File details:', {
            name: file.name,
            type: file.type,
            size: file.size
        });

        // Validate file type
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (!allowedTypes.includes(file.type)) {
            console.log('Invalid file type:', file.type);
            showErrorAlert('Format file tidak didukung. Silakan pilih file JPG, PNG, atau GIF.');
            clearFileSelection();
            return;
        }

        // Validate file size (2MB = 2 * 1024 * 1024 bytes)
        const maxSize = 2 * 1024 * 1024;
        if (file.size > maxSize) {
            console.log('File too large:', file.size);
            showErrorAlert('Ukuran file terlalu besar. Maksimal 2MB.');
            clearFileSelection();
            return;
        }

        console.log('File validation passed, showing preview');
        
        // Show file preview
        showFilePreview(file);
        showSuccessAlert();
        
        // Add has-file class to upload area
        fileUploadArea.addClass('has-file');
    }

    function showFilePreview(file) {
        console.log('showFilePreview called');
        
        // Check if preview elements exist
        if (filePreview.length === 0) {
            console.log('Preview elements not found, creating simple preview');
            // Create a simple preview if elements don't exist
            const simplePreview = $(`
                <div class="simple-file-preview" style="background: #e8f5e8; border: 2px solid #28a745; border-radius: 8px; padding: 15px; margin-top: 10px;">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <i class="fa fa-check-circle" style="color: #28a745; font-size: 1.2rem;"></i>
                            <div>
                                <div style="font-weight: 600; color: #155724;">${file.name}</div>
                                <div style="font-size: 0.9rem; color: #6c757d;">${formatFileSize(file.size)} - ${file.type.split('/')[1].toUpperCase()}</div>
                            </div>
                        </div>
                        <button type="button" class="remove-file-btn" style="background: #dc3545; color: white; border: none; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            `);
            fileUploadArea.after(simplePreview);
            return;
        }
        
        // Hide placeholder and show preview
        console.log('Hiding placeholder, showing preview');
        uploadPlaceholder.hide();
        filePreview.show();

        // Set file info
        console.log('Setting file info');
        $('#file-name').text(file.name);
        $('#file-size').text(formatFileSize(file.size));
        $('#file-type').text(file.type.split('/')[1].toUpperCase());

        // Show image preview
        console.log('Reading file for preview');
        const reader = new FileReader();
        reader.onload = function(e) {
            console.log('File read successfully, setting preview image');
            $('#preview-img').attr('src', e.target.result);
        };
        reader.onerror = function(e) {
            console.error('Error reading file:', e);
        };
        reader.readAsDataURL(file);
    }

    function clearFileSelection() {
        console.log('clearFileSelection called');
        
        // Clear file input
        fileInput.val('');
        
        // Hide preview and show placeholder
        if (filePreview.length > 0) filePreview.hide();
        if (uploadPlaceholder.length > 0) uploadPlaceholder.show();
        
        // Remove any simple previews
        $('.simple-file-preview').remove();
        
        // Hide alerts
        hideAllAlerts();
        
        // Remove has-file class
        if (fileUploadArea.length > 0) fileUploadArea.removeClass('has-file');
    }

    function showSuccessAlert() {
        hideAllAlerts();
        
        if (successAlert.length > 0) {
            successAlert.fadeIn();
            // Auto hide after 5 seconds
            setTimeout(function() {
                successAlert.fadeOut();
            }, 5000);
        } else {
            // Fallback: create simple success alert
            const alert = $(`
                <div class="simple-success-alert" style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 12px; border-radius: 8px; margin-top: 10px; display: flex; align-items: center; gap: 10px;">
                    <i class="fa fa-check-circle"></i>
                    <span><strong>Berhasil!</strong> Bukti pembayaran telah dipilih. Klik "Konfirmasi Pembayaran" untuk melanjutkan.</span>
                </div>
            `);
            fileUploadArea.after(alert);
            setTimeout(function() {
                alert.fadeOut();
            }, 5000);
        }
    }

    function showErrorAlert(message) {
        hideAllAlerts();
        
        if (errorAlert.length > 0) {
            $('#error-message').text(message);
            errorAlert.fadeIn();
            // Auto hide after 5 seconds
            setTimeout(function() {
                errorAlert.fadeOut();
            }, 5000);
        } else {
            // Fallback: create simple error alert
            const alert = $(`
                <div class="simple-error-alert" style="background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 12px; border-radius: 8px; margin-top: 10px; display: flex; align-items: center; gap: 10px;">
                    <i class="fa fa-exclamation-triangle"></i>
                    <span><strong>Error!</strong> ${message}</span>
                </div>
            `);
            fileUploadArea.after(alert);
            setTimeout(function() {
                alert.fadeOut();
            }, 5000);
        }
    }

    function hideAllAlerts() {
        if (successAlert.length > 0) successAlert.hide();
        if (errorAlert.length > 0) errorAlert.hide();
        // Also hide any fallback alerts
        $('.simple-success-alert, .simple-error-alert').remove();
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Form submission handler
    $('form[enctype="multipart/form-data"]').on('submit', function(e) {
        const file = fileInput[0].files[0];
        
        if (!file) {
            e.preventDefault();
            showErrorAlert('Silakan pilih file bukti pembayaran terlebih dahulu.');
            return false;
        }
        
        // Show loading state
        const submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true);
        submitBtn.html('<i class="fa fa-spinner fa-spin me-2"></i>Mengunggah...');
        
        // Show loading alert
        hideAllAlerts();
        const loadingAlert = $(`
            <div class="upload-alert success-alert" style="animation: slideIn 0.3s ease-out;">
                <div class="alert-icon">
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
                <div class="alert-content">
                    <strong>Mengunggah...</strong> Sedang memproses bukti pembayaran Anda.
                </div>
            </div>
        `);
        errorAlert.after(loadingAlert);
    });
    
    // Payment timer (24 hours countdown)
    const orderTime = new Date('{{ $order->created_at->toISOString() }}');
    const endTime = new Date(orderTime.getTime() + (24 * 60 * 60 * 1000)); // 24 hours
    
    function updateTimer() {
        const now = new Date();
        const timeLeft = endTime - now;
        
        if (timeLeft <= 0) {
            $('#paymentTimer').text('00:00:00');
            $('.payment-timer').addClass('expired');
            return;
        }
        
        const hours = Math.floor(timeLeft / (1000 * 60 * 60));
        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
        
        const display = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        $('#paymentTimer').text(display);
    }
    
    // Update timer every second
    updateTimer();
    setInterval(updateTimer, 1000);
});

// Copy to clipboard function
function copyToClipboard(text, message = 'Nomor berhasil disalin!') {
    navigator.clipboard.writeText(text).then(function() {
        // Show success message
        const toast = $(`<div class="copy-toast">${message}</div>`);
        $('body').append(toast);
        
        setTimeout(() => {
            toast.addClass('show');
        }, 100);
        
        setTimeout(() => {
            toast.removeClass('show');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 2000);
    }).catch(function(err) {
        console.error('Could not copy text: ', err);
        
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();
        try {
            document.execCommand('copy');
            const toast = $(`<div class="copy-toast">${message}</div>`);
            $('body').append(toast);
            
            setTimeout(() => {
                toast.addClass('show');
            }, 100);
            
            setTimeout(() => {
                toast.removeClass('show');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 2000);
        } catch (err) {
            alert('Gagal menyalin nomor. Silakan salin manual.');
        }
        document.body.removeChild(textArea);
    });
}

// WhatsApp message function
function sendWhatsAppMessage() {
    const orderNumber = '{{ $order->order_number }}';
    const orderTotal = '{{ $order->formatted_total }}';
    const paymentMethod = '{{ $paymentDetails["name"] }}';
    const customerName = '{{ $order->user->name }}';
    
    // Create WhatsApp message
    const message = `Halo Admin Avflowril! 👋

Saya ingin konfirmasi pesanan dan pembayaran:

📋 *DETAIL PESANAN*
• Nomor Pesanan: ${orderNumber}
• Nama Pemesan: ${customerName}
• Total Pembayaran: ${orderTotal}
• Metode Pembayaran: ${paymentMethod}

@if($order->payment_method !== 'cod')
💳 *KONFIRMASI PEMBAYARAN*
Saya sudah melakukan pembayaran sesuai instruksi. Mohon bantuannya untuk verifikasi pembayaran saya.

Jika ada yang perlu dikonfirmasi lebih lanjut, saya siap membantu. Terima kasih! 🙏
@else
🚚 *PESANAN COD*
Saya telah melakukan pemesanan dengan metode COD (Cash on Delivery). Mohon proses pesanan saya dan konfirmasi jadwal pengiriman.

Terima kasih! 🙏
@endif`;

    // WhatsApp number (ganti dengan nomor WhatsApp bisnis Anda)
    const whatsappNumber = '6281234567890'; // Ganti dengan nomor WhatsApp Anda
    
    // Create WhatsApp URL
    const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`;
    
    // Open WhatsApp
    window.open(whatsappUrl, '_blank');
}
</script>
@endpush
@endsection
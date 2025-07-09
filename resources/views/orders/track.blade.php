@extends('layouts.app')

@section('title', 'Lacak Pesanan - Avflowril')
@section('description', 'Lacak status pesanan Anda dengan mudah di Avflowril')

@section('content')
<!-- Track Order Area Start -->
<div class="track-order-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <!-- Track Order Form -->
                <div class="track-form-card">
                    <div class="form-header">
                        <div class="header-icon">
                            <i class="fa fa-search"></i>
                        </div>
                        <h1 class="form-title">Lacak Pesanan</h1>
                        <p class="form-subtitle">Masukkan nomor pesanan untuk melihat status terkini</p>
                    </div>
                    
                    <div class="form-body">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                <i class="fa fa-exclamation-triangle me-2"></i>
                                {{ session('error') }}
                            </div>
                        @endif
                        
                        <form action="{{ route('orders.track') }}" method="POST" class="track-form">
                            @csrf
                            <div class="form-group">
                                <label for="order_number" class="form-label">
                                    <i class="fa fa-receipt me-2"></i>Nomor Pesanan
                                </label>
                                <input type="text" 
                                       class="form-control @error('order_number') is-invalid @enderror" 
                                       id="order_number" 
                                       name="order_number" 
                                       placeholder="Contoh: ORD-20250708-6203BA"
                                       value="{{ old('order_number') }}"
                                       required>
                                @error('order_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text">
                                    Nomor pesanan dapat ditemukan di email konfirmasi atau halaman sukses checkout
                                </small>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-track">
                                <i class="fa fa-search me-2"></i>Lacak Pesanan
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Help Section -->
                <div class="help-section">
                    <div class="help-card">
                        <div class="help-icon">
                            <i class="fa fa-question-circle"></i>
                        </div>
                        <div class="help-content">
                            <h5>Tidak menemukan nomor pesanan?</h5>
                            <p>Nomor pesanan dikirimkan melalui email setelah checkout berhasil. Periksa folder inbox atau spam email Anda.</p>
                        </div>
                    </div>
                    
                    <div class="help-card">
                        <div class="help-icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="help-content">
                            <h5>Sudah punya akun?</h5>
                            <p>
                                <a href="{{ route('login') }}">Login</a> untuk melihat semua pesanan Anda dengan mudah di halaman 
                                <a href="{{ route('orders.my-orders') }}">Pesanan Saya</a>.
                            </p>
                        </div>
                    </div>
                    
                    <div class="help-card">
                        <div class="help-icon">
                            <i class="fa fa-headset"></i>
                        </div>
                        <div class="help-content">
                            <h5>Butuh bantuan?</h5>
                            <p>Tim customer service kami siap membantu Anda 24/7</p>
                            <div class="contact-buttons">
                                <a href="https://wa.me/6281234567890" class="btn btn-success btn-sm" target="_blank">
                                    <i class="fa fa-whatsapp me-1"></i>WhatsApp
                                </a>
                                <a href="tel:081234567890" class="btn btn-info btn-sm">
                                    <i class="fa fa-phone me-1"></i>Telepon
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Features Section -->
                <div class="features-section">
                    <h4 class="features-title">Fitur Tracking Pesanan</h4>
                    <div class="features-grid">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fa fa-clock"></i>
                            </div>
                            <div class="feature-content">
                                <h6>Real-time Updates</h6>
                                <p>Status pesanan diperbarui secara real-time</p>
                            </div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fa fa-map-marker-alt"></i>
                            </div>
                            <div class="feature-content">
                                <h6>Lokasi Terkini</h6>
                                <p>Pantau lokasi paket Anda saat ini</p>
                            </div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fa fa-bell"></i>
                            </div>
                            <div class="feature-content">
                                <h6>Notifikasi</h6>
                                <p>Dapatkan notifikasi setiap perubahan status</p>
                            </div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fa fa-shield-alt"></i>
                            </div>
                            <div class="feature-content">
                                <h6>Aman & Terpercaya</h6>
                                <p>Data pesanan Anda aman dan terlindungi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Track Order Area End -->

@push('styles')
<style>
/* Track Order Styles */
.track-order-area {
    padding: 80px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
}

/* Track Form Card */
.track-form-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-bottom: 40px;
}

.form-header {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    text-align: center;
    padding: 40px 30px;
}

.header-icon {
    width: 80px;
    height: 80px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 2rem;
}

.form-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 10px;
}

.form-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 0;
}

.form-body {
    padding: 40px 30px;
}

/* Alert Styles */
.alert {
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 25px;
    border: none;
    display: flex;
    align-items: center;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
}

/* Form Styles */
.track-form {
    max-width: 400px;
    margin: 0 auto;
}

.form-group {
    margin-bottom: 25px;
}

.form-label {
    display: block;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
    font-size: 0.9rem;
}

.form-control {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.form-control:focus {
    outline: none;
    border-color: #e74c3c;
    background: white;
    box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1);
}

.form-control.is-invalid {
    border-color: #dc3545;
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.8rem;
    margin-top: 5px;
}

.form-text {
    color: #666;
    font-size: 0.8rem;
    margin-top: 5px;
    display: block;
}

.btn-track {
    width: 100%;
    padding: 15px;
    font-size: 1.1rem;
    font-weight: 600;
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    border: none;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.btn-track:hover {
    background: linear-gradient(135deg, #c0392b, #a93226);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
}

/* Help Section */
.help-section {
    margin-bottom: 40px;
}

.help-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    display: flex;
    align-items: flex-start;
    gap: 20px;
    transition: all 0.3s ease;
}

.help-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
}

.help-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.help-content h5 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 8px;
}

.help-content p {
    color: #666;
    margin: 0;
    line-height: 1.5;
}

.help-content a {
    color: #e74c3c;
    text-decoration: none;
    font-weight: 600;
}

.help-content a:hover {
    text-decoration: underline;
}

.contact-buttons {
    margin-top: 15px;
    display: flex;
    gap: 10px;
}

.btn-sm {
    padding: 8px 15px;
    font-size: 0.8rem;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-success {
    background: #25d366;
    color: white;
    border: 1px solid #25d366;
}

.btn-success:hover {
    background: #128c7e;
    color: white;
    transform: translateY(-1px);
}

.btn-info {
    background: #17a2b8;
    color: white;
    border: 1px solid #17a2b8;
}

.btn-info:hover {
    background: #138496;
    color: white;
    transform: translateY(-1px);
}

/* Features Section */
.features-section {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.features-title {
    text-align: center;
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 30px;
    font-size: 1.3rem;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 25px;
}

.feature-item {
    text-align: center;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.feature-item:hover {
    background: #e74c3c;
    color: white;
    transform: translateY(-3px);
}

.feature-icon {
    width: 60px;
    height: 60px;
    background: #e74c3c;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin: 0 auto 15px;
    transition: all 0.3s ease;
}

.feature-item:hover .feature-icon {
    background: white;
    color: #e74c3c;
}

.feature-content h6 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 8px;
    transition: color 0.3s ease;
}

.feature-item:hover .feature-content h6 {
    color: white;
}

.feature-content p {
    color: #666;
    margin: 0;
    font-size: 0.9rem;
    line-height: 1.4;
    transition: color 0.3s ease;
}

.feature-item:hover .feature-content p {
    color: rgba(255,255,255,0.9);
}

/* Responsive Design */
@media (max-width: 768px) {
    .track-order-area {
        padding: 40px 0;
    }
    
    .form-header {
        padding: 30px 20px;
    }
    
    .form-title {
        font-size: 1.5rem;
    }
    
    .form-subtitle {
        font-size: 1rem;
    }
    
    .form-body {
        padding: 30px 20px;
    }
    
    .help-card {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .features-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .contact-buttons {
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .track-form-card,
    .help-card,
    .features-section {
        margin-left: -15px;
        margin-right: -15px;
        border-radius: 0;
    }
    
    .header-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
    
    .form-title {
        font-size: 1.3rem;
    }
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.track-form-card,
.help-card,
.features-section {
    animation: fadeInUp 0.6s ease-out;
}

.help-card:nth-child(2) {
    animation-delay: 0.1s;
}

.help-card:nth-child(3) {
    animation-delay: 0.2s;
}

.features-section {
    animation-delay: 0.3s;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Auto-format order number input
    $('#order_number').on('input', function() {
        let value = $(this).val().toUpperCase();
        $(this).val(value);
    });
    
    // Form validation
    $('.track-form').on('submit', function(e) {
        const orderNumber = $('#order_number').val().trim();
        
        if (!orderNumber) {
            e.preventDefault();
            $('#order_number').addClass('is-invalid');
            return false;
        }
        
        // Show loading state
        $('.btn-track').html('<i class="fa fa-spinner fa-spin me-2"></i>Mencari...');
        $('.btn-track').prop('disabled', true);
    });
    
    // Remove invalid class on input
    $('#order_number').on('input', function() {
        $(this).removeClass('is-invalid');
    });
    
    // Auto-focus on order number input
    $('#order_number').focus();
});
</script>
@endpush
@endsection
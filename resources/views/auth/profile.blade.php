@extends('layouts.app')

@section('title', 'Profil Saya - Avflowril')
@section('description', 'Kelola informasi profil dan akun Anda di Avflowril')

@section('content')
<!-- Profile Hero Section -->
<section class="profile-hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="profile-hero-content">
                    <div class="breadcrumb-nav">
                        <a href="{{ route('home') }}">Home</a>
                        <i class="fa fa-chevron-right"></i>
                        <span>Profil Saya</span>
                    </div>
                    <h1>Profil Saya</h1>
                    <p class="hero-subtitle">Kelola informasi akun dan preferensi Anda dengan mudah</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="profile-hero-icons">
                    <div class="hero-icon-grid">
                        <div class="hero-icon">
                            <i class="fa fa-user-circle"></i>
                            <span>Profil</span>
                        </div>
                        <div class="hero-icon">
                            <i class="fa fa-shield-alt"></i>
                            <span>Keamanan</span>
                        </div>
                        <div class="hero-icon">
                            <i class="fa fa-shopping-bag"></i>
                            <span>Pesanan</span>
                        </div>
                        <div class="hero-icon">
                            <i class="fa fa-heart"></i>
                            <span>Favorit</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Profile Main Area -->
<div class="profile-main-area">
    <div class="container">
        <!-- Display Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Display Error Messages -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle me-2"></i>
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <!-- Profile Sidebar -->
            <div class="col-lg-4 col-md-5 mb-4">
                <div class="profile-sidebar">
                    <div class="profile-card">
                        <div class="profile-header">
                            <div class="profile-avatar">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="profile-info">
                                <h4 class="profile-name">{{ Auth::user()->name }}</h4>
                                <p class="profile-email">{{ Auth::user()->email }}</p>
                                <span class="profile-badge">Member Aktif</span>
                            </div>
                        </div>
                    </div>

                    <div class="profile-menu">
                        <div class="menu-section">
                            <h6 class="menu-title">Akun Saya</h6>
                            <ul class="menu-list">
                                <li class="menu-item active">
                                    <a href="#profile-info" data-tab="profile-info">
                                        <div class="menu-icon">
                                            <i class="fa fa-user-circle"></i>
                                        </div>
                                        <div class="menu-content">
                                            <span class="menu-label">Informasi Profil</span>
                                            <span class="menu-desc">Data pribadi Anda</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="#change-password" data-tab="change-password">
                                        <div class="menu-icon">
                                            <i class="fa fa-lock"></i>
                                        </div>
                                        <div class="menu-content">
                                            <span class="menu-label">Ubah Password</span>
                                            <span class="menu-desc">Keamanan akun</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="menu-section">
                            <h6 class="menu-title">Aktivitas</h6>
                            <ul class="menu-list">
                                <li class="menu-item">
                                    <a href="{{ route('orders.my-orders') }}">
                                        <div class="menu-icon">
                                            <i class="fa fa-shopping-bag"></i>
                                        </div>
                                        <div class="menu-content">
                                            <span class="menu-label">Pesanan Saya</span>
                                            <span class="menu-desc">Riwayat pembelian</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{ route('orders.track') }}">
                                        <div class="menu-icon">
                                            <i class="fa fa-truck"></i>
                                        </div>
                                        <div class="menu-content">
                                            <span class="menu-label">Lacak Pesanan</span>
                                            <span class="menu-desc">Status pengiriman</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="menu-section">
                            <h6 class="menu-title">Lainnya</h6>
                            <ul class="menu-list">
                                <li class="menu-item">
                                    <a href="{{ route('shop') }}">
                                        <div class="menu-icon">
                                            <i class="fa fa-store"></i>
                                        </div>
                                        <div class="menu-content">
                                            <span class="menu-label">Lanjut Belanja</span>
                                            <span class="menu-desc">Jelajahi produk</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="col-lg-8 col-md-7">
                <!-- Profile Information Tab -->
                <div class="tab-content active" id="profile-info">
                    <div class="profile-content-card">
                        <div class="content-header">
                            <div class="header-info">
                                <h3 class="content-title">Informasi Profil</h3>
                                <p class="content-subtitle">Kelola informasi pribadi Anda untuk pengalaman berbelanja yang lebih baik</p>
                            </div>
                            <div class="header-icon">
                                <i class="fa fa-user-edit"></i>
                            </div>
                        </div>
                        
                        <form action="{{ route('profile.update') }}" method="POST" class="profile-form">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-section">
                                <h5 class="section-title">Informasi Dasar</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label">
                                                <i class="fa fa-user me-2"></i>Nama Lengkap
                                            </label>
                                            <input type="text" 
                                                   class="form-control @error('name') is-invalid @enderror" 
                                                   id="name" 
                                                   name="name" 
                                                   value="{{ old('name', Auth::user()->name) }}" 
                                                   required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="form-label">
                                                <i class="fa fa-envelope me-2"></i>Email Address
                                            </label>
                                            <input type="email" 
                                                   class="form-control @error('email') is-invalid @enderror" 
                                                   id="email" 
                                                   name="email" 
                                                   value="{{ old('email', Auth::user()->email) }}" 
                                                   required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <h5 class="section-title">Informasi Kontak</h5>
                                <div class="form-group">
                                    <label for="phone" class="form-label">
                                        <i class="fa fa-phone me-2"></i>Nomor Telepon
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" 
                                           name="phone" 
                                           value="{{ old('phone', Auth::user()->phone) }}" 
                                           placeholder="Contoh: 08123456789">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="address" class="form-label">
                                        <i class="fa fa-map-marker-alt me-2"></i>Alamat Lengkap
                                    </label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" 
                                              id="address" 
                                              name="address" 
                                              rows="4" 
                                              placeholder="Masukkan alamat lengkap untuk pengiriman">{{ old('address', Auth::user()->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save me-2"></i>Simpan Perubahan
                                </button>
                                <button type="reset" class="btn btn-secondary">
                                    <i class="fa fa-undo me-2"></i>Reset
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Change Password Tab -->
                <div class="tab-content" id="change-password">
                    <div class="profile-content-card">
                        <div class="content-header">
                            <div class="header-info">
                                <h3 class="content-title">Ubah Password</h3>
                                <p class="content-subtitle">Pastikan akun Anda tetap aman dengan password yang kuat</p>
                            </div>
                            <div class="header-icon">
                                <i class="fa fa-shield-alt"></i>
                            </div>
                        </div>
                        
                        <form action="{{ route('profile.update') }}" method="POST" class="password-form">
                            @csrf
                            @method('PUT')
                            
                            <!-- Hidden fields to maintain other data -->
                            <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                            <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                            <input type="hidden" name="phone" value="{{ Auth::user()->phone }}">
                            <input type="hidden" name="address" value="{{ Auth::user()->address }}">
                            
                            <div class="form-section">
                                <h5 class="section-title">Keamanan Password</h5>
                                
                                <div class="form-group">
                                    <label for="current_password" class="form-label">
                                        <i class="fa fa-key me-2"></i>Password Saat Ini
                                    </label>
                                    <div class="password-input">
                                        <input type="password" 
                                               class="form-control @error('current_password') is-invalid @enderror" 
                                               id="current_password" 
                                               name="current_password" 
                                               placeholder="Masukkan password saat ini">
                                        <button type="button" class="password-toggle" onclick="togglePassword('current_password')">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="new_password" class="form-label">
                                        <i class="fa fa-lock me-2"></i>Password Baru
                                    </label>
                                    <div class="password-input">
                                        <input type="password" 
                                               class="form-control @error('new_password') is-invalid @enderror" 
                                               id="new_password" 
                                               name="new_password" 
                                               placeholder="Minimal 8 karakter">
                                        <button type="button" class="password-toggle" onclick="togglePassword('new_password')">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="password-strength">
                                        <div class="strength-meter">
                                            <div class="strength-bar"></div>
                                        </div>
                                        <span class="strength-text">Kekuatan password</span>
                                    </div>
                                    @error('new_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="new_password_confirmation" class="form-label">
                                        <i class="fa fa-check-circle me-2"></i>Konfirmasi Password Baru
                                    </label>
                                    <div class="password-input">
                                        <input type="password" 
                                               class="form-control" 
                                               id="new_password_confirmation" 
                                               name="new_password_confirmation" 
                                               placeholder="Ulangi password baru">
                                        <button type="button" class="password-toggle" onclick="togglePassword('new_password_confirmation')">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="security-tips">
                                <h6><i class="fa fa-lightbulb me-2"></i>Tips Keamanan</h6>
                                <ul>
                                    <li>Gunakan kombinasi huruf besar, kecil, angka, dan simbol</li>
                                    <li>Minimal 8 karakter untuk keamanan optimal</li>
                                    <li>Jangan gunakan informasi pribadi yang mudah ditebak</li>
                                    <li>Ganti password secara berkala</li>
                                </ul>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fa fa-shield-alt me-2"></i>Ubah Password
                                </button>
                                <button type="reset" class="btn btn-secondary">
                                    <i class="fa fa-undo me-2"></i>Reset
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
/* Profile Hero Section */
.profile-hero-section {
    background: linear-gradient(135deg, #ffeef0, #fff5f6);
    padding: 80px 0;
    overflow: hidden;
}

.profile-hero-content h1 {
    font-size: 48px;
    color: #2c3e50;
    margin-bottom: 20px;
    line-height: 1.2;
    font-weight: 700;
}

.hero-subtitle {
    font-size: 18px;
    color: #666;
    margin-bottom: 30px;
    opacity: 0.9;
}

.breadcrumb-nav {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
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

/* Hero Icons Grid */
.profile-hero-icons {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
}

.hero-icon-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
    max-width: 300px;
}

.hero-icon {
    background: white;
    padding: 25px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border: 2px solid #f0f0f0;
}

.hero-icon:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(231, 76, 60, 0.2);
    border-color: #e74c3c;
}

.hero-icon i {
    font-size: 24px;
    color: #e74c3c;
    margin-bottom: 10px;
    display: block;
}

.hero-icon span {
    font-size: 14px;
    color: #666;
    font-weight: 600;
}

/* Profile Main Area */
.profile-main-area {
    padding: 60px 0;
    background: #f8f9fa;
}

/* Profile Sidebar */
.profile-sidebar {
    position: sticky;
    top: 20px;
}

.profile-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    margin-bottom: 20px;
    border: 2px solid #e74c3c;
}

.profile-header {
    display: flex;
    align-items: center;
    gap: 15px;
}

.profile-avatar {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    flex-shrink: 0;
}

.profile-info {
    flex: 1;
}

.profile-name {
    font-size: 18px;
    font-weight: 700;
    color: #2c3e50;
    margin: 0 0 5px 0;
}

.profile-email {
    font-size: 14px;
    color: #666;
    margin: 0 0 8px 0;
}

.profile-badge {
    background: linear-gradient(135deg, #27ae60, #229954);
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

/* Profile Menu */
.profile-menu {
    background: white;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.menu-section {
    margin-bottom: 25px;
}

.menu-section:last-child {
    margin-bottom: 0;
}

.menu-title {
    font-size: 12px;
    font-weight: 700;
    color: #999;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 15px;
    padding-left: 15px;
}

.menu-list {
    list-style: none;
    margin: 0;
    padding: 0;
}

.menu-item {
    margin-bottom: 8px;
}

.menu-item a {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 12px 15px;
    border-radius: 10px;
    text-decoration: none;
    transition: all 0.3s ease;
    color: #2c3e50;
}

.menu-item:hover a,
.menu-item.active a {
    background: #e74c3c;
    color: white;
    transform: translateX(5px);
}

.menu-icon {
    width: 40px;
    height: 40px;
    background: #f8f9fa;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.menu-item:hover .menu-icon,
.menu-item.active .menu-icon {
    background: rgba(255,255,255,0.2);
}

.menu-icon i {
    font-size: 16px;
    color: #666;
    transition: color 0.3s ease;
}

.menu-item:hover .menu-icon i,
.menu-item.active .menu-icon i {
    color: white;
}

.menu-content {
    flex: 1;
}

.menu-label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 2px;
}

.menu-desc {
    display: block;
    font-size: 12px;
    opacity: 0.8;
}

/* Profile Content */
.profile-content-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.content-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f8f9fa;
}

.header-info {
    flex: 1;
}

.content-title {
    font-size: 24px;
    font-weight: 700;
    color: #2c3e50;
    margin: 0 0 8px 0;
}

.content-subtitle {
    font-size: 14px;
    color: #666;
    margin: 0;
}

.header-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
}

/* Form Sections */
.form-section {
    margin-bottom: 30px;
    padding-bottom: 25px;
    border-bottom: 1px solid #f0f0f0;
}

.form-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.section-title {
    font-size: 16px;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.section-title::before {
    content: '';
    width: 4px;
    height: 20px;
    background: #e74c3c;
    border-radius: 2px;
}

/* Form Controls */
.form-group {
    margin-bottom: 20px;
}

.form-label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    font-size: 14px;
}

.form-control {
    padding: 12px 15px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.3s ease;
    background: #fafafa;
}

.form-control:focus {
    border-color: #e74c3c;
    box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.25);
    background: white;
}

/* Password Input */
.password-input {
    position: relative;
}

.password-toggle {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #666;
    cursor: pointer;
    padding: 5px;
    transition: color 0.3s ease;
}

.password-toggle:hover {
    color: #e74c3c;
}

/* Password Strength */
.password-strength {
    margin-top: 8px;
}

.strength-meter {
    height: 4px;
    background: #e9ecef;
    border-radius: 2px;
    overflow: hidden;
    margin-bottom: 5px;
}

.strength-bar {
    height: 100%;
    width: 0%;
    background: #dc3545;
    transition: all 0.3s ease;
    border-radius: 2px;
}

.strength-text {
    font-size: 12px;
    color: #666;
}

/* Security Tips */
.security-tips {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 25px;
    border-left: 4px solid #e74c3c;
}

.security-tips h6 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 15px;
}

.security-tips ul {
    margin: 0;
    padding-left: 20px;
}

.security-tips li {
    color: #666;
    font-size: 14px;
    margin-bottom: 8px;
}

/* Form Actions */
.form-actions {
    display: flex;
    gap: 15px;
    padding-top: 20px;
    border-top: 2px solid #f8f9fa;
}

.btn {
    padding: 12px 25px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    border: none;
    display: inline-flex;
    align-items: center;
    text-decoration: none;
}

.btn-primary {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #c0392b, #a93226);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
}

.btn-warning {
    background: linear-gradient(135deg, #f39c12, #e67e22);
    color: white;
}

.btn-warning:hover {
    background: linear-gradient(135deg, #e67e22, #d35400);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-2px);
}

/* Tab Content */
.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

/* Alerts */
.alert {
    border-radius: 10px;
    border: none;
    padding: 15px 20px;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border-left: 4px solid #28a745;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
    border-left: 4px solid #dc3545;
}

/* Responsive Design */
@media (max-width: 768px) {
    .profile-hero-content h1 {
        font-size: 36px;
    }
    
    .hero-icon-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    .hero-icon {
        padding: 20px;
    }
    
    .profile-main-area {
        padding: 40px 0;
    }
    
    .profile-card {
        margin-bottom: 30px;
    }
    
    .profile-header {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .content-header {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .breadcrumb-nav {
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .profile-hero-section {
        padding: 60px 0;
    }
    
    .profile-hero-content h1 {
        font-size: 28px;
    }
    
    .hero-subtitle {
        font-size: 16px;
    }
    
    .hero-icon-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .profile-content-card {
        padding: 20px;
    }
    
    .menu-item a {
        padding: 10px 12px;
    }
    
    .menu-icon {
        width: 35px;
        height: 35px;
    }
    
    .menu-label {
        font-size: 13px;
    }
    
    .menu-desc {
        font-size: 11px;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const tabLinks = document.querySelectorAll('[data-tab]');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all tabs and contents
            tabLinks.forEach(l => l.closest('.menu-item').classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            
            // Add active class to clicked tab
            this.closest('.menu-item').classList.add('active');
            
            // Show corresponding content
            const targetTab = this.getAttribute('data-tab');
            document.getElementById(targetTab).classList.add('active');
        });
    });

    // Password strength checker
    const newPasswordInput = document.getElementById('new_password');
    if (newPasswordInput) {
        newPasswordInput.addEventListener('input', function() {
            checkPasswordStrength(this.value);
        });
    }

    function checkPasswordStrength(password) {
        const strengthBar = document.querySelector('.strength-bar');
        const strengthText = document.querySelector('.strength-text');
        
        if (!strengthBar || !strengthText) return;
        
        let strength = 0;
        let text = '';
        let color = '';
        
        if (password.length >= 8) strength += 25;
        if (/[a-z]/.test(password)) strength += 25;
        if (/[A-Z]/.test(password)) strength += 25;
        if (/[0-9]/.test(password)) strength += 25;
        if (/[^A-Za-z0-9]/.test(password)) strength += 25;
        
        if (strength <= 25) {
            text = 'Lemah';
            color = '#dc3545';
        } else if (strength <= 50) {
            text = 'Sedang';
            color = '#ffc107';
        } else if (strength <= 75) {
            text = 'Kuat';
            color = '#28a745';
        } else {
            text = 'Sangat Kuat';
            color = '#20c997';
        }
        
        strengthBar.style.width = Math.min(strength, 100) + '%';
        strengthBar.style.background = color;
        strengthText.textContent = `Kekuatan password: ${text}`;
        strengthText.style.color = color;
    }
});

// Toggle password visibility
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const toggle = input.nextElementSibling;
    const icon = toggle.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
@endpush
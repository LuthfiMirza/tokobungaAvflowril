<!-- Header Area Start Here -->
<header class="header-area">
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo Section -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="header-logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/images/logop1.jpg') }}" alt="Avflowril Logo" class="logo-img">
                        <span class="logo-text">Avflowril</span>
                    </a>
                </div>
            </div>
            
            <!-- Navigation Menu -->
            <div class="col-lg-6 d-none d-lg-block">
                <nav class="main-nav">
                    <ul>
                        <li>
                            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('shop') }}" class="{{ request()->routeIs('shop') ? 'active' : '' }}">
                                Shop
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                                Contact Us
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            
            <!-- Header Right Icons -->
            <div class="col-lg-3 col-md-8 col-sm-6">
                <div class="header-right-icons d-flex justify-content-end align-items-center">
                    <!-- Shopping Cart -->
                    <div class="minicart-wrap">
                        <a href="{{ route('cart') }}" title="Shopping Cart" class="header-icon minicart-btn" style="position: relative;">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="cart-count">{{ is_array(session('cart', [])) ? array_sum(array_column(session('cart', []), 'quantity')) : 0 }}</span>
                        </a>
                        <div class="cart-item-wrapper">
                            <div class="cart-items">
                                <div class="cart-empty">Keranjang kosong</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- User Account -->
                    @auth
                        <div class="user-dropdown">
                            <a href="#" class="header-icon user-toggle" title="My Account">
                                <div class="user-avatar">
                                    <i class="fa fa-user"></i>
                                </div>
                                <span class="user-name d-none d-md-inline">{{ Str::limit(Auth::user()->name, 12) }}</span>
                                <i class="fa fa-chevron-down dropdown-arrow d-none d-md-inline"></i>
                            </a>
                            <div class="dropdown-menu user-dropdown-menu">
                                <div class="dropdown-header">
                                    <div class="user-info">
                                        <div class="user-avatar-large">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <div class="user-details">
                                            <h6 class="user-name-full">{{ Auth::user()->name }}</h6>
                                            <p class="user-email">{{ Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-body">
                                    <a href="{{ route('profile') }}" class="dropdown-item">
                                        <div class="item-icon">
                                            <i class="fa fa-user-circle"></i>
                                        </div>
                                        <div class="item-content">
                                            <span class="item-title">Profil Saya</span>
                                            <span class="item-desc">Kelola informasi akun</span>
                                        </div>
                                    </a>
                                    <a href="{{ route('orders.my-orders') }}" class="dropdown-item">
                                        <div class="item-icon">
                                            <i class="fa fa-shopping-bag"></i>
                                        </div>
                                        <div class="item-content">
                                            <span class="item-title">Pesanan Saya</span>
                                            <span class="item-desc">Lihat riwayat pembelian</span>
                                        </div>
                                    </a>
                                    <a href="{{ route('orders.track') }}" class="dropdown-item">
                                        <div class="item-icon">
                                            <i class="fa fa-truck"></i>
                                        </div>
                                        <div class="item-content">
                                            <span class="item-title">Lacak Pesanan</span>
                                            <span class="item-desc">Cek status pengiriman</span>
                                        </div>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                                        @csrf
                                        <button type="submit" class="dropdown-item logout-btn">
                                            <div class="item-icon logout-icon">
                                                <i class="fa fa-sign-out-alt"></i>
                                            </div>
                                            <div class="item-content">
                                                <span class="item-title">Keluar</span>
                                                <span class="item-desc">Logout dari akun</span>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="auth-buttons">
                            <a href="{{ route('login') }}" title="Login" class="header-icon login-btn">
                                <i class="fa fa-sign-in-alt"></i>
                                <span class="d-none d-md-inline">Masuk</span>
                            </a>
                            <a href="{{ route('register') }}" title="Register" class="header-icon register-btn">
                                <i class="fa fa-user-plus"></i>
                                <span class="d-none d-md-inline">Daftar</span>
                            </a>
                        </div>
                    @endauth
                    
                    <!-- Mobile Menu Toggle -->
                    <a href="#" class="d-lg-none header-icon" title="Menu">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Header & Logo Styles -->
<style>
/* Header Logo Styles */
.header-logo {
    display: flex;
    align-items: center;
}

.header-logo a {
    display: flex;
    align-items: center;
    text-decoration: none;
    gap: 12px;
}

.logo-img {
    height: 50px;
    width: auto;
    max-width: 60px;
    object-fit: contain;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.logo-img:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.logo-text {
    font-size: 24px;
    font-weight: 700;
    color: #e74c3c;
    font-family: 'Arial', sans-serif;
    letter-spacing: -0.5px;
}

/* Header Area */
.header-area {
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 15px 0;
    position: sticky;
    top: 0;
    z-index: 1000;
}

/* Navigation Styles */
.main-nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    gap: 30px;
    justify-content: center;
}

.main-nav ul li a {
    color: #2c3e50;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
    padding: 8px 0;
    position: relative;
    transition: color 0.3s ease;
}

.main-nav ul li a:hover,
.main-nav ul li a.active {
    color: #e74c3c;
}

.main-nav ul li a::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: #e74c3c;
    transition: width 0.3s ease;
}

.main-nav ul li a:hover::after,
.main-nav ul li a.active::after {
    width: 100%;
}

/* Navigation Auth Section Styles */
.nav-auth-section {
    margin-left: 20px;
}

.nav-login {
    background: linear-gradient(135deg, #3498db, #2980b9) !important;
    color: white !important;
    padding: 10px 20px !important;
    border-radius: 25px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    border: 2px solid transparent !important;
}

.nav-login:hover,
.nav-login.active {
    background: linear-gradient(135deg, #2980b9, #21618c) !important;
    color: white !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(52, 152, 219, 0.4);
}

.nav-register {
    background: linear-gradient(135deg, #e74c3c, #c0392b) !important;
    color: white !important;
    padding: 10px 20px !important;
    border-radius: 25px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    border: 2px solid transparent !important;
}

.nav-register:hover,
.nav-register.active {
    background: linear-gradient(135deg, #c0392b, #a93226) !important;
    color: white !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(231, 76, 60, 0.4);
}

.nav-login::after,
.nav-register::after {
    display: none !important;
}

/* Header Icons */
.header-right-icons {
    gap: 15px;
}

.header-icon {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 12px;
    color: #2c3e50;
    text-decoration: none;
    border-radius: 6px;
    transition: all 0.3s ease;
    font-size: 14px;
    font-weight: 500;
}

.header-icon:hover {
    background-color: #e74c3c;
    color: white;
    transform: translateY(-2px);
}

.header-icon i {
    font-size: 16px;
}

.cart-count {
    background: #e74c3c;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 12px;
    font-weight: 600;
    position: absolute;
    top: -5px;
    right: -5px;
    min-width: 18px;
    text-align: center;
}

/* User Avatar */
.user-avatar {
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 14px;
    margin-right: 8px;
}

.dropdown-arrow {
    font-size: 10px;
    margin-left: 4px;
    transition: transform 0.3s ease;
}

.user-dropdown:hover .dropdown-arrow {
    transform: rotate(180deg);
}

/* User Dropdown - FIXED */
.user-dropdown {
    position: relative;
}

.user-dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background: white;
    min-width: 320px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    border-radius: 12px;
    padding: 0;
    z-index: 1000;
    margin-top: 2px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(0,0,0,0.05);
}

.user-dropdown:hover .user-dropdown-menu,
.user-dropdown-menu:hover {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

/* Dropdown Header */
.dropdown-header {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    padding: 20px;
    border-radius: 12px 12px 0 0;
    color: white;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 15px;
}

.user-avatar-large {
    width: 50px;
    height: 50px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    flex-shrink: 0;
}

.user-details h6 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
    color: white;
}

.user-email {
    margin: 4px 0 0 0;
    font-size: 13px;
    color: rgba(255,255,255,0.8);
    opacity: 0.9;
}

/* Dropdown Body */
.dropdown-body {
    padding: 8px 0;
}

.dropdown-item {
    display: flex;
    align-items: center;
    padding: 12px 20px;
    color: #2c3e50;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
}

.dropdown-item:hover {
    background: #f8f9fa;
    color: #e74c3c;
    transform: translateX(4px);
}

.item-icon {
    width: 40px;
    height: 40px;
    background: #f8f9fa;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.dropdown-item:hover .item-icon {
    background: #e74c3c;
    color: white;
}

.item-icon i {
    font-size: 16px;
    color: #666;
    transition: color 0.3s ease;
}

.dropdown-item:hover .item-icon i {
    color: white;
}

.item-content {
    flex: 1;
}

.item-title {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 2px;
}

.item-desc {
    display: block;
    font-size: 12px;
    color: #666;
    line-height: 1.3;
}

.dropdown-item:hover .item-title {
    color: #e74c3c;
}

.dropdown-item:hover .item-desc {
    color: #999;
}

.dropdown-divider {
    height: 1px;
    background: #f0f0f0;
    margin: 8px 20px;
}

/* Logout Button */
.logout-form {
    margin: 0;
}

.logout-btn {
    background: none;
    border: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
    font-family: inherit;
}

.logout-icon {
    background: #fee;
}

.logout-btn:hover .logout-icon {
    background: #dc3545;
}

.logout-btn:hover .logout-icon i {
    color: white;
}

.logout-btn:hover .item-title {
    color: #dc3545;
}

/* Auth Buttons */
.auth-buttons {
    display: flex;
    gap: 8px;
}

.login-btn {
    background: linear-gradient(135deg, #3498db, #2980b9);
    color: white !important;
    border-radius: 8px;
    padding: 10px 16px;
    transition: all 0.3s ease;
}

.login-btn:hover {
    background: linear-gradient(135deg, #2980b9, #21618c);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
}

.register-btn {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white !important;
    border-radius: 8px;
    padding: 10px 16px;
    transition: all 0.3s ease;
}

.register-btn:hover {
    background: linear-gradient(135deg, #c0392b, #a93226);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
}

/* Cart Dropdown Styles - FIXED */
.minicart-wrap {
    position: relative;
}

.cart-item-wrapper {
    position: absolute;
    top: 100%;
    right: 0;
    background: white;
    min-width: 350px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    border-radius: 8px;
    padding: 20px;
    z-index: 1000;
    margin-top: 2px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
}

.minicart-wrap:hover .cart-item-wrapper,
.cart-item-wrapper:hover {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.cart-item-wrapper.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.cart-item {
    display: flex;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.cart-item:last-child {
    border-bottom: none;
}

.cart-item-img {
    width: 60px;
    height: 60px;
    margin-right: 15px;
    border-radius: 6px;
    overflow: hidden;
}

.cart-item-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.cart-item-content {
    flex: 1;
    position: relative;
}

.cart-item-content h4 {
    font-size: 14px;
    margin: 0 0 5px 0;
    font-weight: 600;
}

.cart-item-content h4 a {
    color: #333;
    text-decoration: none;
}

.cart-item-content h4 a:hover {
    color: #e74c3c;
}

.cart-item-quantity {
    font-size: 12px;
    color: #666;
}

.cart-item-remove {
    position: absolute;
    top: 0;
    right: 0;
    background: none;
    border: none;
    color: #999;
    font-size: 14px;
    cursor: pointer;
    padding: 2px;
}

.cart-item-remove:hover {
    color: #e74c3c;
}

.cart-footer {
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid #eee;
}

.cart-total {
    text-align: center;
    margin-bottom: 15px;
    font-size: 16px;
}

.cart-buttons {
    display: flex;
    gap: 10px;
}

.cart-buttons .btn {
    flex: 1;
    padding: 8px 12px;
    font-size: 12px;
    text-align: center;
    text-decoration: none;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.cart-buttons .btn-primary {
    background-color: #3498db;
    color: white;
    border: 1px solid #3498db;
}

.cart-buttons .btn-primary:hover {
    background-color: #2980b9;
    border-color: #2980b9;
}

.cart-buttons .btn-success {
    background-color: #27ae60;
    color: white;
    border: 1px solid #27ae60;
}

.cart-buttons .btn-success:hover {
    background-color: #229954;
    border-color: #229954;
}

.cart-empty {
    text-align: center;
    color: #999;
    padding: 20px;
    font-style: italic;
}

/* Responsive Design */
@media (max-width: 768px) {
    .header-area {
        padding: 10px 0;
    }
    
    .logo-img {
        height: 40px;
        max-width: 50px;
    }
    
    .logo-text {
        font-size: 20px;
    }
    
    .header-icon span {
        display: none !important;
    }
    
    .header-icon {
        padding: 8px;
        min-width: 40px;
        justify-content: center;
    }
    
    .cart-item-wrapper {
        min-width: 300px;
        right: -50px;
    }
    
    .user-dropdown-menu {
        min-width: 280px;
        right: -20px;
    }
    
    .dropdown-header {
        padding: 15px;
    }
    
    .user-avatar-large {
        width: 40px;
        height: 40px;
        font-size: 16px;
    }
    
    .user-details h6 {
        font-size: 14px;
    }
    
    .user-email {
        font-size: 12px;
    }
    
    .dropdown-item {
        padding: 10px 15px;
    }
    
    .item-icon {
        width: 35px;
        height: 35px;
        margin-right: 10px;
    }
    
    .item-icon i {
        font-size: 14px;
    }
    
    .item-title {
        font-size: 13px;
    }
    
    .item-desc {
        font-size: 11px;
    }
    
    .auth-buttons {
        gap: 6px;
    }
    
    .login-btn,
    .register-btn {
        padding: 8px 12px;
        font-size: 12px;
    }
}

@media (max-width: 576px) {
    .logo-img {
        height: 35px;
        max-width: 45px;
    }
    
    .logo-text {
        font-size: 18px;
    }
    
    .header-right-icons {
        gap: 6px;
    }
    
    .header-icon {
        padding: 6px;
        min-width: 35px;
    }
    
    .user-avatar {
        width: 28px;
        height: 28px;
        font-size: 12px;
        margin-right: 6px;
    }
    
    .user-dropdown-menu {
        min-width: 260px;
        right: -30px;
    }
    
    .dropdown-header {
        padding: 12px;
    }
    
    .user-info {
        gap: 10px;
    }
    
    .user-avatar-large {
        width: 35px;
        height: 35px;
        font-size: 14px;
    }
    
    .user-details h6 {
        font-size: 13px;
    }
    
    .user-email {
        font-size: 11px;
    }
    
    .dropdown-item {
        padding: 8px 12px;
    }
    
    .item-icon {
        width: 30px;
        height: 30px;
        margin-right: 8px;
    }
    
    .item-icon i {
        font-size: 12px;
    }
    
    .item-title {
        font-size: 12px;
    }
    
    .item-desc {
        font-size: 10px;
    }
    
    .auth-buttons {
        gap: 4px;
    }
    
    .login-btn,
    .register-btn {
        padding: 6px 10px;
        font-size: 11px;
        min-width: 32px;
    }
}
</style>
<!-- Header Area End Here -->
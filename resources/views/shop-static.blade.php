@extends('layouts.app')

@section('title', 'Shop - Avflowril')
@section('description', 'Koleksi lengkap bucket bunga terbaik dari Avflowril - Hadiah sempurna untuk orang tersayang')

@section('content')
    <!-- Hero Section Start -->
    <div class="shop-hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="hero-title">Koleksi Bucket Bunga Terbaik</h1>
                        <p class="hero-subtitle">Hadiah sempurna untuk orang tersayang dengan berbagai pilihan bucket bunga unik dan menarik</p>
                        <div class="hero-stats">
                            <div class="stat-item">
                                <span class="stat-number">50+</span>
                                <span class="stat-label">Pilihan Bucket</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">100%</span>
                                <span class="stat-label">Kualitas Terjamin</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">24/7</span>
                                <span class="stat-label">Layanan</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image">
                        <img src="{{ asset('assets/images/product/12.jpg') }}" alt="Bucket Bunga Avflowril" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Section End -->

    <!-- Welcome Message for Authenticated Users -->
    @auth
        <div class="welcome-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="welcome-card">
                            <div class="welcome-icon">
                                <i class="fa fa-user-circle"></i>
                            </div>
                            <div class="welcome-content">
                                <h4>Selamat datang kembali, {{ Auth::user()->name }}!</h4>
                                <p>Nikmati pengalaman berbelanja bucket bunga terbaik di Avflowril. Temukan koleksi eksklusif kami!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth

    <!-- Filter Section Start -->
    <div class="filter-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="filter-wrapper">
                        <div class="filter-left">
                            <h3 class="filter-title">Bucket Bunga Pilihan</h3>
                            <p class="filter-subtitle">Temukan bucket bunga yang sempurna untuk setiap momen spesial</p>
                        </div>
                        <div class="filter-right">
                            <div class="filter-controls">
                                <div class="view-toggle">
                                    <button class="view-btn active" data-view="grid" title="Grid View">
                                        <i class="fa fa-th"></i>
                                    </button>
                                    
                                </div>
                                <div class="sort-dropdown">
                                    <select class="form-select">
                                        <option value="default">Urutkan</option>
                                        <option value="price-low">Harga: Rendah ke Tinggi</option>
                                        <option value="price-high">Harga: Tinggi ke Rendah</option>
                                        <option value="name">Nama A-Z</option>
                                        <option value="popular">Terpopuler</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Filter Section End -->

    <!-- Products Section Start -->
    <div class="products-section">
        <div class="container">
            <!-- Category Tabs -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="category-tabs">
                        <button class="category-tab active" data-category="all">Semua Produk</button>
                        <button class="category-tab" data-category="satin">Bucket Satin</button>
                        <button class="category-tab" data-category="money">Bucket Money</button>
                        <button class="category-tab" data-category="kawat">Bucket Kawat</button>
                        <button class="category-tab" data-category="glitter">Bucket Glitter</button>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="row products-grid" id="productsGrid">
                <!-- Product 1 -->
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4 product-item" data-category="satin">
                    <div class="product-card">
                        <div class="product-image-wrapper">
                            <div class="product-badge">
                                <span class="badge-discount">-29%</span>
                            </div>
                            <div class="product-image">
                                <img src="{{ asset('assets/images/product/12.jpg') }}" alt="Bucket Bunga Satin" class="img-fluid">
                                <div class="product-overlay">
                                    <div class="product-actions">
                                        <button class="action-btn view-btn" title="View Product" onclick="quickView(1)">
                                            <i class="fa fa-eye"></i>
                                            <span></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="product-category">Bucket Satin</div>
                            <h4 class="product-title">
                                <a href="{{ route('product.details', 1) }}">Bucket Bunga Satin Pink</a>
                            </h4>
                            <div class="product-rating">
                                <div class="stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <span class="rating-count">(24 ulasan)</span>
                            </div>
                            <div class="product-price">
                                <span class="current-price">Rp 250.000</span>
                                <span class="old-price">Rp 350.000</span>
                            </div>
                            <div class="product-description">
                                Bucket bunga satin yang indah dan elegan, cocok untuk hadiah spesial kepada orang tersayang.
                            </div>
                            <button class="add-to-cart-btn" onclick="addToCart(1)">
                                <i class="fa fa-shopping-cart me-2"></i>Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4 product-item" data-category="satin glitter">
                    <div class="product-card">
                        <div class="product-image-wrapper">
                            <div class="product-badge">
                                <span class="badge-new">Baru</span>
                            </div>
                            <div class="product-image">
                                <img src="{{ asset('assets/images/product/16.jpg') }}" alt="Bucket Satin with Glitter" class="img-fluid">
                                <div class="product-overlay">
                                    <div class="product-actions">
                                        <button class="action-btn view-btn" title="View Product" onclick="quickView(2)">
                                            <i class="fa fa-eye"></i>
                                            <span>View</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="product-category">Bucket Glitter</div>
                            <h4 class="product-title">
                                <a href="{{ route('product.details', 2) }}">Bucket Satin with Glitter</a>
                            </h4>
                            <div class="product-rating">
                                <div class="stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <span class="rating-count">(18 ulasan)</span>
                            </div>
                            <div class="product-price">
                                <span class="current-price">Rp 370.000</span>
                                <span class="old-price">Rp 470.000</span>
                            </div>
                            <div class="product-description">
                                Bucket bunga satin dengan hiasan glitter yang berkilau, memberikan kesan mewah dan elegan.
                            </div>
                            <button class="add-to-cart-btn" onclick="addToCart(2)">
                                <i class="fa fa-shopping-cart me-2"></i>Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4 product-item" data-category="kawat">
                    <div class="product-card">
                        <div class="product-image-wrapper">
                            <div class="product-badge">
                                <span class="badge-popular">Populer</span>
                            </div>
                            <div class="product-image">
                                <img src="{{ asset('assets/images/product/6.jpg') }}" alt="Bunga Kawat Bulu" class="img-fluid">
                                <div class="product-overlay">
                                    <div class="product-actions">
                                        <button class="action-btn view-btn" title="View Product" onclick="quickView(3)">
                                            <i class="fa fa-eye"></i>
                                            <span>View</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="product-category">Bucket Kawat</div>
                            <h4 class="product-title">
                                <a href="{{ route('product.details', 3) }}">Bucket Kawat Bulu</a>
                            </h4>
                            <div class="product-rating">
                                <div class="stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <span class="rating-count">(32 ulasan)</span>
                            </div>
                            <div class="product-price">
                                <span class="current-price">Rp 270.000</span>
                                <span class="old-price">Rp 450.000</span>
                            </div>
                            <div class="product-description">
                                Bunga kawat bulu yang unik dan tahan lama, cocok untuk dekorasi atau hadiah yang berkesan.
                            </div>
                            <button class="add-to-cart-btn" onclick="addToCart(3)">
                                <i class="fa fa-shopping-cart me-2"></i>Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4 product-item" data-category="money">
                    <div class="product-card">
                        <div class="product-image-wrapper">
                            <div class="product-badge">
                                <span class="badge-special">Spesial</span>
                            </div>
                            <div class="product-image">
                                <img src="{{ asset('assets/images/product/18.jpg') }}" alt="Bucket Money" class="img-fluid">
                                <div class="product-overlay">
                                    <div class="product-actions">
                                        <button class="action-btn view-btn" title="View Product" onclick="quickView(4)">
                                            <i class="fa fa-eye"></i>
                                            <span>View</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="product-category">Bucket Money</div>
                            <h4 class="product-title">
                                <a href="{{ route('product.details', 4) }}">Bucket Money Special</a>
                            </h4>
                            <div class="product-rating">
                                <div class="stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <span class="rating-count">(15 ulasan)</span>
                            </div>
                            <div class="product-price">
                                <span class="current-price">Rp 310.000</span>
                                <span class="old-price">Rp 470.000</span>
                            </div>
                            <div class="product-description">
                                Bucket money yang kreatif dan unik, hadiah yang sempurna untuk berbagai acara spesial.
                            </div>
                            <button class="add-to-cart-btn" onclick="addToCart(4)">
                                <i class="fa fa-shopping-cart me-2"></i>Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Add more products here -->
                @for($i = 5; $i <= 8; $i++)
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-4 product-item" data-category="satin">
                        <div class="product-card">
                            <div class="product-image-wrapper">
                                <div class="product-image">
                                    <img src="{{ asset('assets/images/product/' . ($i <= 26 ? $i : rand(1,26)) . '.jpg') }}" alt="Bucket Bunga {{ $i }}" class="img-fluid">
                                    <div class="product-overlay">
                                        <div class="product-actions">
                                            <button class="action-btn quick-view-btn" title="Quick View" onclick="quickView({{ $i }})">
                                                <i class="fa fa-eye"></i>
                                                <span>Quick View</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="product-category">Bucket Satin</div>
                                <h4 class="product-title">
                                    <a href="{{ route('product.details', $i) }}">Bucket Bunga Premium {{ $i }}</a>
                                </h4>
                                <div class="product-rating">
                                    <div class="stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <span class="rating-count">({{ rand(10, 50) }} ulasan)</span>
                                </div>
                                <div class="product-price">
                                    <span class="current-price">Rp {{ number_format(rand(200, 500) * 1000, 0, ',', '.') }}</span>
                                </div>
                                <div class="product-description">
                                    Bucket bunga berkualitas tinggi dengan desain yang menarik dan elegan.
                                </div>
                                <button class="add-to-cart-btn" onclick="addToCart({{ $i }})">
                                    <i class="fa fa-shopping-cart me-2"></i>Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>

            <!-- Load More Button -->
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <button class="load-more-btn" id="loadMoreBtn">
                        <i class="fa fa-plus me-2"></i>Muat Lebih Banyak
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Products Section End -->

    <!-- Features Section Start -->
    <div class="features-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fa fa-shipping-fast"></i>
                        </div>
                        <div class="feature-content">
                            <h5>Pengiriman Cepat</h5>
                            <p>Pengiriman same day untuk area Jakarta</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fa fa-award"></i>
                        </div>
                        <div class="feature-content">
                            <h5>Kualitas Terjamin</h5>
                            <p>100% fresh dan berkualitas tinggi</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fa fa-headset"></i>
                        </div>
                        <div class="feature-content">
                            <h5>Customer Service</h5>
                            <p>Layanan pelanggan 24/7</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fa fa-undo"></i>
                        </div>
                        <div class="feature-content">
                            <h5>Garansi Kepuasan</h5>
                            <p>Jaminan uang kembali 100%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features Section End -->

<!-- Product Detail Modal -->
<div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productDetailModalLabel">Detail Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Product Images -->
                    <div class="col-md-6">
                        <div class="product-detail-images">
                            <div class="main-image">
                                <img id="modalMainImage" src="" alt="" class="img-fluid">
                                <div class="image-zoom-overlay">
                                    <i class="fa fa-search-plus"></i>
                                </div>
                            </div>
                            <div class="thumbnail-images">
                                <div class="thumbnail-item active">
                                    <img id="modalThumb1" src="" alt="" class="img-fluid">
                                </div>
                                <div class="thumbnail-item">
                                    <img id="modalThumb2" src="" alt="" class="img-fluid">
                                </div>
                                <div class="thumbnail-item">
                                    <img id="modalThumb3" src="" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product Info -->
                    <div class="col-md-6">
                        <div class="product-detail-info">
                            <div class="product-badge-modal">
                                <span id="modalBadge" class="badge-discount">-29%</span>
                            </div>
                            
                            <div class="product-category-modal" id="modalCategory">Bucket Satin</div>
                            
                            <h3 class="product-title-modal" id="modalTitle">Bucket Bunga Satin Pink</h3>
                            
                            <div class="product-rating-modal">
                                <div class="stars" id="modalStars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <span class="rating-text" id="modalRating">(24 ulasan)</span>
                            </div>
                            
                            <div class="product-price-modal">
                                <span class="current-price-modal" id="modalCurrentPrice">Rp 250.000</span>
                                <span class="old-price-modal" id="modalOldPrice">Rp 350.000</span>
                                <span class="discount-percentage" id="modalDiscount">29% OFF</span>
                            </div>
                            
                            <div class="product-description-modal">
                                <h6>Deskripsi Produk</h6>
                                <p id="modalDescription">Bucket bunga satin yang indah dan elegan, cocok untuk hadiah spesial kepada orang tersayang. Dibuat dengan bahan berkualitas tinggi dan desain yang menarik.</p>
                            </div>
                            
                            <div class="product-features">
                                <h6>Keunggulan Produk</h6>
                                <ul>
                                    <li><i class="fa fa-check text-success me-2"></i>Bahan berkualitas tinggi</li>
                                    <li><i class="fa fa-check text-success me-2"></i>Desain elegan dan menarik</li>
                                    <li><i class="fa fa-check text-success me-2"></i>Tahan lama</li>
                                    <li><i class="fa fa-check text-success me-2"></i>Cocok untuk berbagai acara</li>
                                </ul>
                            </div>
                            
                            <div class="product-specifications">
                                <h6>Spesifikasi</h6>
                                <div class="spec-item">
                                    <span class="spec-label">Ukuran:</span>
                                    <span class="spec-value" id="modalSize">Medium (25cm x 30cm)</span>
                                </div>
                                <div class="spec-item">
                                    <span class="spec-label">Berat:</span>
                                    <span class="spec-value" id="modalWeight">500 gram</span>
                                </div>
                                <div class="spec-item">
                                    <span class="spec-label">Material:</span>
                                    <span class="spec-value" id="modalMaterial">Satin Premium</span>
                                </div>
                                <div class="spec-item">
                                    <span class="spec-label">Warna:</span>
                                    <span class="spec-value" id="modalColor">Pink, Putih, Merah</span>
                                </div>
                            </div>
                            
                            <div class="quantity-selector">
                                <h6>Jumlah</h6>
                                <div class="quantity-controls-modal">
                                    <button class="qty-btn-modal minus" onclick="updateModalQuantity(-1)">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input type="number" id="modalQuantity" class="qty-input-modal" value="1" min="1">
                                    <button class="qty-btn-modal plus" onclick="updateModalQuantity(1)">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="modal-actions">
                                <button class="add-to-cart-modal-btn" id="modalAddToCart">
                                    <i class="fa fa-shopping-cart me-2"></i>Tambah ke Keranjang
                                </button>
                                <button class="wishlist-btn-modal" title="Tambah ke Wishlist">
                                    <i class="fa fa-heart"></i>
                                </button>
                                <button class="share-btn-modal" title="Bagikan" onclick="shareProduct()">
                                    <i class="fa fa-share-alt"></i>
                                </button>
                            </div>
                            
                            <div class="delivery-info">
                                <div class="delivery-item">
                                    <i class="fa fa-truck text-primary me-2"></i>
                                    <span>Pengiriman same day untuk Jakarta</span>
                                </div>
                                <div class="delivery-item">
                                    <i class="fa fa-shield-alt text-success me-2"></i>
                                    <span>Garansi kualitas 100%</span>
                                </div>
                                <div class="delivery-item">
                                    <i class="fa fa-undo text-info me-2"></i>
                                    <span>Bisa retur dalam 24 jam</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
/* Shop Hero Section */
.shop-hero-section {
    background: linear-gradient(135deg, #ffeef0 0%, #fff5f6 100%);
    padding: 80px 0;
    margin-bottom: 0;
}

.hero-title {
    font-size: 3rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 20px;
    line-height: 1.2;
}

.hero-subtitle {
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 40px;
    line-height: 1.6;
}

.hero-stats {
    display: flex;
    gap: 40px;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 2rem;
    font-weight: 700;
    color: #e74c3c;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 0.9rem;
    color: #666;
    font-weight: 500;
}

.hero-image {
    text-align: center;
}

.hero-image img {
    max-width: 400px;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

/* Welcome Section */
.welcome-section {
    padding: 30px 0;
    background: #f8f9fa;
}

.welcome-card {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    padding: 25px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    gap: 20px;
    box-shadow: 0 10px 30px rgba(231, 76, 60, 0.2);
}

.welcome-icon i {
    font-size: 3rem;
    opacity: 0.8;
}

.welcome-content h4 {
    margin-bottom: 8px;
    font-weight: 600;
}

.welcome-content p {
    margin: 0;
    opacity: 0.9;
}

/* Filter Section */
.filter-section {
    padding: 40px 0;
    background: white;
    border-bottom: 1px solid #eee;
}

.filter-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.filter-title {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 8px;
}

.filter-subtitle {
    color: #666;
    margin: 0;
}

.filter-controls {
    display: flex;
    align-items: center;
    gap: 20px;
}

.view-toggle {
    display: flex;
    background: #f8f9fa;
    border-radius: 8px;
    padding: 4px;
}

.view-btn {
    background: none;
    border: none;
    padding: 10px 15px;
    border-radius: 6px;
    color: #666;
    transition: all 0.3s ease;
}

.view-btn.active,
.view-btn:hover {
    background: #e74c3c;
    color: white;
}

.form-select {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 10px 15px;
    font-weight: 500;
    min-width: 180px;
}

.form-select:focus {
    border-color: #e74c3c;
    box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.25);
}

/* Category Tabs */
.category-tabs {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 40px;
    flex-wrap: wrap;
}

.category-tab {
    background: white;
    border: 2px solid #e9ecef;
    color: #666;
    padding: 12px 24px;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
    cursor: pointer;
}

.category-tab.active,
.category-tab:hover {
    background: #e74c3c;
    border-color: #e74c3c;
    color: white;
    transform: translateY(-2px);
}

/* Products Section */
.products-section {
    padding: 60px 0;
    background: #f8f9fa;
}

.product-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.product-image-wrapper {
    position: relative;
    overflow: hidden;
}

.product-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    z-index: 2;
}

.product-badge span {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    color: white;
}

.badge-discount {
    background: #e74c3c;
}

.badge-new {
    background: #27ae60;
}

.badge-popular {
    background: #f39c12;
}

.badge-special {
    background: #9b59b6;
}

.product-image {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.1);
}

.product-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-card:hover .product-overlay {
    opacity: 1;
}

.product-actions {
    display: flex;
    gap: 10px;
}

.action-btn {
    width: 45px;
    height: 45px;
    background: white;
    border: none;
    border-radius: 50%;
    color: #333;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    cursor: pointer;
}

.action-btn:hover {
    background: #e74c3c;
    color: white;
    transform: scale(1.1);
}

.product-content {
    padding: 25px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.product-category {
    color: #e74c3c;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.product-title {
    margin-bottom: 12px;
    flex-grow: 1;
}

.product-title a {
    color: #2c3e50;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    line-height: 1.4;
    transition: color 0.3s ease;
}

.product-title a:hover {
    color: #e74c3c;
}

.product-rating {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 12px;
}

.stars {
    color: #ffc107;
}

.rating-count {
    font-size: 0.9rem;
    color: #666;
}

.product-price {
    margin-bottom: 15px;
}

.current-price {
    font-size: 1.3rem;
    font-weight: 700;
    color: #e74c3c;
}

.old-price {
    font-size: 1rem;
    color: #999;
    margin-left: 10px;
}

.product-description {
    color: #666;
    font-size: 0.9rem;
    line-height: 1.5;
    margin-bottom: 20px;
    flex-grow: 1;
}

.add-to-cart-btn {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    width: 100%;
}

.add-to-cart-btn:hover {
    background: linear-gradient(135deg, #c0392b, #a93226);
    transform: translateY(-2px);
}

/* Load More Button */
.load-more-btn {
    background: linear-gradient(135deg, #27ae60, #229954);
    color: white;
    border: none;
    padding: 15px 40px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.load-more-btn:hover {
    background: linear-gradient(135deg, #229954, #1e8449);
    transform: translateY(-3px);
}

/* Features Section */
.features-section {
    padding: 60px 0;
    background: white;
}

.feature-card {
    text-align: center;
    padding: 30px 20px;
    border-radius: 15px;
    transition: all 0.3s ease;
}

.feature-card:hover {
    background: #f8f9fa;
    transform: translateY(-5px);
}

.feature-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    color: white;
    font-size: 2rem;
}

.feature-content h5 {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 10px;
}

.feature-content p {
    color: #666;
    margin: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-stats {
        gap: 20px;
        justify-content: center;
    }
    
    .filter-wrapper {
        flex-direction: column;
        gap: 20px;
        text-align: center;
    }
    
    .filter-controls {
        flex-direction: column;
        gap: 15px;
    }
    
    .category-tabs {
        gap: 8px;
    }
    
    .category-tab {
        padding: 10px 16px;
        font-size: 0.9rem;
    }
    
    .welcome-card {
        flex-direction: column;
        text-align: center;
    }
    
    .product-image {
        height: 200px;
    }
}

@media (max-width: 576px) {
    .hero-stats {
        flex-direction: column;
        gap: 15px;
    }
    
    .stat-number {
        font-size: 1.5rem;
    }
}

/* Product Detail Modal Styles */
.modal-content {
    border: none;
    border-radius: 15px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.2);
}

.modal-header {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    border-radius: 15px 15px 0 0;
    padding: 20px 30px;
}

.modal-title {
    font-weight: 600;
    font-size: 1.3rem;
}

.btn-close {
    filter: invert(1);
    opacity: 0.8;
}

.modal-body {
    padding: 30px;
}

/* Product Images */
.product-detail-images {
    position: sticky;
    top: 20px;
}

.main-image {
    position: relative;
    margin-bottom: 15px;
    border-radius: 10px;
    overflow: hidden;
    background: #f8f9fa;
}

.main-image img {
    width: 100%;
    height: 350px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.image-zoom-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    cursor: zoom-in;
}

.main-image:hover .image-zoom-overlay {
    opacity: 1;
}

.image-zoom-overlay i {
    color: white;
    font-size: 2rem;
}

.thumbnail-images {
    display: flex;
    gap: 10px;
}

.thumbnail-item {
    width: 80px;
    height: 80px;
    border-radius: 8px;
    overflow: hidden;
    border: 2px solid transparent;
    cursor: pointer;
    transition: all 0.3s ease;
}

.thumbnail-item.active {
    border-color: #e74c3c;
}

.thumbnail-item:hover {
    border-color: #e74c3c;
    transform: scale(1.05);
}

.thumbnail-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Product Info */
.product-detail-info {
    height: 100%;
    overflow-y: auto;
    padding-right: 10px;
}

.product-badge-modal {
    margin-bottom: 15px;
}

.product-badge-modal span {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    color: white;
    background: #e74c3c;
}

.product-category-modal {
    color: #e74c3c;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.product-title-modal {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 15px;
    line-height: 1.3;
}

.product-rating-modal {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
}

.product-rating-modal .stars {
    color: #ffc107;
}

.rating-text {
    color: #666;
    font-size: 0.9rem;
}

.product-price-modal {
    margin-bottom: 25px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
}

.current-price-modal {
    font-size: 1.8rem;
    font-weight: 700;
    color: #e74c3c;
    display: block;
}

.old-price-modal {
    font-size: 1.2rem;
    color: #999;
    text-decoration: line-through;
    margin-right: 10px;
}

.discount-percentage {
    background: #27ae60;
    color: white;
    padding: 4px 8px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
}

.product-description-modal,
.product-features,
.product-specifications {
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 1px solid #f0f0f0;
}

.product-description-modal h6,
.product-features h6,
.product-specifications h6,
.quantity-selector h6 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 12px;
    font-size: 1rem;
}

.product-description-modal p {
    color: #666;
    line-height: 1.6;
    margin: 0;
}

.product-features ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.product-features li {
    padding: 8px 0;
    color: #666;
    display: flex;
    align-items: center;
}

.spec-item {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid #f8f9fa;
}

.spec-label {
    color: #666;
    font-weight: 500;
}

.spec-value {
    color: #2c3e50;
    font-weight: 600;
}

/* Quantity Selector */
.quantity-selector {
    margin-bottom: 25px;
}

.quantity-controls-modal {
    display: flex;
    align-items: center;
    background: #f8f9fa;
    border-radius: 8px;
    padding: 5px;
    width: fit-content;
}

.qty-btn-modal {
    width: 40px;
    height: 40px;
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

.qty-btn-modal:hover {
    background: #e74c3c;
    color: white;
}

.qty-input-modal {
    width: 80px;
    height: 40px;
    border: none;
    background: transparent;
    text-align: center;
    font-weight: 600;
    color: #2c3e50;
    font-size: 1.1rem;
}

/* Modal Actions */
.modal-actions {
    display: flex;
    gap: 15px;
    margin-bottom: 25px;
}

.add-to-cart-modal-btn {
    flex: 1;
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    border: none;
    padding: 15px 20px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.add-to-cart-modal-btn:hover {
    background: linear-gradient(135deg, #c0392b, #a93226);
    transform: translateY(-2px);
}

.wishlist-btn-modal,
.share-btn-modal {
    width: 50px;
    height: 50px;
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    color: #666;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    cursor: pointer;
}

.wishlist-btn-modal:hover {
    background: #e74c3c;
    border-color: #e74c3c;
    color: white;
}

.share-btn-modal:hover {
    background: #3498db;
    border-color: #3498db;
    color: white;
}

/* Delivery Info */
.delivery-info {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
}

.delivery-item {
    display: flex;
    align-items: center;
    padding: 8px 0;
    color: #666;
    font-size: 0.9rem;
}

.delivery-item:last-child {
    border-bottom: none;
}

/* Responsive Modal */
@media (max-width: 768px) {
    .modal-dialog {
        margin: 10px;
        max-width: calc(100% - 20px);
    }
    
    .modal-body {
        padding: 20px;
    }
    
    .main-image img {
        height: 250px;
    }
    
    .thumbnail-images {
        justify-content: center;
    }
    
    .modal-actions {
        flex-direction: column;
    }
    
    .wishlist-btn-modal,
    .share-btn-modal {
        width: 100%;
        height: 45px;
    }
    
    .current-price-modal {
        font-size: 1.5rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Category filter functionality
    const categoryTabs = document.querySelectorAll('.category-tab');
    const productItems = document.querySelectorAll('.product-item');

    categoryTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            categoryTabs.forEach(t => t.classList.remove('active'));
            // Add active class to clicked tab
            this.classList.add('active');

            const category = this.getAttribute('data-category');

            // Filter products
            productItems.forEach(item => {
                if (category === 'all') {
                    item.style.display = 'block';
                } else {
                    const itemCategories = item.getAttribute('data-category');
                    if (itemCategories && itemCategories.includes(category)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                }
            });
        });
    });

    // View toggle functionality
    const viewBtns = document.querySelectorAll('.view-btn');
    const productsGrid = document.getElementById('productsGrid');

    viewBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            viewBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const view = this.getAttribute('data-view');
            if (view === 'list') {
                productsGrid.classList.add('list-view');
            } else {
                productsGrid.classList.remove('list-view');
            }
        });
    });

    // Load more functionality
    document.getElementById('loadMoreBtn').addEventListener('click', function() {
        // This would typically load more products via AJAX
        alert('Fitur load more akan diimplementasikan dengan AJAX');
    });
});

// Quick view function
function quickView(productId) {
    // Get product data based on ID
    const productData = getProductData(productId);
    
    // Populate modal with product data
    populateModal(productData);
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('productDetailModal'));
    modal.show();
}

// Get product data (this would typically come from a database)
function getProductData(productId) {
    const products = {
        1: {
            id: 1,
            name: 'Bucket Bunga Satin Pink',
            category: 'Bucket Satin',
            currentPrice: 250000,
            oldPrice: 350000,
            discount: 29,
            rating: 5,
            reviewCount: 24,
            description: 'Bucket bunga satin yang indah dan elegan, cocok untuk hadiah spesial kepada orang tersayang. Dibuat dengan bahan berkualitas tinggi dan desain yang menarik. Sempurna untuk berbagai acara seperti ulang tahun, anniversary, atau sebagai ungkapan kasih sayang.',
            images: [
                '/assets/images/product/12.jpg',
                '/assets/images/product/11.jpg',
                '/assets/images/product/13.jpg'
            ],
            specifications: {
                size: 'Medium (25cm x 30cm)',
                weight: '500 gram',
                material: 'Satin Premium',
                color: 'Pink, Putih, Merah'
            },
            badge: 'discount'
        },
        2: {
            id: 2,
            name: 'Bucket Satin with Glitter',
            category: 'Bucket Glitter',
            currentPrice: 370000,
            oldPrice: 470000,
            discount: 21,
            rating: 5,
            reviewCount: 18,
            description: 'Bucket bunga satin dengan hiasan glitter yang berkilau, memberikan kesan mewah dan elegan. Cocok untuk acara-acara istimewa yang membutuhkan sentuhan glamour.',
            images: [
                '/assets/images/product/16.jpg',
                '/assets/images/product/17.jpg',
                '/assets/images/product/18.jpg'
            ],
            specifications: {
                size: 'Large (30cm x 35cm)',
                weight: '600 gram',
                material: 'Satin Premium + Glitter',
                color: 'Gold, Silver, Rose Gold'
            },
            badge: 'new'
        },
        3: {
            id: 3,
            name: 'Bucket Kawat Bulu',
            category: 'Bucket Kawat',
            currentPrice: 270000,
            oldPrice: 450000,
            discount: 40,
            rating: 5,
            reviewCount: 32,
            description: 'Bunga kawat bulu yang unik dan tahan lama, cocok untuk dekorasi atau hadiah yang berkesan. Desain yang kreatif dan bahan yang berkualitas membuat produk ini menjadi pilihan favorit.',
            images: [
                '/assets/images/product/6.jpg',
                '/assets/images/product/13.jpg',
                '/assets/images/product/14.jpg'
            ],
            specifications: {
                size: 'Medium (25cm x 30cm)',
                weight: '400 gram',
                material: 'Kawat Premium + Bulu Sintetis',
                color: 'Multicolor'
            },
            badge: 'popular'
        },
        4: {
            id: 4,
            name: 'Bucket Money Special',
            category: 'Bucket Money',
            currentPrice: 310000,
            oldPrice: 470000,
            discount: 34,
            rating: 5,
            reviewCount: 15,
            description: 'Bucket money yang kreatif dan unik, hadiah yang sempurna untuk berbagai acara spesial. Desain yang inovatif dan kualitas premium menjadikan produk ini pilihan terbaik.',
            images: [
                '/assets/images/product/18.jpg',
                '/assets/images/product/3.jpg',
                '/assets/images/product/4.jpg'
            ],
            specifications: {
                size: 'Large (30cm x 35cm)',
                weight: '550 gram',
                material: 'Premium Mixed Materials',
                color: 'Custom'
            },
            badge: 'special'
        }
    };
    
    // Default product for IDs not in the list
    const defaultProduct = {
        id: productId,
        name: `Bucket Bunga Premium ${productId}`,
        category: 'Bucket Satin',
        currentPrice: Math.floor(Math.random() * 300000) + 200000,
        oldPrice: Math.floor(Math.random() * 200000) + 400000,
        discount: Math.floor(Math.random() * 30) + 10,
        rating: 5,
        reviewCount: Math.floor(Math.random() * 40) + 10,
        description: 'Bucket bunga berkualitas tinggi dengan desain yang menarik dan elegan. Cocok untuk berbagai acara spesial dan momen berkesan.',
        images: [
            `/assets/images/product/${productId}.jpg`,
            `/assets/images/product/${productId <= 24 ? productId + 1 : productId - 1}.jpg`,
            `/assets/images/product/${productId <= 23 ? productId + 2 : productId - 2}.jpg`
        ],
        specifications: {
            size: 'Medium (25cm x 30cm)',
            weight: '500 gram',
            material: 'Premium Materials',
            color: 'Berbagai Pilihan'
        },
        badge: 'discount'
    };
    
    return products[productId] || defaultProduct;
}

// Populate modal with product data
function populateModal(product) {
    // Set basic info
    document.getElementById('modalTitle').textContent = product.name;
    document.getElementById('modalCategory').textContent = product.category;
    document.getElementById('modalDescription').textContent = product.description;
    
    // Set prices
    document.getElementById('modalCurrentPrice').textContent = 'Rp ' + product.currentPrice.toLocaleString('id-ID');
    document.getElementById('modalOldPrice').textContent = 'Rp ' + product.oldPrice.toLocaleString('id-ID');
    document.getElementById('modalDiscount').textContent = product.discount + '% OFF';
    
    // Set rating
    document.getElementById('modalRating').textContent = `(${product.reviewCount} ulasan)`;
    
    // Set images
    document.getElementById('modalMainImage').src = product.images[0];
    document.getElementById('modalThumb1').src = product.images[0];
    document.getElementById('modalThumb2').src = product.images[1] || product.images[0];
    document.getElementById('modalThumb3').src = product.images[2] || product.images[0];
    
    // Set specifications
    document.getElementById('modalSize').textContent = product.specifications.size;
    document.getElementById('modalWeight').textContent = product.specifications.weight;
    document.getElementById('modalMaterial').textContent = product.specifications.material;
    document.getElementById('modalColor').textContent = product.specifications.color;
    
    // Set badge
    const badgeElement = document.getElementById('modalBadge');
    badgeElement.className = `badge-${product.badge}`;
    switch(product.badge) {
        case 'new':
            badgeElement.textContent = 'Baru';
            break;
        case 'popular':
            badgeElement.textContent = 'Populer';
            break;
        case 'special':
            badgeElement.textContent = 'Spesial';
            break;
        default:
            badgeElement.textContent = `-${product.discount}%`;
    }
    
    // Set add to cart button
    const addToCartBtn = document.getElementById('modalAddToCart');
    addToCartBtn.onclick = function() {
        addToCartFromModal(product);
    };
    
    // Reset quantity
    document.getElementById('modalQuantity').value = 1;
}

// Add to cart from modal
function addToCartFromModal(product) {
    const quantity = parseInt(document.getElementById('modalQuantity').value);
    const btn = document.getElementById('modalAddToCart');
    const originalText = btn.innerHTML;
    
    btn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i>Menambahkan...';
    btn.disabled = true;
    
    // Send AJAX request to add item to cart
    fetch('{{ route("cart.add") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_id: product.id,
            name: product.name,
            price: product.currentPrice,
            image: product.images[0].replace(window.location.origin, ''),
            category: product.category,
            quantity: quantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            btn.innerHTML = '<i class="fa fa-check me-2"></i>Ditambahkan!';
            btn.style.background = 'linear-gradient(135deg, #27ae60, #229954)';
            
            // Update cart count in header
            updateCartCount(data.cart_count);
            
            // Show success notification
            showNotification(data.message, 'success');
            
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.style.background = '';
                btn.disabled = false;
            }, 1500);
        } else {
            btn.innerHTML = originalText;
            btn.disabled = false;
            showNotification(data.message || 'Gagal menambahkan ke keranjang', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        btn.innerHTML = originalText;
        btn.disabled = false;
        showNotification('Terjadi kesalahan', 'error');
    });
}

// Update modal quantity
function updateModalQuantity(change) {
    const quantityInput = document.getElementById('modalQuantity');
    let currentQuantity = parseInt(quantityInput.value);
    let newQuantity = currentQuantity + change;
    
    if (newQuantity < 1) newQuantity = 1;
    if (newQuantity > 99) newQuantity = 99;
    
    quantityInput.value = newQuantity;
}

// Share product
function shareProduct() {
    const productTitle = document.getElementById('modalTitle').textContent;
    const productUrl = window.location.href;
    
    if (navigator.share) {
        navigator.share({
            title: productTitle,
            text: `Lihat produk ${productTitle} di Avflowril`,
            url: productUrl
        });
    } else {
        // Fallback: copy to clipboard
        navigator.clipboard.writeText(productUrl).then(() => {
            showNotification('Link produk berhasil disalin!', 'success');
        });
    }
}

// Thumbnail image switching
document.addEventListener('DOMContentLoaded', function() {
    // Add click event to thumbnail images
    document.addEventListener('click', function(e) {
        if (e.target.closest('.thumbnail-item')) {
            const thumbnailItem = e.target.closest('.thumbnail-item');
            const thumbnailImg = thumbnailItem.querySelector('img');
            const mainImage = document.getElementById('modalMainImage');
            
            // Remove active class from all thumbnails
            document.querySelectorAll('.thumbnail-item').forEach(item => {
                item.classList.remove('active');
            });
            
            // Add active class to clicked thumbnail
            thumbnailItem.classList.add('active');
            
            // Update main image
            mainImage.src = thumbnailImg.src;
        }
    });
    
    // Image zoom functionality
    document.addEventListener('click', function(e) {
        if (e.target.closest('.image-zoom-overlay')) {
            const mainImage = document.getElementById('modalMainImage');
            // Create a larger image view (you can implement a lightbox here)
            window.open(mainImage.src, '_blank');
        }
    });
});

// Add to cart function
function addToCart(productId) {
    // Get product details from the card
    const productCard = event.target.closest('.product-card');
    const productName = productCard.querySelector('.product-title a').textContent;
    const productPrice = productCard.querySelector('.current-price').textContent.replace(/[^\d]/g, '');
    const productImage = productCard.querySelector('.product-image img').src.replace(window.location.origin, '');
    const productCategory = productCard.querySelector('.product-category').textContent;
    
    // Add animation
    const btn = event.target;
    const originalText = btn.innerHTML;
    
    btn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i>Menambahkan...';
    btn.disabled = true;
    
    // Send AJAX request to add item to cart
    fetch('{{ route("cart.add") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_id: productId,
            name: productName,
            price: parseInt(productPrice),
            image: productImage,
            category: productCategory,
            quantity: 1
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            btn.innerHTML = '<i class="fa fa-check me-2"></i>Ditambahkan!';
            btn.style.background = 'linear-gradient(135deg, #27ae60, #229954)';
            
            // Update cart count in header
            updateCartCount(data.cart_count);
            
            // Show success notification
            showNotification(data.message, 'success');
            
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.style.background = '';
                btn.disabled = false;
            }, 1500);
        } else {
            btn.innerHTML = originalText;
            btn.disabled = false;
            showNotification(data.message || 'Gagal menambahkan ke keranjang', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        btn.innerHTML = originalText;
        btn.disabled = false;
        showNotification('Terjadi kesalahan', 'error');
    });
}

// Update cart count in header
function updateCartCount(count) {
    const cartCountElement = document.querySelector('.cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = count;
    }
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

// Add notification styles if not already added
if (!document.querySelector('#notification-styles')) {
    const notificationStyles = document.createElement('style');
    notificationStyles.id = 'notification-styles';
    notificationStyles.innerHTML = `
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
    `;
    document.head.appendChild(notificationStyles);
}
</script>
@endpush
@endsection
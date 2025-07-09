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
                                <span class="stat-number">{{ $products->total() }}+</span>
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
                                    <button class="view-btn" data-view="list" title="List View">
                                        <i class="fa fa-list"></i>
                                    </button>
                                </div>
                                <div class="sort-dropdown">
                                    <select class="form-select" onchange="sortProducts(this.value)">
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
                        @foreach($categories as $key => $label)
                            <button class="category-tab {{ $key === 'all' ? 'active' : '' }}" 
                                    data-category="{{ $key }}" 
                                    onclick="filterByCategory('{{ $key }}')">
                                {{ $label }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="row products-grid" id="productsGrid">
                @forelse($products as $product)
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-4 product-item" data-category="{{ $product->category }}">
                        <div class="product-card">
                            <div class="product-image-wrapper">
                                @if($product->is_on_sale)
                                    <div class="product-badge">
                                        <span class="badge-discount">-{{ $product->discount_percentage }}%</span>
                                    </div>
                                @elseif($product->featured)
                                    <div class="product-badge">
                                        <span class="badge-popular">Unggulan</span>
                                    </div>
                                @endif
                                <div class="product-image">
                                    <img src="{{ $product->main_image ? asset($product->main_image) : asset('assets/images/product/default.jpg') }}" 
                                         alt="{{ $product->name }}" class="img-fluid">
                                    <div class="product-overlay">
                                        <div class="product-actions">
                                            <button class="action-btn view-btn" title="View Product" onclick="quickView({{ $product->id }})">
                                                <i class="fa fa-eye"></i>
                                                <span>View</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="product-category">
                                    @switch($product->category)
                                        @case('satin')
                                            Bucket Satin
                                            @break
                                        @case('money')
                                            Bucket Money
                                            @break
                                        @case('kawat')
                                            Bucket Kawat
                                            @break
                                        @case('glitter')
                                            Bucket Glitter
                                            @break
                                        @case('custom')
                                            Bucket Custom
                                            @break
                                        @case('special')
                                            Bucket Special
                                            @break
                                        @default
                                            {{ ucfirst($product->category) }}
                                    @endswitch
                                </div>
                                <h4 class="product-title">
                                    <a href="{{ route('product.details', $product->id) }}">{{ $product->name }}</a>
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
                                    @if($product->sale_price)
                                        <span class="current-price">{{ $product->formatted_sale_price }}</span>
                                        <span class="old-price">{{ $product->formatted_price }}</span>
                                    @else
                                        <span class="current-price">{{ $product->formatted_price }}</span>
                                    @endif
                                </div>
                                <div class="product-description">
                                    {{ Str::limit($product->short_description ?: $product->description, 80) }}
                                </div>
                                <button class="add-to-cart-btn" onclick="addToCart({{ $product->id }})">
                                    <i class="fa fa-shopping-cart me-2"></i>Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fa fa-box-open" style="font-size: 80px; color: #ddd; margin-bottom: 20px;"></i>
                            <h3>Tidak ada produk ditemukan</h3>
                            <p>Maaf, tidak ada produk yang sesuai dengan kriteria pencarian Anda.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="pagination-wrapper d-flex justify-content-center">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            @endif
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
/* Include all the existing styles from the original shop.blade.php */
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
    background: white;
    border: none;
    border-radius: 8px;
    color: #333;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    cursor: pointer;
    padding: 12px 20px;
    font-weight: 600;
}

.action-btn:hover {
    background: #e74c3c;
    color: white;
    transform: scale(1.05);
}

.action-btn i {
    margin-right: 8px;
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
    text-decoration: line-through;
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

/* Pagination */
.pagination-wrapper {
    margin-top: 40px;
}

.pagination-wrapper .pagination {
    border-radius: 10px;
    overflow: hidden;
}

.pagination-wrapper .page-link {
    border: none;
    padding: 12px 16px;
    color: #666;
    background: white;
    margin: 0 2px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.pagination-wrapper .page-link:hover {
    background: #e74c3c;
    color: white;
}

.pagination-wrapper .page-item.active .page-link {
    background: #e74c3c;
    color: white;
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
</style>
@endpush

@push('scripts')
<script>
// Filter by category
function filterByCategory(category) {
    const url = new URL(window.location);
    if (category === 'all') {
        url.searchParams.delete('category');
    } else {
        url.searchParams.set('category', category);
    }
    window.location.href = url.toString();
}

// Sort products
function sortProducts(sort) {
    const url = new URL(window.location);
    if (sort === 'default') {
        url.searchParams.delete('sort');
    } else {
        url.searchParams.set('sort', sort);
    }
    window.location.href = url.toString();
}

// Quick view function (using existing logic)
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
    // This should be replaced with actual AJAX call to get product data
    const defaultProduct = {
        id: productId,
        name: `Product ${productId}`,
        category: 'Bucket Satin',
        currentPrice: 250000,
        oldPrice: 350000,
        discount: 29,
        rating: 5,
        reviewCount: 24,
        description: 'Deskripsi produk akan dimuat dari database.',
        images: [
            '/assets/images/product/12.jpg',
            '/assets/images/product/13.jpg',
            '/assets/images/product/14.jpg'
        ],
        specifications: {
            size: 'Medium (25cm x 30cm)',
            weight: '500 gram',
            material: 'Premium Materials',
            color: 'Berbagai Pilihan'
        },
        badge: 'discount'
    };
    
    return defaultProduct;
}

// Populate modal with product data
function populateModal(product) {
    document.getElementById('modalTitle').textContent = product.name;
    document.getElementById('modalCategory').textContent = product.category;
    document.getElementById('modalDescription').textContent = product.description;
    
    document.getElementById('modalCurrentPrice').textContent = 'Rp ' + product.currentPrice.toLocaleString('id-ID');
    document.getElementById('modalOldPrice').textContent = 'Rp ' + product.oldPrice.toLocaleString('id-ID');
    document.getElementById('modalDiscount').textContent = product.discount + '% OFF';
    
    document.getElementById('modalRating').textContent = `(${product.reviewCount} ulasan)`;
    
    document.getElementById('modalMainImage').src = product.images[0];
    document.getElementById('modalThumb1').src = product.images[0];
    document.getElementById('modalThumb2').src = product.images[1] || product.images[0];
    document.getElementById('modalThumb3').src = product.images[2] || product.images[0];
    
    document.getElementById('modalSize').textContent = product.specifications.size;
    document.getElementById('modalWeight').textContent = product.specifications.weight;
    document.getElementById('modalMaterial').textContent = product.specifications.material;
    document.getElementById('modalColor').textContent = product.specifications.color;
    
    const addToCartBtn = document.getElementById('modalAddToCart');
    addToCartBtn.onclick = function() {
        addToCartFromModal(product);
    };
    
    document.getElementById('modalQuantity').value = 1;
}

// Add to cart from modal
function addToCartFromModal(product) {
    const quantity = parseInt(document.getElementById('modalQuantity').value);
    addToCart(product.id, quantity);
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
        navigator.clipboard.writeText(productUrl).then(() => {
            showNotification('Link produk berhasil disalin!', 'success');
        });
    }
}

// Add to cart function
function addToCart(productId, quantity = 1) {
    // This should be replaced with actual AJAX call
    console.log(`Adding product ${productId} to cart with quantity ${quantity}`);
    showNotification('Produk berhasil ditambahkan ke keranjang!', 'success');
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
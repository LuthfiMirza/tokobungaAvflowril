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
                                        <option value="default" {{ request('sort') == 'default' || !request('sort') ? 'selected' : '' }}>Urutkan</option>
                                        <option value="price-low" {{ request('sort') == 'price-low' ? 'selected' : '' }}>Harga: Rendah ke Tinggi</option>
                                        <option value="price-high" {{ request('sort') == 'price-high' ? 'selected' : '' }}>Harga: Tinggi ke Rendah</option>
                                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama A-Z</option>
                                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler</option>
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
                            <button class="category-tab {{ (request('category') == $key) || (request('category') == null && $key === 'all') ? 'active' : '' }}" 
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

    <!-- Custom Order Section Start -->
    <div class="custom-order-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="custom-order-card">
                        <div class="custom-order-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <h3 class="custom-order-title">Butuh Desain Khusus?</h3>
                        <p class="custom-order-subtitle">Tidak menemukan bucket bunga yang sesuai keinginan? Kami siap membuatkan desain custom sesuai permintaan Anda!</p>
                        <a href="https://wa.me/6281384303654?text=Halo%20Avflowril,%20saya%20ingin%20custom%20order%20bucket%20bunga" 
                           class="custom-order-btn" target="_blank">
                            <i class="fab fa-whatsapp me-2"></i>Custom Order Aja
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Custom Order Section End -->

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

<!-- Product Quick View Modal -->
<div class="modal fade" id="productQuickViewModal" tabindex="-1" aria-labelledby="productQuickViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productQuickViewModalLabel">
                    <i class="fa fa-eye me-2"></i>Quick View
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Product Images -->
                    <div class="col-lg-6">
                        <div class="product-images-modal">
                            <div class="main-image-modal">
                                <img id="modalMainImage" src="" alt="" class="img-fluid">
                                <div class="image-zoom-overlay">
                                    <i class="fa fa-search-plus"></i>
                                </div>
                            </div>
                            <div class="thumbnail-images-modal">
                                <div class="thumbnail-item-modal active">
                                    <img id="modalThumb1" src="" alt="" class="img-fluid">
                                </div>
                                <div class="thumbnail-item-modal">
                                    <img id="modalThumb2" src="" alt="" class="img-fluid">
                                </div>
                                <div class="thumbnail-item-modal">
                                    <img id="modalThumb3" src="" alt="" class="img-fluid">
                                </div>
                                <div class="thumbnail-item-modal">
                                    <img id="modalThumb4" src="" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product Details -->
                    <div class="col-lg-6">
                        <div class="product-detail-info-modal">
                            <div class="product-badge-modal">
                                <span id="modalBadge" class="badge-discount">-29%</span>
                            </div>
                            
                            <div class="product-category-modal" id="modalCategory">Bucket Satin</div>
                            
                            <h3 class="product-title-modal" id="modalTitle">Bucket Bunga Satin Pink</h3>
                            
                            <div class="product-rating-modal">
                                <div class="stars-modal" id="modalStars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <span class="rating-text-modal" id="modalRating">(24 ulasan)</span>
                            </div>
                            
                            <div class="product-price-modal">
                                <span class="current-price-modal" id="modalCurrentPrice">Rp 250.000</span>
                                <span class="old-price-modal" id="modalOldPrice">Rp 350.000</span>
                                <span class="discount-percentage-modal" id="modalDiscount">29% OFF</span>
                            </div>
                            
                            <div class="product-description-modal">
                                <h6>Deskripsi Produk</h6>
                                <p id="modalDescription">Bucket bunga satin yang indah dan elegan, cocok untuk hadiah spesial kepada orang tersayang. Dibuat dengan bahan berkualitas tinggi dan desain yang menarik.</p>
                            </div>
                            
                            <div class="product-specifications-modal">
                                <h6>Spesifikasi</h6>
                                <div class="spec-row">
                                    <span class="spec-label">Ukuran:</span>
                                    <span class="spec-value" id="modalSize">Medium (25cm x 30cm)</span>
                                </div>
                                <div class="spec-row">
                                    <span class="spec-label">Berat:</span>
                                    <span class="spec-value" id="modalWeight">500 gram</span>
                                </div>
                                <div class="spec-row">
                                    <span class="spec-label">Material:</span>
                                    <span class="spec-value" id="modalMaterial">Satin Premium</span>
                                </div>
                                <div class="spec-row">
                                    <span class="spec-label">Warna:</span>
                                    <span class="spec-value" id="modalColor">Pink, Putih, Merah</span>
                                </div>
                            </div>
                            
                            <div class="product-quantity-modal">
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
                                <a id="modalViewDetails" href="#" class="view-details-btn-modal">
                                    <i class="fa fa-external-link-alt me-2"></i>Lihat Detail
                                </a>
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

/* Custom Order Section */
.custom-order-section {
    padding: 60px 0;
    background: linear-gradient(135deg, #25d366 0%, #128c7e 100%);
    position: relative;
    overflow: hidden;
}

.custom-order-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="whatsapp-pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23whatsapp-pattern)"/></svg>');
    opacity: 0.3;
}

.custom-order-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 50px 40px;
    text-align: center;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    position: relative;
    z-index: 2;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.custom-order-icon {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #25d366, #128c7e);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 30px;
    box-shadow: 0 10px 30px rgba(37, 211, 102, 0.3);
    animation: pulse 2s infinite;
}

.custom-order-icon i {
    font-size: 3rem;
    color: white;
}

@keyframes pulse {
    0% {
        transform: scale(1);
        box-shadow: 0 10px 30px rgba(37, 211, 102, 0.3);
    }
    50% {
        transform: scale(1.05);
        box-shadow: 0 15px 40px rgba(37, 211, 102, 0.4);
    }
    100% {
        transform: scale(1);
        box-shadow: 0 10px 30px rgba(37, 211, 102, 0.3);
    }
}

.custom-order-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 20px;
    line-height: 1.2;
}

.custom-order-subtitle {
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 40px;
    line-height: 1.6;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.custom-order-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #25d366, #128c7e);
    color: white;
    padding: 18px 40px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 700;
    font-size: 1.2rem;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(37, 211, 102, 0.3);
    border: 2px solid transparent;
    position: relative;
    overflow: hidden;
}

.custom-order-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.custom-order-btn:hover::before {
    left: 100%;
}

.custom-order-btn:hover {
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(37, 211, 102, 0.4);
    border-color: rgba(255, 255, 255, 0.3);
}

.custom-order-btn i {
    font-size: 1.3rem;
    margin-right: 12px;
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
    
    /* Custom Order Section Mobile */
    .custom-order-card {
        padding: 40px 25px;
    }
    
    .custom-order-icon {
        width: 80px;
        height: 80px;
    }
    
    .custom-order-icon i {
        font-size: 2.5rem;
    }
    
    .custom-order-title {
        font-size: 2rem;
    }
    
    .custom-order-subtitle {
        font-size: 1.1rem;
    }
    
    .custom-order-btn {
        padding: 16px 30px;
        font-size: 1.1rem;
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

/* Modal Improvements */
.modal-content {
    max-height: 90vh;
    overflow-y: auto;
}

.modal-header {
    border-bottom: none;
}

.modal-body {
    background: #fafafa;
}

.product-badge-modal span {
    padding: 8px 16px !important;
    border-radius: 25px !important;
    font-size: 0.85rem !important;
    font-weight: 700 !important;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.product-badge-modal .badge-discount {
    background: linear-gradient(135deg, #e74c3c, #c0392b) !important;
}

.product-badge-modal .badge-popular {
    background: linear-gradient(135deg, #f39c12, #e67e22) !important;
}

.product-title-modal {
    color: #2c3e50 !important;
    font-weight: 700 !important;
    margin-bottom: 15px !important;
    line-height: 1.3 !important;
    font-size: 1.5rem !important;
}

.product-category-modal {
    color: #e74c3c !important;
    font-size: 0.9rem !important;
    font-weight: 600 !important;
    margin-bottom: 10px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
}

.product-price-modal {
    background: white !important;
    padding: 20px !important;
    border-radius: 12px !important;
    margin-bottom: 25px !important;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05) !important;
}

.current-price-modal {
    font-size: 2rem !important;
    font-weight: 700 !important;
    color: #e74c3c !important;
    display: block !important;
}

.old-price-modal {
    font-size: 1.2rem !important;
    color: #999 !important;
    text-decoration: line-through !important;
    margin-right: 10px !important;
}

.discount-percentage {
    background: #27ae60 !important;
    color: white !important;
    padding: 4px 8px !important;
    border-radius: 15px !important;
    font-size: 0.8rem !important;
    font-weight: 600 !important;
}

.product-description-modal,
.product-features,
.product-specifications {
    background: white;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.product-description-modal h6,
.product-features h6,
.product-specifications h6 {
    color: #2c3e50 !important;
    font-weight: 600 !important;
    margin-bottom: 15px !important;
    font-size: 1.1rem !important;
    border-bottom: 2px solid #e74c3c;
    padding-bottom: 8px;
}

.add-to-cart-modal-btn {
    background: linear-gradient(135deg, #e74c3c, #c0392b) !important;
    border: none !important;
    padding: 15px 25px !important;
    border-radius: 10px !important;
    font-weight: 600 !important;
    font-size: 1.1rem !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3) !important;
}

.add-to-cart-modal-btn:hover {
    background: linear-gradient(135deg, #c0392b, #a93226) !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4) !important;
}

.quantity-controls-modal {
    background: white !important;
    border-radius: 10px !important;
    padding: 8px !important;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05) !important;
}

.delivery-info {
    background: white !important;
    border-radius: 12px !important;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05) !important;
}

/* Quick View Modal Styles - Same as Featured Products */
.modal-xl {
    max-width: 1200px;
}

.modal-content {
    border: none;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,0.2);
}

.modal-header {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    border-bottom: none;
    padding: 20px 30px;
}

.modal-title {
    font-weight: 600;
    font-size: 18px;
}

.btn-close {
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    width: 35px;
    height: 35px;
    opacity: 1;
    filter: brightness(0) invert(1);
}

.btn-close:hover {
    background: rgba(255,255,255,0.3);
    transform: scale(1.1);
}

.modal-body {
    padding: 40px;
    background: #fafafa;
}

/* Product Images Modal */
.product-images-modal {
    position: sticky;
    top: 20px;
}

.main-image-modal {
    position: relative;
    margin-bottom: 20px;
    border-radius: 15px;
    overflow: hidden;
    background: white;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.main-image-modal img {
    width: 100%;
    height: 400px;
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
    cursor: pointer;
}

.main-image-modal:hover .image-zoom-overlay {
    opacity: 1;
}

.image-zoom-overlay i {
    color: white;
    font-size: 24px;
}

.thumbnail-images-modal {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.thumbnail-item-modal {
    width: 80px;
    height: 80px;
    border-radius: 10px;
    overflow: hidden;
    cursor: pointer;
    border: 3px solid transparent;
    transition: all 0.3s ease;
    background: white;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.thumbnail-item-modal.active {
    border-color: #e74c3c;
    transform: scale(1.05);
}

.thumbnail-item-modal img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Product Details Modal */
.product-detail-info-modal {
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    height: fit-content;
}

.product-badge-modal {
    margin-bottom: 15px;
}

.product-badge-modal span {
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge-discount {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
}

.badge-popular {
    background: linear-gradient(135deg, #f39c12, #e67e22);
    color: white;
}

.product-category-modal {
    color: #e74c3c;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 10px;
}

.product-title-modal {
    color: #2c3e50;
    font-size: 28px;
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

.stars-modal {
    display: flex;
    gap: 2px;
}

.stars-modal i {
    color: #ffc107;
    font-size: 16px;
}

.stars-modal i.fa-star-o {
    color: #ddd;
}

.rating-text-modal {
    color: #666;
    font-size: 14px;
}

.product-price-modal {
    background: white;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 25px;
    border: 2px solid #f0f0f0;
    display: flex;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
}

.current-price-modal {
    font-size: 2rem;
    font-weight: 700;
    color: #e74c3c;
}

.old-price-modal {
    font-size: 1.2rem;
    color: #999;
    text-decoration: line-through;
}

.discount-percentage-modal {
    background: #27ae60;
    color: white;
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 600;
}

.product-description-modal,
.product-specifications-modal,
.product-quantity-modal {
    margin-bottom: 25px;
}

.product-description-modal h6,
.product-specifications-modal h6,
.product-quantity-modal h6 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 15px;
    font-size: 16px;
}

.product-description-modal p {
    color: #666;
    line-height: 1.6;
    margin: 0;
}

.spec-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid #f0f0f0;
}

.spec-row:last-child {
    border-bottom: none;
}

.spec-label {
    font-weight: 600;
    color: #2c3e50;
}

.spec-value {
    color: #666;
}

.quantity-controls-modal {
    display: flex;
    align-items: center;
    gap: 0;
    background: white;
    border: 2px solid #f0f0f0;
    border-radius: 10px;
    overflow: hidden;
    width: fit-content;
}

.qty-btn-modal {
    width: 45px;
    height: 45px;
    border: none;
    background: #f8f9fa;
    color: #2c3e50;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.qty-btn-modal:hover {
    background: #e74c3c;
    color: white;
}

.qty-input-modal {
    width: 80px;
    height: 45px;
    border: none;
    text-align: center;
    font-weight: 600;
    font-size: 16px;
    background: white;
    color: #2c3e50;
}

.qty-input-modal:focus {
    outline: none;
}

/* Modal Actions */
.modal-actions {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    align-items: center;
}

.add-to-cart-modal-btn {
    flex: 1;
    min-width: 200px;
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    border: none;
    padding: 15px 25px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.add-to-cart-modal-btn:hover {
    background: linear-gradient(135deg, #c0392b, #a93226);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
}

.wishlist-btn-modal,
.share-btn-modal {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    border: 2px solid #f0f0f0;
    background: white;
    color: #666;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}

.wishlist-btn-modal:hover {
    background: #e74c3c;
    color: white;
    border-color: #e74c3c;
}

.share-btn-modal:hover {
    background: #3498db;
    color: white;
    border-color: #3498db;
}

.view-details-btn-modal {
    background: linear-gradient(135deg, #2c3e50, #34495e);
    color: white;
    padding: 15px 25px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.view-details-btn-modal:hover {
    background: linear-gradient(135deg, #34495e, #2c3e50);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(44, 62, 80, 0.3);
}

/* Responsive Modal */
@media (max-width: 1200px) {
    .modal-xl {
        max-width: 95%;
    }
}

@media (max-width: 768px) {
    .modal-dialog {
        margin: 10px;
    }
    
    .modal-body {
        padding: 20px;
    }
    
    .product-detail-info-modal {
        padding: 20px;
        margin-top: 20px;
    }
    
    .main-image-modal img {
        height: 300px;
    }
    
    .product-title-modal {
        font-size: 24px;
    }
    
    .current-price-modal {
        font-size: 1.5rem;
    }
    
    .modal-actions {
        flex-direction: column;
        gap: 10px;
    }
    
    .add-to-cart-modal-btn,
    .view-details-btn-modal {
        width: 100%;
        min-width: auto;
    }
    
    .wishlist-btn-modal,
    .share-btn-modal {
        width: 100%;
        height: 45px;
    }
    
    .thumbnail-images-modal {
        justify-content: center;
    }
    
    .thumbnail-item-modal {
        width: 70px;
        height: 70px;
    }
}

@media (max-width: 576px) {
    .modal-header {
        padding: 15px 20px;
    }
    
    .modal-title {
        font-size: 16px;
    }
    
    .product-title-modal {
        font-size: 20px;
    }
    
    .current-price-modal {
        font-size: 1.3rem;
    }
    
    .product-price-modal {
        padding: 15px;
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .thumbnail-item-modal {
        width: 60px;
        height: 60px;
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

// Quick view function - fetch real product data
function quickView(productId) {
    // Show loading state
    showLoadingModal();
    
    // Show modal immediately
    const modal = new bootstrap.Modal(document.getElementById('productQuickViewModal'));
    modal.show();
    
    // Try to fetch real product data
    fetch(`/api/product/${productId}`)
        .then(response => response.json())
        .then(product => {
            populateModal(product);
        })
        .catch(error => {
            console.log('API fetch failed, using fallback data:', error);
            // Fallback to extracting data from the product card
            const productCard = document.querySelector(`[onclick="quickView(${productId})"]`).closest('.product-card');
            const fallbackProduct = extractProductDataFromCard(productCard, productId);
            populateModal(fallbackProduct);
        });
}

// Show loading state in modal
function showLoadingModal() {
    document.getElementById('modalTitle').textContent = 'Memuat...';
    document.getElementById('modalCategory').textContent = '';
    document.getElementById('modalDescription').textContent = 'Memuat detail produk...';
    document.getElementById('modalCurrentPrice').textContent = '';
    document.getElementById('modalOldPrice').textContent = '';
    document.getElementById('modalDiscount').style.display = 'none';
}

// Extract product data from card element
function extractProductDataFromCard(productCard, productId) {
    const name = productCard.querySelector('.product-title a').textContent.trim();
    const category = productCard.querySelector('.product-category').textContent.trim();
    const description = productCard.querySelector('.product-description').textContent.trim();
    const currentPriceText = productCard.querySelector('.current-price').textContent.trim();
    const oldPriceElement = productCard.querySelector('.old-price');
    const oldPriceText = oldPriceElement ? oldPriceElement.textContent.trim() : null;
    const image = productCard.querySelector('.product-image img').src;
    const badgeElement = productCard.querySelector('.product-badge span');
    
    // Extract prices
    const currentPrice = parseInt(currentPriceText.replace(/[^\d]/g, ''));
    const oldPrice = oldPriceText ? parseInt(oldPriceText.replace(/[^\d]/g, '')) : null;
    const discount = oldPrice ? Math.round(((oldPrice - currentPrice) / oldPrice) * 100) : 0;
    
    return {
        id: productId,
        name: name,
        category: category,
        currentPrice: currentPrice,
        oldPrice: oldPrice,
        discount: discount,
        rating: 5,
        reviewCount: Math.floor(Math.random() * 40) + 10,
        description: description,
        images: [image, image, image],
        specifications: {
            size: 'Medium (25cm x 30cm)',
            weight: '500 gram',
            material: getCategoryMaterial(category),
            color: 'Berbagai Pilihan'
        },
        badge: badgeElement ? badgeElement.className.includes('discount') ? 'discount' : 'popular' : null
    };
}

// Get material based on category
function getCategoryMaterial(category) {
    const materials = {
        'Bucket Satin': 'Satin Premium',
        'Bucket Money': 'Mixed Premium Materials',
        'Bucket Kawat': 'Kawat Premium + Bulu Sintetis',
        'Bucket Glitter': 'Satin Premium + Glitter',
        'Bucket Custom': 'Custom Materials',
        'Bucket Special': 'Premium Mixed Materials'
    };
    return materials[category] || 'Premium Materials';
}

// Populate modal with product data
function populateModal(product) {
    // Basic info
    document.getElementById('modalTitle').textContent = product.name;
    document.getElementById('modalCategory').textContent = product.category;
    document.getElementById('modalDescription').textContent = product.description;
    
    // Pricing
    document.getElementById('modalCurrentPrice').textContent = 'Rp ' + product.currentPrice.toLocaleString('id-ID');
    
    const oldPriceElement = document.getElementById('modalOldPrice');
    const discountElement = document.getElementById('modalDiscount');
    
    if (product.oldPrice && product.oldPrice > product.currentPrice) {
        oldPriceElement.textContent = 'Rp ' + product.oldPrice.toLocaleString('id-ID');
        oldPriceElement.style.display = 'inline';
        discountElement.textContent = product.discount + '% OFF';
        discountElement.style.display = 'inline';
    } else {
        oldPriceElement.style.display = 'none';
        discountElement.style.display = 'none';
    }
    
    // Rating
    document.getElementById('modalRating').textContent = `(${product.reviewCount} ulasan)`;
    
    // Images
    const mainImage = product.images && product.images.length > 0 ? product.images[0] : '/assets/images/product/default.jpg';
    document.getElementById('modalMainImage').src = mainImage;
    document.getElementById('modalThumb1').src = mainImage;
    document.getElementById('modalThumb2').src = product.images && product.images[1] ? product.images[1] : mainImage;
    document.getElementById('modalThumb3').src = product.images && product.images[2] ? product.images[2] : mainImage;
    
    // Specifications
    document.getElementById('modalSize').textContent = product.specifications.size;
    document.getElementById('modalWeight').textContent = product.specifications.weight;
    document.getElementById('modalMaterial').textContent = product.specifications.material;
    document.getElementById('modalColor').textContent = product.specifications.color;
    
    // Badge
    const badgeElement = document.getElementById('modalBadge');
    if (product.badge === 'discount' && product.discount > 0) {
        badgeElement.textContent = `-${product.discount}%`;
        badgeElement.className = 'badge-discount';
        badgeElement.parentElement.style.display = 'block';
    } else if (product.badge === 'popular') {
        badgeElement.textContent = 'Unggulan';
        badgeElement.className = 'badge-popular';
        badgeElement.parentElement.style.display = 'block';
    } else {
        badgeElement.parentElement.style.display = 'none';
    }
    
    // Set up add to cart button
    const addToCartBtn = document.getElementById('modalAddToCart');
    addToCartBtn.onclick = function() {
        addToCartFromModal(product);
    };
    
    // Reset quantity
    document.getElementById('modalQuantity').value = 1;
    
    // Set up view details link
    setupViewDetailsLink(product.id);
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

// Thumbnail image switching
document.addEventListener('DOMContentLoaded', function() {
    const thumbnails = document.querySelectorAll('.thumbnail-item-modal');
    const mainImage = document.getElementById('modalMainImage');
    
    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            // Remove active class from all thumbnails
            thumbnails.forEach(t => t.classList.remove('active'));
            
            // Add active class to clicked thumbnail
            this.classList.add('active');
            
            // Update main image
            const thumbnailImg = this.querySelector('img');
            if (thumbnailImg && mainImage) {
                mainImage.src = thumbnailImg.src;
            }
        });
    });
    
    // Image zoom functionality
    const imageZoomOverlay = document.querySelector('.image-zoom-overlay');
    if (imageZoomOverlay) {
        imageZoomOverlay.addEventListener('click', function() {
            const mainImage = document.getElementById('modalMainImage');
            // Create a larger image view (you can implement a lightbox here)
            window.open(mainImage.src, '_blank');
        });
    }
});

// Set up view details link
function setupViewDetailsLink(productId) {
    const viewDetailsBtn = document.getElementById('modalViewDetails');
    if (viewDetailsBtn) {
        viewDetailsBtn.href = `/product/${productId}`;
    }
}
</script>
@endpush
@endsection

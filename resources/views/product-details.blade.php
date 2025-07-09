@extends('layouts.app')

@section('title', $product->name . ' - Avflowril')
@section('description', $product->meta_description ?: $product->short_description ?: Str::limit($product->description, 160))

@section('content')
    <!-- Breadcrumb Section Start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('shop') }}">Shop</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Start -->
    <div class="product-details-section">
        <div class="container">
            <div class="row">
                <!-- Product Images -->
                <div class="col-lg-6 col-md-6">
                    <div class="product-details-images">
                        <!-- Main Image -->
                        <div class="main-image-wrapper">
                            @if($product->is_on_sale)
                                <div class="product-badge">
                                    <span class="badge-discount">-{{ $product->discount_percentage }}%</span>
                                </div>
                            @elseif($product->featured)
                                <div class="product-badge">
                                    <span class="badge-popular">Unggulan</span>
                                </div>
                            @endif
                            
                            <div class="main-image">
                                <img id="mainProductImage" 
                                     src="{{ $product->main_image ? asset($product->main_image) : asset('assets/images/product/default.jpg') }}" 
                                     alt="{{ $product->name }}" 
                                     class="img-fluid">
                                <div class="image-zoom-overlay">
                                    <i class="fa fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Thumbnail Images -->
                        @if($product->images && is_array($product->images) && count($product->images) > 1)
                            <div class="thumbnail-images">
                                @foreach($product->images as $index => $image)
                                    <div class="thumbnail-item {{ $index === 0 ? 'active' : '' }}" 
                                         onclick="changeMainImage('{{ asset($image) }}', this)">
                                        <img src="{{ asset($image) }}" alt="{{ $product->name }}" class="img-fluid">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Product Info -->
                <div class="col-lg-6 col-md-6">
                    <div class="product-details-info">
                        <!-- Category Badge -->
                        <div class="category-badge">
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
                        
                        <!-- Product Title -->
                        <h1 class="product-title">{{ $product->name }}</h1>
                        
                        <!-- Rating & Reviews -->
                        <div class="rating-section">
                            <div class="stars-wrapper">
                                <div class="stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <span class="rating-score">5.0</span>
                            </div>
                            <span class="review-count">({{ rand(15, 50) }} ulasan)</span>
                        </div>
                        
                        <!-- Price Section -->
                        <div class="price-section">
                            <div class="price-wrapper">
                                @if($product->sale_price)
                                    <div class="price-main">
                                        <span class="current-price">{{ $product->formatted_sale_price }}</span>
                                        <span class="old-price">{{ $product->formatted_price }}</span>
                                    </div>
                                    <div class="discount-badge">
                                        <span class="discount-text">{{ $product->discount_percentage }}% OFF</span>
                                    </div>
                                @else
                                    <div class="price-main">
                                        <span class="current-price">{{ $product->formatted_price }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Stock Status -->
                        <div class="stock-status-card">
                            @if($product->stock_quantity > 0)
                                <div class="stock-available">
                                    <i class="fa fa-check-circle"></i>
                                    <span>Stok tersedia ({{ $product->stock_quantity }} item)</span>
                                </div>
                            @else
                                <div class="stock-unavailable">
                                    <i class="fa fa-times-circle"></i>
                                    <span>Stok habis</span>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Purchase Section -->
                        @if($product->stock_quantity > 0)
                            <div class="purchase-section">
                                <div class="quantity-section">
                                    <label class="quantity-label">Jumlah</label>
                                    <div class="quantity-controls">
                                        <button type="button" class="qty-btn minus" onclick="updateQuantity(-1)">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <input type="number" id="quantity" class="qty-input" value="1" min="1" max="{{ $product->stock_quantity }}">
                                        <button type="button" class="qty-btn plus" onclick="updateQuantity(1)">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="action-buttons">
                                    <button class="add-to-cart-btn" onclick="addToCart({{ $product->id }})">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span>Tambah ke Keranjang</span>
                                    </button>
                                    <button class="wishlist-btn" title="Tambah ke Wishlist">
                                        <i class="fa fa-heart"></i>
                                    </button>
                                    <button class="share-btn" title="Bagikan" onclick="shareProduct()">
                                        <i class="fa fa-share-alt"></i>
                                    </button>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Product Description Card -->
                        @if($product->short_description || $product->description)
                            <div class="info-card description-card">
                                <div class="card-header">
                                    <h6><i class="fa fa-info-circle"></i> Deskripsi Produk</h6>
                                </div>
                                <div class="card-content">
                                    <p>{{ $product->short_description ?: Str::limit($product->description, 150) }}</p>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Product Features Card -->
                        <div class="info-card features-card">
                            <div class="card-header">
                                <h6><i class="fa fa-star"></i> Keunggulan Produk</h6>
                            </div>
                            <div class="card-content">
                                <div class="features-grid">
                                    <div class="feature-item">
                                        <i class="fa fa-gem"></i>
                                        <span>Bahan berkualitas tinggi</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fa fa-palette"></i>
                                        <span>Desain elegan dan menarik</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fa fa-shield-alt"></i>
                                        <span>Tahan lama</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fa fa-calendar-check"></i>
                                        <span>Cocok untuk berbagai acara</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Specifications Card -->
                        <div class="info-card specs-card">
                            <div class="card-header">
                                <h6><i class="fa fa-cog"></i> Spesifikasi</h6>
                            </div>
                            <div class="card-content">
                                <div class="specs-grid">
                                    @if($product->dimensions)
                                        <div class="spec-item">
                                            <span class="spec-label">Ukuran:</span>
                                            <span class="spec-value">{{ $product->dimensions }}</span>
                                        </div>
                                    @endif
                                    @if($product->weight)
                                        <div class="spec-item">
                                            <span class="spec-label">Berat:</span>
                                            <span class="spec-value">{{ $product->weight }} gram</span>
                                        </div>
                                    @endif
                                    <div class="spec-item">
                                        <span class="spec-label">Material:</span>
                                        <span class="spec-value">
                                            @switch($product->category)
                                                @case('satin')
                                                    Satin Premium
                                                    @break
                                                @case('money')
                                                    Mixed Premium Materials
                                                    @break
                                                @case('kawat')
                                                    Kawat Premium + Bulu Sintetis
                                                    @break
                                                @case('glitter')
                                                    Satin Premium + Glitter
                                                    @break
                                                @case('custom')
                                                    Custom Materials
                                                    @break
                                                @case('special')
                                                    Premium Mixed Materials
                                                    @break
                                                @default
                                                    Premium Materials
                                            @endswitch
                                        </span>
                                    </div>
                                    <div class="spec-item">
                                        <span class="spec-label">Warna:</span>
                                        <span class="spec-value">Berbagai Pilihan</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Delivery Info Card -->
                        <div class="info-card delivery-card">
                            <div class="card-header">
                                <h6><i class="fa fa-shipping-fast"></i> Informasi Pengiriman</h6>
                            </div>
                            <div class="card-content">
                                <div class="delivery-features">
                                    <div class="delivery-item">
                                        <div class="delivery-icon">
                                            <i class="fa fa-truck"></i>
                                        </div>
                                        <div class="delivery-text">
                                            <strong>Pengiriman Cepat</strong>
                                            <span>Same day untuk Jakarta</span>
                                        </div>
                                    </div>
                                    <div class="delivery-item">
                                        <div class="delivery-icon">
                                            <i class="fa fa-shield-alt"></i>
                                        </div>
                                        <div class="delivery-text">
                                            <strong>Garansi Kualitas</strong>
                                            <span>100% berkualitas tinggi</span>
                                        </div>
                                    </div>
                                    <div class="delivery-item">
                                        <div class="delivery-icon">
                                            <i class="fa fa-undo"></i>
                                        </div>
                                        <div class="delivery-text">
                                            <strong>Easy Return</strong>
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
    </div>
    <!-- Product Details Section End -->

    <!-- Product Description Section Start -->
    <div class="product-description-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-tabs">
                        <ul class="nav nav-tabs" id="productTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab">
                                    Deskripsi
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="specifications-tab" data-bs-toggle="tab" data-bs-target="#specifications" type="button" role="tab">
                                    Spesifikasi
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">
                                    Ulasan
                                </button>
                            </li>
                        </ul>
                        
                        <div class="tab-content" id="productTabsContent">
                            <!-- Description Tab -->
                            <div class="tab-pane fade show active" id="description" role="tabpanel">
                                <div class="description-content">
                                    {!! nl2br(e($product->description)) !!}
                                </div>
                            </div>
                            
                            <!-- Specifications Tab -->
                            <div class="tab-pane fade" id="specifications" role="tabpanel">
                                <div class="specifications-content">
                                    <table class="table table-striped">
                                        <tbody>
                                            @if($product->sku)
                                                <tr>
                                                    <td><strong>SKU</strong></td>
                                                    <td>{{ $product->sku }}</td>
                                                </tr>
                                            @endif
                                            @if($product->weight)
                                                <tr>
                                                    <td><strong>Berat</strong></td>
                                                    <td>{{ $product->weight }} gram</td>
                                                </tr>
                                            @endif
                                            @if($product->dimensions)
                                                <tr>
                                                    <td><strong>Dimensi</strong></td>
                                                    <td>{{ $product->dimensions }}</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td><strong>Kategori</strong></td>
                                                <td>
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
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Material</strong></td>
                                                <td>
                                                    @switch($product->category)
                                                        @case('satin')
                                                            Satin Premium
                                                            @break
                                                        @case('money')
                                                            Mixed Premium Materials
                                                            @break
                                                        @case('kawat')
                                                            Kawat Premium + Bulu Sintetis
                                                            @break
                                                        @case('glitter')
                                                            Satin Premium + Glitter
                                                            @break
                                                        @case('custom')
                                                            Custom Materials
                                                            @break
                                                        @case('special')
                                                            Premium Mixed Materials
                                                            @break
                                                        @default
                                                            Premium Materials
                                                    @endswitch
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <!-- Reviews Tab -->
                            <div class="tab-pane fade" id="reviews" role="tabpanel">
                                <div class="reviews-content">
                                    <div class="reviews-summary">
                                        <div class="rating-overview">
                                            <div class="average-rating">
                                                <span class="rating-number">5.0</span>
                                                <div class="stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <span class="total-reviews">Berdasarkan {{ rand(15, 50) }} ulasan</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="reviews-list">
                                        <!-- Sample Reviews -->
                                        <div class="review-item">
                                            <div class="reviewer-info">
                                                <div class="reviewer-avatar">
                                                    <i class="fa fa-user-circle"></i>
                                                </div>
                                                <div class="reviewer-details">
                                                    <h6>Sarah M.</h6>
                                                    <div class="review-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <span class="review-date">2 hari yang lalu</span>
                                                </div>
                                            </div>
                                            <div class="review-content">
                                                <p>Produk sangat bagus dan sesuai dengan gambar. Kualitas premium dan pengiriman cepat. Sangat puas dengan pembelian ini!</p>
                                            </div>
                                        </div>
                                        
                                        <div class="review-item">
                                            <div class="reviewer-info">
                                                <div class="reviewer-avatar">
                                                    <i class="fa fa-user-circle"></i>
                                                </div>
                                                <div class="reviewer-details">
                                                    <h6>Andi P.</h6>
                                                    <div class="review-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <span class="review-date">1 minggu yang lalu</span>
                                                </div>
                                            </div>
                                            <div class="review-content">
                                                <p>Bucket bunga yang indah dan elegan. Cocok untuk hadiah anniversary. Terima kasih Avflowril!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Description Section End -->

    <!-- Related Products Section Start -->
    @if($relatedProducts->count() > 0)
        <div class="related-products-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <h2>Produk Serupa</h2>
                            <p>Produk lain yang mungkin Anda sukai</p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    @foreach($relatedProducts as $relatedProduct)
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="product-card">
                                <div class="product-image-wrapper">
                                    @if($relatedProduct->is_on_sale)
                                        <div class="product-badge">
                                            <span class="badge-discount">-{{ $relatedProduct->discount_percentage }}%</span>
                                        </div>
                                    @elseif($relatedProduct->featured)
                                        <div class="product-badge">
                                            <span class="badge-popular">Unggulan</span>
                                        </div>
                                    @endif
                                    <div class="product-image">
                                        <img src="{{ $relatedProduct->main_image ? asset($relatedProduct->main_image) : asset('assets/images/product/default.jpg') }}" 
                                             alt="{{ $relatedProduct->name }}" class="img-fluid">
                                        <div class="product-overlay">
                                            <div class="product-actions">
                                                <a href="{{ route('product.details', $relatedProduct->id) }}" class="action-btn view-btn">
                                                    <i class="fa fa-eye"></i>
                                                    <span>Lihat</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="product-category">
                                        @switch($relatedProduct->category)
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
                                                {{ ucfirst($relatedProduct->category) }}
                                        @endswitch
                                    </div>
                                    <h4 class="product-title">
                                        <a href="{{ route('product.details', $relatedProduct->id) }}">{{ $relatedProduct->name }}</a>
                                    </h4>
                                    <div class="product-price">
                                        @if($relatedProduct->sale_price)
                                            <span class="current-price">{{ $relatedProduct->formatted_sale_price }}</span>
                                            <span class="old-price">{{ $relatedProduct->formatted_price }}</span>
                                        @else
                                            <span class="current-price">{{ $relatedProduct->formatted_price }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- Related Products Section End -->

@push('styles')
<style>
/* Breadcrumb */
.breadcrumb-section {
    background: linear-gradient(135deg, #ffeef0 0%, #fff5f6 100%);
    padding: 25px 0;
    border-bottom: 1px solid #f0f0f0;
}

.breadcrumb {
    background: none;
    margin: 0;
    padding: 0;
    font-size: 0.95rem;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: ">";
    color: #999;
    font-weight: 600;
}

.breadcrumb-item a {
    color: #e74c3c;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.breadcrumb-item a:hover {
    color: #c0392b;
}

.breadcrumb-item.active {
    color: #2c3e50;
    font-weight: 600;
}

/* Product Details */
.product-details-section {
    padding: 60px 0;
    background: #f8f9fa;
}

.product-details-images {
    position: relative;
    margin-bottom: 30px;
}

.main-image-wrapper {
    position: relative;
    margin-bottom: 20px;
}

.product-badge {
    position: absolute;
    top: 20px;
    left: 20px;
    z-index: 2;
}

.product-badge span {
    padding: 8px 16px;
    border-radius: 25px;
    font-size: 0.85rem;
    font-weight: 700;
    color: white;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.2);
}

.badge-discount {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
}

.badge-popular {
    background: linear-gradient(135deg, #f39c12, #e67e22);
}

.main-image {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    background: white;
}

.main-image img {
    width: 100%;
    height: 500px;
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
    flex-wrap: wrap;
}

.thumbnail-item {
    width: 80px;
    height: 80px;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    border: 3px solid transparent;
    transition: all 0.3s ease;
    background: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.thumbnail-item.active {
    border-color: #e74c3c;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
}

.thumbnail-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}

.thumbnail-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Product Info */
.product-details-info {
    padding-left: 40px;
}

/* Category Badge */
.category-badge {
    display: inline-block;
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    padding: 8px 20px;
    border-radius: 25px;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 15px;
    box-shadow: 0 3px 15px rgba(231, 76, 60, 0.3);
}

/* Product Title */
.product-title {
    font-size: 2.2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 20px;
    line-height: 1.3;
    font-family: 'Poppins', sans-serif;
}

/* Rating Section */
.rating-section {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 25px;
    padding: 20px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 3px 15px rgba(0,0,0,0.08);
}

.stars-wrapper {
    display: flex;
    align-items: center;
    gap: 8px;
}

.stars {
    color: #ffc107;
    font-size: 1.1rem;
}

.rating-score {
    font-weight: 700;
    color: #2c3e50;
    font-size: 1.1rem;
}

.review-count {
    color: #666;
    font-size: 0.9rem;
}

/* Price Section */
.price-section {
    margin-bottom: 30px;
}

.price-wrapper {
    background: linear-gradient(135deg, #ffffff, #fafafa);
    border: 2px solid #e74c3c;
    border-radius: 15px;
    padding: 25px;
    position: relative;
    box-shadow: 0 5px 20px rgba(231, 76, 60, 0.1);
}

.price-main {
    display: flex;
    align-items: baseline;
    gap: 15px;
    margin-bottom: 10px;
}

.current-price {
    font-size: 2.5rem;
    font-weight: 800;
    color: #e74c3c;
    line-height: 1;
    font-family: 'Poppins', sans-serif;
}

.old-price {
    font-size: 1.4rem;
    color: #999;
    text-decoration: line-through;
    font-weight: 500;
}

.discount-badge {
    position: absolute;
    top: -10px;
    right: 20px;
}

.discount-text {
    background: linear-gradient(135deg, #27ae60, #2ecc71);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 3px 10px rgba(39, 174, 96, 0.3);
}

/* Stock Status */
.stock-status-card {
    margin-bottom: 25px;
}

.stock-available {
    display: flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    color: #155724;
    padding: 15px 20px;
    border-radius: 12px;
    border: 1px solid #c3e6cb;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(39, 174, 96, 0.1);
}

.stock-unavailable {
    display: flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #f8d7da, #f5c6cb);
    color: #721c24;
    padding: 15px 20px;
    border-radius: 12px;
    border: 1px solid #f5c6cb;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(220, 53, 69, 0.1);
}

/* Purchase Section */
.purchase-section {
    background: white;
    border: 2px solid #e74c3c;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 25px;
    box-shadow: 0 5px 20px rgba(231, 76, 60, 0.1);
}

.quantity-section {
    margin-bottom: 20px;
}

.quantity-label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 12px;
    display: block;
    font-size: 1rem;
}

.quantity-controls {
    display: flex;
    align-items: center;
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    overflow: hidden;
    width: fit-content;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.qty-btn {
    background: white;
    border: none;
    padding: 15px 18px;
    cursor: pointer;
    transition: all 0.3s ease;
    color: #e74c3c;
    font-weight: 600;
}

.qty-btn:hover {
    background: #e74c3c;
    color: white;
}

.qty-input {
    border: none;
    padding: 15px 20px;
    width: 80px;
    text-align: center;
    font-weight: 600;
    background: white;
    color: #2c3e50;
    font-size: 1rem;
}

.qty-input:focus {
    outline: none;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 12px;
    align-items: center;
}

.add-to-cart-btn {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    border: none;
    padding: 18px 30px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    cursor: pointer;
    font-family: 'Poppins', sans-serif;
}

.add-to-cart-btn:hover {
    background: linear-gradient(135deg, #c0392b, #a93226);
    transform: translateY(-3px);
    box-shadow: 0 6px 25px rgba(231, 76, 60, 0.4);
}

.wishlist-btn,
.share-btn {
    background: white;
    border: 2px solid #e9ecef;
    color: #666;
    padding: 18px;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 55px;
    height: 55px;
}

.wishlist-btn:hover {
    border-color: #e74c3c;
    color: #e74c3c;
    background: #ffeef0;
    transform: translateY(-2px);
}

.share-btn:hover {
    border-color: #3498db;
    color: #3498db;
    background: #ebf3fd;
    transform: translateY(-2px);
}

/* Info Cards */
.info-card {
    background: white;
    border-radius: 15px;
    margin-bottom: 20px;
    box-shadow: 0 3px 15px rgba(0,0,0,0.08);
    border: 1px solid #f0f0f0;
    overflow: hidden;
    transition: all 0.3s ease;
}

.info-card:hover {
    box-shadow: 0 5px 25px rgba(0,0,0,0.12);
    transform: translateY(-2px);
}

.card-header {
    background: linear-gradient(135deg, #f8f9fa, #ffffff);
    padding: 15px 20px;
    border-bottom: 1px solid #f0f0f0;
}

.card-header h6 {
    margin: 0;
    font-weight: 600;
    color: #2c3e50;
    font-size: 1rem;
    display: flex;
    align-items: center;
    gap: 8px;
    font-family: 'Poppins', sans-serif;
}

.card-header i {
    color: #e74c3c;
    font-size: 1.1rem;
}

.card-content {
    padding: 20px;
}

/* Features Grid */
.features-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
}

.feature-item:hover {
    background: #e74c3c;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
}

.feature-item i {
    color: #e74c3c;
    font-size: 1.2rem;
    width: 20px;
    text-align: center;
}

.feature-item:hover i {
    color: white;
}

.feature-item span {
    font-weight: 500;
    font-size: 0.9rem;
}

/* Specifications Grid */
.specs-grid {
    display: grid;
    gap: 12px;
}

.spec-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #f0f0f0;
}

.spec-item:last-child {
    border-bottom: none;
}

.spec-label {
    font-weight: 600;
    color: #2c3e50;
    font-size: 0.9rem;
}

.spec-value {
    color: #666;
    font-weight: 500;
    font-size: 0.9rem;
}

/* Delivery Features */
.delivery-features {
    display: grid;
    gap: 15px;
}

.delivery-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 12px;
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
}

.delivery-item:hover {
    background: #e74c3c;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
}

.delivery-icon {
    width: 45px;
    height: 45px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #e74c3c;
    font-size: 1.2rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.delivery-item:hover .delivery-icon {
    background: white;
    color: #e74c3c;
}

.delivery-text {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.delivery-text strong {
    font-weight: 600;
    font-size: 0.95rem;
}

.delivery-text span {
    font-size: 0.85rem;
    opacity: 0.8;
}

.delivery-item:hover .delivery-text span {
    opacity: 1;
}

/* Product Description Section */
.product-description-section {
    padding: 60px 0;
    background: #f8f9fa;
}

.product-tabs .nav-tabs {
    border-bottom: 2px solid #e9ecef;
    margin-bottom: 30px;
}

.product-tabs .nav-link {
    border: none;
    color: #666;
    font-weight: 600;
    padding: 15px 25px;
    border-radius: 0;
    border-bottom: 3px solid transparent;
    transition: all 0.3s ease;
}

.product-tabs .nav-link.active {
    color: #e74c3c;
    border-bottom-color: #e74c3c;
    background: none;
}

.tab-content {
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.description-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #555;
}

.specifications-content .table {
    margin: 0;
}

.specifications-content .table td {
    padding: 15px;
    border-color: #f8f9fa;
}

.reviews-summary {
    margin-bottom: 30px;
    text-align: center;
}

.average-rating {
    display: inline-block;
}

.rating-number {
    font-size: 3rem;
    font-weight: 700;
    color: #e74c3c;
    display: block;
}

.average-rating .stars {
    font-size: 1.5rem;
    margin: 10px 0;
}

.total-reviews {
    color: #666;
    font-size: 0.9rem;
}

.review-item {
    border-bottom: 1px solid #f8f9fa;
    padding: 20px 0;
}

.review-item:last-child {
    border-bottom: none;
}

.reviewer-info {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.reviewer-avatar {
    margin-right: 15px;
}

.reviewer-avatar i {
    font-size: 2.5rem;
    color: #ddd;
}

.reviewer-details h6 {
    margin: 0 0 5px 0;
    font-weight: 600;
}

.review-rating {
    color: #ffc107;
    margin-bottom: 5px;
}

.review-date {
    color: #999;
    font-size: 0.85rem;
}

.review-content p {
    margin: 0;
    color: #555;
    line-height: 1.6;
}

/* Related Products */
.related-products-section {
    padding: 60px 0;
    background: white;
}

.section-title {
    margin-bottom: 50px;
}

.section-title h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 10px;
}

.section-title p {
    color: #666;
    font-size: 1.1rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .product-details-info {
        padding-left: 0;
        margin-top: 30px;
    }
    
    .product-title {
        font-size: 1.8rem;
    }
    
    .current-price {
        font-size: 2rem;
    }
    
    .main-image img {
        height: 300px;
    }
    
    .features-grid {
        grid-template-columns: 1fr;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 15px;
    }
    
    .add-to-cart-btn {
        width: 100%;
    }
    
    .wishlist-btn,
    .share-btn {
        width: 100%;
        height: auto;
        padding: 15px;
    }
    
    .price-wrapper {
        padding: 20px;
    }
    
    .rating-section {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .purchase-section {
        padding: 20px;
    }
    
    .delivery-item {
        padding: 12px;
    }
    
    .delivery-icon {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }
}

@media (max-width: 576px) {
    .product-title {
        font-size: 1.5rem;
    }
    
    .current-price {
        font-size: 1.8rem;
    }
    
    .old-price {
        font-size: 1.2rem;
    }
    
    .thumbnail-item {
        width: 60px;
        height: 60px;
    }
    
    .category-badge {
        font-size: 0.75rem;
        padding: 6px 16px;
    }
    
    .card-content {
        padding: 15px;
    }
    
    .card-header {
        padding: 12px 15px;
    }
    
    .feature-item {
        padding: 10px;
    }
    
    .spec-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
    
    .quantity-controls {
        width: 100%;
        justify-content: center;
    }
    
    .qty-input {
        width: 60px;
    }
    
    .price-main {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    
    .discount-badge {
        position: static;
        margin-top: 10px;
    }
}
</style/* Additional fixes for overlapping issues */
.product-details-info {
    position: relative;
    z-index: 1;
}

.product-badge {
    z-index: 10;
}

.main-image-wrapper {
    position: relative;
    z-index: 1;
}

/* Ensure proper spacing and prevent overlaps */
.info-card {
    clear: both;
    position: relative;
    z-index: 1;
}

.purchase-section {
    clear: both;
    position: relative;
    z-index: 2;
}

/* Fix for mobile overlapping */
@media (max-width: 991px) {
    .product-details-info {
        padding-left: 0 !important;
        margin-top: 40px;
        clear: both;
    }
    
    .product-details-images {
        margin-bottom: 40px;
    }
}

/* Additional mobile fixes */
@media (max-width: 767px) {
    .container {
        padding-left: 15px;
        padding-right: 15px;
    }
    
    .row {
        margin-left: -15px;
        margin-right: -15px;
    }
    
    .col-lg-6, .col-md-6 {
        padding-left: 15px;
        padding-right: 15px;
    }
    
    .product-details-section {
        padding: 40px 0;
    }
    
    .breadcrumb-section {
        padding: 20px 0;
    }
    
    /* Prevent text overflow and overlapping */
    .product-title {
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
    
    .category-badge {
        display: block;
        width: fit-content;
        margin-bottom: 20px;
    }
    
    .price-wrapper {
        overflow: hidden;
    }
    
    .current-price {
        word-wrap: break-word;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Change main image when thumbnail is clicked
function changeMainImage(imageSrc, thumbnailElement) {
    document.getElementById('mainProductImage').src = imageSrc;
    
    // Update active thumbnail
    document.querySelectorAll('.thumbnail-item').forEach(item => {
        item.classList.remove('active');
    });
    thumbnailElement.classList.add('active');
}

// Update quantity
function updateQuantity(change) {
    const quantityInput = document.getElementById('quantity');
    let currentQuantity = parseInt(quantityInput.value);
    let newQuantity = currentQuantity + change;
    
    const maxQuantity = parseInt(quantityInput.getAttribute('max'));
    
    if (newQuantity < 1) newQuantity = 1;
    if (newQuantity > maxQuantity) newQuantity = maxQuantity;
    
    quantityInput.value = newQuantity;
}

// Add to cart function
function addToCart(productId) {
    const quantity = parseInt(document.getElementById('quantity').value);
    
    // This should be replaced with actual AJAX call
    console.log(`Adding product ${productId} to cart with quantity ${quantity}`);
    showNotification('Produk berhasil ditambahkan ke keranjang!', 'success');
}

// Share product
function shareProduct() {
    const productTitle = document.querySelector('.product-title').textContent;
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
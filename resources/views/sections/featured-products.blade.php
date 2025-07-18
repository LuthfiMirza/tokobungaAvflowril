<!-- Featured Products Section Start -->
<section class="featured-products-section section-padding">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header text-center">
            <div class="section-subtitle">Our Best Sellers</div>
            <h2 class="section-title">Featured Products</h2>
            <p class="section-description">Discover our most popular and beautiful flower arrangements</p>
            <div class="section-divider"></div>
        </div>
        
        <!-- Products Grid -->
        <div class="products-grid">
            <div class="row">
                @forelse($featuredProducts ?? [] as $product)
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                        <div class="product-card">
                            <div class="product-image-wrapper">
                                <!-- Product Badge -->
                                @if($product->is_on_sale ?? false)
                                    <div class="product-badge sale-badge">
                                        <span>Sale</span>
                                    </div>
                                @elseif($product->featured ?? false)
                                    <div class="product-badge featured-badge">
                                        <span>Featured</span>
                                    </div>
                                @endif
                                
                                <!-- Product Image -->
                                <div class="product-image">
                                    <a href="{{ route('product.details', $product->id ?? '#') }}">
                                        <img src="{{ asset($product->main_image ?? 'assets/images/product/default.jpg') }}" 
                                             alt="{{ $product->name ?? 'Product' }}" 
                                             class="img-fluid">
                                    </a>
                                </div>
                                
                                <!-- Product Actions -->
                                <div class="product-actions">
                                    <button class="action-btn quickview-btn" title="Quick View" data-product-id="{{ $product->id ?? '' }}" onclick="quickView({{ $product->id ?? '1' }})">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Product Content -->
                            <div class="product-content">
                                <div class="product-category">
                                    <span>{{ $product->category ?? 'Flower Arrangement' }}</span>
                                </div>
                                
                                <h3 class="product-title">
                                    <a href="{{ route('product.details', $product->id ?? '#') }}">
                                        {{ $product->name ?? 'Beautiful Flower Arrangement' }}
                                    </a>
                                </h3>
                                
                                <div class="product-rating">
                                    <div class="stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fa fa-star{{ $i <= ($product->rating ?? 5) ? '' : '-o' }}"></i>
                                        @endfor
                                    </div>
                                    <span class="rating-count">({{ $product->reviews_count ?? rand(15, 50) }} reviews)</span>
                                </div>
                                
                                <div class="product-price">
                                    @if($product->is_on_sale ?? false)
                                        <span class="current-price">{{ $product->formatted_sale_price ?? 'Rp 250.000' }}</span>
                                        <span class="old-price">{{ $product->formatted_price ?? 'Rp 350.000' }}</span>
                                        <span class="discount-percent">
                                            -{{ round((($product->price - $product->sale_price) / $product->price) * 100) ?? '29' }}%
                                        </span>
                                    @else
                                        <span class="current-price">{{ $product->formatted_price ?? 'Rp 280.000' }}</span>
                                    @endif
                                </div>
                                
                                <button class="add-to-cart-btn" data-product-id="{{ $product->id ?? '' }}">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Add to Cart</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Default Products when no featured products available -->
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                        <div class="product-card">
                            <div class="product-image-wrapper">
                                <div class="product-badge sale-badge">
                                    <span>Sale</span>
                                </div>
                                <div class="product-image">
                                    <a href="{{ route('product.details', 1) }}">
                                        <img src="{{ asset('assets/images/product/small-size/1.jpg') }}" 
                                             alt="Bucket Bunga Satin Pink" class="img-fluid">
                                    </a>
                                </div>
                                <div class="product-actions">
                                    <button class="action-btn quickview-btn" title="Quick View" onclick="quickView(1)">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="product-category">
                                    <span>Bucket Flowers</span>
                                </div>
                                <h3 class="product-title">
                                    <a href="{{ route('product.details', 1) }}">Bucket Bunga Satin Pink</a>
                                </h3>
                                <div class="product-rating">
                                    <div class="stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <span class="rating-count">(45 reviews)</span>
                                </div>
                                <div class="product-price">
                                    <span class="current-price">Rp 250.000</span>
                                    <span class="old-price">Rp 350.000</span>
                                    <span class="discount-percent">-29%</span>
                                </div>
                                <button class="add-to-cart-btn">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Add to Cart</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                        <div class="product-card">
                            <div class="product-image-wrapper">
                                <div class="product-badge sale-badge">
                                    <span>Sale</span>
                                </div>
                                <div class="product-image">
                                    <a href="{{ route('product.details', 2) }}">
                                        <img src="{{ asset('assets/images/product/small-size/2.jpg') }}" 
                                             alt="Bucket Satin with Glitter" class="img-fluid">
                                    </a>
                                </div>
                                <div class="product-actions">
                                    <button class="action-btn quickview-btn" title="Quick View" onclick="quickView(2)">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="product-category">
                                    <span>Premium Collection</span>
                                </div>
                                <h3 class="product-title">
                                    <a href="{{ route('product.details', 2) }}">Bucket Satin with Glitter</a>
                                </h3>
                                <div class="product-rating">
                                    <div class="stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <span class="rating-count">(36 reviews)</span>
                                </div>
                                <div class="product-price">
                                    <span class="current-price">Rp 370.000</span>
                                    <span class="old-price">Rp 470.000</span>
                                    <span class="discount-percent">-21%</span>
                                </div>
                                <button class="add-to-cart-btn">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Add to Cart</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                        <div class="product-card">
                            <div class="product-image-wrapper">
                                <div class="product-badge sale-badge">
                                    <span>Sale</span>
                                </div>
                                <div class="product-image">
                                    <a href="{{ route('product.details', 3) }}">
                                        <img src="{{ asset('assets/images/product/small-size/3.jpg') }}" 
                                             alt="Bucket Kawat Bulu" class="img-fluid">
                                    </a>
                                </div>
                                <div class="product-actions">
                                    <button class="action-btn quickview-btn" title="Quick View" onclick="quickView(3)">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="product-category">
                                    <span>Unique Design</span>
                                </div>
                                <h3 class="product-title">
                                    <a href="{{ route('product.details', 3) }}">Bucket Kawat Bulu</a>
                                </h3>
                                <div class="product-rating">
                                    <div class="stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <span class="rating-count">(46 reviews)</span>
                                </div>
                                <div class="product-price">
                                    <span class="current-price">Rp 270.000</span>
                                    <span class="old-price">Rp 450.000</span>
                                    <span class="discount-percent">-40%</span>
                                </div>
                                <button class="add-to-cart-btn">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Add to Cart</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                        <div class="product-card">
                            <div class="product-image-wrapper">
                                <div class="product-badge sale-badge">
                                    <span>Sale</span>
                                </div>
                                <div class="product-image">
                                    <a href="{{ route('product.details', 4) }}">
                                        <img src="{{ asset('assets/images/product/small-size/4.jpg') }}" 
                                             alt="Bucket Money Special" class="img-fluid">
                                    </a>
                                </div>
                                <div class="product-actions">
                                    <button class="action-btn quickview-btn" title="Quick View" onclick="quickView(4)">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="product-category">
                                    <span>Special Edition</span>
                                </div>
                                <h3 class="product-title">
                                    <a href="{{ route('product.details', 4) }}">Bucket Money Special</a>
                                </h3>
                                <div class="product-rating">
                                    <div class="stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <span class="rating-count">(31 reviews)</span>
                                </div>
                                <div class="product-price">
                                    <span class="current-price">Rp 310.000</span>
                                    <span class="old-price">Rp 470.000</span>
                                    <span class="discount-percent">-34%</span>
                                </div>
                                <button class="add-to-cart-btn">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Add to Cart</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        
        <!-- View All Products Button -->
        <div class="section-footer text-center">
            <a href="{{ route('shop') }}" class="view-all-btn">
                <span>View All Products</span>
                <i class="fa fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Featured Products Styles -->
<style>
/* Section Styling */
.featured-products-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    padding: 80px 0;
    position: relative;
    overflow: hidden;
}

.featured-products-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23e74c3c" opacity="0.02"/><circle cx="75" cy="75" r="1" fill="%23e74c3c" opacity="0.02"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    pointer-events: none;
}

/* Section Header */
.section-header {
    margin-bottom: 60px;
    position: relative;
    z-index: 1;
}

.section-subtitle {
    color: #e74c3c;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;
}

.section-title {
    font-size: 42px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 20px;
    line-height: 1.2;
}

.section-description {
    font-size: 18px;
    color: #666;
    max-width: 600px;
    margin: 0 auto 30px;
    line-height: 1.6;
}

.section-divider {
    width: 80px;
    height: 4px;
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    margin: 0 auto;
    border-radius: 2px;
}

/* Products Grid */
.products-grid {
    position: relative;
    z-index: 1;
}

/* Product Card */
.product-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    transition: all 0.4s ease;
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.15);
}

/* Product Image Wrapper */
.product-image-wrapper {
    position: relative;
    overflow: hidden;
    border-radius: 20px 20px 0 0;
}

.product-image {
    position: relative;
    overflow: hidden;
    aspect-ratio: 1;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.1);
}

/* Product Badge */
.product-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    z-index: 2;
    border-radius: 20px;
    padding: 6px 12px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.sale-badge {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
}

.featured-badge {
    background: linear-gradient(135deg, #f39c12, #e67e22);
    color: white;
}

/* Product Actions */
.product-actions {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    gap: 10px;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.product-card:hover .product-actions {
    opacity: 1;
    visibility: visible;
}

.action-btn {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: white;
    border: none;
    color: #2c3e50;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.action-btn:hover {
    background: #e74c3c;
    color: white;
    transform: scale(1.1);
}

/* Product Content */
.product-content {
    padding: 25px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.product-category {
    margin-bottom: 8px;
}

.product-category span {
    color: #e74c3c;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.product-title {
    margin-bottom: 15px;
    flex: 1;
}

.product-title a {
    color: #2c3e50;
    text-decoration: none;
    font-size: 18px;
    font-weight: 600;
    line-height: 1.3;
    transition: color 0.3s ease;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.product-title a:hover {
    color: #e74c3c;
}

/* Product Rating */
.product-rating {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 15px;
}

.stars {
    display: flex;
    gap: 2px;
}

.stars i {
    color: #ffc107;
    font-size: 14px;
}

.stars i.fa-star-o {
    color: #ddd;
}

.rating-count {
    color: #666;
    font-size: 12px;
}

/* Product Price */
.product-price {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.current-price {
    color: #e74c3c;
    font-size: 20px;
    font-weight: 700;
}

.old-price {
    color: #999;
    font-size: 16px;
    text-decoration: line-through;
}

.discount-percent {
    background: #27ae60;
    color: white;
    padding: 2px 6px;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 600;
}

/* Add to Cart Button */
.add-to-cart-btn {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
}

.add-to-cart-btn:hover {
    background: linear-gradient(135deg, #c0392b, #a93226);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
}

/* Section Footer */
.section-footer {
    margin-top: 60px;
    position: relative;
    z-index: 1;
}

.view-all-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #2c3e50, #34495e);
    color: white;
    padding: 15px 30px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s ease;
    box-shadow: 0 6px 20px rgba(44, 62, 80, 0.3);
}

.view-all-btn:hover {
    background: linear-gradient(135deg, #34495e, #2c3e50);
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(44, 62, 80, 0.4);
    color: white;
}

.view-all-btn i {
    transition: transform 0.3s ease;
}

.view-all-btn:hover i {
    transform: translateX(5px);
}

/* Responsive Design */
@media (max-width: 1200px) {
    .section-title {
        font-size: 36px;
    }
}

@media (max-width: 768px) {
    .featured-products-section {
        padding: 60px 0;
    }
    
    .section-header {
        margin-bottom: 40px;
    }
    
    .section-title {
        font-size: 28px;
    }
    
    .section-description {
        font-size: 16px;
    }
    
    .product-content {
        padding: 20px;
    }
    
    .product-title a {
        font-size: 16px;
    }
    
    .current-price {
        font-size: 18px;
    }
    
    .action-btn {
        width: 40px;
        height: 40px;
        font-size: 14px;
    }
    
    .section-footer {
        margin-top: 40px;
    }
}

@media (max-width: 576px) {
    .section-title {
        font-size: 24px;
    }
    
    .product-actions {
        gap: 8px;
    }
    
    .action-btn {
        width: 35px;
        height: 35px;
        font-size: 12px;
    }
    
    .view-all-btn {
        padding: 12px 24px;
        font-size: 14px;
    }
}
</style>

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

<!-- Quick View Modal Styles -->
<style>
/* Modal Improvements */
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

<!-- Quick View JavaScript -->
<script>
// Quick view function - improved version
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
            const productCard = document.querySelector(`[data-product-id="${productId}"]`).closest('.product-card');
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
    document.getElementById('modalMainImage').src = '/assets/images/product/loading.jpg';
}

// Extract product data from card (fallback)
function extractProductDataFromCard(productCard, productId) {
    const title = productCard.querySelector('.product-title a')?.textContent || 'Product';
    const category = productCard.querySelector('.product-category span')?.textContent || 'Category';
    const currentPrice = productCard.querySelector('.current-price')?.textContent || 'Rp 0';
    const oldPrice = productCard.querySelector('.old-price')?.textContent || '';
    const discount = productCard.querySelector('.discount-percent')?.textContent || '';
    const image = productCard.querySelector('.product-image img')?.src || '/assets/images/product/default.jpg';
    const rating = productCard.querySelectorAll('.stars i.fa-star').length || 5;
    const reviewCount = productCard.querySelector('.rating-count')?.textContent || '(0 reviews)';
    
    return {
        id: productId,
        name: title,
        category: category,
        currentPrice: currentPrice,
        oldPrice: oldPrice,
        discount: discount,
        rating: rating,
        reviewCount: reviewCount.replace(/[()]/g, ''),
        description: `${title} - Produk berkualitas tinggi dengan desain yang menarik dan bahan premium.`,
        images: [image, image, image, image],
        specifications: {
            size: 'Medium (25cm x 30cm)',
            weight: '500 gram',
            material: 'Premium Materials',
            color: 'Berbagai Pilihan'
        },
        badge: oldPrice ? 'discount' : 'popular'
    };
}

// Populate modal with product data
function populateModal(product) {
    // Basic info
    document.getElementById('modalTitle').textContent = product.name;
    document.getElementById('modalCategory').textContent = product.category;
    document.getElementById('modalDescription').textContent = product.description;
    
    // Pricing
    if (typeof product.currentPrice === 'string') {
        document.getElementById('modalCurrentPrice').textContent = product.currentPrice;
    } else {
        document.getElementById('modalCurrentPrice').textContent = 'Rp ' + product.currentPrice.toLocaleString('id-ID');
    }
    
    const oldPriceElement = document.getElementById('modalOldPrice');
    const discountElement = document.getElementById('modalDiscount');
    
    if (product.oldPrice && product.oldPrice !== '') {
        if (typeof product.oldPrice === 'string') {
            oldPriceElement.textContent = product.oldPrice;
        } else {
            oldPriceElement.textContent = 'Rp ' + product.oldPrice.toLocaleString('id-ID');
        }
        oldPriceElement.style.display = 'inline';
        
        if (product.discount) {
            discountElement.textContent = product.discount;
            discountElement.style.display = 'inline';
        }
    } else {
        oldPriceElement.style.display = 'none';
        discountElement.style.display = 'none';
    }
    
    // Rating
    const starsContainer = document.getElementById('modalStars');
    starsContainer.innerHTML = '';
    for (let i = 1; i <= 5; i++) {
        const star = document.createElement('i');
        star.className = i <= product.rating ? 'fa fa-star' : 'fa fa-star-o';
        starsContainer.appendChild(star);
    }
    
    document.getElementById('modalRating').textContent = `(${product.reviewCount} ulasan)`;
    
    // Images
    const mainImage = product.images && product.images.length > 0 ? product.images[0] : '/assets/images/product/default.jpg';
    document.getElementById('modalMainImage').src = mainImage;
    document.getElementById('modalThumb1').src = mainImage;
    document.getElementById('modalThumb2').src = product.images && product.images[1] ? product.images[1] : mainImage;
    document.getElementById('modalThumb3').src = product.images && product.images[2] ? product.images[2] : mainImage;
    document.getElementById('modalThumb4').src = product.images && product.images[3] ? product.images[3] : mainImage;
    
    // Specifications
    if (product.specifications) {
        document.getElementById('modalSize').textContent = product.specifications.size;
        document.getElementById('modalWeight').textContent = product.specifications.weight;
        document.getElementById('modalMaterial').textContent = product.specifications.material;
        document.getElementById('modalColor').textContent = product.specifications.color;
    }
    
    // Badge
    const badgeElement = document.getElementById('modalBadge');
    if (product.badge === 'discount' && product.discount) {
        badgeElement.className = 'badge-discount';
        badgeElement.textContent = product.discount;
        badgeElement.style.display = 'inline';
    } else if (product.badge === 'popular') {
        badgeElement.className = 'badge-popular';
        badgeElement.textContent = 'Popular';
        badgeElement.style.display = 'inline';
    } else {
        badgeElement.style.display = 'none';
    }
    
    // Set up add to cart button
    const addToCartBtn = document.getElementById('modalAddToCart');
    addToCartBtn.onclick = function() {
        addToCartFromModal(product);
    };
    
    // Set up view details link
    const viewDetailsBtn = document.getElementById('modalViewDetails');
    viewDetailsBtn.href = `/product/${product.id}`;
    
    // Reset quantity
    document.getElementById('modalQuantity').value = 1;
}

// Add to cart from modal
function addToCartFromModal(product) {
    const quantity = parseInt(document.getElementById('modalQuantity').value);
    const btn = document.getElementById('modalAddToCart');
    const originalText = btn.innerHTML;
    
    // Show loading state
    btn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i>Menambahkan...';
    btn.disabled = true;
    
    // Simulate add to cart (replace with actual cart functionality)
    setTimeout(() => {
        btn.innerHTML = '<i class="fa fa-check me-2"></i>Berhasil Ditambahkan!';
        btn.style.background = 'linear-gradient(135deg, #27ae60, #229954)';
        
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.style.background = 'linear-gradient(135deg, #e74c3c, #c0392b)';
            btn.disabled = false;
        }, 2000);
        
        // Close modal after successful add
        setTimeout(() => {
            const modal = bootstrap.Modal.getInstance(document.getElementById('productQuickViewModal'));
            modal.hide();
        }, 1500);
        
    }, 1000);
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

// Share product function
function shareProduct() {
    const productTitle = document.getElementById('modalTitle').textContent;
    const productUrl = window.location.href;
    
    if (navigator.share) {
        navigator.share({
            title: productTitle,
            text: `Check out this amazing product: ${productTitle}`,
            url: productUrl
        });
    } else {
        // Fallback for browsers that don't support Web Share API
        const shareText = `Check out this amazing product: ${productTitle} - ${productUrl}`;
        navigator.clipboard.writeText(shareText).then(() => {
            alert('Product link copied to clipboard!');
        });
    }
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
</script>

<!-- Featured Products Section End -->
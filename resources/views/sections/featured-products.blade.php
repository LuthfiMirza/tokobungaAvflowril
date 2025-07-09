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
                                    <button class="action-btn wishlist-btn" title="Add to Wishlist" data-product-id="{{ $product->id ?? '' }}">
                                        <i class="fa fa-heart-o"></i>
                                    </button>
                                    <button class="action-btn cart-btn" title="Add to Cart" data-product-id="{{ $product->id ?? '' }}">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                    <button class="action-btn quickview-btn" title="Quick View" data-product-id="{{ $product->id ?? '' }}">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button class="action-btn compare-btn" title="Compare" data-product-id="{{ $product->id ?? '' }}">
                                        <i class="fa fa-exchange"></i>
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
                                    <button class="action-btn wishlist-btn" title="Add to Wishlist">
                                        <i class="fa fa-heart-o"></i>
                                    </button>
                                    <button class="action-btn cart-btn" title="Add to Cart">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                    <button class="action-btn quickview-btn" title="Quick View">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button class="action-btn compare-btn" title="Compare">
                                        <i class="fa fa-exchange"></i>
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
                                    <button class="action-btn wishlist-btn" title="Add to Wishlist">
                                        <i class="fa fa-heart-o"></i>
                                    </button>
                                    <button class="action-btn cart-btn" title="Add to Cart">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                    <button class="action-btn quickview-btn" title="Quick View">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button class="action-btn compare-btn" title="Compare">
                                        <i class="fa fa-exchange"></i>
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
                                    <button class="action-btn wishlist-btn" title="Add to Wishlist">
                                        <i class="fa fa-heart-o"></i>
                                    </button>
                                    <button class="action-btn cart-btn" title="Add to Cart">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                    <button class="action-btn quickview-btn" title="Quick View">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button class="action-btn compare-btn" title="Compare">
                                        <i class="fa fa-exchange"></i>
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
                                    <button class="action-btn wishlist-btn" title="Add to Wishlist">
                                        <i class="fa fa-heart-o"></i>
                                    </button>
                                    <button class="action-btn cart-btn" title="Add to Cart">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                    <button class="action-btn quickview-btn" title="Quick View">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button class="action-btn compare-btn" title="Compare">
                                        <i class="fa fa-exchange"></i>
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
<!-- Featured Products Section End -->
<!-- Hero Section Start -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <!-- Hero Content -->
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1>Special Smells<br>Special Bouquets</h1>
                    <p>Discover our top-rated flowers and create unforgettable moments with our carefully crafted bouquets!</p>
                    <a href="{{ route('shop') }}" class="btn-primary">
                        Start buying now
                        <i class="fa fa-arrow-right ml-2"></i>
                    </a>
                    
                    <!-- Hero Features -->
                    <div class="hero-features mt-4">
                        <div class="feature-item">
                            <i class="fa fa-truck"></i>
                            <span>Free Delivery</span>
                        </div>
                        <div class="feature-item">
                            <i class="fa fa-leaf"></i>
                            <span>Fresh Flowers</span>
                        </div>
                        <div class="feature-item">
                            <i class="fa fa-heart"></i>
                            <span>Made with Love</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Hero Image -->
            <div class="col-lg-6">
                <div class="hero-image">
                    <img src="{{ asset('assets/images/collection/bungatulip.png') }}" alt="Beautiful Pink and White Tulips Bouquet">
                    
                    <!-- Floating Elements -->
                    <div class="floating-element element-1">
                        <i class="fa fa-heart"></i>
                    </div>
                    <div class="floating-element element-2">
                        <i class="fa fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Hero Navigation Arrows -->
    <div class="hero-navigation">
        <button class="hero-prev" type="button">
            <i class="fa fa-chevron-left"></i>
        </button>
        <button class="hero-next" type="button">
            <i class="fa fa-chevron-right"></i>
        </button>
    </div>
</section>
<!-- Hero Section End -->
@extends('layouts.app')

@section('title', 'About Us - Avflowril')
@section('description', 'Tentang Avflowril - Cerita dan sejarah kami dalam menyediakan bucket bunga terbaik')

@section('content')
    <!-- Hero About Section -->
    <section class="about-hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-hero-content">
                        <div class="breadcrumb-nav">
                            <a href="{{ route('home') }}">Home</a>
                            <i class="fa fa-chevron-right"></i>
                            <span>About Us</span>
                        </div>
                        <h1>Tentang Avflowril</h1>
                        <p class="hero-subtitle">Menciptakan kebahagiaan melalui keindahan bucket bunga yang dibuat dengan penuh cinta dan dedikasi</p>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- About Story Section -->
    <section class="about-story-section section-padding">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6">
                    <div class="story-content">
                        <div class="section-title text-left">
                            <span class="section-subtitle">Cerita Kami</span>
                            <h2>Bucket Bunga untuk Ulang Tahun & Hadiah</h2>
                        </div>
                        <p>Kami menyediakan berbagai macam bucket bunga yang indah dan berkualitas tinggi untuk berbagai acara spesial. Setiap bucket dibuat dengan penuh cinta dan perhatian detail untuk memberikan kebahagiaan kepada orang tersayang.</p>
                        <div class="story-highlights">
                            <div class="highlight-item">
                                <i class="fa fa-check-circle"></i>
                                <span>Bunga segar pilihan terbaik</span>
                            </div>
                            <div class="highlight-item">
                                <i class="fa fa-check-circle"></i>
                                <span>Desain unik dan personal</span>
                            </div>
                            <div class="highlight-item">
                                <i class="fa fa-check-circle"></i>
                                <span>Pengiriman tepat waktu</span>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="story-image">
                        <img src="{{ asset('assets/images/about/1.jpg') }}" alt="Bucket Bunga Ulang Tahun" class="main-image">
                        <div class="image-overlay">
                            <div class="overlay-content">
                                <i class="fa fa-gift"></i>
                                <span>Perfect Gift</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="story-content">
                        <div class="section-title text-left">
                            <span class="section-subtitle">Koleksi Spesial</span>
                            <h2>Bucket Bunga untuk Hari Pernikahan</h2>
                        </div>
                        <p>Koleksi khusus bucket bunga untuk hari pernikahan yang akan membuat momen spesial Anda semakin berkesan. Dibuat dengan bunga-bunga pilihan terbaik dan desain yang elegan.</p>
                        <div class="story-highlights">
                            <div class="highlight-item">
                                <i class="fa fa-check-circle"></i>
                                <span>Desain romantis dan elegan</span>
                            </div>
                            <div class="highlight-item">
                                <i class="fa fa-check-circle"></i>
                                <span>Bunga premium berkualitas</span>
                            </div>
                            <div class="highlight-item">
                                <i class="fa fa-check-circle"></i>
                                <span>Kemasan mewah dan eksklusif</span>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="story-image">
                        <img src="{{ asset('assets/images/about/2.jpg') }}" alt="Bucket Bunga Pernikahan" class="main-image">
                        <div class="image-overlay">
                            <div class="overlay-content">
                                <i class="fa fa-heart"></i>
                                <span>Wedding Special</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our History Section -->
    <section class="our-history-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <span class="section-subtitle">Sedikit cerita tentang kami</span>
                        <h2>Sejarah Kami</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="history-content">
                        <div class="history-quote">
                            <i class="fa fa-quote-left"></i>
                            <p>Avflowril dimulai dari kecintaan kami terhadap seni merangkai bunga dan keinginan untuk berbagi kebahagiaan.</p>
                        </div>
                        <div class="history-text">
                            <p>Kami memulai perjalanan ini dengan visi sederhana: menciptakan bucket bunga yang tidak hanya indah dipandang, tetapi juga mampu menyampaikan perasaan dan emosi yang mendalam. Setiap bucket yang kami buat adalah hasil dari dedikasi, kreativitas, dan pengalaman bertahun-tahun dalam dunia florist.</p>
                            <p>Kami bangga dapat menjadi bagian dari momen-momen spesial dalam hidup Anda dan orang-orang terkasih. Dari ulang tahun hingga pernikahan, dari ucapan selamat hingga permintaan maaf, setiap bucket bunga kami dirancang untuk menyampaikan pesan yang tepat dengan cara yang paling indah.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <span class="section-subtitle">Nilai-Nilai Kami</span>
                        <h2>Mengapa Memilih Avflowril?</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fa fa-heart"></i>
                        </div>
                        <h3>Dibuat dengan Cinta</h3>
                        <p>Setiap bucket bunga dibuat dengan penuh perhatian dan cinta, memastikan kualitas terbaik untuk momen spesial Anda.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fa fa-leaf"></i>
                        </div>
                        <h3>Bunga Segar</h3>
                        <p>Kami hanya menggunakan bunga-bunga segar pilihan terbaik yang dipetik langsung dari kebun untuk menjaga kesegaran dan keindahan.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fa fa-truck"></i>
                        </div>
                        <h3>Pengiriman Terpercaya</h3>
                        <p>Layanan pengiriman yang cepat dan aman memastikan bucket bunga Anda sampai dalam kondisi sempurna.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
/* About Page Styles */
.about-hero-section {
    background: linear-gradient(135deg, var(--secondary-color), #FAD9E6);
    padding: 80px 0;
    overflow: hidden;
}

.about-hero-content h1 {
    font-family: var(--font-secondary);
    font-size: 48px;
    color: var(--accent-color);
    margin-bottom: 20px;
    line-height: 1.2;
}

.hero-subtitle {
    font-size: 18px;
    color: var(--accent-color);
    margin-bottom: 30px;
    opacity: 0.8;
}

.breadcrumb-nav {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
    font-size: 14px;
}

.breadcrumb-nav a {
    color: var(--accent-color);
    text-decoration: none;
    transition: var(--transition-main);
}

.breadcrumb-nav a:hover {
    color: var(--primary-color);
}

.breadcrumb-nav i {
    font-size: 12px;
    opacity: 0.6;
}

.breadcrumb-nav span {
    color: var(--primary-color);
    font-weight: 600;
}


.about-hero-image {
    position: relative;
}

.about-hero-image img {
    max-width: 100%;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-medium);
}

.section-subtitle {
    color: var(--primary-color);
    font-weight: 600;
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;
    display: block;
}

.story-content h2 {
    font-family: var(--font-secondary);
    font-size: 36px;
    color: var(--accent-color);
    margin-bottom: 20px;
    line-height: 1.3;
}

.story-content p {
    font-size: 16px;
    line-height: 1.8;
    color: var(--accent-color);
    margin-bottom: 25px;
}

.story-highlights {
    margin: 25px 0;
}

.highlight-item {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
}

.highlight-item i {
    color: var(--primary-color);
    font-size: 16px;
}

.highlight-item span {
    color: var(--accent-color);
    font-weight: 500;
}

.story-image {
    position: relative;
    border-radius: var(--border-radius);
    overflow: hidden;
}

.story-image .main-image {
    width: 100%;
    height: 400px;
    object-fit: cover;
    transition: var(--transition-main);
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(217, 90, 141, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: var(--transition-main);
}

.story-image:hover .image-overlay {
    opacity: 1;
}

.story-image:hover .main-image {
    transform: scale(1.05);
}

.overlay-content {
    text-align: center;
    color: var(--white-color);
}

.overlay-content i {
    font-size: 48px;
    margin-bottom: 10px;
    display: block;
}

.overlay-content span {
    font-size: 18px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.our-history-section {
    background: #FDF6F8;
    padding: 80px 0;
}

.history-content {
    text-align: center;
}

.history-quote {
    background: var(--white-color);
    padding: 40px;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-light);
    margin-bottom: 40px;
    position: relative;
}

.history-quote i {
    color: var(--primary-color);
    font-size: 48px;
    margin-bottom: 20px;
}

.history-quote p {
    font-family: var(--font-secondary);
    font-size: 24px;
    color: var(--accent-color);
    font-style: italic;
    margin: 0;
    line-height: 1.4;
}

.history-text p {
    font-size: 16px;
    line-height: 1.8;
    color: var(--accent-color);
    margin-bottom: 20px;
}

.values-section {
    background: var(--white-color);
}

.value-card {
    background: var(--white-color);
    padding: 40px 30px;
    border-radius: var(--border-radius);
    text-align: center;
    box-shadow: var(--shadow-light);
    transition: var(--transition-main);
    margin-bottom: 30px;
    border: 1px solid var(--border-color);
}

.value-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-medium);
    border-color: var(--primary-color);
}

.value-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    transition: var(--transition-main);
}

.value-card:hover .value-icon {
    transform: scale(1.1);
}

.value-icon i {
    color: var(--white-color);
    font-size: 32px;
}

.value-card h3 {
    font-family: var(--font-secondary);
    font-size: 24px;
    color: var(--accent-color);
    margin-bottom: 15px;
}

.value-card p {
    color: var(--accent-color);
    line-height: 1.6;
    margin: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .about-hero-content h1 {
        font-size: 36px;
    }
    
    .story-content h2 {
        font-size: 28px;
    }
    
    .history-quote {
        padding: 30px 20px;
    }
    
    .history-quote p {
        font-size: 20px;
    }
    
    .value-card {
        padding: 30px 20px;
    }
    
    .floating-element {
        display: none;
    }
}

@media (max-width: 576px) {
    .about-hero-section {
        padding: 60px 0;
    }
    
    .about-hero-content h1 {
        font-size: 28px;
    }
    
    .hero-subtitle {
        font-size: 16px;
    }
    
    .story-content h2 {
        font-size: 24px;
    }
    
    .history-quote i {
        font-size: 36px;
    }
    
    .history-quote p {
        font-size: 18px;
    }
}
</style>
@endpush
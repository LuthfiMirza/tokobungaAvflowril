@extends('layouts.app')

@section('title', 'Contact Us - Avflowril')
@section('description', 'Hubungi Avflowril untuk informasi lebih lanjut tentang produk dan layanan kami')

@section('content')
    <!-- Contact Hero Section -->
    <section class="contact-hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="contact-hero-content">
                        <div class="breadcrumb-nav">
                            <a href="{{ route('home') }}">Home</a>
                            <i class="fa fa-chevron-right"></i>
                            <span>Contact Us</span>
                        </div>
                        <h1>Hubungi Kami</h1>
                        <p class="hero-subtitle">Kami siap membantu Anda dengan pertanyaan, pemesanan khusus, atau informasi lebih lanjut tentang produk kami</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-hero-icons">
                        <div class="hero-icon-grid">
                            <a href="mailto:avflowril@gmail.com" class="hero-icon" title="Kirim Email">
                                <i class="fa fa-envelope"></i>
                                <span>Email</span>
                            </a>
                            <a href="tel:+6281384303654" class="hero-icon" title="Telepon Sekarang">
                                <i class="fa fa-phone"></i>
                                <span>Telepon</span>
                            </a>
                            <a href="https://maps.google.com/?q=JL.+Timbul,+Jakarta+Indonesia" target="_blank" class="hero-icon" title="Lihat Lokasi di Maps">
                                <i class="fa fa-map-marker-alt"></i>
                                <span>Lokasi</span>
                            </a>
                            <a href="https://wa.me/6281384303654?text=Halo%20Avflowril,%20saya%20ingin%20bertanya%20tentang%20produk%20Anda" target="_blank" class="hero-icon" title="Chat WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                                <span>WhatsApp</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Info Section -->
    <section class="contact-info-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <span class="section-subtitle">Informasi Kontak</span>
                        <h2>Cara Menghubungi Kami</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="contact-info-card">
                        <div class="contact-icon">
                            <i class="fa fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-content">
                            <h3>Lokasi Kami</h3>
                            <p>JL. Timbul, Jakarta Indonesia (12630)</p>
                            <a href="#" class="contact-link">Lihat di Maps</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="contact-info-card">
                        <div class="contact-icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="contact-content">
                            <h3>Hubungi Kami</h3>
                            <p>0813 8430 3654</p>
                            <a href="tel:081384303654" class="contact-link">Telepon Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="contact-info-card">
                        <div class="contact-icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="contact-content">
                            <h3>Email Kami</h3>
                            <p>avflowril@gmail.com</p>
                            <a href="mailto:avflowril@gmail.com" class="contact-link">Kirim Email</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Operating Hours Section -->
    <section class="operating-hours-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <span class="section-subtitle">Jam Operasional</span>
                        <h2>Kapan Kami Buka?</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="operating-hours-wrapper">
                        <div class="hours-grid">
                            <div class="hours-item">
                                <div class="day">
                                    <i class="fa fa-calendar"></i>
                                    <span>Senin - Jumat</span>
                                </div>
                                <div class="time">08:00 - 20:00 WIB</div>
                            </div>
                            <div class="hours-item">
                                <div class="day">
                                    <i class="fa fa-calendar"></i>
                                    <span>Sabtu</span>
                                </div>
                                <div class="time">08:00 - 18:00 WIB</div>
                            </div>
                            <div class="hours-item">
                                <div class="day">
                                    <i class="fa fa-calendar"></i>
                                    <span>Minggu</span>
                                </div>
                                <div class="time">10:00 - 16:00 WIB</div>
                            </div>
                        </div>
                        <div class="hours-note">
                            <i class="fa fa-info-circle"></i>
                            <p>Untuk pemesanan khusus atau konsultasi design, silakan hubungi kami terlebih dahulu untuk membuat janji</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- WhatsApp CTA Section -->
    <section class="whatsapp-cta-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="whatsapp-cta-content">
                        <div class="whatsapp-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <h2>Butuh Bantuan Segera?</h2>
                        <p>Hubungi kami langsung melalui WhatsApp untuk respon yang lebih cepat</p>
                        <a href="https://wa.me/6281384303654" class="whatsapp-btn" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                            Chat WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
/* Contact Page Styles */
.contact-hero-section {
    background: linear-gradient(135deg, #ffeef0, #fff5f6);
    padding: 80px 0;
    overflow: hidden;
}

.contact-hero-content h1 {
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
    transition: color 0.3s ease;
}

.breadcrumb-nav a:hover {
    color: #c0392b;
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
.contact-hero-icons {
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
    text-decoration: none;
    display: block;
    cursor: pointer;
}

.hero-icon:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(231, 76, 60, 0.2);
    border-color: #e74c3c;
    text-decoration: none;
}

.hero-icon:focus {
    outline: 2px solid #e74c3c;
    outline-offset: 2px;
}

.hero-icon i {
    font-size: 24px;
    color: #e74c3c;
    margin-bottom: 10px;
    display: block;
    transition: all 0.3s ease;
}

.hero-icon:hover i {
    transform: scale(1.1);
    color: #c0392b;
}

.hero-icon span {
    font-size: 14px;
    color: #666;
    font-weight: 600;
    transition: color 0.3s ease;
}

.hero-icon:hover span {
    color: #e74c3c;
}

/* Contact Info Section */
.contact-info-section {
    background: white;
    padding: 80px 0;
}

.contact-info-card {
    background: white;
    padding: 40px 30px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    margin-bottom: 30px;
    border: 2px solid #f0f0f0;
}

.contact-info-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 40px rgba(231, 76, 60, 0.15);
    border-color: #e74c3c;
}

.contact-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    transition: all 0.3s ease;
}

.contact-info-card:hover .contact-icon {
    transform: scale(1.1);
}

.contact-icon i {
    color: white;
    font-size: 32px;
}

.contact-content h3 {
    font-size: 24px;
    color: #2c3e50;
    margin-bottom: 15px;
    font-weight: 600;
}

.contact-content p {
    color: #666;
    margin-bottom: 15px;
    font-size: 16px;
}

.contact-link {
    color: #e74c3c;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.contact-link:hover {
    color: #c0392b;
    text-decoration: underline;
}

/* Contact Form Section */
.contact-form-section {
    background: #fdf6f8;
    padding: 80px 0;
}

.contact-form-wrapper {
    background: white;
    padding: 50px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.modern-contact-form .form-group {
    position: relative;
    margin-bottom: 30px;
}

.modern-contact-form label {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 10px;
    display: block;
}

.modern-contact-form .form-control {
    width: 100%;
    padding: 15px 50px 15px 20px;
    border: 2px solid #f0f0f0;
    border-radius: 8px;
    font-size: 16px;
    transition: all 0.3s ease;
    background: white;
}

.modern-contact-form .form-control:focus {
    outline: none;
    border-color: #e74c3c;
    box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1);
}

.form-icon {
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    color: #e74c3c;
    font-size: 18px;
    pointer-events: none;
}

.modern-contact-form textarea.form-control {
    resize: vertical;
    min-height: 120px;
}

.modern-contact-form .btn-primary {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    padding: 15px 40px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
}

.modern-contact-form .btn-primary:hover {
    background: linear-gradient(135deg, #c0392b, #a93226);
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(231, 76, 60, 0.4);
}

/* Operating Hours Section */
.operating-hours-section {
    background: white;
    padding: 80px 0;
}

.operating-hours-wrapper {
    background: white;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    border: 2px solid #f0f0f0;
}

.hours-grid {
    margin-bottom: 30px;
}

.hours-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 0;
    border-bottom: 1px solid #f0f0f0;
}

.hours-item:last-child {
    border-bottom: none;
}

.day {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #2c3e50;
    font-weight: 600;
}

.day i {
    color: #e74c3c;
    font-size: 18px;
}

.time {
    color: #e74c3c;
    font-weight: 600;
    font-size: 16px;
}

.hours-note {
    background: #fdf6f8;
    padding: 20px;
    border-radius: 8px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.hours-note i {
    color: #e74c3c;
    font-size: 18px;
    margin-top: 2px;
}

.hours-note p {
    margin: 0;
    color: #666;
    line-height: 1.6;
}

/* WhatsApp CTA Section */
.whatsapp-cta-section {
    background: linear-gradient(135deg, #25d366, #128c7e);
    padding: 80px 0;
    color: white;
}

.whatsapp-cta-content {
    text-align: center;
}

.whatsapp-icon {
    width: 100px;
    height: 100px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 30px;
    animation: float 3s ease-in-out infinite;
}

.whatsapp-icon i {
    font-size: 48px;
    color: white;
}

.whatsapp-cta-content h2 {
    font-size: 36px;
    margin-bottom: 20px;
    color: white;
    font-weight: 700;
}

.whatsapp-cta-content p {
    font-size: 18px;
    margin-bottom: 30px;
    opacity: 0.9;
}

.whatsapp-btn {
    background: white;
    color: #25d366;
    padding: 15px 40px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    font-size: 18px;
    display: inline-flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s ease;
    box-shadow: 0 5px 20px rgba(0,0,0,0.2);
}

.whatsapp-btn:hover {
    background: #f8f9fa;
    color: #25d366;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
}

.whatsapp-btn i {
    font-size: 20px;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

/* Section Titles */
.section-title {
    margin-bottom: 60px;
}

.section-subtitle {
    color: #e74c3c;
    font-weight: 600;
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: block;
    margin-bottom: 10px;
}

.section-title h2 {
    color: #2c3e50;
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 15px;
}

.section-title p {
    color: #666;
    font-size: 16px;
    max-width: 600px;
    margin: 0 auto;
}

/* Responsive Design */
@media (max-width: 768px) {
    .contact-hero-content h1 {
        font-size: 36px;
    }
    
    .hero-icon-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    .hero-icon {
        padding: 20px;
    }
    
    .contact-form-wrapper {
        padding: 30px 20px;
    }
    
    .hours-item {
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }
    
    .whatsapp-cta-content h2 {
        font-size: 28px;
    }
    
    .section-title h2 {
        font-size: 28px;
    }
}

@media (max-width: 576px) {
    .contact-hero-section {
        padding: 60px 0;
    }
    
    .contact-hero-content h1 {
        font-size: 28px;
    }
    
    .hero-subtitle {
        font-size: 16px;
    }
    
    .hero-icon-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .contact-info-card {
        padding: 30px 20px;
    }
    
    .contact-form-wrapper {
        padding: 25px 15px;
    }
    
    .operating-hours-wrapper {
        padding: 25px 20px;
    }
    
    .whatsapp-cta-content h2 {
        font-size: 24px;
    }
    
    .whatsapp-btn {
        padding: 12px 30px;
        font-size: 16px;
    }
    
    .section-title h2 {
        font-size: 24px;
    }
    
    .breadcrumb-nav {
        flex-direction: column;
        gap: 5px;
        text-align: center;
    }
    
    .breadcrumb-nav i {
        display: none;
    }
}
</style>
@endpush

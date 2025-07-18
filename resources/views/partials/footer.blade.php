<!-- Footer Area Start -->
<footer class="modern-footer">
    <!-- Main Footer Content -->
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <!-- Brand & About Section -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget brand-widget">
                        <div class="footer-logo">
                            <h3>Avflowril</h3>
                            <span class="tagline">Beautiful Bucket Flowers</span>
                        </div>
                        <p class="brand-description">
                            Spesialis bucket bunga terbaik untuk hadiah istimewa. Kami menciptakan kebahagiaan melalui keindahan bucket bunga yang dibuat dengan penuh cinta dan dedikasi.
                        </p>
                        
                        <!-- Social Media Links -->
                        <div class="social-links">
                            <h5>Ikuti Kami</h5>
                            <div class="social-icons">
                                <a href="#" class="social-link facebook" title="Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="social-link instagram" title="Instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="social-link whatsapp" title="WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                <a href="#" class="social-link tiktok" title="TikTok">
                                    <i class="fab fa-tiktok"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Links Section -->
                <div class="col-lg-2 col-md-6">
                    <div class="footer-widget links-widget">
                        <h4 class="widget-title">Navigasi</h4>
                        <ul class="footer-links">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('about') }}">About</a></li>
                            <li><a href="{{ route('shop') }}">Shop</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Categories Section -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget links-widget">
                        <h4 class="widget-title">Kategori Produk</h4>
                        <ul class="footer-links">
                            <li><a href="{{ route('shop') }}">Bucket Satin</a></li>
                            <li><a href="{{ route('shop') }}">Bucket Money</a></li>
                            <li><a href="{{ route('shop') }}">Bucket Kawat Bulu</a></li>
                            <li><a href="{{ route('shop') }}">Bucket Glitter</a></li>
                            <li><a href="{{ route('shop') }}">Bucket Custom</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Contact & Newsletter Section -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget contact-widget">
                        <h4 class="widget-title">Hubungi Kami</h4>
                        
                        <!-- Contact Info -->
                        <div class="contact-info">
                            <div class="contact-item">
                                <i class="fa fa-phone"></i>
                                <div class="contact-details">
                                    <span class="label">Telepon</span>
                                    <a href="tel:+6281234567890">+62 812 3456 7890</a>
                                </div>
                            </div>
                            <div class="contact-item">
                                <i class="fa fa-envelope"></i>
                                <div class="contact-details">
                                    <span class="label">Email</span>
                                    <a href="mailto:avflowril@gmail.com">avflowril@gmail.com</a>
                                </div>
                            </div>
                            <div class="contact-item">
                                <i class="fa fa-map-marker-alt"></i>
                                <div class="contact-details">
                                    <span class="label">Alamat</span>
                                    <span>JL. Timbul, Jakarta Indonesia</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Newsletter -->
                        <div class="newsletter-section">
                            <h5>Newsletter</h5>
                            <p>Dapatkan update terbaru dan promo spesial</p>
                            <form class="newsletter-form" action="#" method="POST">
                                @csrf
                                <div class="newsletter-input">
                                    <input type="email" name="email" placeholder="Email Anda" required>
                                    <button type="submit" class="newsletter-btn">
                                        <i class="fa fa-paper-plane"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="copyright-text">
                        <p>&copy; {{ date('Y') }} <strong>Avflowril</strong>. All Rights Reserved.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-bottom-links">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms of Service</a>
                        <a href="#">Shipping Info</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Area End -->

<style>
/* Modern Footer Styles */
.modern-footer {
    background: linear-gradient(135deg, #FDF6F8, #F2C4D6);
    color: var(--accent-color);
    margin-top: 80px;
    border-top: 3px solid var(--primary-color);
}

.footer-main {
    padding: 60px 0 40px;
}

.footer-widget {
    margin-bottom: 30px;
}

.widget-title {
    font-family: var(--font-secondary);
    font-size: 20px;
    color: var(--accent-color);
    margin-bottom: 25px;
    position: relative;
    padding-bottom: 10px;
    font-weight: 700;
}

.widget-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 2px;
    background: var(--primary-color);
}

/* Brand Widget */
.brand-widget .footer-logo h3 {
    font-family: var(--font-secondary);
    font-size: 32px;
    color: var(--accent-color);
    margin-bottom: 5px;
    font-weight: 700;
}

.brand-widget .tagline {
    color: var(--primary-color);
    font-style: italic;
    font-size: 14px;
    display: block;
    margin-bottom: 20px;
}

.brand-description {
    color: var(--accent-color);
    line-height: 1.6;
    margin-bottom: 30px;
    opacity: 0.8;
}

/* Social Links */
.social-links h5 {
    color: var(--accent-color);
    font-size: 16px;
    margin-bottom: 15px;
    font-weight: 600;
}

.social-icons {
    display: flex;
    gap: 12px;
}

.social-link {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: var(--transition-main);
    font-size: 16px;
}

.social-link.facebook {
    background: #3b5998;
    color: var(--white-color);
}

.social-link.instagram {
    background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
    color: var(--white-color);
}

.social-link.whatsapp {
    background: #25d366;
    color: var(--white-color);
}

.social-link.tiktok {
    background: #000000;
    color: var(--white-color);
}

.social-link:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

/* Footer Links */
.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 12px;
}

.footer-links a {
    color: var(--accent-color);
    text-decoration: none;
    transition: var(--transition-main);
    font-size: 14px;
    display: flex;
    align-items: center;
    opacity: 0.8;
}

.footer-links a::before {
    content: '→';
    color: var(--primary-color);
    margin-right: 8px;
    transition: var(--transition-main);
}

.footer-links a:hover {
    color: var(--primary-color);
    padding-left: 5px;
    opacity: 1;
}

.footer-links a:hover::before {
    margin-right: 12px;
}

/* Contact Widget */
.contact-info {
    margin-bottom: 30px;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    margin-bottom: 20px;
}

.contact-item i {
    color: var(--primary-color);
    font-size: 18px;
    margin-top: 2px;
    width: 20px;
}

.contact-details .label {
    display: block;
    color: var(--primary-color);
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 2px;
    font-weight: 600;
}

.contact-details a,
.contact-details span {
    color: var(--accent-color);
    text-decoration: none;
    font-size: 14px;
    transition: var(--transition-main);
}

.contact-details a:hover {
    color: var(--primary-color);
}

/* Newsletter */
.newsletter-section {
    background: var(--white-color);
    padding: 20px;
    border-radius: var(--border-radius);
    border: 2px solid var(--primary-color);
    box-shadow: var(--shadow-light);
}

.newsletter-section h5 {
    color: var(--accent-color);
    font-size: 16px;
    margin-bottom: 8px;
    font-weight: 600;
}

.newsletter-section p {
    color: var(--accent-color);
    font-size: 13px;
    margin-bottom: 15px;
    opacity: 0.7;
}

.newsletter-input {
    display: flex;
    gap: 0;
    border-radius: 25px;
    overflow: hidden;
    background: #f8f9fa;
    border: 1px solid var(--border-color);
}

.newsletter-input input {
    flex: 1;
    border: none;
    padding: 12px 16px;
    font-size: 14px;
    outline: none;
    background: transparent;
    color: var(--accent-color);
}

.newsletter-input input::placeholder {
    color: var(--accent-color);
    opacity: 0.6;
}

.newsletter-btn {
    background: var(--primary-color);
    color: var(--white-color);
    border: none;
    padding: 12px 16px;
    cursor: pointer;
    transition: var(--transition-main);
}

.newsletter-btn:hover {
    background: var(--primary-dark, #c0392b);
}

/* Footer Bottom */
.footer-bottom {
    background: var(--primary-color);
    padding: 20px 0;
    border-top: 1px solid rgba(217, 90, 141, 0.3);
}

.copyright-text p {
    margin: 0;
    color: var(--white-color);
    font-size: 14px;
}

.footer-bottom-links {
    display: flex;
    justify-content: flex-end;
    gap: 20px;
}

.footer-bottom-links a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    font-size: 13px;
    transition: var(--transition-main);
}

.footer-bottom-links a:hover {
    color: var(--white-color);
}

/* Responsive Design */
@media (max-width: 768px) {
    .footer-main {
        padding: 40px 0 30px;
    }
    
    .social-icons {
        justify-content: center;
    }
    
    .footer-bottom-links {
        justify-content: center;
        margin-top: 15px;
    }
    
    .copyright-text {
        text-align: center;
    }
    
    .newsletter-input {
        flex-direction: column;
        border-radius: var(--border-radius);
    }
    
    .newsletter-input input,
    .newsletter-btn {
        border-radius: 0;
    }
    
    .newsletter-input input {
        border-radius: var(--border-radius) var(--border-radius) 0 0;
    }
    
    .newsletter-btn {
        border-radius: 0 0 var(--border-radius) var(--border-radius);
    }
}

@media (max-width: 576px) {
    .brand-widget .footer-logo h3 {
        font-size: 28px;
    }
    
    .widget-title {
        font-size: 18px;
    }
    
    .contact-item {
        flex-direction: column;
        gap: 8px;
    }
    
    .newsletter-section {
        padding: 15px;
    }
}
</style>
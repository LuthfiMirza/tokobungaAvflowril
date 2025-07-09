@extends('layouts.app')

@section('title', 'Avflowril - Bucket Bunga Terbaik untuk Hadiah Istimewa')
@section('description', 'Spesialis bucket bunga berkualitas tinggi. Hadiah sempurna untuk orang tersayang dengan berbagai pilihan bucket bunga unik dan menarik.')

@section('content')

<!-- Include Hero Section -->
@include('sections.hero')

<!-- Include Featured Products Section -->
@include('sections.featured-products')

<!-- Include Category Banners Section -->
@include('sections.category-banners')

<!-- Include Testimonials Section -->
@include('sections.testimonials')

@endsection

@push('styles')
<style>
/* Additional styles for home page */
.hero-features {
    display: flex;
    gap: 30px;
    margin-top: 30px;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--accent-color);
}

.feature-item i {
    color: var(--primary-color);
    font-size: 20px;
}

.floating-element {
    position: absolute;
    color: var(--primary-color);
    font-size: 24px;
    animation: float 3s ease-in-out infinite;
}

.element-1 {
    top: 20%;
    right: 10%;
    animation-delay: 0s;
}

.element-2 {
    bottom: 20%;
    right: 20%;
    animation-delay: 1.5s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.hero-navigation {
    position: absolute;
    top: 50%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    padding: 0 20px;
    pointer-events: none;
}

.hero-prev, .hero-next {
    background: var(--white-color);
    border: none;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    color: var(--primary-color);
    font-size: 18px;
    box-shadow: var(--shadow-light);
    cursor: pointer;
    pointer-events: all;
    transition: var(--transition-main);
}

.hero-prev:hover, .hero-next:hover {
    background: var(--primary-color);
    color: var(--white-color);
    transform: scale(1.1);
}

@media (max-width: 768px) {
    .hero-features {
        flex-direction: column;
        gap: 15px;
    }
    
    .floating-element {
        display: none;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Add any home page specific JavaScript here
document.addEventListener('DOMContentLoaded', function() {
    // Product card hover effects
    const productCards = document.querySelectorAll('.product-card');
    productCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endpush
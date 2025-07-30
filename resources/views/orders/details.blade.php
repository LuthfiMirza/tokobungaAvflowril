@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->order_number . ' - Avflowril')
@section('description', 'Detail lengkap pesanan Anda di Avflowril')

@section('content')
<!-- Order Details Area Start -->
<div class="order-details-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Page Header -->
                <div class="details-header">
                    <div class="header-content">
                        <h1 class="page-title">
                            <i class="fa fa-receipt me-3"></i>Detail Pesanan
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('orders.my-orders') }}">Pesanan Saya</a></li>
                                <li class="breadcrumb-item active">{{ $order->order_number }}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="header-actions">
                        <a href="{{ route('orders.tracking', $order->order_number) }}" class="btn btn-primary">
                            <i class="fa fa-search me-2"></i>Lacak Pesanan
                        </a>
                    </div>
                </div>

                <!-- Order Summary Card -->
                <div class="order-summary-card">
                    <div class="card-header">
                        <div class="order-info">
                            <h3 class="order-number">{{ $order->order_number }}</h3>
                            <span class="order-date">Dipesan pada {{ $order->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="order-status">
                            <span class="status-badge status-{{ $order->status }}">
                                {{ $order->status_label }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Left Column -->
                    <div class="col-lg-8">
                        <!-- Order Items -->
                        <div class="order-items-card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <i class="fa fa-box me-2"></i>Item Pesanan ({{ $order->orderItems->count() }} item)
                                </h4>
                            </div>
                            
                            <div class="card-body">
                                <div class="items-list">
                                    @foreach($order->orderItems as $item)
                                        <div class="item-row">
                                            <div class="item-image">
                                                <img src="{{ asset($item->product->main_image ?? 'assets/images/product/default.jpg') }}" 
                                                     alt="{{ $item->product->name }}">
                                            </div>
                                            <div class="item-details">
                                                <h6 class="item-name">{{ $item->product->name }}</h6>
                                                <p class="item-category">{{ $item->product->category }}</p>
                                                <div class="item-specs">
                                                    @if($item->product->dimensions)
                                                        <span class="spec">Ukuran: {{ $item->product->dimensions }}</span>
                                                    @endif
                                                    @if($item->product->weight)
                                                        <span class="spec">Berat: {{ $item->product->weight }}g</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="item-pricing">
                                                <div class="quantity">{{ $item->quantity }}x</div>
                                                <div class="price">{{ $item->formatted_price }}</div>
                                                <div class="total">{{ $item->formatted_total }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Tracking Timeline -->
                        <div class="tracking-timeline-card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <i class="fa fa-route me-2"></i>Riwayat Pesanan
                                </h4>
                            </div>
                            
                            <div class="card-body">
                                @if($trackingHistory->count() > 0)
                                    <div class="timeline">
                                        @foreach($trackingHistory as $index => $tracking)
                                            <div class="timeline-item {{ $index === 0 ? 'active' : '' }}">
                                                <div class="timeline-marker">
                                                    <div class="marker-icon status-{{ $tracking->status }}">
                                                        <i class="fa {{ $tracking->status_icon ?? 'fa-circle' }}"></i>
                                                    </div>
                                                </div>
                                                <div class="timeline-content">
                                                    <div class="timeline-header">
                                                        <h5 class="timeline-title">{{ $tracking->title }}</h5>
                                                        <span class="timeline-date">{{ $tracking->formatted_date }}</span>
                                                    </div>
                                                    <p class="timeline-description">{{ $tracking->description }}</p>
                                                    @if($tracking->location)
                                                        <div class="timeline-location">
                                                            <i class="fa fa-map-marker-alt me-1"></i>
                                                            {{ $tracking->location }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="no-tracking">
                                        <i class="fa fa-info-circle"></i>
                                        <p>Belum ada riwayat tracking untuk pesanan ini.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-lg-4">
                        <!-- Order Summary -->
                        <div class="order-total-card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <i class="fa fa-calculator me-2"></i>Ringkasan Pesanan
                                </h4>
                            </div>
                            
                            <div class="card-body">
                                <div class="summary-list">
                                    <div class="summary-row">
                                        <span class="label">Subtotal ({{ $order->orderItems->count() }} item)</span>
                                        <span class="value">{{ $order->formatted_subtotal }}</span>
                                    </div>
                                    
                                    @if($order->shipping_amount > 0)
                                        <div class="summary-row">
                                            <span class="label">Ongkos Kirim</span>
                                            <span class="value">{{ $order->formatted_shipping_cost }}</span>
                                        </div>
                                    @endif
                                    
                                    @if($order->discount_amount > 0)
                                        <div class="summary-row discount">
                                            <span class="label">Diskon</span>
                                            <span class="value">-{{ $order->formatted_discount }}</span>
                                        </div>
                                    @endif
                                    
                                    <div class="summary-divider"></div>
                                    
                                    <div class="summary-row total">
                                        <span class="label">Total Pembayaran</span>
                                        <span class="value">{{ $order->formatted_total }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Info -->
                        <div class="payment-info-card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <i class="fa fa-credit-card me-2"></i>Informasi Pembayaran
                                </h4>
                            </div>
                            
                            <div class="card-body">
                                <div class="payment-details">
                                    <div class="detail-row">
                                        <span class="label">Metode Pembayaran</span>
                                        <span class="value">
                                            @switch($order->payment_method)
                                                @case('bank_transfer')
                                                    Transfer Bank
                                                    @break
                                                @case('e_wallet')
                                                    E-Wallet
                                                    @break
                                                @case('cod')
                                                    Cash on Delivery (COD)
                                                    @break
                                                @default
                                                    {{ ucfirst($order->payment_method) }}
                                            @endswitch
                                        </span>
                                    </div>
                                    
                                    <div class="detail-row">
                                        <span class="label">Status Pembayaran</span>
                                        <span class="value">
                                            <span class="payment-status status-{{ $order->payment_status ?? 'pending' }}">
                                                {{ $order->payment_status_label ?? 'Menunggu Pembayaran' }}
                                            </span>
                                        </span>
                                    </div>
                                    
                                    @if($order->payment_method !== 'cod' && $order->status === 'pending' && ($order->payment_status === 'pending' || $order->payment_status === null))
                                        <div class="payment-action">
                                            <a href="{{ route('checkout.payment', $order->order_number) }}" class="btn btn-success btn-block">
                                                <i class="fa fa-credit-card me-2"></i>Lanjut Pembayaran
                                            </a>
                                        </div>
                                    @elseif($order->payment_status === 'paid' || $order->payment_status === 'confirmed')
                                        <div class="payment-success">
                                            <div class="success-message">
                                                <i class="fa fa-check-circle me-2"></i>
                                                <span>Pembayaran telah dikonfirmasi</span>
                                            </div>
                                            @if($order->payment_proof)
                                                <div class="payment-proof-info">
                                                    <small class="text-muted">
                                                        <i class="fa fa-image me-1"></i>
                                                        Bukti pembayaran telah diterima
                                                    </small>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Info -->
                        <div class="shipping-info-card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <i class="fa fa-truck me-2"></i>Informasi Pengiriman
                                </h4>
                            </div>
                            
                            <div class="card-body">
                                <div class="shipping-details">
                                    <div class="recipient-info">
                                        <h6 class="recipient-name">{{ $order->shipping_name }}</h6>
                                        <p class="recipient-phone">{{ $order->shipping_phone }}</p>
                                    </div>
                                    
                                    <div class="address-info">
                                        <i class="fa fa-map-marker-alt me-2"></i>
                                        <div class="address-text">
                                            {{ $order->shipping_address_string }}
                                            @if($order->shipping_city)
                                                <br>{{ $order->shipping_city }}
                                            @endif
                                            @if($order->shipping_postal_code)
                                                {{ $order->shipping_postal_code }}
                                            @endif
                                        </div>
                                    </div>
                                    
                                    @if($order->shipping_notes)
                                        <div class="shipping-notes">
                                            <i class="fa fa-sticky-note me-2"></i>
                                            <div class="notes-text">
                                                <strong>Catatan:</strong><br>
                                                {{ $order->shipping_notes }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Order Actions -->
                        <div class="order-actions-card">
                            <div class="card-body">
                                <div class="actions-list">
                                    @if(in_array($order->status, ['pending', 'confirmed']))
                                        <form action="{{ route('orders.cancel', $order->id) }}" method="POST" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-block">
                                                <i class="fa fa-times me-2"></i>Batalkan Pesanan
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <button onclick="window.print()" class="btn btn-outline-secondary btn-block">
                                        <i class="fa fa-print me-2"></i>Cetak Detail
                                    </button>
                                    
                                    <a href="{{ route('orders.my-orders') }}" class="btn btn-outline-primary btn-block">
                                        <i class="fa fa-arrow-left me-2"></i>Kembali ke Daftar Pesanan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Order Details Area End -->

@push('styles')
<style>
/* Order Details Styles */
.order-details-area {
    padding: 80px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
}

/* Page Header */
.details-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    background: white;
    padding: 25px 30px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.page-title {
    color: #2c3e50;
    font-weight: 700;
    font-size: 1.8rem;
    margin-bottom: 10px;
}

.breadcrumb {
    background: none;
    padding: 0;
    margin: 0;
}

.breadcrumb-item a {
    color: #e74c3c;
    text-decoration: none;
}

.breadcrumb-item.active {
    color: #666;
}

/* Card Styles */
.order-summary-card,
.order-items-card,
.tracking-timeline-card,
.order-total-card,
.payment-info-card,
.shipping-info-card,
.order-actions-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    margin-bottom: 25px;
    overflow: hidden;
}

.card-header {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    padding: 20px 25px;
}

.card-title {
    margin: 0;
    font-weight: 600;
    font-size: 1.1rem;
}

.card-body {
    padding: 25px;
}

/* Order Summary */
.order-summary-card .card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.order-number {
    font-family: 'Courier New', monospace;
    font-size: 1.3rem;
    font-weight: 700;
    margin: 0;
}

.order-date {
    font-size: 0.9rem;
    opacity: 0.9;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    background: rgba(255,255,255,0.2);
    border: 1px solid rgba(255,255,255,0.3);
}

/* Order Items */
.items-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.item-row {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
    border: 1px solid #e9ecef;
}

.item-image {
    width: 80px;
    height: 80px;
    border-radius: 8px;
    overflow: hidden;
    flex-shrink: 0;
}

.item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.item-details {
    flex: 1;
}

.item-name {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 5px;
    font-size: 1rem;
}

.item-category {
    color: #e74c3c;
    font-size: 0.9rem;
    margin-bottom: 8px;
}

.item-specs {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.spec {
    font-size: 0.8rem;
    color: #666;
    background: #e9ecef;
    padding: 2px 8px;
    border-radius: 4px;
}

.item-pricing {
    text-align: right;
    min-width: 120px;
}

.quantity {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 5px;
}

.price {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 5px;
}

.total {
    color: #e74c3c;
    font-weight: 700;
    font-size: 1.1rem;
}

/* Timeline Styles */
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    margin-bottom: 25px;
    padding-left: 40px;
}

.timeline-marker {
    position: absolute;
    left: -40px;
    top: 0;
}

.marker-icon {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.8rem;
    border: 3px solid white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.timeline-content {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 15px;
}

.timeline-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.timeline-title {
    color: #2c3e50;
    font-weight: 600;
    margin: 0;
    font-size: 0.9rem;
}

.timeline-date {
    color: #666;
    font-size: 0.8rem;
}

.timeline-description {
    color: #666;
    margin: 0;
    line-height: 1.4;
}

.timeline-location {
    margin-top: 8px;
    color: #e74c3c;
    font-size: 0.8rem;
}

.no-tracking {
    text-align: center;
    padding: 40px;
    color: #666;
}

.no-tracking i {
    font-size: 2rem;
    margin-bottom: 15px;
    color: #e9ecef;
}

/* Summary List */
.summary-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.9rem;
}

.summary-row.discount .value {
    color: #28a745;
}

.summary-row.total {
    font-weight: 700;
    font-size: 1.1rem;
    color: #e74c3c;
    padding-top: 12px;
    border-top: 2px solid #e9ecef;
}

.summary-divider {
    height: 1px;
    background: #e9ecef;
    margin: 8px 0;
}

/* Payment & Shipping Info */
.payment-details,
.shipping-details {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #f0f0f0;
}

.detail-row:last-child {
    border-bottom: none;
}

.label {
    color: #666;
    font-weight: 500;
}

.value {
    color: #2c3e50;
    font-weight: 600;
}

.payment-status {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.7rem;
    text-transform: uppercase;
}

.payment-action {
    margin-top: 15px;
}

.payment-success {
    margin-top: 15px;
    padding: 15px;
    background: #d4edda;
    border: 1px solid #c3e6cb;
    border-radius: 8px;
}

.success-message {
    display: flex;
    align-items: center;
    color: #155724;
    font-weight: 600;
    margin-bottom: 8px;
}

.success-message i {
    color: #28a745;
    margin-right: 8px;
}

.payment-proof-info {
    margin-top: 8px;
}

.payment-proof-info small {
    display: flex;
    align-items: center;
    color: #6c757d;
}

.payment-proof-info i {
    margin-right: 4px;
}

.recipient-info {
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #e74c3c;
}

.recipient-name {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 5px;
}

.recipient-phone {
    color: #666;
    margin: 0;
}

.address-info,
.shipping-notes {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
}

.address-info i,
.shipping-notes i {
    color: #e74c3c;
    margin-top: 2px;
}

.address-text,
.notes-text {
    color: #2c3e50;
    line-height: 1.5;
}

/* Actions */
.actions-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.btn-block {
    width: 100%;
}

/* Button Styles */
.btn {
    padding: 12px 20px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-primary {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    border-color: #e74c3c;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #c0392b, #a93226);
    color: white;
    transform: translateY(-1px);
}

.btn-success {
    background: #28a745;
    color: white;
    border-color: #28a745;
}

.btn-success:hover {
    background: #218838;
    color: white;
    transform: translateY(-1px);
}

.btn-outline-primary {
    background: transparent;
    color: #e74c3c;
    border-color: #e74c3c;
}

.btn-outline-primary:hover {
    background: #e74c3c;
    color: white;
}

.btn-outline-secondary {
    background: transparent;
    color: #6c757d;
    border-color: #6c757d;
}

.btn-outline-secondary:hover {
    background: #6c757d;
    color: white;
}

.btn-outline-danger {
    background: transparent;
    color: #dc3545;
    border-color: #dc3545;
}

.btn-outline-danger:hover {
    background: #dc3545;
    color: white;
}

/* Responsive Design */
@media (max-width: 768px) {
    .details-header {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .page-title {
        font-size: 1.5rem;
    }
    
    .order-summary-card .card-header {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }
    
    .item-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .item-pricing {
        width: 100%;
        text-align: left;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .timeline-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
    
    .detail-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
}

/* Print Styles */
@media print {
    .details-header .header-actions,
    .order-actions-card {
        display: none !important;
    }
    
    .order-details-area {
        background: white !important;
        padding: 20px 0 !important;
    }
    
    .card-header {
        background: #f8f9fa !important;
        color: #2c3e50 !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Smooth scroll animations
    $('.order-items-card, .tracking-timeline-card').each(function(index) {
        $(this).css('animation-delay', (index * 0.1) + 's');
    });
});
</script>
@endpush
@endsection
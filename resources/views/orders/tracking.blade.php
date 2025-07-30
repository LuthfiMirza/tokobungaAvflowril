@extends('layouts.app')

@section('title', 'Lacak Pesanan #' . $order->order_number . ' - Avflowril')
@section('description', 'Lacak status pesanan Anda di Avflowril')

@section('content')
<!-- Order Tracking Area Start -->
<div class="order-tracking-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Page Header -->
                <div class="tracking-header">
                    <div class="header-content">
                        <h1 class="page-title">
                            <i class="fa fa-search me-3"></i>Lacak Pesanan
                        </h1>
                        <p class="page-subtitle">Pantau status dan lokasi pesanan Anda secara real-time</p>
                    </div>
                </div>

                <!-- Order Summary Card -->
                <div class="order-summary-card">
                    <div class="card-header">
                        <div class="order-info">
                            <h3 class="order-number">{{ $order->order_number }}</h3>
                            <span class="order-date">{{ $order->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="order-status">
                            <span class="status-badge status-{{ $order->status }}">
                                {{ $order->status_label }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="order-details-grid">
                            <div class="detail-item">
                                <i class="fa fa-user text-primary"></i>
                                <div>
                                    <span class="label">Penerima</span>
                                    <span class="value">{{ $order->shipping_name }}</span>
                                </div>
                            </div>
                            <div class="detail-item">
                                <i class="fa fa-phone text-success"></i>
                                <div>
                                    <span class="label">Telepon</span>
                                    <span class="value">{{ $order->shipping_phone }}</span>
                                </div>
                            </div>
                            <div class="detail-item">
                                <i class="fa fa-map-marker-alt text-danger"></i>
                                <div>
                                    <span class="label">Alamat</span>
                                    <span class="value">{{ $order->shipping_address_string }}</span>
                                </div>
                            </div>
                            <div class="detail-item">
                                <i class="fa fa-credit-card text-warning"></i>
                                <div>
                                    <span class="label">Total</span>
                                    <span class="value total-amount">{{ $order->formatted_total }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tracking Timeline -->
                <div class="tracking-timeline-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">
                                <i class="fa fa-route me-2"></i>Riwayat Pengiriman
                            </h4>
                            <div class="auto-refresh-indicator">
                                <span class="refresh-status" id="refresh-status">
                                    <i class="fa fa-sync-alt me-1"></i>Auto-refresh aktif
                                </span>
                                <small class="text-light opacity-75 d-block">Update otomatis setiap 30 detik</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        @if($trackingHistory->count() > 0)
                            <div class="timeline" id="tracking-timeline">
                                @foreach($trackingHistory->reverse() as $index => $tracking)
                                    <div class="timeline-item {{ $index === 0 ? 'active' : '' }}" data-status="{{ $tracking->status }}">
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
                                            @if($tracking->metadata && is_array($tracking->metadata))
                                                <div class="timeline-metadata">
                                                    @if(isset($tracking->metadata['courier']))
                                                        <div class="metadata-item">
                                                            <i class="fa fa-truck me-1"></i>
                                                            <strong>Kurir:</strong> {{ $tracking->metadata['courier'] }}
                                                        </div>
                                                    @endif
                                                    @if(isset($tracking->metadata['tracking_number']))
                                                        <div class="metadata-item">
                                                            <i class="fa fa-barcode me-1"></i>
                                                            <strong>No. Resi:</strong> 
                                                            <span class="tracking-number">{{ $tracking->metadata['tracking_number'] }}</span>
                                                            <button class="btn btn-sm btn-outline-primary ms-2" onclick="copyTrackingNumber('{{ $tracking->metadata['tracking_number'] }}')">
                                                                <i class="fa fa-copy"></i>
                                                            </button>
                                                        </div>
                                                    @endif
                                                    @if(isset($tracking->metadata['estimated_delivery']))
                                                        <div class="metadata-item">
                                                            <i class="fa fa-calendar me-1"></i>
                                                            <strong>Estimasi Tiba:</strong> {{ \Carbon\Carbon::parse($tracking->metadata['estimated_delivery'])->format('d M Y') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <!-- Default tracking steps when no tracking data -->
                            <div class="timeline">
                                <div class="timeline-item {{ $order->status === 'pending' ? 'active' : 'completed' }}">
                                    <div class="timeline-marker">
                                        <div class="marker-icon status-pending">
                                            <i class="fa fa-clock"></i>
                                        </div>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="timeline-header">
                                            <h5 class="timeline-title">Pesanan Diterima</h5>
                                            <span class="timeline-date">{{ $order->created_at->format('d M Y, H:i') }}</span>
                                        </div>
                                        <p class="timeline-description">Pesanan Anda telah diterima dan sedang menunggu konfirmasi pembayaran.</p>
                                    </div>
                                </div>

                                <div class="timeline-item {{ $order->status === 'confirmed' ? 'active' : ($order->status === 'processing' || $order->status === 'shipped' || $order->status === 'delivered' ? 'completed' : '') }}">
                                    <div class="timeline-marker">
                                        <div class="marker-icon status-confirmed">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="timeline-header">
                                            <h5 class="timeline-title">Pembayaran Dikonfirmasi</h5>
                                            <span class="timeline-date">
                                                @if($order->status !== 'pending')
                                                    {{ $order->updated_at->format('d M Y, H:i') }}
                                                @else
                                                    Menunggu konfirmasi
                                                @endif
                                            </span>
                                        </div>
                                        <p class="timeline-description">Pembayaran telah dikonfirmasi dan pesanan mulai diproses.</p>
                                    </div>
                                </div>

                                <div class="timeline-item {{ $order->status === 'processing' ? 'active' : ($order->status === 'shipped' || $order->status === 'delivered' ? 'completed' : '') }}">
                                    <div class="timeline-marker">
                                        <div class="marker-icon status-processing">
                                            <i class="fa fa-cogs"></i>
                                        </div>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="timeline-header">
                                            <h5 class="timeline-title">Sedang Diproses</h5>
                                            <span class="timeline-date">
                                                @if(in_array($order->status, ['processing', 'shipped', 'delivered']))
                                                    {{ $order->updated_at->format('d M Y, H:i') }}
                                                @else
                                                    Menunggu proses
                                                @endif
                                            </span>
                                        </div>
                                        <p class="timeline-description">Pesanan sedang disiapkan oleh tim kami.</p>
                                    </div>
                                </div>

                                <div class="timeline-item {{ $order->status === 'shipped' ? 'active' : ($order->status === 'delivered' ? 'completed' : '') }}">
                                    <div class="timeline-marker">
                                        <div class="marker-icon status-shipped">
                                            <i class="fa fa-truck"></i>
                                        </div>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="timeline-header">
                                            <h5 class="timeline-title">Dalam Pengiriman</h5>
                                            <span class="timeline-date">
                                                @if(in_array($order->status, ['shipped', 'delivered']))
                                                    {{ $order->updated_at->format('d M Y, H:i') }}
                                                @else
                                                    Menunggu pengiriman
                                                @endif
                                            </span>
                                        </div>
                                        <p class="timeline-description">Pesanan sedang dalam perjalanan menuju alamat tujuan.</p>
                                    </div>
                                </div>

                                <div class="timeline-item {{ $order->status === 'delivered' ? 'active completed' : '' }}">
                                    <div class="timeline-marker">
                                        <div class="marker-icon status-delivered">
                                            <i class="fa fa-check-circle"></i>
                                        </div>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="timeline-header">
                                            <h5 class="timeline-title">Pesanan Diterima</h5>
                                            <span class="timeline-date">
                                                @if($order->status === 'delivered')
                                                    {{ $order->updated_at->format('d M Y, H:i') }}
                                                @else
                                                    Menunggu penerimaan
                                                @endif
                                            </span>
                                        </div>
                                        <p class="timeline-description">Pesanan telah berhasil diterima oleh penerima.</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

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
                                        <div class="item-price">
                                            <span class="quantity">{{ $item->quantity }}x</span>
                                            <span class="price">{{ $item->formatted_price }}</span>
                                        </div>
                                    </div>
                                    <div class="item-total">
                                        {{ $item->formatted_total }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    @auth
                        @if($order->user_id === Auth::id())
                            <a href="{{ route('orders.my-orders') }}" class="btn btn-outline-primary">
                                <i class="fa fa-list me-2"></i>Lihat Semua Pesanan
                            </a>
                        @endif
                    @endauth
                    
                    <a href="{{ route('shop') }}" class="btn btn-primary">
                        <i class="fa fa-shopping-bag me-2"></i>Lanjut Belanja
                    </a>
                    
                    <button onclick="window.print()" class="btn btn-secondary">
                        <i class="fa fa-print me-2"></i>Cetak
                    </button>
                </div>

                <!-- Contact Support -->
                <div class="support-card">
                    <div class="support-content">
                        <div class="support-icon">
                            <i class="fa fa-headset"></i>
                        </div>
                        <div class="support-text">
                            <h5>Butuh Bantuan?</h5>
                            <p>Tim customer service kami siap membantu Anda 24/7</p>
                        </div>
                        <div class="support-actions">
                            <a href="https://wa.me/6281384303654" class="btn btn-success btn-sm" target="_blank">
                                <i class="fa fa-whatsapp me-1"></i>WhatsApp
                            </a>
                            <a href="tel:081384303654" class="btn btn-info btn-sm">
                                <i class="fa fa-phone me-1"></i>Telepon
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Order Tracking Area End -->

@push('styles')
<style>
/* Order Tracking Styles */
.order-tracking-area {
    padding: 80px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
}

/* Page Header */
.tracking-header {
    text-align: center;
    margin-bottom: 40px;
}

.page-title {
    color: #2c3e50;
    font-weight: 700;
    font-size: 2.5rem;
    margin-bottom: 10px;
}

.page-subtitle {
    color: #666;
    font-size: 1.1rem;
    margin: 0;
}

/* Card Styles */
.order-summary-card,
.tracking-timeline-card,
.order-items-card,
.support-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    overflow: hidden;
}

.card-header {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    padding: 20px 30px;
    border-bottom: none;
}

.card-title {
    margin: 0;
    font-weight: 600;
    font-size: 1.2rem;
}

.card-body {
    padding: 30px;
}

/* Order Summary */
.order-summary-card .card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.order-number {
    font-family: 'Courier New', monospace;
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0;
}

.order-date {
    font-size: 0.9rem;
    opacity: 0.9;
}

.status-badge {
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
}

.status-pending {
    background: rgba(255, 193, 7, 0.2);
    color: #856404;
    border: 1px solid rgba(255, 193, 7, 0.3);
}

.status-confirmed {
    background: rgba(23, 162, 184, 0.2);
    color: #0c5460;
    border: 1px solid rgba(23, 162, 184, 0.3);
}

.status-processing {
    background: rgba(0, 123, 255, 0.2);
    color: #004085;
    border: 1px solid rgba(0, 123, 255, 0.3);
}

.status-shipped {
    background: rgba(255, 152, 0, 0.2);
    color: #e65100;
    border: 1px solid rgba(255, 152, 0, 0.3);
}

.status-delivered {
    background: rgba(40, 167, 69, 0.2);
    color: #155724;
    border: 1px solid rgba(40, 167, 69, 0.3);
}

.status-cancelled {
    background: rgba(220, 53, 69, 0.2);
    color: #721c24;
    border: 1px solid rgba(220, 53, 69, 0.3);
}

/* Order Details Grid */
.order-details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
    border-left: 4px solid #e74c3c;
}

.detail-item i {
    font-size: 1.2rem;
    width: 20px;
    text-align: center;
}

.detail-item .label {
    display: block;
    font-size: 0.8rem;
    color: #666;
    text-transform: uppercase;
    font-weight: 600;
    margin-bottom: 2px;
}

.detail-item .value {
    display: block;
    color: #2c3e50;
    font-weight: 600;
}

.total-amount {
    color: #e74c3c !important;
    font-size: 1.1rem !important;
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
    margin-bottom: 30px;
    padding-left: 40px;
}

.timeline-item:last-child {
    margin-bottom: 0;
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

.marker-icon.status-pending {
    background: #ffc107;
}

.marker-icon.status-confirmed {
    background: #17a2b8;
}

.marker-icon.status-processing {
    background: #007bff;
}

.marker-icon.status-shipped {
    background: #ff9800;
}

.marker-icon.status-delivered {
    background: #28a745;
}

.timeline-item.active .marker-icon {
    animation: pulse 2s infinite;
}

.timeline-item.completed .marker-icon {
    background: #28a745 !important;
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(231, 76, 60, 0.7); }
    70% { box-shadow: 0 0 0 10px rgba(231, 76, 60, 0); }
    100% { box-shadow: 0 0 0 0 rgba(231, 76, 60, 0); }
}

.timeline-content {
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.timeline-item.active .timeline-content {
    border-color: #e74c3c;
    box-shadow: 0 4px 15px rgba(231, 76, 60, 0.1);
}

.timeline-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.timeline-title {
    color: #2c3e50;
    font-weight: 600;
    margin: 0;
    font-size: 1rem;
}

.timeline-date {
    color: #666;
    font-size: 0.8rem;
    font-weight: 500;
}

.timeline-description {
    color: #666;
    margin: 0;
    line-height: 1.5;
}

.timeline-location {
    margin-top: 10px;
    color: #e74c3c;
    font-size: 0.9rem;
    font-weight: 500;
}

.timeline-metadata {
    margin-top: 15px;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 6px;
    border-left: 3px solid #e74c3c;
}

.metadata-item {
    display: flex;
    align-items: center;
    margin-bottom: 5px;
    font-size: 0.85rem;
}

.metadata-item:last-child {
    margin-bottom: 0;
}

.metadata-item i {
    color: #e74c3c;
    width: 16px;
}

.tracking-number {
    font-family: 'Courier New', monospace;
    background: #e9ecef;
    padding: 2px 6px;
    border-radius: 3px;
    font-weight: 600;
}

/* Auto-refresh indicator */
.auto-refresh-indicator {
    text-align: right;
}

.refresh-status {
    font-size: 0.8rem;
    font-weight: 500;
}

.refresh-status i {
    animation: spin 2s linear infinite;
}

.refresh-status.updating i {
    animation: spin 0.5s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Status-specific marker colors */
.marker-icon.status-payment_uploaded {
    background: #17a2b8;
}

.marker-icon.status-packed {
    background: #6c757d;
}

/* Order Items */
.items-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.item-row {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
    border: 1px solid #e9ecef;
}

.item-image {
    width: 60px;
    height: 60px;
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
    margin-bottom: 4px;
    font-size: 0.9rem;
}

.item-category {
    color: #e74c3c;
    font-size: 0.8rem;
    margin-bottom: 8px;
}

.item-price {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.9rem;
}

.quantity {
    color: #666;
}

.price {
    color: #2c3e50;
    font-weight: 600;
}

.item-total {
    font-weight: 700;
    color: #e74c3c;
    font-size: 0.9rem;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 30px;
}

.btn {
    padding: 12px 25px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.btn-primary {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    border-color: #e74c3c;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #c0392b, #a93226);
    color: white;
    transform: translateY(-2px);
}

.btn-secondary {
    background: #6c757d;
    color: white;
    border-color: #6c757d;
}

.btn-secondary:hover {
    background: #5a6268;
    color: white;
    transform: translateY(-2px);
}

.btn-outline-primary {
    background: transparent;
    color: #e74c3c;
    border-color: #e74c3c;
}

.btn-outline-primary:hover {
    background: #e74c3c;
    color: white;
    transform: translateY(-2px);
}

/* Support Card */
.support-card {
    background: linear-gradient(135deg, #3498db, #2980b9);
    color: white;
}

.support-content {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 25px 30px;
}

.support-icon {
    font-size: 2rem;
    opacity: 0.9;
}

.support-text {
    flex: 1;
}

.support-text h5 {
    margin: 0 0 5px 0;
    font-weight: 600;
}

.support-text p {
    margin: 0;
    opacity: 0.9;
    font-size: 0.9rem;
}

.support-actions {
    display: flex;
    gap: 10px;
}

.btn-sm {
    padding: 8px 15px;
    font-size: 0.8rem;
}

.btn-success {
    background: #25d366;
    border-color: #25d366;
    color: white;
}

.btn-success:hover {
    background: #128c7e;
    border-color: #128c7e;
    color: white;
}

.btn-info {
    background: #17a2b8;
    border-color: #17a2b8;
    color: white;
}

.btn-info:hover {
    background: #138496;
    border-color: #138496;
    color: white;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
    }
    
    .order-summary-card .card-header {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }
    
    .order-details-grid {
        grid-template-columns: 1fr;
    }
    
    .timeline-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
    
    .action-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .btn {
        width: 100%;
        max-width: 300px;
    }
    
    .support-content {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .support-actions {
        justify-content: center;
    }
    
    .item-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .item-details {
        width: 100%;
    }
}

/* Print Styles */
@media print {
    .action-buttons,
    .support-card {
        display: none !important;
    }
    
    .order-tracking-area {
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
let autoRefreshInterval;
let lastTrackingCount = {{ $trackingHistory->count() }};

$(document).ready(function() {
    // Start auto-refresh for non-delivered orders
    @if(!in_array($order->status, ['delivered', 'cancelled']))
        startAutoRefresh();
    @endif
    
    // Smooth scroll to timeline
    if (window.location.hash === '#timeline') {
        $('html, body').animate({
            scrollTop: $('.tracking-timeline-card').offset().top - 100
        }, 1000);
    }
});

function startAutoRefresh() {
    autoRefreshInterval = setInterval(function() {
        updateTrackingData();
    }, 30000); // 30 seconds
}

function stopAutoRefresh() {
    if (autoRefreshInterval) {
        clearInterval(autoRefreshInterval);
        $('#refresh-status').html('<i class="fa fa-pause me-1"></i>Auto-refresh dihentikan');
    }
}

function updateTrackingData() {
    const orderNumber = '{{ $order->order_number }}';
    const refreshStatus = $('#refresh-status');
    
    // Show updating status
    refreshStatus.addClass('updating').html('<i class="fa fa-sync-alt me-1"></i>Memperbarui...');
    
    $.ajax({
        url: `/api/tracking/${orderNumber}`,
        method: 'GET',
        success: function(response) {
            // Check if there are new tracking entries
            if (response.tracking.length > lastTrackingCount) {
                // Reload page to show new tracking data
                location.reload();
            } else {
                // Update status back to normal
                refreshStatus.removeClass('updating').html('<i class="fa fa-sync-alt me-1"></i>Auto-refresh aktif');
            }
            
            // Stop auto-refresh if order is delivered or cancelled
            if (['delivered', 'cancelled'].includes(response.status)) {
                stopAutoRefresh();
                refreshStatus.html('<i class="fa fa-check me-1"></i>Pesanan selesai');
            }
        },
        error: function() {
            refreshStatus.removeClass('updating').html('<i class="fa fa-exclamation-triangle me-1"></i>Error refresh');
            setTimeout(function() {
                refreshStatus.html('<i class="fa fa-sync-alt me-1"></i>Auto-refresh aktif');
            }, 5000);
        }
    });
}

function copyTrackingNumber(trackingNumber) {
    navigator.clipboard.writeText(trackingNumber).then(function() {
        // Show success message
        const button = event.target.closest('button');
        const originalHtml = button.innerHTML;
        button.innerHTML = '<i class="fa fa-check"></i>';
        button.classList.remove('btn-outline-primary');
        button.classList.add('btn-success');
        
        setTimeout(function() {
            button.innerHTML = originalHtml;
            button.classList.remove('btn-success');
            button.classList.add('btn-outline-primary');
        }, 2000);
        
        // Show toast notification
        showToast('Nomor resi berhasil disalin!', 'success');
    }).catch(function() {
        showToast('Gagal menyalin nomor resi', 'error');
    });
}

function showToast(message, type) {
    const toast = $(`
        <div class="toast-notification toast-${type}">
            <i class="fa ${type === 'success' ? 'fa-check' : 'fa-exclamation-triangle'} me-2"></i>
            ${message}
        </div>
    `);
    
    $('body').append(toast);
    
    setTimeout(function() {
        toast.addClass('show');
    }, 100);
    
    setTimeout(function() {
        toast.removeClass('show');
        setTimeout(function() {
            toast.remove();
        }, 300);
    }, 3000);
}
</script>

<style>
.toast-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 12px 20px;
    border-radius: 8px;
    color: white;
    font-weight: 500;
    z-index: 9999;
    transform: translateX(100%);
    transition: transform 0.3s ease;
}

.toast-notification.show {
    transform: translateX(0);
}

.toast-success {
    background: #28a745;
}

.toast-error {
    background: #dc3545;
}
</style>
@endpush
@endsection

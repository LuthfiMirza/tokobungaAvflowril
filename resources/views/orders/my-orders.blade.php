@extends('layouts.app')

@section('title', 'Pesanan Saya - Avflowril')
@section('description', 'Lihat riwayat dan status semua pesanan Anda di Avflowril')

@section('content')
<!-- My Orders Area Start -->
<div class="my-orders-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Page Header -->
                <div class="orders-header">
                    <div class="header-content">
                        <h1 class="page-title">
                            <i class="fa fa-list me-3"></i>Pesanan Saya
                        </h1>
                        <p class="page-subtitle">Kelola dan pantau semua pesanan Anda</p>
                    </div>
                    <div class="header-actions">
                        <a href="{{ route('shop') }}" class="btn btn-primary">
                            <i class="fa fa-shopping-bag me-2"></i>Belanja Lagi
                        </a>
                    </div>
                </div>

                @if($orders->count() > 0)
                    <!-- Orders List -->
                    <div class="orders-list">
                        @foreach($orders as $order)
                            <div class="order-card">
                                <div class="order-header">
                                    <div class="order-info">
                                        <h4 class="order-number">{{ $order->order_number }}</h4>
                                        <span class="order-date">{{ $order->created_at->format('d M Y, H:i') }}</span>
                                    </div>
                                    <div class="order-status">
                                        <span class="status-badge status-{{ $order->status }}">
                                            {{ $order->status_label }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="order-body">
                                    <div class="order-items">
                                        @foreach($order->orderItems->take(3) as $item)
                                            <div class="order-item">
                                                <div class="item-image">
                                                    <img src="{{ asset($item->product->main_image ?? 'assets/images/product/default.jpg') }}" 
                                                         alt="{{ $item->product->name }}">
                                                </div>
                                                <div class="item-details">
                                                    <h6 class="item-name">{{ $item->product->name }}</h6>
                                                    <p class="item-info">{{ $item->quantity }}x {{ $item->formatted_price }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                        
                                        @if($order->orderItems->count() > 3)
                                            <div class="more-items">
                                                <span>+{{ $order->orderItems->count() - 3 }} item lainnya</span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="order-summary">
                                        <div class="summary-row">
                                            <span class="label">Total Item:</span>
                                            <span class="value">{{ $order->orderItems->count() }} item</span>
                                        </div>
                                        <div class="summary-row total">
                                            <span class="label">Total Pembayaran:</span>
                                            <span class="value">{{ $order->formatted_total }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="order-footer">
                                    <div class="order-actions">
                                        <a href="{{ route('orders.tracking', $order->order_number) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-search me-1"></i>Lacak Pesanan
                                        </a>
                                        
                                        <a href="{{ route('orders.details', $order->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-eye me-1"></i>Detail
                                        </a>
                                        
                                        @if(in_array($order->status, ['pending', 'confirmed']))
                                            <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="d-inline" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    <i class="fa fa-times me-1"></i>Batalkan
                                                </button>
                                            </form>
                                        @endif
                                        
                                        @if($order->payment_method !== 'cod' && $order->status === 'pending')
                                            <a href="{{ route('checkout.payment', $order->order_number) }}" class="btn btn-success btn-sm">
                                                <i class="fa fa-credit-card me-1"></i>Bayar
                                            </a>
                                        @endif
                                    </div>
                                    
                                    @if($order->latestTracking)
                                        <div class="latest-tracking">
                                            <i class="fa fa-info-circle me-1"></i>
                                            <span>{{ $order->latestTracking->title ?? 'Update terbaru' }}</span>
                                            <small class="text-muted">{{ $order->latestTracking->formatted_date ?? $order->updated_at->format('d M Y, H:i') }}</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($orders->hasPages())
                        <div class="pagination-wrapper">
                            {{ $orders->links() }}
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="empty-orders">
                        <div class="empty-icon">
                            <i class="fa fa-shopping-bag"></i>
                        </div>
                        <h3>Belum Ada Pesanan</h3>
                        <p>Anda belum memiliki pesanan. Mulai berbelanja sekarang dan temukan produk bucket bunga terbaik!</p>
                        <a href="{{ route('shop') }}" class="btn btn-primary">
                            <i class="fa fa-shopping-bag me-2"></i>Mulai Belanja
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- My Orders Area End -->

@push('styles')
<style>
/* My Orders Styles */
.my-orders-area {
    padding: 80px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
}

/* Page Header */
.orders-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.header-content .page-title {
    color: #2c3e50;
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 5px;
}

.header-content .page-subtitle {
    color: #666;
    margin: 0;
}

/* Order Card */
.order-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    margin-bottom: 25px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.order-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
}

/* Order Header */
.order-header {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    padding: 20px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.order-number {
    font-family: 'Courier New', monospace;
    font-size: 1.2rem;
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

.status-pending {
    background: rgba(255, 193, 7, 0.9) !important;
    color: #856404 !important;
}

.status-confirmed {
    background: rgba(23, 162, 184, 0.9) !important;
    color: #0c5460 !important;
}

.status-processing {
    background: rgba(0, 123, 255, 0.9) !important;
    color: #004085 !important;
}

.status-shipped {
    background: rgba(255, 152, 0, 0.9) !important;
    color: #e65100 !important;
}

.status-delivered {
    background: rgba(40, 167, 69, 0.9) !important;
    color: #155724 !important;
}

.status-cancelled {
    background: rgba(220, 53, 69, 0.9) !important;
    color: #721c24 !important;
}

/* Order Body */
.order-body {
    padding: 25px 30px;
    display: flex;
    gap: 30px;
}

.order-items {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.order-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 12px;
    background: #f8f9fa;
    border-radius: 8px;
}

.item-image {
    width: 50px;
    height: 50px;
    border-radius: 6px;
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
    margin-bottom: 2px;
    font-size: 0.9rem;
}

.item-info {
    color: #666;
    font-size: 0.8rem;
    margin: 0;
}

.more-items {
    text-align: center;
    padding: 10px;
    background: #e9ecef;
    border-radius: 6px;
    color: #666;
    font-size: 0.8rem;
    font-style: italic;
}

/* Order Summary */
.order-summary {
    min-width: 200px;
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    border-left: 4px solid #e74c3c;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
    font-size: 0.9rem;
}

.summary-row.total {
    border-top: 1px solid #dee2e6;
    padding-top: 8px;
    margin-top: 8px;
    font-weight: 600;
    color: #e74c3c;
}

.summary-row .label {
    color: #666;
}

.summary-row .value {
    color: #2c3e50;
    font-weight: 600;
}

/* Order Footer */
.order-footer {
    padding: 20px 30px;
    background: #f8f9fa;
    border-top: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.order-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.btn-sm {
    padding: 6px 12px;
    font-size: 0.8rem;
    border-radius: 6px;
}

.latest-tracking {
    color: #666;
    font-size: 0.8rem;
    display: flex;
    align-items: center;
    gap: 5px;
}

.latest-tracking small {
    margin-left: 5px;
}

/* Button Styles */
.btn {
    padding: 10px 20px;
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

.btn-outline-primary {
    background: transparent;
    color: #e74c3c;
    border-color: #e74c3c;
}

.btn-outline-primary:hover {
    background: #e74c3c;
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

.btn-outline-danger {
    background: transparent;
    color: #dc3545;
    border-color: #dc3545;
}

.btn-outline-danger:hover {
    background: #dc3545;
    color: white;
    transform: translateY(-1px);
}

/* Empty State */
.empty-orders {
    text-align: center;
    padding: 80px 20px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.empty-icon {
    font-size: 4rem;
    color: #e9ecef;
    margin-bottom: 30px;
}

.empty-orders h3 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 15px;
}

.empty-orders p {
    color: #666;
    margin-bottom: 30px;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

/* Pagination */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 40px;
}

.pagination {
    background: white;
    border-radius: 10px;
    padding: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

/* Responsive Design */
@media (max-width: 768px) {
    .orders-header {
        flex-direction: column;
        gap: 20px;
        text-align: center;
    }
    
    .header-content .page-title {
        font-size: 1.5rem;
    }
    
    .order-header {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }
    
    .order-body {
        flex-direction: column;
        gap: 20px;
    }
    
    .order-summary {
        min-width: auto;
    }
    
    .order-footer {
        flex-direction: column;
        gap: 15px;
        align-items: stretch;
    }
    
    .order-actions {
        justify-content: center;
    }
    
    .latest-tracking {
        text-align: center;
        justify-content: center;
    }
    
    .btn-sm {
        flex: 1;
        min-width: 120px;
    }
}

@media (max-width: 576px) {
    .my-orders-area {
        padding: 40px 0;
    }
    
    .orders-header,
    .order-card {
        margin-left: -15px;
        margin-right: -15px;
        border-radius: 0;
    }
    
    .order-header,
    .order-body,
    .order-footer {
        padding: 20px;
    }
    
    .order-actions {
        flex-direction: column;
    }
    
    .btn-sm {
        width: 100%;
    }
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Auto-refresh order status every 60 seconds
    setInterval(function() {
        // You can implement auto-refresh logic here if needed
        console.log('Checking for order updates...');
    }, 60000);
    
    // Smooth animations for order cards
    $('.order-card').each(function(index) {
        $(this).css('animation-delay', (index * 0.1) + 's');
        $(this).addClass('animate__animated animate__fadeInUp');
    });
});
</script>
@endpush
@endsection
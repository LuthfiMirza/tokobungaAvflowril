@extends('layouts.app')

@section('title', 'Pesanan Berhasil - Avflowril')
@section('description', 'Pesanan Anda telah berhasil dibuat - Avflowril')

@section('content')
<!-- Success Area Start -->
<div class="success-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="success-content">
                    <!-- Success Icon -->
                    <div class="success-icon">
                        <i class="fa fa-check-circle"></i>
                    </div>
                    
                    <!-- Success Message -->
                    <div class="success-message">
                        <h1>Pesanan Berhasil Dibuat!</h1>
                        <p class="lead">Terima kasih telah berbelanja di Avflowril. Pesanan Anda telah berhasil dibuat dan akan segera diproses.</p>
                    </div>
                    
                    <!-- Order Information -->
                    <div class="order-info-card">
                        <h4 class="card-title">
                            <i class="fa fa-receipt me-2"></i>Informasi Pesanan
                        </h4>
                        
                        <div class="order-details">
                            <div class="detail-row">
                                <span class="label">Nomor Pesanan:</span>
                                <span class="value order-number">{{ $order->order_number }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="label">Tanggal Pesanan:</span>
                                <span class="value">{{ $order->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="label">Total Pembayaran:</span>
                                <span class="value total-amount">{{ $order->formatted_total }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="label">Metode Pembayaran:</span>
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
                                <span class="label">Status Pesanan:</span>
                                <span class="value">
                                    <span class="status-badge status-{{ $order->status }}">
                                        {{ $order->status_label }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Next Steps -->
                    <div class="next-steps">
                        <h4 class="steps-title">
                            <i class="fa fa-list-ol me-2"></i>Langkah Selanjutnya
                        </h4>
                        
                        @if($order->payment_method === 'cod')
                            <div class="steps-list">
                                <div class="step-item">
                                    <div class="step-number">1</div>
                                    <div class="step-content">
                                        <h6>Pesanan Dikonfirmasi</h6>
                                        <p>Pesanan Anda telah dikonfirmasi dan akan segera diproses oleh tim kami.</p>
                                    </div>
                                </div>
                                <div class="step-item">
                                    <div class="step-number">2</div>
                                    <div class="step-content">
                                        <h6>Persiapan Pengiriman</h6>
                                        <p>Tim kami akan mempersiapkan pesanan Anda untuk pengiriman.</p>
                                    </div>
                                </div>
                                <div class="step-item">
                                    <div class="step-number">3</div>
                                    <div class="step-content">
                                        <h6>Pembayaran saat Terima</h6>
                                        <p>Siapkan uang pas sebesar {{ $order->formatted_total }} untuk pembayaran saat barang diterima.</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="steps-list">
                                <div class="step-item">
                                    <div class="step-number">1</div>
                                    <div class="step-content">
                                        <h6>Lakukan Pembayaran</h6>
                                        <p>Selesaikan pembayaran sesuai instruksi yang telah diberikan dalam 24 jam.</p>
                                    </div>
                                </div>
                                <div class="step-item">
                                    <div class="step-number">2</div>
                                    <div class="step-content">
                                        <h6>Upload Bukti Pembayaran</h6>
                                        <p>Upload bukti transfer untuk mempercepat proses verifikasi.</p>
                                    </div>
                                </div>
                                <div class="step-item">
                                    <div class="step-number">3</div>
                                    <div class="step-content">
                                        <h6>Menunggu Konfirmasi</h6>
                                        <p>Tim kami akan memverifikasi pembayaran dan memproses pesanan Anda.</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        @if($order->payment_method !== 'cod')
                            <a href="{{ route('checkout.payment', $order->order_number) }}" class="btn btn-primary">
                                <i class="fa fa-file-alt me-2"></i>Detail Pesanan
                            </a>
                        @endif
                        
                        <!-- WhatsApp Confirmation Button -->
                        <a href="#" class="btn btn-whatsapp" onclick="confirmOrderViaWhatsApp('{{ $order->order_number }}', '{{ $order->formatted_total }}', '{{ $order->customer_name }}')">
                            <i class="fab fa-whatsapp me-2"></i>Konfirmasi via WhatsApp
                        </a>
                        
                        <a href="{{ route('orders.tracking', $order->order_number) }}" class="btn btn-secondary">
                            <i class="fa fa-search me-2"></i>Lacak Pesanan
                        </a>
                        
                        <a href="{{ route('shop') }}" class="btn btn-outline-primary">
                            <i class="fa fa-shopping-bag me-2"></i>Lanjut Belanja
                        </a>
                    </div>
                    
                    <!-- Contact Info -->
                    <div class="contact-info">
                        <div class="info-card">
                            <i class="fa fa-headset text-primary"></i>
                            <div>
                                <h6>Butuh Bantuan?</h6>
                                <p>Hubungi customer service kami di <strong>+62 813-8430-3654</strong> atau email <strong>support@avflowril.com</strong></p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Order Items Summary -->
                    <div class="order-items-summary">
                        <h4 class="summary-title">
                            <i class="fa fa-box me-2"></i>Item Pesanan
                        </h4>
                        
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
            </div>
        </div>
    </div>
</div>
<!-- Success Area End -->

@push('styles')
<style>
/* Success Area */
.success-area {
    padding: 80px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
}

.success-content {
    background: white;
    border-radius: 20px;
    padding: 50px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    text-align: center;
}

/* Success Icon */
.success-icon {
    margin-bottom: 30px;
}

.success-icon i {
    font-size: 5rem;
    color: #27ae60;
    animation: successPulse 2s ease-in-out infinite;
}

@keyframes successPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

/* Success Message */
.success-message {
    margin-bottom: 40px;
}

.success-message h1 {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 15px;
    font-size: 2.5rem;
}

.success-message .lead {
    color: #666;
    font-size: 1.2rem;
    line-height: 1.6;
}

/* Order Info Card */
.order-info-card {
    background: #f8f9fa;
    border-radius: 15px;
    padding: 30px;
    margin-bottom: 40px;
    text-align: left;
}

.card-title {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 25px;
    font-size: 1.3rem;
    text-align: center;
    padding-bottom: 15px;
    border-bottom: 2px solid #e9ecef;
}

.order-details {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #e9ecef;
}

.detail-row:last-child {
    border-bottom: none;
}

.label {
    font-weight: 600;
    color: #666;
}

.value {
    font-weight: 600;
    color: #2c3e50;
}

.order-number {
    font-family: 'Courier New', monospace;
    background: #e74c3c;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 0.9rem;
}

.total-amount {
    color: #e74c3c;
    font-size: 1.2rem;
}

/* Status Badge */
.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
}

.status-pending {
    background: #fff3cd;
    color: #856404;
}

.status-confirmed {
    background: #d1ecf1;
    color: #0c5460;
}

.status-processing {
    background: #cce5ff;
    color: #004085;
}

/* Next Steps */
.next-steps {
    margin-bottom: 40px;
    text-align: left;
}

.steps-title {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 25px;
    font-size: 1.3rem;
    text-align: center;
}

.steps-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.step-item {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    padding: 20px;
    background: #fff5f5;
    border-radius: 10px;
    border-left: 4px solid #e74c3c;
}

.step-number {
    width: 40px;
    height: 40px;
    background: #e74c3c;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.1rem;
    flex-shrink: 0;
}

.step-content h6 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 8px;
}

.step-content p {
    color: #666;
    margin: 0;
    line-height: 1.5;
}

/* Action Buttons */
.action-buttons {
    margin-bottom: 40px;
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
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

/* WhatsApp Button */
.btn-whatsapp {
    background: linear-gradient(135deg, #25d366, #128c7e);
    color: white;
    border-color: #25d366;
    position: relative;
    overflow: hidden;
}

.btn-whatsapp:hover {
    background: linear-gradient(135deg, #128c7e, #0d7377);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
}

.btn-whatsapp:before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.btn-whatsapp:hover:before {
    left: 100%;
}

.btn-whatsapp i {
    animation: whatsappPulse 2s ease-in-out infinite;
}

@keyframes whatsappPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

/* Contact Info */
.contact-info {
    margin-bottom: 40px;
}

.info-card {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    background: #e3f2fd;
    border: 1px solid #bbdefb;
    border-radius: 10px;
    padding: 20px;
    text-align: left;
}

.info-card i {
    font-size: 1.5rem;
    margin-top: 5px;
}

.info-card h6 {
    color: #1976d2;
    font-weight: 600;
    margin-bottom: 8px;
}

.info-card p {
    color: #1565c0;
    margin: 0;
}

/* Order Items Summary */
.order-items-summary {
    text-align: left;
}

.summary-title {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 25px;
    font-size: 1.3rem;
    text-align: center;
    padding-bottom: 15px;
    border-bottom: 2px solid #e9ecef;
}

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

/* Responsive Design */
@media (max-width: 768px) {
    .success-content {
        padding: 30px 20px;
    }
    
    .success-message h1 {
        font-size: 2rem;
    }
    
    .success-message .lead {
        font-size: 1rem;
    }
    
    .action-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .btn {
        width: 100%;
        max-width: 300px;
    }
    
    .detail-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
    
    .step-item {
        flex-direction: column;
        text-align: center;
    }
    
    .step-number {
        align-self: center;
    }
    
    .item-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .item-details {
        width: 100%;
    }
    
    .info-card {
        flex-direction: column;
        text-align: center;
    }
}

@media (max-width: 576px) {
    .success-area {
        padding: 40px 0;
    }
    
    .success-icon i {
        font-size: 3rem;
    }
    
    .success-message h1 {
        font-size: 1.5rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Auto-scroll to top
    window.scrollTo(0, 0);
    
    // Add confetti effect (optional)
    if (typeof confetti !== 'undefined') {
        confetti({
            particleCount: 100,
            spread: 70,
            origin: { y: 0.6 }
        });
    }
    
    // Copy order number functionality
    $('.order-number').click(function() {
        const orderNumber = $(this).text();
        navigator.clipboard.writeText(orderNumber).then(function() {
            // Show success message
            const toast = $('<div class="copy-toast">Nomor pesanan berhasil disalin!</div>');
            $('body').append(toast);
            
            setTimeout(() => {
                toast.addClass('show');
            }, 100);
            
            setTimeout(() => {
                toast.removeClass('show');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 2000);
        });
    });
});

// Add toast styles
const toastStyles = `
<style>
.copy-toast {
    position: fixed;
    top: 20px;
    right: 20px;
    background: #27ae60;
    color: white;
    padding: 15px 20px;
    border-radius: 8px;
    z-index: 9999;
    transform: translateX(400px);
    transition: transform 0.3s ease;
    cursor: pointer;
}

.copy-toast.show {
    transform: translateX(0);
}

.order-number {
    cursor: pointer;
    transition: all 0.3s ease;
}

.order-number:hover {
    background: #c0392b;
    transform: scale(1.05);
}
</style>
`;

document.head.insertAdjacentHTML('beforeend', toastStyles);

// WhatsApp Order Confirmation Function
function confirmOrderViaWhatsApp(orderNumber, totalAmount, customerName) {
    // WhatsApp business number (replace with actual business number)
    const whatsappNumber = '6281384303654'; // Format: country code + number without +
    
    // Create order confirmation message
    const message = `🌸 *KONFIRMASI PESANAN AVFLOWRIL* 🌸

Halo! Saya ingin mengkonfirmasi pesanan saya:

📋 *Detail Pesanan:*
• Nomor Pesanan: *${orderNumber}*
• Nama Pemesan: *${customerName || 'Customer'}*
• Total Pembayaran: *${totalAmount}*
• Tanggal: *${new Date().toLocaleDateString('id-ID')}*

✅ Pesanan telah berhasil dibuat melalui website Avflowril.

Mohon konfirmasi dan informasi lebih lanjut mengenai:
• Status pemrosesan pesanan
• Estimasi waktu pengiriman
• Detail pengiriman

Terima kasih! 🙏`;

    // Encode message for URL
    const encodedMessage = encodeURIComponent(message);
    
    // Create WhatsApp URL
    const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodedMessage}`;
    
    // Show loading state
    const btn = event.target.closest('.btn-whatsapp');
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i>Membuka WhatsApp...';
    btn.style.pointerEvents = 'none';
    
    // Open WhatsApp
    setTimeout(() => {
        window.open(whatsappUrl, '_blank');
        
        // Reset button after delay
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.style.pointerEvents = 'auto';
            
            // Show success message
            showWhatsAppToast();
        }, 2000);
    }, 500);
}

// Show WhatsApp success toast
function showWhatsAppToast() {
    const toast = $('<div class="whatsapp-toast"><i class="fab fa-whatsapp me-2"></i>WhatsApp berhasil dibuka! Silakan kirim pesan konfirmasi.</div>');
    $('body').append(toast);
    
    setTimeout(() => {
        toast.addClass('show');
    }, 100);
    
    setTimeout(() => {
        toast.removeClass('show');
        setTimeout(() => {
            toast.remove();
        }, 300);
    }, 4000);
}

// Add WhatsApp toast styles
const whatsappToastStyles = `
<style>
.whatsapp-toast {
    position: fixed;
    top: 80px;
    right: 20px;
    background: linear-gradient(135deg, #25d366, #128c7e);
    color: white;
    padding: 15px 20px;
    border-radius: 8px;
    z-index: 9999;
    transform: translateX(400px);
    transition: transform 0.3s ease;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
    max-width: 350px;
    font-size: 14px;
    line-height: 1.4;
}

.whatsapp-toast.show {
    transform: translateX(0);
}

.whatsapp-toast i {
    color: white;
}
</style>
`;

document.head.insertAdjacentHTML('beforeend', whatsappToastStyles);
</script>
@endpush
@endsection

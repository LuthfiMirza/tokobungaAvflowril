@extends('layouts.app')

@section('title', 'Keranjang Belanja - Avflowril')
@section('description', 'Keranjang belanja Anda di Avflowril')

@section('content')
    <!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content">
                        <h1 class="breadcrumb-title">Keranjang Belanja</h1>
                        <div class="breadcrumb-nav">
                            <a href="{{ route('home') }}">Home</a>
                            <i class="fa fa-chevron-right"></i>
                            <a href="{{ route('shop') }}">Shop</a>
                            <i class="fa fa-chevron-right"></i>
                            <span>Keranjang</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->

    <!-- cart main wrapper start -->
    <div class="cart-main-wrapper mt-no-text">
        <div class="container custom-area">
            <div class="row">
                <div class="col-lg-12 col-custom">
                    <!-- Cart Table Area -->
                    <div class="cart-table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="pro-thumbnail">Gambar</th>
                                    <th class="pro-title">Produk</th>
                                    <th class="pro-price">Harga</th>
                                    <th class="pro-quantity">Jumlah</th>
                                    <th class="pro-subtotal">Total</th>
                                    <th class="pro-remove">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="pro-thumbnail">
                                        <a href="{{ route('product.details', 1) }}">
                                            <img class="img-fluid" src="{{ asset('assets/images/product/small-size/1.jpg') }}" alt="Product" />
                                        </a>
                                    </td>
                                    <td class="pro-title">
                                        <a href="{{ route('product.details', 1) }}">Bucket Bunga Satin <br> Pink / Medium</a>
                                    </td>
                                    <td class="pro-price"><span>Rp 250.000</span></td>
                                    <td class="pro-quantity">
                                        <div class="quantity">
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" value="1" type="text">
                                                <div class="dec qtybutton">-</div>
                                                <div class="inc qtybutton">+</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="pro-subtotal"><span>Rp 250.000</span></td>
                                    <td class="pro-remove"><a href="#"><i class="lnr lnr-trash"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="pro-thumbnail">
                                        <a href="{{ route('product.details', 2) }}">
                                            <img class="img-fluid" src="{{ asset('assets/images/product/small-size/2.jpg') }}" alt="Product" />
                                        </a>
                                    </td>
                                    <td class="pro-title">
                                        <a href="{{ route('product.details', 2) }}">Bucket Satin with Gliter <br> Gold</a>
                                    </td>
                                    <td class="pro-price"><span>Rp 370.000</span></td>
                                    <td class="pro-quantity">
                                        <div class="quantity">
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" value="1" type="text">
                                                <div class="dec qtybutton">-</div>
                                                <div class="inc qtybutton">+</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="pro-subtotal"><span>Rp 370.000</span></td>
                                    <td class="pro-remove"><a href="#"><i class="lnr lnr-trash"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="pro-thumbnail">
                                        <a href="{{ route('product.details', 3) }}">
                                            <img class="img-fluid" src="{{ asset('assets/images/product/small-size/3.jpg') }}" alt="Product" />
                                        </a>
                                    </td>
                                    <td class="pro-title">
                                        <a href="{{ route('product.details', 3) }}">Bunga Kawat Bulu <br> Multicolor</a>
                                    </td>
                                    <td class="pro-price"><span>Rp 270.000</span></td>
                                    <td class="pro-quantity">
                                        <div class="quantity">
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" value="1" type="text">
                                                <div class="dec qtybutton">-</div>
                                                <div class="inc qtybutton">+</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="pro-subtotal"><span>Rp 270.000</span></td>
                                    <td class="pro-remove"><a href="#"><i class="lnr lnr-trash"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="pro-thumbnail">
                                        <a href="{{ route('product.details', 4) }}">
                                            <img class="img-fluid" src="{{ asset('assets/images/product/small-size/4.jpg') }}" alt="Product" />
                                        </a>
                                    </td>
                                    <td class="pro-title">
                                        <a href="{{ route('product.details', 4) }}">Bucket Money <br> Special Edition</a>
                                    </td>
                                    <td class="pro-price"><span>Rp 310.000</span></td>
                                    <td class="pro-quantity">
                                        <div class="quantity">
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" value="2" type="text">
                                                <div class="dec qtybutton">-</div>
                                                <div class="inc qtybutton">+</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="pro-subtotal"><span>Rp 620.000</span></td>
                                    <td class="pro-remove"><a href="#"><i class="lnr lnr-trash"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Cart Update Option -->
                    <div class="cart-update-option d-flex justify-content-end">
                        <div class="cart-update">
                            <a href="#" class="btn flosun-button primary-btn rounded-0 black-btn">Update Keranjang</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-5 ml-auto col-custom">
                    <!-- Cart Calculation Area -->
                    <div class="cart-calculator-wrapper">
                        <div class="cart-calculate-items">
                            <h3>Total Keranjang</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>Rp 1.510.000</td>
                                    </tr>
                                    <tr>
                                        <td>Ongkos Kirim</td>
                                        <td>Rp 50.000</td>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <td class="total-amount">Rp 1.560.000</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <a href="{{ route('checkout.index') }}" class="btn flosun-button primary-btn rounded-0 black-btn w-100">Lanjut ke Checkout</a>
                        
                        <!-- Payment Icons -->
                        <div class="payment-icons">
                            <h6>Metode Pembayaran yang Didukung:</h6>
                            <div class="supported-banks">
                                <img src="{{ asset('assets/images/payment/bca.svg') }}" alt="BCA">
                                <img src="{{ asset('assets/images/payment/mandiri.svg') }}" alt="Mandiri">
                                <img src="{{ asset('assets/images/payment/bni.svg') }}" alt="BNI">
                                <img src="{{ asset('assets/images/payment/bri.svg') }}" alt="BRI">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Continue Shopping -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="continue-shopping text-center">
                        <a href="{{ route('shop') }}" class="btn flosun-button secondary-btn rounded-0">
                            <i class="fa fa-arrow-left"></i> Lanjut Belanja
                        </a>
                    </div>
                </div>
            </div>

            <!-- Empty Cart Message (hidden by default, show when cart is empty) -->
            <div class="row empty-cart-message" style="display: none;">
                <div class="col-12">
                    <div class="empty-cart text-center py-5">
                        <i class="fa fa-shopping-cart" style="font-size: 80px; color: #ddd; margin-bottom: 20px;"></i>
                        <h3>Keranjang Anda Kosong</h3>
                        <p>Belum ada produk di keranjang belanja Anda.</p>
                        <a href="{{ route('shop') }}" class="btn flosun-button secondary-btn rounded-0">Mulai Belanja</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart main wrapper end -->
@endsection

@push('styles')
<style>
/* Breadcrumb */
.breadcrumb-area {
    background: linear-gradient(135deg, #ffeef0 0%, #fff5f6 100%);
    padding: 60px 0;
}

.breadcrumb-title {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 15px;
}

.breadcrumb-nav {
    display: flex;
    align-items: center;
    gap: 8px;
    justify-content: center;
    font-size: 14px;
}

.breadcrumb-nav a {
    color: #e74c3c;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.breadcrumb-nav a:hover {
    color: #c0392b;
    text-decoration: none;
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

/* Cart Table Styles */
.cart-main-wrapper {
    padding: 60px 0;
    background: #f8f9fa;
}

.cart-table {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    margin-bottom: 30px;
}

.cart-table .table {
    margin: 0;
}

.cart-table .table th {
    background-color: #e74c3c;
    color: white;
    font-weight: 600;
    border: none;
    padding: 20px 15px;
    text-align: center;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.cart-table .table td {
    vertical-align: middle;
    padding: 20px 15px;
    border-color: #f0f0f0;
    text-align: center;
}

.pro-thumbnail img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.pro-title {
    text-align: left;
}

.pro-title a {
    color: #2c3e50;
    text-decoration: none;
    font-weight: 600;
    line-height: 1.4;
}

.pro-title a:hover {
    color: #e74c3c;
}

.pro-price span {
    font-weight: 600;
    color: #2c3e50;
    font-size: 1rem;
}

.cart-plus-minus {
    display: inline-flex;
    align-items: center;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    overflow: hidden;
    background: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.cart-plus-minus-box {
    border: none;
    text-align: center;
    width: 60px;
    padding: 12px 8px;
    font-size: 14px;
    font-weight: 600;
    background: white;
    color: #2c3e50;
}

.cart-plus-minus-box:focus {
    outline: none;
}

.qtybutton {
    background: #f8f9fa;
    border: none;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    color: #666;
    font-weight: 600;
}

.qtybutton:hover {
    background: #e74c3c;
    color: white;
}

.pro-subtotal span {
    font-weight: 700;
    color: #e74c3c;
    font-size: 1.1rem;
}

.pro-remove a {
    color: #dc3545;
    font-size: 18px;
    text-decoration: none;
    padding: 8px;
    border-radius: 50%;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 35px;
    height: 35px;
}

.pro-remove a:hover {
    background: #dc3545;
    color: white;
    transform: scale(1.1);
}

/* Cart Update Option */
.cart-update-option {
    padding: 20px 0;
}

.cart-update a {
    background: linear-gradient(135deg, #6c757d, #5a6268);
    color: white;
    padding: 12px 30px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
}

.cart-update a:hover {
    background: linear-gradient(135deg, #5a6268, #495057);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

/* Cart Calculator */
.cart-calculator-wrapper {
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    border: 2px solid #e74c3c;
}

.cart-calculate-items h3 {
    margin-bottom: 25px;
    font-size: 1.3rem;
    font-weight: 700;
    color: #2c3e50;
    text-align: center;
    padding-bottom: 15px;
    border-bottom: 2px solid #f8f9fa;
}

.cart-calculate-items .table {
    margin: 0;
}

.cart-calculate-items .table td {
    border: none;
    padding: 15px 0;
    font-size: 1rem;
}

.cart-calculate-items .table td:first-child {
    color: #666;
    font-weight: 500;
}

.cart-calculate-items .table td:last-child {
    color: #2c3e50;
    font-weight: 600;
    text-align: right;
}

.cart-calculate-items .total td {
    font-weight: 700;
    font-size: 1.2rem;
    border-top: 2px solid #e74c3c;
    padding-top: 20px;
    color: #e74c3c;
}

.cart-calculator-wrapper a {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    padding: 15px 20px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    display: block;
    text-align: center;
    margin-top: 20px;
    border: none;
}

.cart-calculator-wrapper a:hover {
    background: linear-gradient(135deg, #c0392b, #a93226);
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(231, 76, 60, 0.4);
    color: white;
}

/* Payment Icons */
.payment-icons {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #f0f0f0;
    text-align: center;
}

.payment-icons h6 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 15px;
    font-size: 0.9rem;
}

.supported-banks {
    display: flex;
    gap: 10px;
    justify-content: center;
    flex-wrap: wrap;
}

.supported-banks img {
    width: 40px;
    height: 26px;
    object-fit: contain;
    border-radius: 4px;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.supported-banks img:hover {
    transform: scale(1.1);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

/* Continue Shopping */
.continue-shopping {
    margin-top: 30px;
    padding: 30px 0;
    border-top: 2px solid #e9ecef;
}

.continue-shopping a {
    background: linear-gradient(135deg, #6c757d, #5a6268);
    color: white;
    padding: 12px 30px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
}

.continue-shopping a:hover {
    background: linear-gradient(135deg, #5a6268, #495057);
    transform: translateY(-2px);
    color: white;
}

/* Empty Cart */
.empty-cart {
    padding: 80px 20px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.empty-cart h3 {
    color: #666;
    margin-bottom: 15px;
    font-weight: 600;
}

.empty-cart p {
    color: #999;
    margin-bottom: 30px;
}

.empty-cart a {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    padding: 12px 30px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.empty-cart a:hover {
    background: linear-gradient(135deg, #c0392b, #a93226);
    transform: translateY(-2px);
    color: white;
}

/* Responsive Design */
@media (max-width: 768px) {
    .cart-main-wrapper {
        padding: 40px 0;
    }
    
    .breadcrumb-area {
        padding: 40px 0;
    }
    
    .cart-table .table th,
    .cart-table .table td {
        padding: 15px 8px;
        font-size: 0.8rem;
    }
    
    .pro-thumbnail img {
        width: 60px;
        height: 60px;
    }
    
    .cart-plus-minus {
        width: auto;
    }
    
    .cart-plus-minus-box {
        width: 50px;
        padding: 8px 5px;
    }
    
    .qtybutton {
        width: 35px;
        height: 35px;
    }
    
    .cart-calculator-wrapper {
        padding: 20px;
        margin-top: 20px;
    }
    
    .breadcrumb-nav {
        flex-direction: column;
        gap: 5px;
    }
    
    .breadcrumb-nav i {
        display: none;
    }
}

@media (max-width: 576px) {
    .cart-table {
        font-size: 0.75rem;
    }
    
    .pro-title a {
        font-size: 0.85rem;
    }
    
    .cart-calculator-wrapper {
        padding: 15px;
    }
    
    .cart-calculate-items h3 {
        font-size: 1.1rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Quantity increase/decrease functionality
    $('.inc').on('click', function() {
        var $input = $(this).siblings('.cart-plus-minus-box');
        var currentVal = parseInt($input.val());
        if (!isNaN(currentVal)) {
            $input.val(currentVal + 1);
            updateSubtotal($(this).closest('tr'));
        }
    });
    
    $('.dec').on('click', function() {
        var $input = $(this).siblings('.cart-plus-minus-box');
        var currentVal = parseInt($input.val());
        if (!isNaN(currentVal) && currentVal > 1) {
            $input.val(currentVal - 1);
            updateSubtotal($(this).closest('tr'));
        }
    });
    
    // Update subtotal when quantity changes
    function updateSubtotal($row) {
        var price = parseInt($row.find('.pro-price span').text().replace(/[^\d]/g, ''));
        var quantity = parseInt($row.find('.cart-plus-minus-box').val());
        var subtotal = price * quantity;
        
        $row.find('.pro-subtotal span').text('Rp ' + subtotal.toLocaleString('id-ID'));
        
        updateCartTotal();
    }
    
    // Update cart total
    function updateCartTotal() {
        var total = 0;
        $('.pro-subtotal span').each(function() {
            var subtotal = parseInt($(this).text().replace(/[^\d]/g, ''));
            total += subtotal;
        });
        
        var shipping = 50000; // Fixed shipping cost
        var grandTotal = total + shipping;
        
        $('.cart-calculate-items .table tr:first-child td:last-child').text('Rp ' + total.toLocaleString('id-ID'));
        $('.total-amount').text('Rp ' + grandTotal.toLocaleString('id-ID'));
    }
    
    // Remove item from cart
    $('.pro-remove a').on('click', function(e) {
        e.preventDefault();
        if (confirm('Apakah Anda yakin ingin menghapus item ini dari keranjang?')) {
            $(this).closest('tr').remove();
            updateCartTotal();
            
            // Check if cart is empty
            if ($('.cart-table tbody tr').length === 0) {
                $('.cart-table, .cart-update-option, .cart-calculator-wrapper, .continue-shopping').hide();
                $('.empty-cart-message').show();
            }
        }
    });
});
</script>
@endpush

// Cart functionality
$(document).ready(function() {
    // CSRF Token untuk Laravel
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Update cart count di header
    function updateCartCount() {
        $.get('/cart/get', function(response) {
            if (response.success) {
                // Pastikan cart_count adalah number, bukan string
                const cartCount = parseInt(response.cart_count) || 0;
                $('.cart-count').text(cartCount);
                $('.cart-total').text('Rp ' + formatNumber(response.cart_total));
                
                console.log('Cart count updated:', cartCount); // Debug log
            }
        }).fail(function() {
            console.error('Failed to get cart data');
            $('.cart-count').text('0');
        });
    }

    // Format number dengan titik sebagai pemisah ribuan
    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Add to Cart functionality - untuk button dengan class .btn-add-to-cart
    $(document).on('click', '.btn-add-to-cart, .add-to-cart-btn', function(e) {
        e.preventDefault();
        
        const $button = $(this);
        const productId = $button.data('product-id');
        
        // Jika tidak ada product ID, tampilkan pesan error
        if (!productId) {
            showNotification('Error: Product ID tidak ditemukan', 'error');
            return;
        }

        addToCartHandler($button, productId);
    });

    // Global addToCart function untuk onclick handlers
    window.addToCart = function(productId, quantity = 1) {
        console.log('addToCart called with productId:', productId, 'quantity:', quantity);
        
        if (!productId) {
            showNotification('Error: Product ID tidak ditemukan', 'error');
            return;
        }

        // Cari button yang diklik berdasarkan product ID
        const $button = $(`.add-to-cart-btn[onclick*="${productId}"]`).first();
        
        if ($button.length === 0) {
            console.warn('Button not found, creating virtual button');
            // Jika button tidak ditemukan, buat virtual button
            const $virtualButton = $('<button>').addClass('add-to-cart-btn').text('Tambah ke Keranjang');
            addToCartHandler($virtualButton, productId, quantity);
        } else {
            addToCartHandler($button, productId, quantity);
        }
    };

    // Handler untuk add to cart
    function addToCartHandler($button, productId, quantity = 1) {
        // Disable button sementara
        $button.prop('disabled', true);
        const originalText = $button.html();
        $button.html('<i class="fa fa-spinner fa-spin me-2"></i>Menambahkan...');

        // Ambil data produk dari elemen terdekat
        const $productCard = $button.closest('.product-card, .product-item');
        
        // Cari nama produk dengan berbagai selector
        let productName = $productCard.find('.product-title a').text().trim() || 
                         $productCard.find('h3 a').text().trim() || 
                         $productCard.find('h4 a').text().trim() || 
                         'Product';

        // Cari harga dengan berbagai selector
        let priceText = $productCard.find('.current-price').text().trim() || 
                       $productCard.find('.price').first().text().trim();
        
        const priceMatch = priceText.match(/Rp\s*([\d.,]+)/);
        const price = priceMatch ? parseInt(priceMatch[1].replace(/[.,]/g, '')) : 0;
        
        // Ambil gambar produk
        const productImage = $productCard.find('.product-image img').attr('src') || 
                            $productCard.find('img').first().attr('src') || 
                            '/assets/images/product/default.jpg';
        
        // Ambil kategori
        let category = $productCard.find('.product-category').text().trim() || 
                      $button.data('category') || 
                      'Bucket Bunga';

        // Data untuk dikirim ke server
        const cartData = {
            product_id: productId,
            name: productName,
            price: price,
            image: productImage,
            category: category,
            quantity: quantity
        };

        console.log('Adding to cart:', cartData); // Debug log

        // Kirim request AJAX
        $.ajax({
            url: '/cart/add',
            method: 'POST',
            data: cartData,
            success: function(response) {
                if (response.success) {
                    showNotification(response.message, 'success');
                    updateCartCount();
                    updateCartDropdown();
                } else {
                    showNotification(response.message || 'Gagal menambahkan ke keranjang', 'error');
                }
            },
            error: function(xhr, status, error) {
                console.error('Cart Error:', xhr.responseText);
                let errorMessage = 'Terjadi kesalahan saat menambahkan ke keranjang';
                
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    errorMessage = Object.values(xhr.responseJSON.errors).flat().join(', ');
                }
                
                showNotification(errorMessage, 'error');
            },
            complete: function() {
                // Restore button
                $button.prop('disabled', false);
                $button.html(originalText);
            }
        });
    }

    // Update cart dropdown
    function updateCartDropdown() {
        $.get('/cart/get', function(response) {
            if (response.success && response.cart) {
                let cartHtml = '';
                let cartCount = 0;
                let cartTotal = 0;

                $.each(response.cart, function(id, item) {
                    cartCount += parseInt(item.quantity) || 0;
                    cartTotal += (parseInt(item.price) || 0) * (parseInt(item.quantity) || 0);
                    
                    cartHtml += `
                        <div class="cart-item">
                            <div class="cart-item-img">
                                <img src="${item.image}" alt="${item.name}">
                            </div>
                            <div class="cart-item-content">
                                <h4><a href="/product/${item.id}">${item.name}</a></h4>
                                <span class="cart-item-quantity">${item.quantity} x Rp ${formatNumber(item.price)}</span>
                                <button class="cart-item-remove" data-product-id="${item.id}">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                    `;
                });

                if (cartCount > 0) {
                    cartHtml += `
                        <div class="cart-footer">
                            <div class="cart-total">
                                <strong>Total: Rp ${formatNumber(cartTotal)}</strong>
                            </div>
                            <div class="cart-buttons">
                                <a href="/cart" class="btn btn-primary btn-sm">Lihat Keranjang</a>
                                <a href="/checkout" class="btn btn-success btn-sm">Checkout</a>
                            </div>
                        </div>
                    `;
                } else {
                    cartHtml = '<div class="cart-empty">Keranjang kosong</div>';
                }

                $('.cart-item-wrapper .cart-items').html(cartHtml);
                $('.cart-count').text(cartCount);
                $('.cart-total').text('Rp ' + formatNumber(cartTotal));
                
                console.log('Cart dropdown updated - Count:', cartCount, 'Total:', cartTotal); // Debug log
            }
        });
    }

    // Remove item from cart
    $(document).on('click', '.cart-item-remove', function(e) {
        e.preventDefault();
        
        const productId = $(this).data('product-id');
        const $cartItem = $(this).closest('.cart-item');
        
        $.ajax({
            url: '/cart/remove',
            method: 'POST',
            data: { product_id: productId },
            success: function(response) {
                if (response.success) {
                    $cartItem.fadeOut(300, function() {
                        $(this).remove();
                        updateCartCount();
                        updateCartDropdown();
                    });
                    showNotification(response.message, 'success');
                } else {
                    showNotification(response.message || 'Gagal menghapus item', 'error');
                }
            },
            error: function() {
                showNotification('Terjadi kesalahan saat menghapus item', 'error');
            }
        });
    });

    // Quick view functionality
    $(document).on('click', '.action-quickview', function(e) {
        e.preventDefault();
        
        const productId = $(this).data('product-id');
        
        if (!productId) {
            showNotification('Product ID tidak ditemukan', 'error');
            return;
        }

        // Show loading
        showNotification('Loading product details...', 'info');

        $.get(`/api/product/${productId}`, function(response) {
            showQuickViewModal(response);
        }).fail(function() {
            showNotification('Gagal memuat detail produk', 'error');
        });
    });

    // Show notification
    function showNotification(message, type = 'info') {
        // Remove existing notifications
        $('.notification').remove();
        
        const notificationClass = type === 'success' ? 'alert-success' : 
                                 type === 'error' ? 'alert-danger' : 'alert-info';
        
        const notification = $(`
            <div class="notification alert ${notificationClass} alert-dismissible fade show" 
                 style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
                ${message}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        `);
        
        $('body').append(notification);
        
        // Auto hide after 3 seconds
        setTimeout(function() {
            notification.fadeOut(300, function() {
                $(this).remove();
            });
        }, 3000);
    }

    // Show quick view modal
    function showQuickViewModal(product) {
        const modalHtml = `
            <div class="modal fade" id="quickViewModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">${product.name}</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="${product.images[0]}" alt="${product.name}" class="img-fluid">
                                </div>
                                <div class="col-md-6">
                                    <h4>${product.name}</h4>
                                    <p class="text-muted">${product.category}</p>
                                    <div class="price mb-3">
                                        ${product.oldPrice ? 
                                            `<span class="current-price">Rp ${formatNumber(product.currentPrice)}</span>
                                             <span class="old-price">Rp ${formatNumber(product.oldPrice)}</span>` :
                                            `<span class="current-price">Rp ${formatNumber(product.currentPrice)}</span>`
                                        }
                                    </div>
                                    <p>${product.description}</p>
                                    <div class="product-actions">
                                        <button class="btn btn-primary btn-add-to-cart" data-product-id="${product.id}">
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        // Remove existing modal
        $('#quickViewModal').remove();
        
        // Add and show modal
        $('body').append(modalHtml);
        $('#quickViewModal').modal('show');
        
        // Remove modal from DOM when hidden
        $('#quickViewModal').on('hidden.bs.modal', function() {
            $(this).remove();
        });
    }

    // Cart dropdown functionality
    $('.minicart-wrap').hover(
        function() {
            $(this).find('.cart-item-wrapper').addClass('show');
        },
        function() {
            $(this).find('.cart-item-wrapper').removeClass('show');
        }
    );

    // Initialize cart count on page load
    updateCartCount();
    
    // Update cart dropdown on page load
    updateCartDropdown();
    
    // Fix cart count display issues
    function fixCartCount() {
        const $cartCount = $('.cart-count');
        const currentText = $cartCount.text().trim();
        
        // Jika cart count menampilkan string aneh seperti "011", perbaiki
        if (isNaN(currentText) || currentText.length > 2) {
            console.log('Fixing cart count from:', currentText);
            $cartCount.text('0');
            updateCartCount(); // Refresh dari server
        }
    }
    
    // Jalankan fix setelah DOM ready
    setTimeout(fixCartCount, 100);
});
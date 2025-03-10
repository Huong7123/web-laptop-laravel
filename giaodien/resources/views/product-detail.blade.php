@extends('layout.layout')  <!-- Kế thừa layout.blade.php -->

@section('title', 'Chi tiết sản phẩm | Laptop-Shoppe')  <!-- Tiêu đề trang -->

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="productDetails" class="product-details">
                    <!-- Thông tin sản phẩm sẽ được thêm vào đây -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- <script src="/fontend/js/pddetail.js"></script> -->
    
    <script>

        // Hàm để lấy ID từ URL
        function getProductIdFromUrl() {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get('id'); // Lấy giá trị của tham số 'id'
        }

        // Hàm để tải chi tiết sản phẩm
        function loadProductDetails() {
            const productId = getProductIdFromUrl(); // Lấy ID sản phẩm từ URL
            
            if (!productId) {
                $('#details').text('Không tìm thấy ID sản phẩm.');
                return;
            }

            $.ajax({
                url: `http://127.0.0.1:8000/api/v1/productsdetail/${productId}`, // Địa chỉ API
                type: 'GET', // Phương thức HTTP
                success: function(data) {
                    if (data.status === 'success') {
                        // Xử lý thông tin sản phẩm
                        const product = data.data.product; // Lấy sản phẩm từ đối tượng
                        const row = `
                            <div class="col-sm-5">
                                <input type="hidden" value="${product.product_id}" class="cart_product_id_${product.product_id}">
                                <input type="hidden" value="${product.product_name}" class="cart_product_name_${product.product_id}">
                                <input type="hidden" value="${product.image_url}" class="cart_product_image_${product.product_id}">
                                <input type="hidden" value="${product.price}" class="cart_product_price_${product.product_id}">
                                <div class="view-product">
                                    <img src="/fontend/images/product/${product.image_url}" alt="${product.product_name}" />
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="product-information">
                                    <h1>Chi Tiết Sản Phẩm</h1>
                                    <h2>${product.product_name}</h2>
                                    <p><strong>Mã sản phẩm</strong>: ${product.product_id}</p>
                                    <p><strong>Mô tả sản phẩm</strong>: ${product.description}</p>
                                    <span>
                                        <span >${new Intl.NumberFormat('vi-VN').format(product.price)} VNĐ</span>
                                        <label>Số lượng:</label>
                                        <input class="cart_product_qty_${product.product_id}" name="qty" type="number" min="1" value="1" />
                                        <button type="button" class="btn btn-default cart add-to-cart" data-id_product="${product.product_id}">
                                            <i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng
                                        </button>
                                    </span>
                                    <p><b>Tình trạng:</b> ${product.is_deleted === 0 ? 'Còn hàng' : 'Hết hàng'}</p>
                                    <p><b>Danh mục:</b> ${product.category ? product.category.category_name : 'Không có'}</p>
                                    <p><b>Giảm giá:</b> ${product.discount ? product.discount.discount_percent + '% ' : 'Không có'}</p>
                                </div>
                            </div>
                        `;
                        $('#productDetails').html(row);
                    }
                    else {
                        $('#productDetails').text('Không thể tải thông tin sản phẩm.');
                    }
                },
                error: function(xhr) {
                    console.error('Lỗi khi tải thông tin sản phẩm:', xhr);
                    $('#productDetails').text('Có lỗi xảy ra trong việc tải thông tin sản phẩm.');
                }
            });
        }
        
        const addToCart = (productId, quantity) => {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];

            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
            const existingProductIndex = cart.findIndex(item => item.product_id === productId);

            if (existingProductIndex > -1) {
                // Nếu sản phẩm đã có, cập nhật số lượng
                cart[existingProductIndex].quantity += quantity;
            } else {
                // Nếu chưa có, thêm sản phẩm mới vào giỏ hàng
                const productName = document.querySelector(`.cart_product_name_${productId}`).value;
                const price = parseFloat(document.querySelector(`.cart_product_price_${productId}`).value);
                const imageUrl = document.querySelector(`.cart_product_image_${productId}`).value;
                const newProduct = {
                    product_id: productId,
                    product_name: productName,
                    price: price,
                    image_url: imageUrl,
                    quantity: quantity
                };
                cart.push(newProduct);
            }

            // Lưu giỏ hàng vào localStorage
            localStorage.setItem("cart", JSON.stringify(cart));
            // Cập nhật lại số lượng giỏ hàng
            updateCartCount();
        };
        
        // Cập nhật số lượng sản phẩm trong giỏ
        const updateCartCount = () => {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
            document.querySelector(".cart-count").innerText = totalItems;
        };

        // Thêm sự kiện cho nút "Thêm giỏ hàng"
        document.addEventListener('click', (event) => {
            if (event.target.classList.contains('add-to-cart')) {
                const productId = event.target.dataset.id_product;
                const quantityInput = document.querySelector(`.cart_product_qty_${productId}`);
                const quantity = parseInt(quantityInput.value) || 1; // Lấy số lượng từ input
                
                addToCart(productId, quantity);
                alert('Sản phẩm đã được thêm vào giỏ hàng!');
            }
        });
        $(document).ready(function() {
            // Gọi hàm để tải chi tiết sản phẩm
            loadProductDetails();
        });
    </script>

@endsection


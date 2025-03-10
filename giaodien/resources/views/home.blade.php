@extends('layout.layout')  <!-- Kế thừa layout.blade.php -->

@section('title', 'Home | Laptop-Shoppe')  <!-- Tiêu đề trang -->

@section('content')

<section id="slider"><!--slider-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="slider-carousel" class="carousel slide" data-ride="carousel">
					
					<div class="carousel-inner">
						<div style="padding: 0 50px;" class="item active">
							<div class="col-sm-12">
								<img style="width: 100%;" src="/fontend/images/slide3.jpg" class="girl img-responsive" alt="" />
							</div>
						</div>
						<div style="padding: 0 50px;" class="item">
							<div class="col-sm-12">
								<img style="width: 100%;" src="/fontend/images/slide1.jpg" class="girl img-responsive" alt="" />
							</div>
						</div>
						
						<div style="padding: 0 50px;" class="item">
							<div class="col-sm-12">
								<img style="width: 100%;" src="/fontend/images/slide2.jpg" class="girl img-responsive" alt="" />
							</div>
						</div>
						<div style="padding: 0 50px;" class="item">
							<div class="col-sm-12">
								<img style="width: 100%;" src="/fontend/images/slide4.jpg" class="girl img-responsive" alt="" />
							</div>
						</div>
					</div>
					
					<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>
				</div>
				
			</div>
		</div>
	</div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3" id="sidebarPosition" style="position: sticky; top: 0;">
                <div class="left-sidebar">
                    <h2>Danh mục sản phẩm</h2>
                    <div class="panel-group category-products" style="padding-top: 0; border: none;" id="accordian">
                    <h2>Thương hiệu</h2>
                        <div class="brands-name">
                            <ul class="nav nav-pills nav-stacked">
                                <label class="checkbox-item">
                                    <input type="checkbox" class="filter-category-checkbox" value="1"> Laptop HP
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" class="filter-category-checkbox" value="2"> Laptop Lenovo
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" class="filter-category-checkbox" value="3"> Latop Dell
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" class="filter-category-checkbox" value="4"> Latop MSI
                                </label>
                            </ul>
                        </div>
                    </div>
                    <h2>Mức giá</h2>
                        <div class="filter-price ">
                            <label class="checkbox-item">
                                <input type="checkbox" class="filter-price-checkbox" value="10-20"> 10 - 20 triệu
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" class="filter-price-checkbox" value="20-50"> 20 - 50 triệu
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" class="filter-price-checkbox" value="50-100"> 50 - 100 triệu
                            </label>
                        </div>
                    
                    <button id="apply-filters" class="btn btn-primary">Áp dụng bộ lọc</button>
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="fontendatures_items">
                    <h2 class="title text-center">Sản phẩm mới nhất</h2>
                    <div id="productsList"></div> <!-- Products will be added here -->
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const applyFiltersButton = document.getElementById('apply-filters');

        // Hàm gọi API lọc sản phẩm
        function filterProducts() {
            // Lấy danh sách category_id đã chọn
            const selectedCategories = Array.from(document.querySelectorAll('.filter-category-checkbox:checked'))
                .map(checkbox => checkbox.value);

            // Lấy danh sách price_range đã chọn
            const selectedPriceRanges = Array.from(document.querySelectorAll('.filter-price-checkbox:checked'))
                .map(checkbox => checkbox.value);

            // Tạo URL với query string từ các bộ lọc
            const url = new URL('http://127.0.0.1:8000/api/products/filter');
            if (selectedCategories.length > 0) url.searchParams.append('category_id', selectedCategories.join(','));
            if (selectedPriceRanges.length > 0) url.searchParams.append('price_range', selectedPriceRanges.join(','));

            // Gọi API
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Xóa danh sách sản phẩm cũ
                        $('#productsList').empty();

                        // Hiển thị danh sách sản phẩm mới
                        if (data.data.length > 0) {
                            data.data.forEach(product => {
                                const productHTML = `
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <input type="hidden" value="${product.product_id}" class="cart_product_id_${product.product_id}">
                                                    <input type="hidden" value="${product.product_name}" class="cart_product_name_${product.product_id}">
                                                    <input type="hidden" value="${product.image_url}" class="cart_product_image_${product.product_id}">
                                                    <input type="hidden" value="${product.price}" class="cart_product_price_${product.product_id}">
                                                    <input type="hidden" value="1" class="cart_product_qty_${product.product_id}">
                                                    <a href="/product-detail?id=${product.product_id}">
                                                        <img src="${product.image_url ? '/fontend/images/product/' + product.image_url : '/fontend/images/no-image.png'}" alt="${product.product_name}" />
                                                        <h2>${new Intl.NumberFormat('vi-VN').format(product.price)} VNĐ</h2>
                                                        <p style="height:40px;">${product.product_name}</p>
                                                    </a>
                                                    <button type="button" class="btn btn-default add-to-cart" data-id_product="${product.product_id}" name="add-to-cart">
                                                        <i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                $('#productsList').append(productHTML);
                            });

                            attachAddToCartEvent();
                        } else {
                            productsList.innerHTML = '<p>Không có sản phẩm nào phù hợp.</p>';
                        }
                    } else {
                        alert(data.message || 'Có lỗi xảy ra khi tải sản phẩm.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Không thể tải sản phẩm.');
                });
        }

        // Gắn sự kiện click vào nút "Áp dụng bộ lọc"
        applyFiltersButton.addEventListener('click', function () {
            filterProducts();
        });

        //tìm kiếm sản phẩm
        $('#search').on('keypress', function(event) {
            if (event.which === 13) { // Kiểm tra nếu phím Enter được nhấn
                event.preventDefault(); // Ngăn chặn hành vi mặc định của phím Enter
                const keyword = $(this).val();

                if (keyword.length >= 2) { // Tìm kiếm khi có ít nhất 2 ký tự
                    $.ajax({
                        url: 'http://127.0.0.1:8000/api/v1/products/search',
                        type: 'GET',
                        data: { keyword: keyword },
                        success: function(data) {
                            $('#productsList').empty(); // Xóa kết quả trước đó
                            data.forEach(function(product) {
                                const productHTML = `
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <input type="hidden" value="${product.product_id}" class="cart_product_id_${product.product_id}">
                                                    <input type="hidden" value="${product.product_name}" class="cart_product_name_${product.product_id}">
                                                    <input type="hidden" value="${product.image_url}" class="cart_product_image_${product.product_id}">
                                                    <input type="hidden" value="${product.price}" class="cart_product_price_${product.product_id}">
                                                    <input type="hidden" value="1" class="cart_product_qty_${product.product_id}">
                                                    <a href="/product-detail?id=${product.product_id}">
                                                        <img src="${product.image_url ? '/fontend/images/product/' + product.image_url : '/fontend/images/no-image.png'}" alt="${product.product_name}" />
                                                        <h2>${new Intl.NumberFormat('vi-VN').format(product.price)} VNĐ</h2>
                                                        <p style="height:40px;">${product.product_name}</p>
                                                    </a>
                                                    <button type="button" class="btn btn-default add-to-cart" data-id_product="${product.product_id}" name="add-to-cart">
                                                        <i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                
                                $('#productsList').append(productHTML);
                            });
                        },
                        error: function(xhr) {
                            console.error(xhr);
                        }
                    });
                }
            }
        });
    });
</script>
@endsection

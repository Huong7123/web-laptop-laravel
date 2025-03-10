// Hàm gọi API để lấy sản phẩm và hiển thị
const fetchAndRenderProducts = () => {
    $.ajax({
        url: 'http://127.0.0.1:8000/api/v1/products',
        type: 'GET',
        success: function(data) {
            console.log
            renderAvailableProducts(data.product); // Gọi hàm render để hiển thị sản phẩm
            renderCategories(data.category); // Gọi hàm để hiển thị danh mục
            renderDiscounts(data.discount); // Gọi hàm để hiển thị giảm giá
        },
        error: function(xhr) {
            console.error('Lỗi khi gọi API:', xhr);
            alert('Không thể lấy sản phẩm.');
        }
    });
};

// Hàm hiển thị sản phẩm
const renderAvailableProducts = (products) => {
    $('#productsList').empty(); // Xóa danh sách sản phẩm hiện tại

    // Kiểm tra xem có sản phẩm nào hay không
    if (!Array.isArray(products) || products.length === 0) {
        $('#productsList').append('<p>Không có sản phẩm.</p>');
        return;
    }

    // Lặp qua mỗi sản phẩm và thêm vào danh sách
    products.forEach(product => {
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

    // Gắn sự kiện click "Thêm giỏ hàng"
    attachAddToCartEvent();
};

$(document).ready(function() {
    fetchAndRenderProducts();
});


// Hàm hiển thị danh mục
const renderCategories = (categories) => {
    const categoryList = document.getElementById('category-list');
    categoryList.innerHTML = ''; // Xóa danh sách danh mục cũ

    categories.forEach(category => {
        const categoryItem = document.createElement('option');
        categoryItem.value = category.category_id;
        categoryItem.innerText = category.category_name;
        categoryList.appendChild(categoryItem);
    });
};

// Hàm hiển thị giảm giá
const renderDiscounts = (discounts) => {
    const discountList = document.getElementById('discount-list');
    discountList.innerHTML = ''; // Xóa danh sách giảm giá cũ

    discounts.forEach(discount => {
        const discountItem = document.createElement('option');
        discountItem.value = discount.discount_id;
        discountItem.innerText = `${discount.discount_name} (${discount.discount_percent}%)`;
        discountList.appendChild(discountItem);
    });
};

// Gắn sự kiện click "Thêm giỏ hàng"
const attachAddToCartEvent = () => {
    document.querySelectorAll(".add-to-cart").forEach(button => {
        button.addEventListener("click", () => {
            const productId = button.getAttribute("data-id_product");
            const productName = document.querySelector(`.cart_product_name_${productId}`).value;
            const price = parseFloat(document.querySelector(`.cart_product_price_${productId}`).value);
            const imageUrl = document.querySelector(`.cart_product_image_${productId}`).value;
            const quantity = parseInt(document.querySelector(`.cart_product_qty_${productId}`).value);

            const product = {
                product_id: productId,
                product_name: productName,
                price: price,
                image_url: imageUrl,
                quantity: quantity
            };

            addToCart(product);
        });
    });
};

// Hàm thêm sản phẩm vào giỏ hàng
const addToCart = (product) => {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    const existingProductIndex = cart.findIndex(item => item.product_id === product.product_id);
    if (existingProductIndex !== -1) {
        cart[existingProductIndex].quantity += product.quantity;
    } else {
        cart.push(product);
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    alert('Sản phẩm đã được thêm vào giỏ hàng!');
    updateCartCount();
};


const updateCartCount = () => {
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
    document.querySelector(".cart-count").innerText = totalItems;
};




@extends('layout.layout')  <!-- Kế thừa layout.blade.php -->

@section('title', 'Home | Laptop-Shoppe')  <!-- Tiêu đề trang -->

@section('content')
<body>
    <div id="header-container"></div>

    <div class="container">
        <h2 class="title text-center">Giỏ Hàng Của Bạn</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Hình Ảnh</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Đơn Giá</th>
                    <th>Số Lượng</th>
                    <th>Thành Tiền</th>
                </tr>
            </thead>
            <tbody id="cart-items">
                <!-- Sản phẩm sẽ được hiển thị ở đây -->
            </tbody>
        </table>
        <div class="text-right">
            <h3 id="cart-total"></h3>
            <a>
                <button  class="btn btn-primary" id="checkout-button">Thanh Toán</button>
            </a>
        </div>
    </div>

    <div id="footer-container"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="/fontend/js/cart.js"></script> -->

    <script>
        function displayCartItems() {
            let products = JSON.parse(localStorage.getItem('cart')) || [];
            const cartContainer = document.getElementById('cart-items');
            const cartTotal = document.getElementById('cart-total');

            cartContainer.innerHTML = ''; // Xóa nội dung trước đó
            let total = 0;
            if (products.length === 0) {
                // Hiển thị thông báo nếu không có sản phẩm
                cartContainer.innerHTML = '<tr><td colspan="5"><h4 style="text-align: center;">Giỏ hàng của bạn đang trống hãy tiếp tục mua sắm!</h4></td></tr>';
                cartTotal.innerHTML = '';
                document.getElementById('checkout-button').style.display = 'none';
                return; // Dừng hàm nếu không có sản phẩm
            }
            

            products.forEach(product => {
                const itemTotal = product.price * product.quantity;
                total += itemTotal;
                const row = document.createElement('tr');
                row.setAttribute('style', 'height: 67px;');
                row.innerHTML = `
                    <td style="vertical-align: middle;"><img src="/fontend/images/product/${product.image_url}" alt="${product.product_name}" width="50"></td>
                    <td style="vertical-align: middle;">${product.product_name}</td>
                    <td style="vertical-align: middle;">${new Intl.NumberFormat('vi-VN').format(product.price)} VNĐ</td>
                    <td style="vertical-align: middle;">
                        <input type="number" min="1" value="${product.quantity}" data-id="${product.product_id}" class="quantity-input">
                    </td>
                    <td style="vertical-align: middle;">${new Intl.NumberFormat('vi-VN').format(itemTotal)} VNĐ</td>
                    <td style="vertical-align: middle;">
                        <button class="btn btn-danger btn-sm remove-item" data-id="${product.product_id}">Xóa</button>
                    </td>
                `;
                cartContainer.appendChild(row);
            });
            cartTotal.textContent = `Tổng: ${new Intl.NumberFormat('vi-VN').format(total)} VNĐ`;
        }

        // Cập nhật số lượng sản phẩm
        const updateQuantity = (productId, quantity) => {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const itemIndex = cart.findIndex(item => item.product_id === productId);
            if (itemIndex !== -1) {
                cart[itemIndex].quantity = quantity;
                localStorage.setItem('cart', JSON.stringify(cart));
                updateHeaderCartCount();
                displayCartItems();
            }
        };

        // Cập nhật số lượng sản phẩm trong giỏ hàng
        const updateHeaderCartCount = () => {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
            document.querySelector(".cart-count").innerText = totalItems;
        };

        // Xóa sản phẩm khỏi giỏ hàng
        const removeItem = (productId) => {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            cart = cart.filter(item => item.product_id !== productId); // Xóa sản phẩm
            localStorage.setItem('cart', JSON.stringify(cart));
            updateHeaderCartCount();
            displayCartItems();
        };

        // Lắng nghe sự kiện thay đổi số lượng
        document.addEventListener('input', (event) => {
            if (event.target && event.target.classList.contains('quantity-input')) {
                const productId = event.target.getAttribute('data-id');
                const quantity = parseInt(event.target.value);
                if (quantity > 0) {
                    updateQuantity(productId, quantity);
                } else {
                    alert('Số lượng phải lớn hơn 0!');
                    event.target.value = 1; // Đặt lại số lượng về 1 nếu nhập không hợp lệ
                }
            }
        });

        // Lắng nghe sự kiện xóa sản phẩm
        document.addEventListener('click', (event) => {
            if (event.target && event.target.classList.contains('remove-item')) {
                const productId = event.target.getAttribute('data-id');
                removeItem(productId);
            }
        });

        window.onload = displayCartItems;

        //kiểm tra đăng nhập nếu chưa đăng nhập thì bắt đăng nhập rồi mới cho thanh toán
        document.getElementById('checkout-button').addEventListener('click', function() {
            var user = JSON.parse(localStorage.getItem('user'));
            if (user) {
                window.location.href = '/checkout';
            }
            else{
                window.location.href = '/login';
            }
        });
    </script>

</body>
@endsection


// Lấy giỏ hàng và tính tổng tiền
const cart = JSON.parse(localStorage.getItem('cart')) || [];
let totalAmount = 0;
cart.forEach(item => {
    totalAmount += item.price * item.quantity; // Xác định giá trị sản phẩm
});
document.getElementById('total-amount').textContent = totalAmount.toLocaleString() + ' VND';

const paymentMethodSelect = document.getElementById('payment-method');
const paymentOptions = document.getElementById('payment-options');
const vnpayBtn = document.getElementById('vnpay-btn');
const codBtn = document.getElementById('cod-btn');

paymentMethodSelect.addEventListener('change', function () {
    const selectedMethod = paymentMethodSelect.value;
    if (selectedMethod === 'VNPay') {
        paymentOptions.style.display = 'block'; 
        vnpayBtn.style.display = 'inline-block';
        codBtn.style.display = 'none'; 
    } else if (selectedMethod === 'COD') {
        paymentOptions.style.display = 'block'; 
        codBtn.style.display = 'inline-block';
        vnpayBtn.style.display = 'none'; 
    } else {
        paymentOptions.style.display = 'none'; 
    }
});

function createOrder() {
    const paymentMethod = paymentMethodSelect.value;
    let items = JSON.parse(localStorage.getItem('cart')) || [];
    const user = JSON.parse(localStorage.getItem('user'));
    const userId = user.id;
    //lấy các trường trong localstorage để lưu xuống db
    const orderItems = items.map(item => ({
        name: item.product_name, // Lấy trường product_name
        price: item.price,        // Lấy trường price
        quantity: item.quantity    // Lấy trường quantity
    }));
    // Tạo đơn hàng
    const orderData = {
        user_id: userId,
        customer_name: $('#name').val(),
        address: $('#address').val(),
        phone: $('#phone').val(),
        payment_method: paymentMethod,
        total_amount: totalAmount,
        items: orderItems
    };

    $.ajax({
        url: 'http://localhost:8004/api/orders',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(orderData),
        success: function(response) {
            localStorage.removeItem('cart');
            window.location.href = '/thankyou';
        },
        error: function(xhr) {
            console.error('Có lỗi xảy ra:', error);
        }
    });
}

function handleVNPayPayment() {
    const amount = totalAmount; // Giả định totalAmount đã được định nghĩa

    $.ajax({
        url: 'http://localhost:8003/api/payment',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ amount: amount, method: 'vnpay' }),
        success: function(data) {
            if (data.message=='success') {
                localStorage.removeItem('cart');
                window.location.assign(data.data);
            } else {
                $('#message').text('Lỗi: ' + data.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Có lỗi xảy ra:', error);
            $('#message').text('Đã xảy ra lỗi, vui lòng thử lại!');
        }
    });
}

@extends('layout.layout')  <!-- Kế thừa layout.blade.php -->

@section('title', 'Checkout | Laptop-Shoppe')  <!-- Tiêu đề trang -->

@section('content')
<div class="container">
    <h2 class="title text-center">Thông Tin Thanh Toán</h2>
    <form id="checkout-form">
        
    </form>
    <div class="form-group">
        <label for="total-amount">Tổng Số Tiền:</label>
        <p id="total-amount" class="form-control-static"></p>
    </div>
    <!-- <button type="submit" class="btn btn-primary">Tạo Đơn Hàng</button> -->
     
    <div class="form-group">
        <label for="payment-method">Phương Thức Thanh Toán:</label>
        <select id="payment-method" class="form-control" required>
            <option value="">-- Chọn phương thức thanh toán --</option>
            <option value="COD">Thanh Toán Khi Nhận Hàng</option>
            <option value="VNPay">Thanh Toán VNPay</option>
        </select>
    </div>
    <div id="payment-options" style="display:none;">
        <button type="button" id="vnpay-btn" class="btn btn-secondary btn-sm">
            <img src="/fontend/images/vnpay-logo.png" alt="VNPay" style="width: 20px; height: auto; margin-right: 5px;">
            Thanh toán VNPay
        </button>
        <button type="button" id="cod-btn" class="btn btn-secondary btn-sm">
            Thanh toán COD
        </button>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    //hàm hiển thị tên khách hàng
    function inforCustomer(userId) {
        $.ajax({
            url: 'http://127.0.0.1:8001/api/show-account-detail/' + userId,
            type: "GET",
            dataType: 'json',
            success: function(data) {
                const information = $('#checkout-form');
                const row = `
                    <div class="form-group">
                        <label for="name">Tên:</label>
                        <input type="text" id="name" class="form-control" value="${data.username}" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Địa Chỉ:</label>
                        <input type="text" id="address" class="form-control" value="${data.address}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số Điện Thoại:</label>
                        <input type="text" id="phone" class="form-control" value="${data.phone_number}" required>
                    </div>
                `;
                information.empty().append(row);
                    
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    $(document).ready(function() {
        var user = JSON.parse(localStorage.getItem('user'));
        var userId = user.id;
        inforCustomer(userId);
        vnpayBtn.addEventListener('click', () =>{
            createOrder();
            handleVNPayPayment();
        });
        codBtn.addEventListener('click',() =>{
            createOrder();
        });
    });
</script>
@endsection

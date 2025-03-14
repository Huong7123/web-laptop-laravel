@extends('layout.layout')

@section('title', 'Danh Sách Đơn Hàng | Laptop-Shoppe')

@section('content')
<div class="container">
    <h2 class="title text-center">Lịch sử mua hàng</h2>
    
    <div id="orders-container">
        <div style="display:flex;justify-content: space-between;">
            <div>
                <button  class="btn btn-primary order-list" style="margin: 0;border-radius: 4px;height: 32px;">Tất cả đơn hàng</button>
                <button  class="btn btn-primary order-completed" style="margin: 0;border-radius: 4px;height: 32px;">Đã mua</button>
            </div>
            <form id="search-form" style="margin-bottom: 10px;">
                <input type="text" id="search-order" class="search-input" placeholder="Tìm kiếm...">
            </form>
        </div>
        <!-- <div id="no-orders-message" class="text-center">Không có đơn hàng nào.</div> -->
        <table class="table table-bordered mt-3">
            <thead id="order-header">
                <tr>
                    <th>Mã Đơn Hàng</th>
                    <th>Tên Khách Hàng</th>
                    <th>Địa Chỉ</th>
                    <th>Số Điện Thoại</th>
                    <th>Phương Thức Thanh Toán</th>
                    <th>Tổng Số Tiền</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody id="orders-table">

            </tbody>
        </table>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>\
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const user = JSON.parse(localStorage.getItem('user'));
        const userId = user.id;
        $.ajax({
            url: 'http://localhost:8004/api/orders/' + userId,
            type: 'GET',
            success: function(response) {
                const orders = $('#orders-table');
                orders.empty(); 

                response.order.forEach(function(order) {
                    row= `
                        <tr>
                            <td>${order.order_code}</td>
                            <td>${order.customer_name}</td>
                            <td>${order.address}</td>
                            <td>${order.phone}</td>
                            <td>${order.payment_method}</td>
                            <td>${order.total_amount}</td>
                            <td>${order.status}</td>
                            <td>
                                <button class="btn btn-info show-detail" data-id="${order.order_id}">Xem</button>
                                ${order.status === 'completed' ? '' : `<button class="btn btn-danger delete-order" data-id="${order.order_id}">Hủy</button>`}
                            </td>
                        </tr>
                    `;
                    orders.append(row);
                });
            },
            error: function(xhr) {
                console.error('Có lỗi xảy ra:', error);
            }
        });

        //xử lí sự kiện cho nút đã mua
        $(document).on('click', '.order-completed', function(event) {
            event.preventDefault();
            const user = JSON.parse(localStorage.getItem('user'));
            const userId = user.id;
            $.ajax({
                url: 'http://localhost:8004/api/orders-completed/' + userId,
                type: 'GET',
                success: function(response) {
                    const orderHead = $('#order-header');
                    orderHead.empty();
                    header=`
                        <tr>
                            <th>Mã Đơn Hàng</th>
                            <th>Tên Khách Hàng</th>
                            <th>Địa Chỉ</th>
                            <th>Số Điện Thoại</th>
                            <th>Phương Thức Thanh Toán</th>
                            <th>Tổng Số Tiền</th>
                            <th>Trạng Thái</th>
                            <th>Hành Động</th>
                        </tr>
                    `
                    orderHead.append(header);
                    const orders = $('#orders-table');
                    orders.empty(); 
                    response.order.forEach(function(order) {
                        row= `
                            <tr>
                                <td>${order.order_code}</td>
                                <td>${order.customer_name}</td>
                                <td>${order.address}</td>
                                <td>${order.phone}</td>
                                <td>${order.payment_method}</td>
                                <td>${order.total_amount}</td>
                                <td>${order.status}</td>
                                <td>
                                    <button class="btn btn-info show-detail" data-id="${order.order_id}">Xem</button>
                                    ${order.status === 'completed' ? '' : `<button class="btn btn-danger delete-order" data-id="${order.order_id}">Hủy</button>`}
                                </td>
                            </tr>
                        `;
                        orders.append(row);
                    });
                },
                error: function(xhr) {
                    console.error('Có lỗi xảy ra:', error);
                }
            });
        });

        //xử lí sự kiện cho nút tất cả đơn hàng
        $(document).on('click', '.order-list', function(event) {
            event.preventDefault();
            const user = JSON.parse(localStorage.getItem('user'));
            const userId = user.id;
            $.ajax({
                url: 'http://localhost:8004/api/orders/' + userId,
                type: 'GET',
                success: function(response) {
                    const orderHead = $('#order-header');
                    orderHead.empty();
                    header=`
                        <tr>
                            <th>Mã Đơn Hàng</th>
                            <th>Tên Khách Hàng</th>
                            <th>Địa Chỉ</th>
                            <th>Số Điện Thoại</th>
                            <th>Phương Thức Thanh Toán</th>
                            <th>Tổng Số Tiền</th>
                            <th>Trạng Thái</th>
                            <th>Hành Động</th>
                        </tr>
                    `
                    const orders = $('#orders-table');
                    orderHead.append(header);
                    orders.empty(); 
                    response.order.forEach(function(order) {
                        row= `
                            <tr>
                                <td>${order.order_code}</td>
                                <td>${order.customer_name}</td>
                                <td>${order.address}</td>
                                <td>${order.phone}</td>
                                <td>${order.payment_method}</td>
                                <td>${order.total_amount}</td>
                                <td>${order.status}</td>
                                <td>
                                    <button class="btn btn-info show-detail" data-id="${order.order_id}">Xem</button>
                                    ${order.status === 'completed' ? '' : `<button class="btn btn-danger delete-order" data-id="${order.order_id}">Hủy</button>`}
                                </td>
                            </tr>
                        `;
                        orders.append(row);
                    });
                },
                error: function(xhr) {
                    console.error('Có lỗi xảy ra:', error);
                }
            });
        });

        //hủy đơn hàng
        $(document).on('click', '.delete-order', function(event) {
            var orderId = $(this).data('id');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var confirmDelete = confirm("Bạn có chắc chắn muốn hủy đơn hàng không?");
            if(confirmDelete){
                $.ajax({
                    url: 'http://localhost:8004/api/orders/' + orderId,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    },
                    success: function(response) {
                        alert('Hủy đơn hàng thành công!');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
            else{

            }
        });

        //xem chi tiết đơn hàng
        $(document).on('click', '.show-detail', function(event) {
            event.preventDefault();
            var orderId = $(this).data('id');
            $.ajax({
                url: 'http://localhost:8004/api/orders-details/' + orderId,
                type: 'GET',
                success: function(response) {
                    const orders = $('#orders-table');
                    const orderHead = $('#order-header');
                    orderHead.empty();
                    header=`
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                        </tr>
                    `
                    orderHead.append(header);
                    orders.empty(); 
                    response.order.items.forEach(function(order) {
                        row= `
                            <tr>
                                <td>${order.product_name}</td>
                                <td>${order.price}</td>
                                <td>${order.quantity}</td>
                            </tr>
                        `;
                        orders.append(row);
                    });
                },
                error: function(xhr) {
                    console.error('Có lỗi xảy ra:', error);
                }
            });
        });

        //tìm kiếm đơn hàng
        $('#search-order').on('keypress', function(event) {
            event.preventDefault();
            const orderCodeInput = $(this).val();
            orderCode ='#' + orderCodeInput;
            if (event.which === 13) {
                $.ajax({
                    url: `http://localhost:8004/api/orders-search/`, // URL API
                    type: 'GET',
                    data: {order_code: orderCode},
                    success: function(data) {
                        console.log(data);
                        const orders = $('#orders-table');
                        orders.empty(); 
                        if (data) {
                            row= `
                                <tr>
                                    <td>${data.order_code}</td>
                                    <td>${data.customer_name}</td>
                                    <td>${data.address}</td>
                                    <td>${data.phone}</td>
                                    <td>${data.payment_method}</td>
                                    <td>${data.total_amount}</td>
                                    <td>${data.status}</td>
                                    <td>
                                        <button class="btn btn-info show-detail" data-id="${data.order_id}">Xem</button>
                                        ${data.status === 'completed' ? '' : `<button class="btn btn-danger delete-order" data-id="${data.order_id}">Hủy</button>`}
                                    </td>
                                </tr>
                            `;
                            orders.append(row);
                        };
                    },
                    error: function(xhr) {
                        console.error('Có lỗi xảy ra:', xhr);
                        alert(xhr.responseJSON.message || 'Có lỗi xảy ra.');
                    }
                });
            }
        })
    });
</script>
@endsection
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }

        .navbar {
            background-color: rgb(229, 149, 2);
        }

        /* Sidebar Styles */
        .sidebar {
            height: 100vh;
            width: 250px;
            background-color: #f8f9fa;
            position: fixed;
            top: 0;
            left: 0;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            padding: 15px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar.open {
            transform: translateX(0);
        }

        /* Content Styles */
        .content {
            transition: margin-left 0.3s ease;
        }

        .content.shift {
            margin-left: 250px;
        }

        /* Menu Button Style */
        .menu-btn {
            border: none;
            background: transparent;
            font-size: 24px;
            cursor: pointer;
            color: white;
        }

    </style>
</head>

<body>
    <!-- Sidebar Menu -->
    <div class="sidebar" id="sidebar">
        <h5 class="text-center mb-3">Menu</h5>
        <nav class="nav flex-column">
            <a class="nav-link" href="{{URL::to('/management')}}">Quản lý đơn hàng</a>
            <a class="nav-link" href="{{URL::to('/adusers')}}">Quản lý tài khoản</a>
            <a class="nav-link" href="{{URL::to('/adproduct')}}">Quản lý sản phẩm</a>
            <a class="nav-link active" href="{{URL::to('/adcategory')}}">Quản lý danh mục</a>
            <a class="nav-link" href="{{URL::to('/addiscount')}}">Quản lý giảm giá</a>
        </nav>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <div style="display:flex;align-items: center;">
                <button class="menu-btn" id="menuToggle">☰</button>
                <div id="welcome" style="margin-left: 20px;">
                </div>
            </div>
            <a style="cursor: pointer;" id="authBtn" class="navbar-brand">
                
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4 content" id="content">
        <section id="categoryList">
            <h1>Danh sách đơn hàng</h1>
            <div style="display:flex;justify-content: space-between;">
                <div>
                    <button  class="btn btn-success order-list" style="margin: 0;border-radius: 4px;height: 38px;">Tất cả đơn hàng</button>
                    <button  class="btn btn-success order-completed" style="margin: 0;border-radius: 4px;height: 38px;">Đã giao</button>
                </div>
                <form id="search-form" style="margin-bottom: 10px;">
                    <input type="text" id="search-order" class="search-input" placeholder="Tìm kiếm...">
                </form>
            </div>
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
        </section>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/admin/js/admin.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'http://localhost:8004/api/orders',
                type: 'GET',
                success: function(response) {
                    const orders = $('#orders-table');
                    orders.empty(); 

                    response.forEach(function(order) {
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
                                    ${order.status === 'completed' ? '' : `<button class="btn btn-danger update-status" data-id="${order.order_id}">Cập nhật</button>`}
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

            //cập nhật trạng thái đơn hàng
            $(document).on('click', '.update-status', function(event) {
                var orderId = $(this).data('id');
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: 'http://localhost:8004/api/orders/' + orderId,
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    },
                    success: function(response) {
                        alert('Cập nhật trạng thái đơn hàng thành công!');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
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
            //xử lý sự kiện nút đã giao
            $(document).on('click', '.order-completed', function(event) {
                event.preventDefault();
                $.ajax({
                    url: 'http://localhost:8004/api/orders-completed-admin',
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
                                        ${order.status === 'completed' ? '' : `<button class="btn btn-danger update-status" data-id="${order.order_id}">Cập nhật</button>`}
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
            //xử lý sự kiện nút tất cả đơn hàng
            $(document).on('click', '.order-list', function(event) {
                event.preventDefault();
                $.ajax({
                    url: 'http://localhost:8004/api/orders',
                    type: 'GET',
                    success: function(response) {
                        console.log(response)
                        const orders = $('#orders-table');
                        orders.empty(); 

                        response.forEach(function(order) {
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
                                        ${order.status === 'completed' ? '' : `<button class="btn btn-danger update-status" data-id="${order.order_id}">Cập nhật</button>`}
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

            //tìm kiếm đơn hàng
            $('#search-order').on('keypress', function(event) {
                event.preventDefault();
                const orderCode = $(this).val();

                $.ajax({
                    url: `http://localhost:8004/api/orders/search?order_code=${encodeURIComponent(orderCode)}`, // URL API
                    type: 'GET',
                    success: function(data) {
                        console.log(data); // Xem phản hồi từ API

                        const orders = $('#orders-table');
                        orders.empty(); 

                        if (data.order) {
                            row= `
                                <tr>
                                    <td>${data.order.order_code}</td>
                                    <td>${data.order.customer_name}</td>
                                    <td>${data.order.address}</td>
                                    <td>${data.order.phone}</td>
                                    <td>${data.order.payment_method}</td>
                                    <td>${data.order.total_amount}</td>
                                    <td>${data.order.status}</td>
                                    <td>
                                        <button class="btn btn-info show-detail" data-id="${data.order.order_id}">Xem</button>
                                        ${data.order.status === 'completed' ? '' : `<button class="btn btn-danger update-status" data-id="${data.order.order_id}">Cập nhật</button>`}
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
            })
        });
    </script>
</body>

</html>
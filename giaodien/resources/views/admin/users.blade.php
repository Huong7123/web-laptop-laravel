<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
            /* Prevent horizontal scroll */
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
            /* Smooth slide effect */
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

        <!-- User List Section -->
        <section id="userList">
            <h1>Danh sách tài khoản</h1>

            <!-- Add User Button -->
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">Tạo tài khoản</button>

            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th style="width: 80px;">Actions</th>
                    </tr>
                </thead>
                <tbody id="userTable">
                    <!-- Dữ liệu sẽ được thêm vào đây -->
                </tbody>
            </table>
        </section>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Tạo tài khoản</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm">
                        <div class="mb-3">
                            <label for="addUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="addUsername" required>
                        </div>
                        <div class="mb-3">
                            <label for="addEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="addEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="addPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="addPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="addPhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="addPhone">
                        </div>
                        <div class="mb-3">
                            <label for="addAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="addAddress">
                        </div>
                        <button type="button" class="btn btn-primary add-account">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/admin/js/admin.js"></script>

    <!-- Fetch API -->
    <script>
        //hiển thị danh sách
        $.ajax({
            url: "http://127.0.0.1:8001/api/get-account",
            type: "GET",
            dataType: 'json',
            success: function (data) {
                const accounts = $('#userTable');
                accounts.empty(); 
                data.forEach(function(user) {
                    const row = `
                        <tr id="category-${user.id}">
                            <td>${user.username}</td>
                            <td>${user.email}</td>
                            <td>${user.phone_number}</td>
                            <td>${user.address}</td>
                            <td>
                                <button class="btn btn-danger btn-sm delete-account" data-id="${user.id}">Xóa</button>
                            </td>
                        </tr>
                    `;
                    accounts.append(row);
                    
                });
            },
            error: function (e) {
                console.log(xhr.responseText);
            }
        });

        //hàm thêm
        function addAccount(){
            const data = {
                username : $('#addUsername').val(),
                email : $('#addEmail').val(),
                password : $('#addPassword').val(),
                phone_number : $('#addPhone').val(),
                address : $('#addAddress').val(),
            };

            $.ajax({
                url: "http://127.0.0.1:8001/api/admin-register",
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(data),
                success: function(response) {
                    alert('Tạo tài khoản mới thành công!');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        //hàm xóa 
        function deleteAccount(userId) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: 'http://127.0.0.1:8001/api/delete-account/' + userId,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                },
                success: function(response) {
                    alert('Xóa tài khoản thành công!');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        $(document).ready(function() {
            //gọi hàm thêm 
            $(document).on('click', '.add-account', function(event) {
                event.preventDefault();
                addAccount();
            });
    
            //gọi hàm xóa 
            $(document).on('click', '.delete-account', function(event) {
                event.preventDefault();
                
                var userId = $(this).data('id');
                
                // Xác nhận trước khi xóa
                if (confirm('Bạn có chắc chắn muốn xóa tài khoản này không?')) {
                    deleteAccount(userId);
                }
            });
            
        });
    </script>
</body>

</html>
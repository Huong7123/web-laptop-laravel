<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fa;
        }
        .footer {
            background-color: #4d3600;
            position: relative;
            bottom: 0;
            width: 100%;
            padding: 20px;
            text-align: center;
        }
        .form-container {
            background: white;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
        }
        .divider::before, .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #dee2e6;
        }
        .divider::before {
            margin-right: 0.25em;
        }
        .divider::after {
            margin-left: 0.25em;
        }
    </style>
</head>
<body>
<section class="vh-100">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                    class="img-fluid rounded shadow-lg" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 mt-5">
                <form id="login-form" class="form-container">
                    <div class="d-flex flex-row align-items-center justify-content-center mb-4">
                        <p class="lead fw-normal mb-0 me-3">Đăng nhập</p>
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Nhập địa chỉ email hợp lệ" required>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="password">Mật khẩu</label>
                        <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Nhập mật khẩu" required>
                    </div>

                    <div class="text-center text-lg-start">
                        <button type="button" id="login-button" class="btn btn-primary btn-lg px-5 py-2">Đăng nhập</button>
                        <p class="small fw-bold mt-2 pt-1 mb-0">Chưa có tài khoản? <a href="/register" class="link-danger">Đăng ký</a></p>
                    </div>

                    <!-- Phần tử hiển thị lỗi -->
                    <div id="errorMessage" style="color: red;"></div>
                </form>
            </div>

        </div>
    </div>
    <footer class="footer py-4 text-white text-center">
        <div>Bản quyền &copy; 2024. Mọi quyền được bảo lưu.</div>
        <div class="social-links mt-3">
            <a href="#" class="text-white me-4">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="text-white me-4">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="text-white me-4">
                <i class="fab fa-google"></i>
            </a>
            <a href="#" class="text-white">
                <i class="fab fa-linkedin-in"></i>
            </a>
        </div>
    </footer>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#login-button').on('click', function(event) {
            event.preventDefault(); // Ngăn chặn reload trang

            // Lấy dữ liệu từ form
            var email = $('#email').val();
            var password = $('#password').val();

            // Gọi API đăng nhập
            $.ajax({
                url: 'http://127.0.0.1:8001/api/login', // Địa chỉ API đăng nhập
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    email: email,
                    password: password
                }),
                success: function(response) {
                    // Lưu tên người dùng vào localStorage
                    localStorage.setItem('user', JSON.stringify(response.user));
                    console.log(response);
                    if(response.user.role_id === 1){
                        window.location.href = '/management';
                    }else if(response.user.role_id === 2){
                        window.location.href = '/home';
                    }
                },
                error: function(xhr) {
                    // Xử lý khi đăng nhập thất bại
                    var errorResponse = JSON.parse(xhr.responseText);
                    alert(errorResponse.message || 'Đăng nhập không thành công');
                }
            });
        });
    });
</script>
</body>
</html>
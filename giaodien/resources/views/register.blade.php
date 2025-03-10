<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <!-- Hình ảnh -->
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                        class="img-fluid rounded shadow-lg" alt="Registration Image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <h1 class="mb-4">Đăng ký tài khoản</h1>

                    <!-- Form đăng ký -->
                    <form id="register-form">
                        <!-- Tên người dùng -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="username">Tên người dùng</label>
                            <input type="text" id="username" name="username" class="form-control form-control-lg"
                                required>
                        </div>

                        <!-- Email -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control form-control-lg" required>
                        </div>

                        <!-- Mật khẩu -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="password">Mật khẩu</label>
                            <input type="password" id="password" name="password" class="form-control form-control-lg"
                                required>
                        </div>

                        <!-- Số điện thoại -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="phone_number">Số điện thoại</label>
                            <input type="text" id="phone_number" name="phone_number"
                                class="form-control form-control-lg" required>
                        </div>

                        <!-- Địa chỉ -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="address">Địa chỉ</label>
                            <input type="text" id="address" name="address" class="form-control form-control-lg"
                                required>
                        </div>

                        <!-- Submit button -->
                        <button id="btn-register" class="btn btn-primary btn-lg btn-block w-100">Đăng ký</button>
                        
                    </form>

                    <!-- Link đến form đăng nhập -->
                    <div class="text-center mt-3">
                        <p>Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập ngay</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#btn-register').on('click', function(event) {
                event.preventDefault(); // Ngăn chặn gửi form mặc định
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                const data = {
                    username: $('#username').val(),
                    password: $('#password').val(),
                    email: $('#email').val(),
                    phone_number: $('#phone_number').val(),
                    address : $('#address').val(),
                };

                $.ajax({
                    url: "http://127.0.0.1:8001/api/register",
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(data),
                    success: function(response) {
                        alert('Đăng ký tài khoản thành công!');
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });

    </script>
</body>

</html>
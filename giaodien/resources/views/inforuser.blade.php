@extends('layout.layout')  <!-- Kế thừa layout.blade.php -->

@section('title', 'Thông Tin Cá Nhân | Laptop-Shoppe')  <!-- Tiêu đề trang -->

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow" style="margin-left: 350px;">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Thông Tin Cá Nhân</h3>
                </div>
                <div class="card-body">
                    <form id="profile-form">
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    //hàm hiển thị form chỉnh sửa thông tin
    function editUser(userId) {
        $.ajax({
            url: 'http://127.0.0.1:8001/api/show-account-detail/' + userId,
            type: "GET",
            dataType: 'json',
            success: function(data) {
                const profile = $('#profile-form');
                const row = `
                    <div class="form-group mb-3">
                        <label for="username" class="form-label">Tên Người Dùng</label>
                        <input type="text" id="username" name="username" class="form-control" value="${data.username}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="${data.email}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone_number" class="form-label">Số Điện Thoại</label>
                        <input type="text" id="phone_number" name="phone_number" class="form-control" value="${data.phone_number}" >
                    </div>
                    <div class="form-group mb-3">
                        <label for="address" class="form-label">Địa Chỉ</label>
                        <input type="text" id="address" name="address" class="form-control" value="${data.address}">
                    </div>
                    <div class="form-group mb-4">
                        <label for="password" class="form-label">Mật Khẩu (Để trống nếu không đổi)</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <button type="button" class="update-user btn btn-primary w-100" style="margin-left: 121px;">Cập Nhật Thông Tin</button>
                `;
                profile.empty().append(row);
                    

            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    //hàm thay đổi thông tin
    function updateUser(userId) {
        const data = {
            username: $('#username').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            phone_number: $('#phone_number').val(),
            address: $('#address').val(),
        };
        $.ajax({
            url: 'http://127.0.0.1:8001/api/edit-infor/'+ userId,
            type: 'PUT',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function(response) {
                alert("Thay đổi thông tin thành công!");
                window.location.href="/home";
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }

    $(document).ready(function() {
        var user = JSON.parse(localStorage.getItem('user'));
        var userId = user.id;
        editUser(userId);
        //gọi hàm thay đổi thông tin
        $(document).on('click', '.update-user', function(event) {
            event.preventDefault();
            updateUser(userId);
        });
    });
</script>
@endsection

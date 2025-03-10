document.addEventListener('DOMContentLoaded', function(){
    //sự kiện click menu
    document.getElementById('menuToggle').addEventListener('click', function () {
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');

        // Toggle class 'open' cho sidebar
        sidebar.classList.toggle('open');
        // Toggle class 'shift' cho content
        content.classList.toggle('shift');
    });

    // Lấy thông tin người dùng từ localStorage
    var user = JSON.parse(localStorage.getItem('user'));
    if (user && user.role_id === 1) {
        // Nếu người dùng đã đăng nhập, thay đổi nội dung button thành "Đăng Xuất"
        document.getElementById('authBtn').innerHTML  = '<i style="margin-right: 8px;"></i>Đăng Xuất';
        document.getElementById('welcome').innerHTML   = `<span style="color:#fff; font-size: 20px;">Xin Chào ${user.username}</span>`;
    }
    else{
        localStorage.removeItem('user');
        window.location.href = '/login'; // Chuyển hướng về trang đăng nhập
        // alert('Bạn không có quyền truy cập vào trang này.');
    }

    // Xử lý sự kiện cho nút Đăng Xuất
    document.getElementById('authBtn').addEventListener('click', function() {
        if (this.innerHTML === '<i style="margin-right: 8px;"></i>Đăng Xuất') {
            var confirmLogout = confirm("Bạn có chắc chắn muốn đăng xuất không?");
            if (confirmLogout) {
                // Xóa thông tin người dùng từ localStorage
                localStorage.removeItem('user');

                // Chuyển hướng lại trang đăng nhập
                window.location.href = '/login';
            }else {
                
            }
        } 
    });
});

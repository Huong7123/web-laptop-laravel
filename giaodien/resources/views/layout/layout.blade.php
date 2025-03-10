<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title', 'Home | Laptop-Shoppe')</title>
    <link href="/fontend/css/bootstrap.min.css" rel="stylesheet">
    <link href="/fontend/css/font-awesome.min.css" rel="stylesheet">
    <link href="/fontend/css/prettyPhoto.css" rel="stylesheet">
    <link href="/fontend/css/price-range.css" rel="stylesheet">
    <link href="/fontend/css/animate.css" rel="stylesheet">
    <link href="/fontend/css/sweetalert.css" rel="stylesheet">
    <link href="/fontend/css/main.css" rel="stylesheet">
    <link href="/fontend/css/responsive.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="/fontend/js/html5shiv.js"></script>
    <script src="/fontend/js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="/fontend/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="/fontend/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="/fontend/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="/fontend/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/fontend/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
    <header id="header" >
        <div class="header-middle">

            <div class="container">

                <div class="row">
                    <div class="col-sm-1">
                        <div class="logo pull-left">
                            <a href="/home"><img src="/fontend/images/logolaptop.png" alt="" /></a>
                        </div>
                    </div>
                    
                    <div class="col-sm-11">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav" id="auth-menu">
                                <li>
                                    <a href="/inforuser" id="person">
                                        <i class="fa fa-person"></i>Thông tin cá nhân
                                    </a>
                                </li>
                                <li>
                                    <a href="/transaction_history" id="order-history-link">
                                        <i class="fa fa-history"></i> Đơn hàng
                                    </a>
                                </li>
                                <li>
                                    <form id="search-form" class="search-bar">
                                        <input type="text" id="search" class="search-input" placeholder="Tìm kiếm...">
                                    </form>
                                </li>
                                <li>
                                    <a href="tel:+84123456789" id="phone-icon">
                                        <i class="fa fa-phone"></i> +84 123 456 789
                                    </a>
                                </li>
                                <li>
                                    <a href="/cart" id="cart-icon">
                                        <i class="fa fa-shopping-cart"></i> Giỏ hàng
                                        <span class="cart-count badge">0</span>
                                    </a>
                                </li>
                                <!--Icon Người dùng -->
                                <li>
                                    <a style="cursor: pointer;" id="auth-link">

                                    </a>
                                </li>
                            </ul>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </header>


    <div id="main-content" >
        @yield('content')
    </div>

    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span>Laptop</span>-shopper</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="/san-pham">
                                    <div class="iframe-img">
                                        <img src="/fontend/images/footer1.webp" alt="" />
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="/fontend/images/map.png" alt="" />
                            <p>Km 10, đường Nguyễn Trãi, quận Thanh Xuân, thành phố Hà Nội</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2025 website bán hàng laptop</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="/fontend/js/jquery.js"></script>
    <script src="/fontend/js/bootstrap.min.js"></script>
    <script src="/fontend/js/jquery.scrollUp.min.js"></script>
    <script src="/fontend/js/price-range.js"></script>
    <script src="/fontend/js/jquery.prettyPhoto.js"></script>
    <script src="/fontend/js/main.js"></script>
    <script src="/fontend/js/sweetalert.min.js"></script>
    <script src="/fontend/js/home.js"></script>
    <!-- <script src="/fontend/js/pddetail.js"></script> -->
    <!-- <script src="/fontend/js/cart.js"></script> -->
    <script src="/fontend/js/checkout.js"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function(){

            // Cập nhật ngay khi tải trang
            updateCartCount();

            // Lấy thông tin người dùng từ localStorage
            var user = JSON.parse(localStorage.getItem('user'));
            $('#auth-link').empty();
            if (user) {
                // Nếu người dùng đã đăng nhập, thay đổi nội dung button thành "Đăng Xuất"
                const authHTML=`<i style="margin-right: 8px;" class="fa-solid fa-user"></i>Đăng Xuất`;
                $('#auth-link').append(authHTML);
            }
            else{
                const authHTML=`<i style="margin-right: 8px;" class="fa-solid fa-user"></i>Đăng Nhập`;
                $('#auth-link').append(authHTML);
            }
            
            

            // Xử lý sự kiện cho nút Đăng Xuất
            document.getElementById('auth-link').addEventListener('click', function() {
                if (this.innerHTML === '<i style="margin-right: 8px;" class="fa-solid fa-user"></i>Đăng Xuất') {
                    var confirmLogout = confirm("Bạn có chắc chắn muốn đăng xuất không?");
                    if (confirmLogout) {
                        // Xóa thông tin người dùng từ localStorage
                        localStorage.removeItem('user');

                        // Chuyển hướng lại trang đăng nhập
                        window.location.href = '/login';
                    }else {
                        window.location.reload();
                    }
                } else {
                    // Nếu là Đăng Nhập, chuyển hướng đến trang đăng nhập
                    window.location.href = '/login';
                }
            });
        });
    </script>

</script>
    
</body>

</html>
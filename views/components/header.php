<!DOCTYPE html>
<html lang="vi">

<head>
    <link rel="stylesheet" href="<?php echo BASE_URL . "public/fonts/fonts.css" ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . "public/fonts/font-icons.css" ?>">
    <!-- css -->
    <link rel="stylesheet" href="<?php echo BASE_URL . "public/css/bootstrap.min.css" ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . "public/css/swiper-bundle.min.css" ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . "public/css/animate.css" ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . "public/css/styles.css" ?>">

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="<?php echo BASE_URL . "public/images/logo/favicon.png" ?>">

    <style>
        .nav-account {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .nav-account .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            border: 1px solid #ddd;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            list-style: none;
            padding: 10px 0;
            min-width: 150px;
            border-radius: 5px;
            z-index: 1000;
        }

        .nav-account .dropdown-menu.show {
            display: block;
        }

        .nav-account .dropdown-menu li {
            padding: 8px 15px;
            transition: background 0.3s;
        }

        .nav-account .dropdown-menu li:hover {
            background: #f5f5f5;
        }

        .nav-account .dropdown-menu a {
            text-decoration: none;
            color: #333;
            display: block;
        }

        .nav-account .dropdown-menu a:hover {
            color: #007bff;
        }

        .offcanvas-body input.form-control {
            border-radius: 30px;
            padding-left: 15px;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <header id="header" class="header-default">
            <div class="container">
                <div class="row wrapper-header align-items-center">
                    <div class="col-md-4 col-3 d-xl-none">
                        <a href="#mobileMenu" class="mobile-menu" data-bs-toggle="offcanvas" aria-controls="mobileMenu">
                            <i class="icon icon-categories1"></i>
                        </a>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6">
                        <a href="<?php echo BASE_URL ?>" class="logo-header">
                            <img src="<?php echo BASE_URL . "public/images/logo/logoEase.png" ?>" alt="logo" class="logo">
                        </a>
                    </div>
                    <div class="col-xl-8 d-none d-xl-block">
                        <nav class="box-navigation text-center">
                            <ul class="box-nav-menu">
                                <li class="menu-item"><a href="<?php echo BASE_URL ?>" class="item-link">Trang chủ</a></li>
                                <li class="menu-item"><a href="<?php echo BASE_URL . '?act=category' ?>" class="item-link">Danh mục sản phẩm</a></li>
                                <li class="menu-item"><a href="<?php echo BASE_URL . "news.html" ?>" class="item-link">Tin Tức</a></li>
                                <li class="menu-item"><a href="<?php echo BASE_URL . "?act=submit_contact" ?>" class="item-link">Liên hệ</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-xl-2 col-md-4 col-3">
                        <ul class="nav-icon d-flex justify-content-end align-items-center">
                            <!-- ICON TÌM KIẾM -->
                            <li class="nav-search">
                                <a href="#searchOffcanvas" data-bs-toggle="offcanvas" class="nav-icon-item">
                                    <i class="icon icon-search"></i>
                                </a>
                            </li>

                            <!-- ICON NGƯỜI DÙNG -->
                            <li class="nav-account">
                                <div class="nav-icon-item" id="user-menu">
                                    <i class="icon icon-user"></i>
                                </div>
                                <ul class="dropdown-menu">
                                    <?php if (isset($_SESSION["user"])) { ?>
                                        <li><a href="?act=profile">Hồ sơ</a></li>
                                        <li><a href="?act=order_id">Đơn hàng</a></li>
                                        <li><a href="?act=settings">Cài đặt</a></li>
                                        <li><a href="?act=logout">Đăng xuất</a></li>
                                    <?php } else { ?>
                                        <li><a href="?act=login_view">Đăng nhập</a></li>
                                        <li><a href="?act=register">Đăng ký</a></li>
                                    <?php } ?>
                                </ul>
                            </li>

                            <!-- ICON GIỎ HÀNG -->
                            <li class="nav-cart">
                                <a href="<?php echo BASE_URL . "?act=cart_view" ?>" class="nav-icon-item">
                                    <i class="icon icon-cart"></i>
                                    <span class="count-box">
                                        <?php echo isset($_SESSION["user"]["cart"]) ? $_SESSION["user"]["cart"] : "0"; ?>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <!-- OFFCANVAS TÌM KIẾM -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="searchOffcanvas" aria-labelledby="searchOffcanvasLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="searchOffcanvasLabel">Tìm kiếm </h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Đóng"></button>
            </div>
            <div class="offcanvas-body">
                <div class="input-group">
                    <span class="input-group-text"></span>
                    <form action="<?php echo BASE_URL . '?act=search' ?>" method="GET" class="d-flex w-100">
                        <input type="hidden" name="act" value="search">
                        <input type="text" name="keyword" class="form-control me-2" placeholder="Tìm kiếm sản phẩm..." required>
                        <button type="submit" class="btn btn-primary"><i class="icon icon-search"></i></button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT DROPDOWN -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const userMenu = document.querySelector("#user-menu");
            const dropdownMenu = document.querySelector(".nav-account .dropdown-menu");

            if (userMenu) {
                userMenu.addEventListener("click", function(event) {
                    event.stopPropagation();
                    dropdownMenu.classList.toggle("show");
                });

                document.addEventListener("click", function() {
                    dropdownMenu.classList.remove("show");
                });
            }
        });
    </script>
</body>

</html>
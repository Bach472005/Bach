<?php 

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once "./controllers/HomeController.php";
require_once "./controllers/UserController.php";
require_once "./controllers/ProductController.php";


// Require toàn bộ file Models
require_once "./models/UserModel.php";
require_once "./models/ProductModel.php";
require_once "./models/CommentModel.php";

// include('./views/components/header.php');

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match




match ($act) {
    // Trang chủ
    '/' => (new ProductController())->home_view(),

    // Product
    'pd' => (new ProductController()) ->product_detail_view(),

    // USER
    'login' => (new UserController()) -> login(),
    'login_view' => (new UserController()) -> login_view(),
    'register' => (new UserController()) -> register(),
    'register_view' => (new UserController()) -> register_view(),
    'logout' => (new UserController()) -> log_out(),

    // CART
    'cart_view' => (new UserController()) -> cart_view(),
    
    // ORDER
    'order' => (new UserController()) -> order(),
    'order_id' => (new UserController()) -> order_id(),
    'add_orders' => (new UserController()) -> add_orders(),
    

    default => require_once './views/components/404.php', // Trang lỗi 404
};

// include('./views/components/footer.php');
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
// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    '/' => (new ProductController())->home_view(),

    // USER
    'login' => (new UserController()) -> login(),
    'login_view' => (new UserController()) -> login_view(),
    'register' => (new UserController()) -> register(),
    'register_view' => (new UserController()) -> register_view(),
    'logout' => (new UserController()) -> log_out(),
    default => require_once './views/404.php', // Trang lỗi 404
};
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL_ADMIN . "public/css/style.css" ?>">
    <title>Document</title>
</head>

<body>
    <aside class="col-md-3 bg-dark text-white p-4 sidebar order-md-2">
        <h2><i class="fas fa-user"></i>ADMIN</h2>
        <ul>
            <li><i class="fas fa-tachometer-alt"></i> Dashboard</li>
            <li><i class="fas fa-shopping-cart"></i> Đơn hàng</li>
            <li><i class="fas fa-list"></i><a href="<?php echo BASE_URL_ADMIN . "?act=category_view" ?>" class="text-decoration-none text-white"> Danh mục</a></li>

            <li><i class="fas fa-box"></i> <a href="<?php echo BASE_URL_ADMIN   ?>" class="text-decoration-none text-white"> Sản phẩm</a></li>
            <li><i class="fas fa-newspaper"></i> Bài viết</li>
            <li><i class="fas fa-chart-bar"></i> Thống kê</li>
            <li><i class="fas fa-users"></i> <a href="<?php echo BASE_URL_ADMIN . "?act=get_user" ?>" class="text-decoration-none text-white"> Thành viên</a></li>
            <li><i class="fas fa-comments"></i> Bình luận</li>
        </ul>
    </aside>
</body>

</html>
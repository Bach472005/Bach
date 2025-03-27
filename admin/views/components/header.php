<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->

    <link rel="stylesheet" href="<?php echo BASE_URL_ADMIN . "public/css/style.css" ?>">
    <!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>
    <header>
        <div class="topbar">
            <div class="search-container">
            <input type="text" placeholder="Tìm kiếm">
            </div>
          
            <div class="icon">
                <span><i class="fas fa-bell"></i>Thông báo</span>
                <span ><i class="fas fa-envelope"></i>Tin nhắn</span>
                <div class="dropdown">
                <span class="dropdown-toggle" ><i  class="fas fa-user"></i>Admin <i class="fas fa-caret-down"></i></span>
                <div class="dropdown-menu">
                    <a href="#">Hồ sơ</a>
                    <a href="#">Đăng kí</a>
                </div>
                </div>
            </div>
        </div>
    </header>

    <script>
        
        document.querySelector('.dropdown-toggle').addEventListener('click', function() {
            const dropdownMenu = this.nextElementSibling;
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        });

        
        window.addEventListener('click', function(event) {
            if (!event.target.closest('.dropdown')) {
                const dropdownMenus = document.querySelectorAll('.dropdown-menu');
                dropdownMenus.forEach(menu => {
                    menu.style.display = 'none'; // Ẩn menu khi nhấp bên ngoài
                });
            }
        });
    </script>


</body>

</html>
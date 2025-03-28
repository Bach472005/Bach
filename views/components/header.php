<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ease - Thời Trang Hiện Đại</title>
  <link rel="stylesheet" href="assets/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>
<body>
  <!-- Header -->
  <header>
    <div class="logo">Ease</div>
    <div class="search-container">
      <input type="text" placeholder="Tìm kiếm..." />
      <button class="search-btn">🔍</button>
    </div>
    <nav>
      <ul>
        <li><a href="index.html">Trang Chủ</a></li>
        <li><a href="#">Nam</a></li>
        <li><a href="#">Nữ</a></li>
        <li><a href="news.html">Tin Tức</a></li>
        <li><a href="contact.html">Liên Hệ</a></li>
      </ul>
    </nav>
    <div class="header-icons">
      <a href="#">🛒 Giỏ Hàng</a>
      <?php 
        if(isset($_SESSION["user"])){
      ?>
          <a href="<?php echo BASE_URL . "?act=logout"?>">Đăng xuất</a>
      <?php
        } else{
      ?>
        <a href="<?php echo BASE_URL . "?act=login_view"?>">Đăng Ký / Đăng Nhập</a>
      <?php
        }
      ?>
      
    </div>
  </header>

  <!-- Banner Slide -->
  <section class="banner">
    <!-- <div class="slide active"> <img src="img/bander/banner1.jpg" alt="Banner 1" /> </div> -->
    <div class="slide"> <img src="assets/img/bander/baner2.jpg" alt="Banner 2" /> </div>
    <div class="slide"> <img src="assets/img/bander/baner3.jpg" alt="Banner 3" /> </div>
  </section>
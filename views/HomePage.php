<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ease - Thời Trang Hiện Đại</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- css main -->
    <style>
        main {
    padding: 40px 0;
    background-color: #f8f9fa;
}

.categories {
    text-align: center;
    margin-bottom: 40px;
}

.categories h2 {
    font-size: 28px;
    margin-bottom: 20px;
    font-weight: bold;
}

.category-list {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
    list-style: none;
    padding: 0;
}

.category-list li {
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease-in-out;
}

.category-list li:hover {
    transform: scale(1.05);
}

.category-list img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 10px;
}

.featured-products {
    text-align: center;
    margin-bottom: 40px;
}

.featured-products h2 {
    font-size: 28px;
    margin-bottom: 20px;
    font-weight: bold;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    justify-content: center;
}

.product-card {
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
    transition: transform 0.3s ease-in-out;
}

.product-card:hover {
    transform: scale(1.05);
}

.product-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 15px;
}

.product-card h3 {
    font-size: 20px;
    margin-bottom: 10px;
}

.product-card p {
    font-size: 18px;
    color: #dc3545;
    font-weight: bold;
    margin-bottom: 10px;
}

.product-card button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease-in-out;
}

.product-card button:hover {
    background-color: #0056b3;
}

    </style>
</head>


<body>
    <?php ; 
    include('./views/components/header.php');
    include('./views/components/banner.php');
    // include('./views/components/navbar.php');
    ?>


<main>
<section class="categories">
    <h2>Danh Mục Sản Phẩm</h2>
    <ul class="category-list">
        <li>
            <a href="#">
                <img src="public/images/váy/anh11.jpg" alt="Váy" />
               
            </a>
        </li>
        <li>
            <a href="#">
                <img src="public/images/áo phong/z6427049469666_5642f2b40d4f30e919ae96313d6b646b.jpg" alt="Áo Phông" />
              
            </a>
        </li>
        <li>
            <a href="#">
                <img src="public/images/quần/z6427058916226_812197864e55a002aa64164fa47ce000.jpg" alt="Quần" />
                
            </a>
        </li>
        <li>
            <a href="#">
                <img src="public/images/ao khoac/z6427065417228_c4d35643131b5ce9de14e98e3e4b8886.jpg" alt="Áo Khoác" />
                
            </a>
        </li>
    </ul>
</section>
    <section class="featured-products">
        <h2>Sản Phẩm Nổi Bật</h2>
        <div class="product-grid">
            <?php
                foreach($_SESSION["products"] as $product){
            ?>
                <div class="product-card">
                    <img src="<?= BASE_URL_ADMIN .  $product['first_image'] ?>" alt="<?= $product["name"] ?>" />
                    <h3><?= $product["category_name"] ?></h3>
                    <p><?= number_format($product["price"], 0, ".", ".") ?> VNĐ</p>
                    <button onclick="window.location.href='<?= BASE_URL . "?act=pd&product_id=" . $product["id"] ?>'">Chi tiết sản phẩm</button>
                </div>
            <?php
                }
            ?>
        </div>
    </section>
</main>


    <!-- <section class="order-check">
    <h1>Kiểm Tra Đơn Hàng Của Bạn</h1>
    <form action="#" method="post">
      <label for="order-id">Mã Đơn Hàng:</label>
      <input type="text" id="order-id" name="order-id" placeholder="Nhập mã đơn hàng" required />

      <label for="phone">Số Điện Thoại:</label>
      <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại" required />

      <button type="submit">Kiểm Tra Đơn Hàng</button>
    </form>
  </section> -->
    <?php
    include('./views/components/footer.php');    
    ?>


    
</body>
</html>
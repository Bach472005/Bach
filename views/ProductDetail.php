<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CSS product -->
    <style>

    .product-detail {
    display: flex;
    align-items: center;
    justify-content: center;
    }

    .product-image {
        max-width: 100%;
        height: auto;
        object-fit: cover;
    }

    @media (max-width: 768px) {
        .product-detail {
            flex-direction: column;
            text-align: center;
        }
    }

    </style>
</head>

<body>
    <?php ; 
    include('./views/components/header.php');
    // include('./views/components/navbar.php');
    ?>
    <main class="container mt-4">
    <h1 class="text-center mb-4">Trang chi tiết sản phẩm</h1>
    
    <?php foreach ($product_detail as $product) : ?>
        <div class="row product-detail align-items-center mb-5">
            <!-- Cột chứa ảnh sản phẩm -->
            <div class="col-md-5 text-center">
                <img src="<?= BASE_URL_ADMIN . $product['first_image'] ?>" 
                     alt="<?= $product['name'] ?>" 
                     class="img-fluid rounded shadow product-image">
            </div>

            <!-- Cột chứa thông tin sản phẩm -->
            <div class="col-md-7">
                <h2 class="mb-3"><?= $product['name'] ?></h2>
                <p class="text-muted">Màu sắc: 
                    <span style="color: <?= $product['color_code'] ?>; font-weight: bold;">
                        <?= $product['color_name'] ?>
                    </span>
                </p>
                <p>Kích thước: <strong><?= $product['size_name'] ?></strong></p>
                <p>Kho: <strong><?= $product['stock'] > 0 ? $product['stock'] . ' sản phẩm' : 'Hết hàng' ?></strong></p>
                <h3 class="text-danger"><?= number_format($product['price'], 0, ".", ".") ?> VNĐ</h3>
                <p class="mt-3"><?= $product['description'] ?></p>

                <!-- Nút thêm vào giỏ hàng -->
                <?php if ($product['stock'] > 0) : ?>
                    <form action="<?= BASE_URL . '?act=add_to_cart' ?>" method="POST">
                        <input type="hidden" name="product_detail_id" value="<?= $product['product_detail_id'] ?>">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn btn-primary btn-lg mt-3">Thêm vào giỏ hàng</button>
                    </form>
                <?php else : ?>
                    <button class="btn btn-secondary btn-lg mt-3" disabled>Hết hàng</button>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</main>


        
    </main>
    <?php
    include('./views/components/footer.php');    
    ?>

    


   
</body>

</html>
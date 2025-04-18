<!-- filepath: c:\laragon\www\Project_1\views\SearchResults.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết Quả Tìm Kiếm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include('./views/components/header.php'); ?>

    <div class="container mt-5">
        <h2>Kết Quả Tìm Kiếm</h2>
        <?php if (empty($products)): ?>
            <p>Không tìm thấy sản phẩm nào phù hợp với từ khóa "<strong><?= htmlspecialchars($_GET['keyword']) ?></strong>".</p>
        <?php else: ?>
            <div class="row">
                <?php foreach ($products as $product): ?>
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <img src="<?=  $product['first_image'] ?>" class="card-img-top" alt="<?= $product['name'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $product['name'] ?></h5>
                                <p class="card-text"><?= number_format($product['price'], 0, ',', '.') ?> VNĐ</p>
                                <a href="<?= BASE_URL . '?act=pd&product_id=' . $product['id'] ?>" class="btn btn-primary">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <?php include('./views/components/footer.php'); ?>
</body>
</html>
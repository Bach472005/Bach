<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>

    <style>
        body {
            background-color: #f8f9fa;
        }
        .order-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .order-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .product-list {
            margin-bottom: 20px;
            padding: 15px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .product-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }
        .product-item:last-child {
            border-bottom: none;
        }
        .product-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-right: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .product-item p {
            margin: 5px 0;
        }
        input[type="color"] {
            border: none;
            width: 30px;
            height: 30px;
            padding: 3px;
            vertical-align: middle;
            background: none;
        }
    </style>
</head>
<body>
    <div id="container">
        <?php ; 
        include('./views/components/header.php');
        ?>
    <main>
    <div class="order-container">
            <h2>Thông Tin Đặt Hàng</h2>
            <div class="product-list">
                <h5>Sản Phẩm Của Bạn</h5>
                <div class="product-item">
                    <img src="<?= BASE_URL_ADMIN . $cart["first_image"] ?>" alt="Sản phẩm">
                    <div>
                        <p class="mb-1"><strong><?= $cart["name"] ?></strong></p>
                        <p class="mb-1">Size: <?= $cart["size_name"] ?></p>
                        <p class="mb-1">Color: <?= $cart["color_name"] ?>  <input type="color" value="<?= $cart["color_code"] ?>" disabled></p>
                        <p class="mb-1">Giá: <?= number_format($cart["price"], 0, ".", ".") ?> VNĐ</p>
                        <p class="mb-1">Số lượng: <?= $cart["quantity"] ?></p>
                        <p class="mb-1">Tổng: <?= number_format($cart["quantity"] * $cart["price"], 0, ".", ".") ?>VNĐ</p>
                    </div>
                </div>
            </div>
            <form action="<?php echo BASE_URL . "?act=add_orders" ?>" method="POST">
                <div class="mb-3">
                    <label for="fullname" class="form-label">Họ và Tên</label>
                    <input type="text" class="form-control" id="receiver_name" name="receiver_name" value="<?= isset($_SESSION["user"]) ? $_SESSION["user"]["name"] : '' ?>" required >
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Số Điện Thoại</label>
                    <input type="text" class="form-control" id="receiver_phone" name="receiver_phone" value="<?= isset($_SESSION["user"]) ? $_SESSION["user"]["phone"] : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Địa Chỉ Nhận Hàng</label>
                    <input type="text" class="form-control" id="receiver_address" name="receiver_address" value="<?= isset($_SESSION["user"]) ? $_SESSION["user"]["address"] : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="note" class="form-label">NOTE</label>
                    <input type="text" class="form-control" id="receiver_note" name="receiver_note">
                </div>
                <div class="mb-3">
                    <label for="payment" class="form-label">Phương Thức Thanh Toán</label>
                    <select class="form-select" id="payment_method" name="payment_method" required>
                        <option value="COD">COD</option>
                        <option value="Credit Card">Credit Card</option>
                        <option value="Paypal">Paypal</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Đặt Hàng</button>
            </form>


        </div>
    </main>


        <?php ; 
        include('./views/components/footer.php');
        ?>

    </div>

   

</body>
</html>
<!-- filepath: c:\laragon\www\Project_1\views\User\Contact.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên Hệ</title>
    <link rel="stylesheet" href="<?php echo BASE_URL . "public/css/bootstrap.min.css" ?>">
    <style>
        .contact-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .contact-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .contact-header h2 {
            font-size: 28px;
            color: #333;
        }
    </style>
</head>
<body>
    <?php include './views/components/header.php'; ?>

    <div class="contact-container">
        <div class="contact-header">
            <h2>Liên Hệ Với Chúng Tôi</h2>
            <p>Hãy để lại thông tin và chúng tôi sẽ liên hệ với bạn sớm nhất!</p>
        </div>
        <form action="<?php echo BASE_URL . '?act=submit_contact' ?>" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Họ và Tên</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Nội Dung</label>
                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Nhập nội dung liên hệ" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Gửi Liên Hệ</button>
        </form>
    </div>

    <?php include './views/components/footer.php'; ?>
</body>
</html>
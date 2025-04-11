<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        thead {
            background-color: #f2f2f2;
        }
        /* Đảm bảo phần nội dung không bị che */
        .content {
            margin-left: 420px; /* Đảm bảo nội dung không bị sidebar che */
            width: 71.5%;
        }
    </style>
</head>
<body>

<?php include './views/components/header.php'; ?>
<?php include './views/components/sidebar.php' ?>
    
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <!-- Sidebar content (đã bao gồm trong include) -->
        </div>

        <!-- Main Content -->
        <div class="col-md-9 content mt-4">
            <h2>📊 Admin Dashboard</h2>
        
            <!-- Hàng 1: Thống kê -->
            <div class="row">
                <div class="col-md-3">
                    <div class="card text-bg-primary">
                        <div class="card-body">
                            <h5 class="card-title">Tổng số người dùng</h5>
                            <p class="card-text"><?php echo $total_users; ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card text-bg-success">
                        <div class="card-body">
                            <h5 class="card-title">Doanh thu hôm nay</h5>
                            <p class="card-text"><?php echo number_format($today_revenue); ?> VND</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card text-bg-warning">
                        <div class="card-body">
                            <h5 class="card-title">Đơn hàng mới</h5>
                            <p class="card-text"><?php echo $new_orders; ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card text-bg-danger">
                        <div class="card-body">
                            <h5 class="card-title">Sản phẩm hết hàng</h5>
                            <p class="card-text"><?php echo $out_of_stock; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hàng 2: Doanh thu tuần qua -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <h4>📈 Doanh thu tuần qua</h4>
                    <div id="revenue-content">
                        <?php if(count($week_revenue) > 0): ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Thứ 2</th>
                                        <th>Thứ 3</th>
                                        <th>Thứ 4</th>
                                        <th>Thứ 5</th>
                                        <th>Thứ 6</th>
                                        <th>Thứ 7</th>
                                        <th>Chủ Nhật</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php foreach ($week_revenue as $revenue) : ?>
                                            <td><?php echo number_format($revenue); ?> VNĐ</td>
                                        <?php endforeach; ?>
                                    </tr>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div id="fake-table" class="alert alert-warning">
                                Không có dữ liệu doanh thu tuần này.
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Thứ 2</th>
                                            <th>Thứ 3</th>
                                            <th>Thứ 4</th>
                                            <th>Thứ 5</th>
                                            <th>Thứ 6</th>
                                            <th>Thứ 7</th>
                                            <th>Chủ Nhật</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>0 triệu</td>
                                            <td>0 triệu</td>
                                            <td>0 triệu</td>
                                            <td>0 triệu</td>
                                            <td>0 triệu</td>
                                            <td>0 triệu</td>
                                            <td>0 triệu</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include './views/components/footer.php'; ?>
</body>
</html>

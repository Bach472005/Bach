<!-- filepath: c:\laragon\www\Project_1\admin\views\Dashboard\DashBoard.php -->
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

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        thead {
            background-color: #f2f2f2;
        }

        .content {
            margin-left: 420px;
            width: 71.5%;
        }
    </style>
</head>

<body>
    <?php include './views/components/header.php'; ?>
    <?php include './views/components/sidebar.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <!-- Sidebar content -->
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

                <!-- Hàng 2: Biểu đồ doanh thu tuần qua -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h4>📈 Biểu đồ doanh thu tuần qua</h4>
                        <canvas id="revenueChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include './views/components/footer.php'; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
          
            const weekRevenue = <?php echo json_encode($week_revenue); ?>;

            
            const ctx = document.getElementById('revenueChart').getContext('2d');
            const revenueChart = new Chart(ctx, {
                type: 'bar', 
                data: {
                    labels: ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ Nhật'], // Nhãn các ngày
                    datasets: [{
                        label: 'Doanh thu (VNĐ)',
                        data: weekRevenue, 
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(75, 192, 192, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true 
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>
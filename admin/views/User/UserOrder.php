<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Đơn Hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 250px;
            background-color: #f8f9fa;
        }

        .content {
            margin-left: 420px;
        }
    </style>
</head>

<body>

    <?php include './views/components/header.php'; ?>

    <div class="d-flex">
        <?php include './views/components/sidebar.php' ?>

        <div class="content container-fluid mt-4">
            <h2 class="mb-4">Quản Lý Đơn Hàng</h2>

            <!-- Tìm kiếm và lọc theo trạng thái -->
            <div class="mb-4">
                <form id="filterForm">
                    <div class="row">
                        <div class="col-md-3">
                            <select id="statusFilter" class="form-select">
                                <option value="">Tất cả trạng thái</option>
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="shipped">Shipped</option>
                                <option value="delivered">Delivered</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="searchName" class="form-control"
                                placeholder="Tìm theo tên khách hàng">
                        </div>
                        <button type="button" class="btn btn-secondary" id="clearFilter">Xóa bộ lọc</button>
                    </div>
                </form>
            </div>

            <!-- Bảng đơn hàng -->
            <table class="table table-bordered text-center" id="orderTable">
                <thead class="table-dark">
                    <tr>
                        <th>ID Đơn Hàng</th>
                        <th>Khách Hàng</th>
                        <th>Ngày Đặt</th>
                        <th>Ngày hoàn thành</th>
                        <th>Tổng Tiền</th>
                        <th>Trạng Thái</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach ($orders as $order): ?>
                        <tr class="order-item" data-status="<?php echo strtolower($order['status']); ?>"
                            data-name="<?php echo strtolower($order['customer_name']); ?>">
                            <td>#<?php echo $order['user_id']; ?></td>
                            <td><?php echo $order['customer_name']; ?></td>
                            <td><?php echo date('d/m/Y H:i:s', strtotime($order['order_date'])); ?></td>
                            <td><?php echo $order['completed_at'] == null ? "Chưa hoàn thành" : date('d/m/Y H:i:s', strtotime($order['completed_at'])); ?>
                            </td>
                            <td><?php echo number_format($order['price'] * $order["quantity"], 0, ',', '.'); ?>đ</td>
                            <td>
                                <span class="badge bg-<?php echo
                                    ($order['status'] == 'Pending') ? 'warning' :
                                    ($order['status'] == 'Processing' ? 'info' :
                                        ($order['status'] == 'Shipped' ? 'primary' :
                                            ($order['status'] == 'Delivered' ? 'success' :
                                                'danger'))); ?>">
                                    <?php echo ucfirst($order['status']); ?>
                                </span>

                            </td>
                            <td>
                                <!-- Nút xem -->
                                <button type="button" class="btn btn-info btn-sm"
                                    onclick="toggleOrderForm(<?php echo $order['order_detail_id']; ?>, this)">Xem</button>
                                <!-- Thêm spinner vào mỗi dòng đơn hàng -->
                                <div id="order-spinner-<?php echo $order['user_id']; ?>" class="spinner-border text-primary"
                                    role="status" style="display:none;">
                                    <span class="visually-hidden">Loading...</span>
                                </div>

                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>

    <?php include './views/components/footer.php'; ?>

    <script>
        $(document).ready(function () {
            // Lọc đơn hàng khi thay đổi trạng thái
            $('#statusFilter').on('change', function () {
                var status = $(this).val().toLowerCase();
                var searchName = $('#searchName').val().toLowerCase();

                // Lọc theo trạng thái và tên khách hàng
                $('.order-item').each(function () {
                    var itemStatus = $(this).data('status').toLowerCase();
                    var itemName = $(this).data('name');

                    // Kiểm tra trạng thái và tên khách hàng
                    if ((status === '' || itemStatus === status) && (searchName === '' || itemName.includes(searchName))) {
                        $(this).show(); // Hiển thị dòng
                    } else {
                        $(this).hide(); // Ẩn dòng
                    }
                });
            });

            // Lọc đơn hàng khi tìm kiếm theo tên khách hàng
            $('#searchName').on('input', function () {
                var status = $('#statusFilter').val().toLowerCase();
                var searchName = $(this).val().toLowerCase();

                // Lọc theo trạng thái và tên khách hàng
                $('.order-item').each(function () {
                    var itemStatus = $(this).data('status').toLowerCase();
                    var itemName = $(this).data('name');

                    // Kiểm tra trạng thái và tên khách hàng
                    if ((status === '' || itemStatus === status) && (searchName === '' || itemName.includes(searchName))) {
                        $(this).show(); // Hiển thị dòng
                    } else {
                        $(this).hide(); // Ẩn dòng
                    }
                });
            });
        });
        $('#clearFilter').on('click', function () {
            $('#statusFilter').val('');
            $('#searchName').val('');
            $('.order-item').show();
        });

        var ordersData = <?php echo json_encode($orders); ?>;


        function toggleOrderForm(orderDetailId, btn) {
            var spinner = document.getElementById("order-spinner-" + orderDetailId);
            if (spinner) {
                spinner.style.display = "inline-block";
            }

            let existingRow = document.getElementById("order-form-" + orderDetailId);
            if (existingRow) {
                existingRow.classList.toggle("d-none");
                btn.textContent = existingRow.classList.contains("d-none") ? "Xem" : "Ẩn";
                if (spinner) spinner.style.display = "none";
            } else {
                let orderRow = btn.closest("tr");
                let newRow = document.createElement("tr");
                newRow.id = "order-form-" + orderDetailId;

                let order = ordersData.find(o => o.order_detail_id == orderDetailId); // 🔥 tìm theo order_detail_id
                if (!order) {
                    console.log("Không tìm thấy order detail ID:", orderDetailId);
                    alert("Không tìm thấy dữ liệu đơn hàng!");
                    return;
                }

                newRow.innerHTML = `
            <td colspan="7">
                <div class="border rounded p-3 bg-light">
                    <form action="<?= BASE_URL_ADMIN ?>?act=update_order&order_id=${order.id}" method="POST">
                        <input type="hidden" name="user_id" value="${order.user_id}">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label">Tên sản phẩm</label>
                                <input type="text" name="product_name" class="form-control" value="${order.name}" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Số lượng</label>
                                <input type="number" name="quantity" class="form-control" value="${order.quantity}" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Giá</label>
                                <input type="number" name="price" class="form-control" value="${order.price.toLocaleString('vi-VN')}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Trạng thái</label>
                                <select name="status" class="form-select">
                                    <option value="Pending" ${order.status === "Pending" ? "selected" : ""}>Pending</option>
                                    <option value="Processing" ${order.status === "Processing" ? "selected" : ""}>Processing</option>
                                    <option value="Shipped" ${order.status === "Shipped" ? "selected" : ""}>Shipped</option>
                                    <option value="Delivered" ${order.status === "Delivered" ? "selected" : ""}>Delivered</option>
                                    <option value="Cancelled" ${order.status === "Cancelled" ? "selected" : ""}>Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </td>
        `;

                orderRow.after(newRow);
                if (spinner) spinner.style.display = "none";
                btn.textContent = "Ẩn";
            }
        }
    </script>
</body>

</html>
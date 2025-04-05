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
                        <input type="text" id="searchName" class="form-control" placeholder="Tìm theo tên khách hàng">
                    </div>
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
                <?php foreach ($orders as $order) : ?>
                <tr class="order-item" data-status="<?php echo strtolower($order['status']); ?>" data-name="<?php echo strtolower($order['customer_name']); ?>">
                    <td>#<?php echo $order['user_id']; ?></td>
                    <td><?php echo $order['customer_name']; ?></td>
                    <td><?php echo date('d/m/Y H:i:s', strtotime($order['order_date'])); ?></td>
                    <td><?php echo $order['completed_at'] == null ? "Chưa hoàn thành" : date('d/m/Y H:i:s', strtotime($order['completed_at'])); ?></td>
                    <td><?php echo number_format($order['price'] * $order["quantity"], 0, ',', '.'); ?>đ</td>
                    <td>
                        <span class="badge bg-<?php echo ($order['status'] == 'completed') ? 'success' : ($order['status'] == 'pending' ? 'warning' : 'info'); ?>">
                            <?php echo ucfirst($order['status']); ?>
                        </span>
                    </td>
                    <td>
                        <!-- Nút xem -->
                        <button type="button" class="btn btn-info btn-sm" onclick="toggleOrderForm(<?php echo $order['user_id']; ?>, this)">Xem</button>
                        <!-- Chỗ để hiện form -->
                        <div id="order-form-<?php echo $order['user_id']; ?>" class="mt-3"></div>
<!-- 
                        <a href="<?= BASE_URL_ADMIN ?>?act=delete_order&id=<?php echo $order['user_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?');">Xóa</a> -->
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include './views/components/footer.php'; ?>

<script>
    $(document).ready(function() {
        // Lọc đơn hàng khi thay đổi trạng thái
        $('#statusFilter').on('change', function() {
            var status = $(this).val().toLowerCase();
            var searchName = $('#searchName').val().toLowerCase();

            // Lọc theo trạng thái và tên khách hàng
            $('.order-item').each(function() {
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
        $('#searchName').on('input', function() {
            var status = $('#statusFilter').val().toLowerCase();
            var searchName = $(this).val().toLowerCase();

            // Lọc theo trạng thái và tên khách hàng
            $('.order-item').each(function() {
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
    var ordersData = <?php echo json_encode($orders); ?>;

function toggleOrderForm(userId, btn) {
    let existingRow = document.getElementById("order-form-" + userId);

    if (existingRow) {
        // Nếu form đang mở, ẩn nó đi
        existingRow.remove();
        btn.textContent = "Xem";
    } else {
        // Lấy dòng đơn hàng
        let orderRow = btn.closest("tr");
        let newRow = document.createElement("tr");
        newRow.id = "order-form-" + userId;

        // Tìm đơn hàng theo ID
        let order = ordersData.find(o => o.user_id == userId);
        if (!order) {
            alert("Không tìm thấy dữ liệu đơn hàng!");
            return;
        }

        newRow.innerHTML = `
            <td colspan="7">
                <div class="border rounded p-3 bg-light">
                    <form action="<?= BASE_URL_ADMIN ?>?act=update_order" method="POST">
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
                                    <option value="pending" ${order.status === "pending" ? "selected" : ""}>Pending</option>
                                    <option value="processing" ${order.status === "processing" ? "selected" : ""}>Processing</option>
                                    <option value="shipped" ${order.status === "shipped" ? "selected" : ""}>Shipping</option>
                                    <option value="delivered" ${order.status === "delivered" ? "selected" : ""}>Delivered</option>
                                    <option value="cancelled" ${order.status === "cancelled" ? "selected" : ""}>Cancelled</option>
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

        // Chèn dòng form ngay sau dòng đơn hàng tương ứng
        orderRow.after(newRow);
        btn.textContent = "Ẩn";
    }
}
</script>

</body>
</html>

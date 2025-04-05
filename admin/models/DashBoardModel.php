<?php 

class DashboardModel extends Connect
{

    public function totalUser() {
        $sql = "SELECT COUNT(DISTINCT user_id) AS total_users FROM orders";

        $data = $this->conn->prepare($sql);
        $data->execute();
    
        $result = $data->fetch(PDO::FETCH_ASSOC); // Lấy dữ liệu theo kiểu mảng liên kết
        return $result ? $result['total_users'] : 0; // Trả về số lượng, nếu không có thì trả về 0
    }

    public function todayRevenue() {
        $sql = "SELECT SUM(od.quantity * od.price) AS today_revenue
                FROM order_details od
                JOIN orders o ON od.order_id = o.id
                WHERE o.status = 'completed' AND DATE(o.created_at) = CURDATE()";
        $data = $this->conn->prepare($sql);
        $data->execute();
        $result = $data->fetch(PDO::FETCH_ASSOC);
        return $result["today_revenue"] ?? 0;
    }

    public function newOrder() {
        $sql = "SELECT COUNT(*) AS new_orders
               FROM orders
               WHERE status = 'completed' AND DATE(created_at) = CURDATE()";
        $data = $this->conn->prepare($sql);
        $data->execute();
        $result = $data->fetch(); 
        return $result["new_orders"] ?? 0;
    }

    public function outOfStock() {
        $sql = "SELECT COUNT(*) AS out_of_stock
                    FROM products
                    WHERE quantity = 0";
        $data = $this->conn->prepare($sql);
        $data->execute();
        $result = $data->fetch(); 
        return $result["out_of_stock"] ?? 0;
    }

    public function weekRevenue() {
        $sql = "SELECT SUM(od.quantity * od.price) AS revenue,
                       DAYNAME(o.created_at) AS day_name
                FROM order_details od
                JOIN orders o ON od.order_id = o.id
                WHERE o.status = 'completed' 
                    AND o.created_at >= CURDATE() - INTERVAL 7 DAY
                GROUP BY day_name
                ORDER BY MIN(o.created_at)"; // ✅ Thêm MIN để sửa lỗi
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    
        $revenue_data = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $revenue_data[$row['day_name']] = $row['revenue'];
        }
    
        return $revenue_data;
    }
    
    
}
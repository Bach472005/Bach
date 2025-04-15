<?php 

class DashboardController
{
    public $dashboard;

    public function __construct(){
        $this->dashboard = new DashboardModel;
        session_start();

        if (!isset($_SESSION['user']['role']) || $_SESSION['user']['role'] !== 1) {
            // Nếu không phải admin, chuyển hướng người dùng ra trang đăng nhập hoặc trang khác
            echo "<script>
                    alert('Bạn phải là admin mới vào trang này được!');
                    window.location.href = '". BASE_URL ."';
                </script>";
        }
    }

    public function dashboard() {
        $total_users = $this->dashboard->totalUser();
        $today_revenue = $this->dashboard->todayRevenue();
        $new_orders = $this->dashboard->newOrder();
        $out_of_stock = $this->dashboard->outOfStock();
        $week_revenue = $this->dashboard->weekRevenue();

        require_once './views/DashBoard/DashBoard.php';
    }
}
<?php 

class DashboardController
{
    public $dashboard;

    public function __construct(){
        $this->dashboard = new DashboardModel;
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
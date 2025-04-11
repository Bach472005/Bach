<?php
class UserController
{
    public $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
        session_start();
    }
    public function get_user()
    {
        $users = $this->userModel->get_user();

        require_once './views/User/List.php';
    }
    public function delete_user()
    {
        $id = $_GET['id'];
        $this->userModel->delete_user($id);
        return $this->get_user();
    }
    public function update_user_status()
    {
        $id = $_GET['id'];
        $status = $_GET['status'];
        $this->userModel->update_user_status($id, $status);
        return $this->get_user();
    }
    public function get_order()
    {
        $orders = $this->userModel->get_order();
        $groupedOrders = [];

        foreach ($orders as $order) {
            $orderId = $order['id']; // hoặc $order['order_id'] nếu bạn dùng tên khác
            usort($orders, function ($a, $b) {
                return strtotime($b['order_date']) <=> strtotime($a['order_date']);
            });
            // if (!isset($groupedOrders[$orderId])) {
            //     $groupedOrders[$orderId] = [];
            // }

            // $groupedOrders[$orderId][] = $order;
        }

        require_once "./views/User/UserOrder.php";
    }
    public function update_order()
    {
        if (isset($_GET["order_id"])) {
            $status = $_POST["status"];
            $order_id = $_GET["order_id"];
            $this->userModel->update_order($status, $order_id);
            echo "<script> 
                        alert('Update Success');
                        setTimeout(function(){
                            window.location.href = '?act=get_order';
                        }, 1000); 
                      </script>";
        }

    }
    public function __destruct()
    {
        $this->userModel = null;
    }
}
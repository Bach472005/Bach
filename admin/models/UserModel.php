<?php
    class UserModel extends Connect{
        public $conn;

        public function get_user(){
            $sql = "SELECT * FROM users";
            $data = $this->conn->prepare($sql);
            $data->execute();
            return $data->fetchAll(PDO::FETCH_ASSOC);
        }
        public function delete_user($id){
            $sql = "DELETE from users where id = :id";
            $data = $this->conn->prepare($sql);
            $data->bindParam(":id", $id);
            $data->execute();
        }
        public function update_user_status($id, $status){
            $sql = "UPDATE `users` SET status = :status where id = :id";
            $data = $this->conn->prepare($sql);

            $data->bindParam(":id", $id);
            $data->bindParam(":status", $status);
            $data->execute();
        }
        public function get_order(){
            $sql = "SELECT
                        od.quantity,
                        od.price,
                        o.status,
                        o.user_id,
                        o.receiver_name AS customer_name,
                        o.created_at AS order_date,
                        o.completed_at,
                        s.size_name,
                        cl.color_name,
                        cl.color_code,
                        p.name,
                        MIN(i.image_url) AS first_image
                    FROM orders o
                    JOIN order_details od ON od.order_id = o.id
                    JOIN product_detail pd ON od.product_detail_id = pd.id
                    JOIN sizes s ON pd.size_id = s.id
                    JOIN colors cl ON pd.color_id = cl.id
                    JOIN products p ON pd.product_id = p.id
                    LEFT JOIN images i ON i.product_id = p.id
                    GROUP BY od.quantity, od.price, o.status, o.user_id, o.receiver_name, o.created_at, o.completed_at, s.size_name, cl.color_name, cl.color_code, p.name";

            $data = $this->conn->prepare($sql);
            $data->execute();
            return $data->fetchAll(PDO::FETCH_ASSOC);
        }
        public function update_order($status){
            return 0;
        }
    }
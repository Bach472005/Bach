<?php
    class Connect{
        public $conn;
        public function __construct(){
            $this->conn = connect_db();
        }
        public function __destruct(){
            $this->conn = null;
        }
        public function get_table($table_name, $conditions = [], $columns = "*", $limit = null) {
            $sql = "SELECT $columns FROM $table_name";
            $params = [];
        
            if (!empty($conditions)) {
                $sql .= " WHERE ";
                $whereClauses = [];
                
                foreach ($conditions as $column => $value) {
                    $whereClauses[] = "$column = :$column";
                    $params[":$column"] = $value;
                }
                
                $sql .= implode(" AND ", $whereClauses);
            }
        
            if ($limit) {
                $sql .= " LIMIT :limit";
            }
        
            $data = $this->conn->prepare($sql);
            
            foreach ($params as $param => $value) {
                $data->bindValue($param, $value);
            }
        
            if ($limit) {
                $data->bindValue(":limit", $limit, PDO::PARAM_INT);
            }
        
            $data->execute();
            return $data->fetchAll(PDO::FETCH_ASSOC);
        }
        
    }
    class UserModel extends Connect{
        public $conn;

        public function get_user_email($email){
            $sql = "SELECT * FROM users where email = :email";
            $data = $this->conn->prepare($sql);
            $data->bindParam(":email", $email);
            $data->execute();
            return $data->fetch(PDO::FETCH_ASSOC);
        }

        public function register($user){
            $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
            $data = $this->conn->prepare($sql);
            $data->bindParam(":name", $user["name"]);
            $data->bindParam(":email", $user["email"]);
            $data->bindParam(":password", $user["password"]);
            $data->execute();
        }

        public function get_cart($id){
            $sql = "SELECT 
                        cd.id, 
                        cd.cart_id, 
                        cd.product_detail_id, 
                        cd.quantity, 
                        cd.price, 
                        pd.stock,  
                        p.name AS product_name,
                        p.description,
                        p.category_id,
                        p.id AS product_id,
                        s.size_name,
                        cl.color_name,
                        cl.color_code,
                        MIN(i.image_url) AS first_image
                    FROM cart AS c 
                    JOIN cart_details AS cd ON c.id = cd.cart_id
                    JOIN product_detail AS pd ON pd.id = cd.product_detail_id  
                    JOIN products AS p ON pd.product_id = p.id
                    JOIN sizes AS s ON s.id = pd.size_id
                    JOIN colors AS cl ON cl.id = pd.color_id
                    LEFT JOIN images AS i ON p.id = i.product_id
                    WHERE c.user_id = :id
                    GROUP BY cd.id; 
                    ";

            $data = $this->conn->prepare($sql);
            $data->bindParam(":id", $id, PDO::PARAM_INT);
            $data->execute();

            return $data->fetchAll(PDO::FETCH_ASSOC);
        }
        public function get_cart_id($cart_id){
            $sql = "SELECT
                        cd.quantity,
                        cd.price,
                        pd.id as product_detail_id,
                        s.size_name,
                        c.color_name,
                        c.color_code,
                        p.name,
                        MIN(i.image_url) AS first_image
                        from cart_details cd
                        JOIN product_detail pd ON pd.id = cd.product_detail_id
                        JOIN sizes s ON pd.size_id = s.id
                        JOIN colors c ON pd.color_id = c.id
                        JOIN products p ON p.id = pd.product_id
                        LEFT JOIN images i ON i.product_id = p.id
                        where cd.id = :id";
            $data = $this->conn->prepare($sql);
            $data->bindParam(":id", $cart_id, PDO::PARAM_INT);
            $data->execute();

            return $data->fetch(PDO::FETCH_ASSOC);
        }

        public function get_order_by_id($id){
            $sql = "SELECT
                        od.quantity,
                        od.price,
                        o.id as order_id,
                        o.status, 
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
                    WHERE o.user_id = :user_id
                    GROUP BY od.quantity, od.price, o.id, o.status, s.size_name, cl.color_name, cl.color_code, p.name";
            $data = $this->conn->prepare($sql);
            $data->bindParam(":user_id", $id);
            $data->execute();
            return $data->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function add_orders($order, $order_details){
            $sql = "INSERT INTO orders (user_id, payment_method, receiver_name, receiver_phone, receiver_address, receiver_note) values (:user_id, :payment_method, :receiver_name, :receiver_phone, :receiver_address, :receiver_note)";
            $data = $this->conn->prepare($sql);

            $data->bindParam(":user_id", $order["user_id"]);
            $data->bindParam(":payment_method", $order["payment_method"]);
            $data->bindParam(":receiver_name", $order["receiver_name"]);
            $data->bindParam(":receiver_phone", $order["receiver_phone"]);
            $data->bindParam(":receiver_address", $order["receiver_address"]);
            $data->bindParam(":receiver_note", $order["receiver_note"]);
            $data->execute();

            // Get the ID of the last inserted order
            $orderId = $this->conn->lastInsertId();

            $sql_order_details = "INSERT INTO order_details (order_id, product_detail_id, quantity, price) values (:order_id, :product_detail_id, :quantity, :price)";
            $data_order_details = $this->conn->prepare($sql_order_details);
            $data_order_details->bindParam(":order_id", $orderId);
            $data_order_details->bindParam(":product_detail_id", $order_details["product_detail_id"]);
            $data_order_details->bindParam(":quantity", $order_details["quantity"]);
            $data_order_details->bindParam(":price", $order_details["price"]);
            $data_order_details->execute();

        }
    }
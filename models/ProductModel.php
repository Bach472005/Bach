<?php
    class ProductModel extends Connect{
        public function get_product(){
            $sql = "SELECT * FROM products";
            $data = $this->conn->prepare($sql);
            $data->execute();
            return $data->fetchAll(PDO::FETCH_ASSOC);
        }
    }
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
    }
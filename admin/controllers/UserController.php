<?php
    class UserController{
        public $userModel;
        public function __construct(){
            $this->userModel = new UserModel();
            session_start();
        }
        public function get_user(){
            $users = $this->userModel->get_user();

            require_once './views/User/List.php';
        }
        public function delete_user(){
            $id = $_GET['id'];
            $this->userModel->delete_user($id);
            return $this->get_user();
        }
        public function update_user_status(){
            $id = $_GET['id'];
            $status = $_GET['status'];
            $this->userModel->update_user_status($id, $status);
            return $this->get_user();
        }
        public function __destruct(){
            $this->userModel = null;
        }
    }
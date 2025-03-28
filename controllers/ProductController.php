<?php
    class ProductController{
        public $userModel;

        public $productModel;

        public function __construct(){
            $this->productModel = new ProductModel();
            $this->userModel = new UserModel();
            session_start();
        }

        public function home_view(){
            // $products = $this->productModel->get_product();
            require './views/HomePage.php';
        }

        
        public function __destruct(){
            $this->userModel = null;
        }
    }
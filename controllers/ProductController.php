<?php
    class ProductController{
        public $userModel;

        public $productModel;
        public $commentModel;

        public function __construct(){
            $this->productModel = new ProductModel();
            $this->userModel = new UserModel();
            $this->commentModel = new CommentModel();

            session_start();
        }

        public function home_view(){
            $_SESSION["products"] = $this->productModel->get_product();
            require './views/HomePage.php';
        }

        public function product_detail_view(){
            if(isset($_GET["product_id"])){
                $product_detail = $this->productModel->get_product_detail($_GET["product_id"]);
                $comments = $this->commentModel->get_comments($_GET["product_id"]);
                require_once './views/ProductDetail.php';
            }
        }
        public function post_comment(){
            if(isset($_GET["product_id"]) || isset($_SESSION["user"])){
                return 0;
            }
        }
        public function delete_comment(){
            if(isset($_GET["comment_id"])){
                $this->commentModel->delete_comment($_GET["comment_id"]);
                echo "<script>
                            alert('Xóa comment thành công!');
                            window.location.href = '" . BASE_URL . "?act=pd&product_id=" . $_GET["product_id"] . "';
                        </script>";
            }
        }
        public function __destruct(){
            $this->userModel = null;
            $this->productModel = null;
            $this->commentModel = null;
        }
    }
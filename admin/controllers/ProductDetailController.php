<?php 
    class ProductDetailController{
        public $productDetailModel;
        public function __construct(){
            $this->productDetailModel = new ProductDetailModel();
            session_start();
        }
        // Product components   
        public function product_detail_view($id = null) {
            $id = $_GET["id"] ?? $id;
            $products = $this->productDetailModel->get_product_detail($id);
            
            require "./views/Product/Product_detail/Components.php";
        }
        public function add_product_detail_view(){
            if(isset($_GET["id"])){
                $id = $_GET["id"];
                $sizes = $this->productDetailModel->get_table("sizes");
                $colors = $this->productDetailModel->get_table("colors");
            }
            require "./views/Product/Product_detail/Add.php";
        }
        public function add_product_detail(){
            if(isset($_GET["id"]) && $_POST["stock"] > 0){
                $product_id = $_GET["id"];

                $product_detail = [
                    "product_id" => $product_id,
                    "size_id" => $_POST["size_id"],
                    "color_id" => $_POST["color_id"],
                    "stock" => $_POST["stock"]
                ];
                $this->productDetailModel->add_product_detail($product_detail);
                echo "<script> alert('Add Success') </script>";
                return $this->product_detail_view();
            } else{
                echo "<script> alert('Stock > 0') </script>";
                return $this->add_product_detail_view();
            }
        }
        public function delete_product_detail() {
            if (isset($_GET["id"], $_GET["product_id"], $_GET["stock"])) {
                $id = $_GET["id"];
                $product_id = $_GET["product_id"];
                $stock = $_GET["stock"];
                
                $this->productDetailModel->delete_product_detail($id, $product_id, $stock);
        
                header("Location: ?act=product_detail_view&id=" . $product_id);
            }
        }
        public function update_product_detail_view(){
            if(isset($_GET["id"])){
                $product_detail_id = $_GET["id"];

                $product = $this->productDetailModel->get_table("product_detail",["id" =>  $product_detail_id]);
                $sizes = $this->productDetailModel->get_table("sizes");
                $colors = $this->productDetailModel->get_table("colors");

                require "./views/Product/Product_detail/Update.php";
            }
        }
        public function update_product_detail(){
            if(isset($_GET["id"])){
                $product_detail_id = $_GET["id"];
                $product_id = $_GET["product_id"];
                $new = [
                    "size_id" => $_POST["size_id"],
                    "color_id" => $_POST["color_id"],
                    "stock" => $_POST["stock"]
                ];
                $this->productDetailModel->update_product_detail($product_detail_id,$product_id,  $new);

                echo "<script> alert('Update Success') </script>";
                // return $this->product_detail_view($product_id);
                header("Location: ?act=product_detail_view&id=" . $product_id);
                exit;
            }
            return null;
        }
    } 
?>
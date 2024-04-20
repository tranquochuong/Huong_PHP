<?php 

$filepath = realpath(dirname(__FILE__));

include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');

    class cart
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this -> db = new Database();
            $this -> fm = new Format();
        }

        public function addToCart($quantity, $id) {
            $quantity = $this -> fm -> validation($quantity);
            $quantity = mysqli_real_escape_string($this -> db -> link, $quantity);
            $id = mysqli_real_escape_string($this -> db -> link, $id);
            $sId = session_id();

            $query = "SELECT * FROM tbl_product WHERE productId ='$id' ";
            $result = $this -> db -> select($query) -> fetch_assoc(); 
            $productName = $result['productName'];
            $price = $result['price'];
            $image = $result['image'];

            $query_insertCart = "INSERT INTO tbl_cart(productId, sId, productName, price, quantity, image ) VALUES('$id','$sId','$productName','$price','$quantity','$image')";
            $result = $this->db->insert(($query_insertCart));

            if($result) {
                header('Location:cart.php');
            }else {
                header('Location:404.php');
            }
        }

        public function get_product_cart() {
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $result = $this -> db -> select($query);
            return $result;
        }
    }
?>
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

            $query = "SELECT * FROM tbl_product WHERE productId ='$id'";
            $result = $this -> db -> select($query) -> fetch_assoc();

            $productName = $result['productName'];
            $price = $result['price'];
            $image = $result['image'];

            // $checkcart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sId = '$sId'";
            // if($checkcart) {
            //     $msg = "Sản phẩm đã tồn tại trong giỏ hàng!";
            //     return $msg;
            // }else {
                $query_insertCart = "INSERT INTO tbl_cart(productId, sId, productName, price, quantity, image ) VALUES('$id','$sId','$productName','$price','$quantity','$image')";
                $insertCart = $this->db->insert(($query_insertCart));

                if($insertCart) {
                    header('Location:cart.php');
                }else {
                    header('Location:404.php');
                }
            // }
        }

        public function get_product_cart() {
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $result = $this -> db -> select($query);
            return $result;
        }

        public function update_quantity_cart($quantity, $cartId) {
            $quantity = mysqli_real_escape_string($this -> db -> link, $quantity);
            $cartId = mysqli_real_escape_string($this -> db -> link, $cartId);
            $query = "UPDATE tbl_cart SET  quantity ='$quantity' WHERE cartId = '$cartId'";
            $result  = $this ->db ->update($query);

            if($result) {
                header('Location:cart.php');
            }else {
                $msg = "<span class='danger'>Cập nhật số lượng Không thành công!</span>";
                return $msg;
            }
        }

        public function del_Cart($cartId) {
            $cartId = mysqli_real_escape_string($this -> db -> link, $cartId);
            
            $query = "DELETE FROM tbl_cart WHERE cartId = '$cartId'";
            $result = $this->db->delete(($query));
            
            if($result) {
                header('Location:cart.php');
            }else {
                $alert = "<span class='danger'>Xoá không thành công!</span>";
                return $alert;
            }
        }

        public function check_item_cart() {
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $result = $this -> db -> select($query);
            return $result;
        }
    }
?>
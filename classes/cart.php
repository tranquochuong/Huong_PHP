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

            $checkcart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sId = '$sId'";
            $result_cart = $this -> db -> select($checkcart);
            if($result_cart) {
                $msg = "Sản phẩm đã tồn tại trong giỏ hàng!";
                return $msg;
            }else {
                $query_insertCart = "INSERT INTO tbl_cart(productId, sId, productName, price, quantity, image ) VALUES('$id','$sId','$productName','$price','$quantity','$image')";
                $insertCart = $this->db->insert(($query_insertCart));

                if($insertCart) {
                    header('Location:cart.php');
                }else {
                    header('Location:404.php');
                }
            }
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

        public function dell_all_cart() {
            $sId = session_id();
            $query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
            $result = $this -> db -> delete($query);
            return $result;
        }

        public function insertOrder($customer_id) {
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $get_product = $this -> db -> select($query);

            if($get_product) {
                while($result = $get_product ->fetch_assoc()){
                    $productId = $result['productId'];
                    $productName =$result['productName'];
                    $quantity =$result['quantity'];
                    $price = $result['price'] * $quantity;
                    $image =$result['image'];
                    $customer_id = $customer_id;

                $query_insertOrder= "INSERT INTO tbl_order(productId, productName, customer_id, quantity, price, image) 
                                     VALUES('$productId','$productName','$customer_id','$quantity','$price','$image')";
                $insertOrder = $this->db->insert(($query_insertOrder));
                }
            }
        }

        public function getAmountprice($customer_id) {
            $query = "SELECT * FROM tbl_order WHERE customer_Id = '$customer_id'";
            $result = $this -> db -> select($query);
            return $result;
        }

        public function get__cart_ordered($customer_id) {
            $query = "SELECT * FROM tbl_order WHERE customer_Id = '$customer_id'";
            $result = $this -> db -> select($query);
            return $result;
        }

        public function check_order($customer_id) {
            $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
            $result = $this -> db -> select($query);
            return $result;
        }

        public function getInboxCart(){
            $query = "SELECT * FROM tbl_order ORDER BY date_order";
            $result = $this -> db -> select($query);
            return $result;
        }

        public function statusOrder($id,$time,$price){
            $id = mysqli_real_escape_string($this -> db -> link, $id);
            $time = mysqli_real_escape_string($this -> db -> link, $time);
            $price = mysqli_real_escape_string($this -> db -> link, $price);

            $query = "UPDATE tbl_order SET status = '1' WHERE id = '$id' AND date_order = '$time' AND price ='$price'";
            $result  = $this ->db ->update($query);

            if($result) {
                $msg = "<span class='success'>Đơn hàng đã xử lý!</span>";
                return $msg;
            }else {
                $msg = "<span class='danger'>Đơn hàng đang xử lý!</span>";
                return $msg;
            }
        }

        public function delOrder($id,$time,$price) {
            $id = mysqli_real_escape_string($this -> db -> link, $id);
            $time = mysqli_real_escape_string($this -> db -> link, $time);
            $price = mysqli_real_escape_string($this -> db -> link, $price);

            $query = "DELETE FROM tbl_order WHERE id = '$id' AND date_order = '$time' AND price ='$price'";
            $result = $this -> db -> delete($query);
            return $result;

            if($result) {
                $msg = "<span class='success'>Đơn hàng đã xoá thành công!</span>";
                return $msg;
            }else {
                $msg = "<span class='danger'>Đơn chưa được xoá thành công!</span>";
                return $msg;
            }
        }

        public function confirmCustomer($id,$time,$price) {
            $id = mysqli_real_escape_string($this -> db -> link, $id);
            $time = mysqli_real_escape_string($this -> db -> link, $time);
            $price = mysqli_real_escape_string($this -> db -> link, $price);

            $query = "UPDATE tbl_order SET status = '2' WHERE customer_Id = '$id' AND date_order = '$time' AND price ='$price'";
            $result  = $this ->db ->update($query);
            return $result;

            if($result) {
                $msg = "<span class='success'>Nhận hàng thành công!</span>";
                return $msg;
            }else {
                $msg = "<span class='danger'>Nhận hàng không thành công!</span>";
                return $msg;
            }
        }
    }
?>
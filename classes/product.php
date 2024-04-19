<?php 

include_once '../lib/database.php';
include_once '../helpers/format.php';


    class product
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this -> db = new Database();
            $this -> fm = new Format();
        }

        public function insert_Product($data, $files) {

            $productName = mysqli_real_escape_string($this -> db -> link, $data['productName']);
            $category = mysqli_real_escape_string($this -> db -> link, $data['category']);
            $brand = mysqli_real_escape_string($this -> db -> link, $data['brand']);
            $productdesc = mysqli_real_escape_string($this -> db -> link, $data['productdesc']);
            $price = mysqli_real_escape_string($this -> db -> link, $data['price']);
            $type = mysqli_real_escape_string($this -> db -> link, $data['type']);

            // Kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
            $permited = array('jpg','jpeg','png','gif');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];

                $div = explode('.',$file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                $uploaded_image = "uploads/".$unique_image;


            if($productName=="" || $category=="" || $brand=="" || $productdesc=="" || $price=="" || $type=="" || $file_name =="") {
                $alert = "<span class='danger'>Các trường không được rỗng</span>";
                return $alert;
            }else 
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_product(productName, catId, brandId, productdesc, price, type, image) VALUES('$productName','$category','$brand','$productdesc','$price','$type','$unique_image') ";
                $result = $this->db->insert(($query));

                if($result) {
                    $alert = "<span class='success'>Thêm sản phẩm thành công</span>";
                    return $alert;
                }else {
                    $alert = "<span class='danger'>Thêm sản phẩm không thành công</span>";
                    return $alert;
                }
            }

    //     public function getproductbyId($id) {
    //         $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
    //         $result = $this->db->select(($query));
    //         return $result;
    //     }

    //     public function edit_Product($productName, $id) {
    //         $productName = $this->fm -> validation($productName);
    //         $productName = mysqli_real_escape_string($this -> db -> link, $productName);

    //         $id = mysqli_real_escape_string($this -> db -> link, $id);

    //         if(empty($productName)) {
    //             $alert = "<span class='danger'>Vui lòng nhập sản phẩm</span>";
    //             return $alert;
    //         }else {
    //             $query = "UPDATE tbl_product SET productName = '$productName' WHERE productId = '$id'";
    //             $result = $this->db->update(($query));

    //             if($result) {
    //                 $alert = "<span class='success'>Sửa sản phẩm thành công</span>";
    //                 return $alert;
    //             }else {
    //                 $alert = "<span class='danger'>Sửa sản phẩm không thành công</span>";
    //                 return $alert;
    //             }
    //         }
    //     }

    //     public function del_Product($id) {
            
    //         $query = "DELETE FROM tbl_product WHERE productId = '$id'";
    //         $result = $this->db->delete(($query));

    //         if($result) {
    //             $alert = "<span class='success'>Xoá thành công!</span>";
    //             return $alert;
    //         }else {
    //             $alert = "<span class='danger'>Xoá không thành công!</span>";
    //             return $alert;
    //         }
    //     }

        public function showProduct() {
                $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
                FROM tbl_product
                INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 
                INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId 
                order by tbl_product.productId desc";
                $result = $this->db->select(($query));
                return $result;
            }
        }
?>
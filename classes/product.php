<?php

$filepath = realpath(dirname(__FILE__));

include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');


class product
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_Product($data, $files)
    {

        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $productdesc = mysqli_real_escape_string($this->db->link, $data['productdesc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        // Kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;


        if ($productName == "" || $category == "" || $brand == "" || $productdesc == "" || $price == "" || $type == "" || $file_name == "") {
            $alert = "<span class='danger'>Các trường không được rỗng</span>";
            return $alert;
        } else
            move_uploaded_file($file_temp, $uploaded_image);
        $query = "INSERT INTO tbl_product(productName, catId, brandId, productdesc, price, type, image) VALUES('$productName','$category','$brand','$productdesc','$price','$type','$unique_image') ";
        $result = $this->db->insert(($query));

        if ($result) {
            $alert = "<span class='success'>Thêm sản phẩm thành công</span>";
            return $alert;
        } else {
            $alert = "<span class='danger'>Thêm sản phẩm không thành công</span>";
            return $alert;
        }
    }

    public function getproductbyId($id)
    {
        $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->select(($query));
        return $result;
    }

    public function edit_Product($data, $files, $id)
    {
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $productdesc = mysqli_real_escape_string($this->db->link, $data['productdesc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        // Kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div)); // lấy phần đuôi;
        // $file_current = strtolower(current($div)); Lấy phần đầu;
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;


        if ($productName == "" || $category == "" || $brand == "" || $productdesc == "" || $price == "" || $type == "") {
            $alert = "<span class='danger'>Các trường không được rỗng</span>";
            return $alert;
        } else {
            if (!empty($file_name)) {
                // Người dùng đổi ảnh
                if ($file_size > 2048) {
                    $alert = "<span class='danger'>Kích thước ảnh phải nhỏ hơn 2MB</span>";
                    return $alert;
                } elseif (is_array($file_ext, $permited) == false) {
                    $alert = "<span class='danger'> Bạn chỉ có thể tải ảnh theo định dạng: -" . implode(',', $permited) . "</span>";
                    return $alert;
                }

                $query = "UPDATE tbl_product SET 
                    productName = '$productName',
                    catId = '$category',     
                    brandId = '$brand',
                    productdesc = '$productdesc',
                    price = '$price',
                    image = '$unique_image',
                    type = '$type' 
                    WHERE productId = '$id'";
            } else {
                // Người dùng không đổi ảnh
                $query = "UPDATE tbl_product SET 
                    productName = '$productName',
                    catId = '$category',     
                    brandId = '$brand',
                    productdesc = '$productdesc',
                    price = '$price',
                    type = '$type'
                    WHERE productId = '$id' ";
            }

            $result = $this->db->update(($query));
            if ($result) {
                $alert = "<span class='success'> Sửa sản phẩm thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='danger'>Sửa sản phẩm không thành công</span>";
                return $alert;
            }
        }
    }


    public function del_Product($id)
    {

        $query = "DELETE FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->delete(($query));

        if ($result) {
            $alert = "<span class='success'>Xoá thành công!</span>";
            return $alert;
        } else {
            $alert = "<span class='danger'>Xoá không thành công!</span>";
            return $alert;
        }
    }

    public function showProduct()
    {
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
                FROM tbl_product
                INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 
                INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId 
                order by tbl_product.productId desc";
        $result = $this->db->select(($query));
        return $result;
    }

    /// ------------------------------  ENd backend----------------------


    /// ------------------------------  Start frontend ----------------------

    public function getproduct_feathered()
    {
        $query = "SELECT * FROM tbl_product WHERE type = '1'";
        $result = $this->db->select(($query));
        return $result;
    }

    public function getproduct_new()
    {
        $query = "SELECT * FROM tbl_product order by productId desc limit 4";
        $result = $this->db->select(($query));
        return $result;
    }

    public function getdetails($id)
    {
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
        FROM tbl_product
        INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 
        INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId WHERE tbl_product.productId = '$id'";
        $result = $this->db->select(($query));
        return $result;
    }

    public function get_last_dell()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId='2' order by productId desc LIMIT 1";
        $result = $this->db->select(($query));
        return $result;
    }
    public function get_last_hp()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId='1' order by productId desc LIMIT 1";
        $result = $this->db->select(($query));
        return $result;
    }
    public function get_last_iphone()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId='5' order by productId desc LIMIT 1";
        $result = $this->db->select(($query));
        return $result;
    }
    public function get_last_samsung()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId='6' order by productId desc LIMIT 1";
        $result = $this->db->select(($query));
        return $result;
    }

    public function insertCompare($productid, $customer_id)
    {
        $productid = mysqli_real_escape_string($this->db->link, $productid);
        $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

        $checkcompare = "SELECT * FROM tbl_compare WHERE productId = '$productid' AND customer_Id = '$customer_id'";
        $result_compare = $this ->db ->select($checkcompare);
        if ($result_compare) {
            $msg = "<span class='danger'>Sản phẩm đã được thêm vào so sánh!</span>";
            return $msg;
        } else {
            $query = "SELECT * FROM tbl_product WHERE productId ='$productid'";
            $result = $this->db->select($query)->fetch_assoc();

            $productName = $result['productName'];
            $price = $result['price'];
            $image = $result['image'];

            $query_insertCompare = "INSERT INTO tbl_compare(customer_Id, productId, productName, price,  image ) VALUES('$customer_id','$productid','$productName','$price','$image')";
            $insertCompare = $this->db->insert(($query_insertCompare));

            if ($insertCompare) {
                $alert = "<span class='success'>Thêm vào so sánh thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='danger'>Thêm vào so sánh không thành công</span>";
                return $alert;
            }
        }
    }
}

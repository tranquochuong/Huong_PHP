<?php

$filepath = realpath(dirname(__FILE__));

include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');


class slider
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_Slider($data, $files)
    {
        $sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        // Kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['sliderImage']['name'];
        $file_size = $_FILES['sliderImage']['size'];
        $file_temp = $_FILES['sliderImage']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;


        if ($sliderName == "" || $file_name == "" || $type == "") {
            $alert = "<span class='danger'>Các trường không được rỗng</span>";
            return $alert;
        } else
            move_uploaded_file($file_temp, $uploaded_image);
        $query = "INSERT INTO tbl_slider(sliderName, sliderImage, type) VALUES('$sliderName','$unique_image','$type') ";
        $result = $this->db->insert(($query));

        if ($result) {
            $alert = "<span class='success'>Thêm slider thành công</span>";
            return $alert;
        } else {
            $alert = "<span class='danger'>Thêm slider không thành công</span>";
            return $alert;
        }
    }

    public function getsliderbyId($id)
    {
        $query = "SELECT * FROM tbl_slider WHERE sliderId = '$id'";
        $result = $this->db->select(($query));
        return $result;
    }

    public function showSlider() {
        $query = "SELECT * FROM tbl_slider order by sliderId desc";
        $result = $this->db->select(($query));
        return $result;
    }

            // --------Front End ---------------
    public function showAllSlider() {
        $query = "SELECT sliderImage FROM tbl_slider WHERE type ='1' order by sliderId desc";
        $result = $this->db->select(($query));
        return $result;
    }

    public function del_Slider($id)
    {

        $query = "DELETE FROM tbl_slider WHERE sliderId = '$id'";
        $result = $this->db->delete(($query));

        if ($result) {
            $alert = "<span class='success'>Xoá Slider thành công!</span>";
            return $alert;
        } else {
            $alert = "<span class='danger'>Xoá Slider không thành công!</span>";
            return $alert;
        }
    }

    
    public function updateType($id,$type) {
        $type = mysqli_real_escape_string($this->db->link, $type);
        $query = "UPDATE tbl_slider SET type ='$type' WHERE sliderId = '$id'";
        $result  = $this ->db ->update($query);

        if($result) {
            $msg = "<span class='success'>Cập nhật type thành công!</span>";
            return $msg;
        }else {
            $msg = "<span class='danger'>Cập nhật type Không thành công!</span>";
            return $msg;
        }
    }

}

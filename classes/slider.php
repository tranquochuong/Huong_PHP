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

    public function getproductbyId($id)
    {
        $query = "SELECT * FROM tbl_slider WHERE id = '$id'";
        $result = $this->db->select(($query));
        return $result;
    }
}

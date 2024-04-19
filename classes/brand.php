<?php 

include_once '../lib/database.php';
include_once '../helpers/format.php';


    class brand
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this -> db = new Database();
            $this -> fm = new Format();
        }

        public function insert_Brand($brandName) {
            $brandName = $this->fm -> validation($brandName);

            $brandName = mysqli_real_escape_string($this -> db -> link, $brandName);

            if(empty($brandName)) {
                $alert = "<span class='danger'>Vui lòng nhập thương hiệu</span>";
                return $alert;
            }else {
                $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName') ";
                $result = $this->db->insert(($query));

                if($result) {
                    $alert = "<span class='success'>Thêm thương hiệu thành công</span>";
                    return $alert;
                }else {
                    $alert = "<span class='danger'>Thêm thương hiệu không thành công</span>";
                    return $alert;
                }
            }
        }

        public function getbrandbyId($id) {
            $query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
            $result = $this->db->select(($query));
            return $result;
        }

        public function edit_Brand($brandName, $id) {
            $brandName = $this->fm -> validation($brandName);
            $brandName = mysqli_real_escape_string($this -> db -> link, $brandName);

            $id = mysqli_real_escape_string($this -> db -> link, $id);

            if(empty($brandName)) {
                $alert = "<span class='danger'>Vui lòng nhập thương hiệu</span>";
                return $alert;
            }else {
                $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$id'";
                $result = $this->db->update(($query));

                if($result) {
                    $alert = "<span class='success'>Sửa thương hiệu thành công</span>";
                    return $alert;
                }else {
                    $alert = "<span class='danger'>Sửa thương hiệu không thành công</span>";
                    return $alert;
                }
            }
        }

        public function del_Brand($id) {
            
            $query = "DELETE FROM tbl_brand WHERE brandId = '$id'";
            $result = $this->db->delete(($query));

            if($result) {
                $alert = "<span class='success'>Xoá thành công!</span>";
                return $alert;
            }else {
                $alert = "<span class='danger'>Xoá không thành công!</span>";
                return $alert;
            }
        }

        public function showBrand() {
                $query = "SELECT * FROM tbl_brand order by brandId desc";
                $result = $this->db->select(($query));
                return $result;
            }
    }
?>
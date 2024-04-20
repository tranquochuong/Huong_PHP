<?php 

$filepath = realpath(dirname(__FILE__));

include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');

    class category
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this -> db = new Database();
            $this -> fm = new Format();
        }

        public function insert_Category($catName) {
            $catName = $this->fm -> validation($catName);

            $catName = mysqli_real_escape_string($this -> db -> link, $catName);

            if(empty($catName)) {
                $alert = "<span class='danger'>Vui lòng nhập danh mục</span>";
                return $alert;
            }else {
                $query = "INSERT INTO tbl_category(catName) VALUES('$catName') ";
                $result = $this->db->insert(($query));

                if($result) {
                    $alert = "<span class='success'>Thêm danh mục thành công</span>";
                    return $alert;
                }else {
                    $alert = "<span class='danger'>Thêm danh mục không thành công</span>";
                    return $alert;
                }
            }
        }

        public function getcatbyId($id) {
            $query = "SELECT * FROM tbl_category WHERE catId = '$id'";
            $result = $this->db->select(($query));
            return $result;
        }

        public function edit_Category($catName, $id) {
            $catName = $this->fm -> validation($catName);
            $catName = mysqli_real_escape_string($this -> db -> link, $catName);

            $id = mysqli_real_escape_string($this -> db -> link, $id);

            if(empty($catName)) {
                $alert = "<span class='danger'>Vui lòng nhập danh mục</span>";
                return $alert;
            }else {
                $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id'";
                $result = $this->db->update(($query));

                if($result) {
                    $alert = "<span class='success'>Sửa danh mục thành công</span>";
                    return $alert;
                }else {
                    $alert = "<span class='danger'>Sửa danh mục không thành công</span>";
                    return $alert;
                }
            }
        }

        public function del_Category($id) {
            
            $query = "DELETE FROM tbl_category WHERE catId = '$id'";
            $result = $this->db->delete(($query));

            if($result) {
                $alert = "<span class='success'>Xoá thành công!</span>";
                return $alert;
            }else {
                $alert = "<span class='danger'>Xoá không thành công!</span>";
                return $alert;
            }
        }

        public function showCat() {
                $query = "SELECT * FROM tbl_category order by catId desc";
                $result = $this->db->select(($query));
                return $result;
            }
    }
?>
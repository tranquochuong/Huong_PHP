<?php

$filepath = realpath(dirname(__FILE__));

include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');

class customer
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_Customer($data) {

        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if ($name == "" || $address == "" || $city == "" || $country == "" || $zipcode == "" || $phone == "" || $email == "" || $password == "") {
            $alert = "<span class='danger'>Các trường không được rỗng</span>";
            return $alert;
        } else {
            $check_mail = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
            $result_check = $this->db->select($check_mail);
            if ($result_check) {
                $alert = "<span class= danger>Email đã tồn tại. Vui lòng chọn email khác !!</span>";
                return $alert;
            } else {
                $query = "INSERT INTO tbl_customer(name, address, city, country, zipcode, phone, email, password)
                          VALUES('$name','$address','$city','$country', '$zipcode', '$phone', '$email', '$password')";
                $result = $this->db->insert(($query));

                if ($result) {
                    $alert = "<span class='success'>Thêm khách hàng thành công</span>";
                    return $alert;
                } else {
                    $alert = "<span class='danger'>Thêm khách hàng không thành công</span>";
                    return $alert;
                }
            }
        }
    } 

    public function login_Customer($data) {
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if ($email == ''|| $password == '') {
            $alert = "<span class='danger'>Email và Mật khẩu không được để trống!!</span>";
            return $alert;
        } else {
            $check_login = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password'";
            $result_check = $this->db->select($check_login);
            if ($result_check != false) {
                $value = $result_check -> fetch_assoc();
                Session::set('customer_login', true);
                Session::set('customer_id', $value['id']);
                Session::set('customer_name', $value['name']);
                header('Location:order.php');
            } else {
                $alert = "<span class= danger>Email hoặc mật khẩu không đúng!!</span>";
                return $alert;
            }
        }
    }

    public function show_customer($id) {
        $query = "SELECT * FROM tbl_customer WHERE id = '$id'";
        $result= $this->db->select($query);
        return $result;
    }
}

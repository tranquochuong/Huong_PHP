<?php
include_once 'include/header.php';
?>
<?php
$check_login = Session::get('customer_login');
if ($check_login == false) {
    header('Location:login.php');
}
?>
<?php
// if (!isset($_GET['proId']) || $_GET['proId'] == NULL) {
// 	echo "<script>window.location = '404.php' </script>";
// } else {
// 	$id = $_GET['proId'];
// }

// if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
// 	$quantity = $_POST['quantity'];
// 	$addToCart = $cart ->addToCart($quantity,$id);
// }
?>

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3> Thông tin tài khoản</h3>
                    </h3>
                </div>
                <div class="clear"></div>
            </div>
            <table style="border: 1px solid black" class="tblone">
                <?php
                $id = Session::get('customer_id');
                $get_customer = $customer -> show_customer($id);
                if($get_customer) {
                    while($result_customer = $get_customer ->fetch_assoc()){
                ?>
                <tr>
                    <td colspan="2"><a href="editprofile.php">Sửa</a></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Name</td>
                    <td><?php echo $result_customer['name']?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Địa chỉ</td>
                    <td><?php echo $result_customer['address']?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Thành Phố</td>
                    <td><?php echo $result_customer['city']?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Đất nước</td>
                    <td><?php echo $result_customer['country']?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Zipcode</td>
                    <td><?php echo $result_customer['zipcode']?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Số điện thoại</td>
                    <td><?php echo $result_customer['phone']?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Email</td>
                    <td><?php echo $result_customer['email']?></td>
                </tr>
                <?php
                        }
                    }
                ?>
            </table>
        </div>
    </div>
</div>

<?php
include_once 'include/footer.php';
?>
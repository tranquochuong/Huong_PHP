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
$id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
    $edit_customer = $customer->edit_customer($_POST, $id);
}
?>

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3> Sửa thông tin tài khoản</h3>
                    </h3>
                </div>
                <div class="clear"></div>
            </div>
            <form action="" method="post">
                <table style="border: 1px solid black" class="tblone">
                <?php 
                    if(isset($edit_customer)) {
                        echo $edit_customer;
                    }
                ?>
                    <?php
                    $id = Session::get('customer_id');
                    $get_customer = $customer->show_customer($id);
                    if ($get_customer) {
                        while ($result_customer = $get_customer->fetch_assoc()) {
                    ?>
                            <tr>
                                <td style="font-weight: bold;">Name</td>
                                <td>
                                    <input type="text" name="name" value="<?php echo $result_customer['name'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Địa chỉ</td>
                                <td>
                                    <input type="text" name="address" value="<?php echo $result_customer['address'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Zipcode</td>
                                <td>
                                    <input type="text" name="zipcode" value="<?php echo $result_customer['zipcode'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Số điện thoại</td>
                                <td>
                                    <input type="text" name="phone" value="<?php echo $result_customer['phone'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Email</td>
                                <td>
                                    <input type="text" name="email" value="<?php echo $result_customer['email'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" name="save" value="Lưu" class="grey"></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
            </form>
        </div>
    </div>
</div>

<?php
include_once 'include/footer.php';
?>
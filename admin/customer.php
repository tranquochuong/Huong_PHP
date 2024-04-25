<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/customer.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
$customer = new customer();

if (!isset($_GET['customerid']) || $_GET['customerid'] == NULL) {
    echo "<script>window.location = 'inbox.php' </script>";
} else {
    $id = $_GET['customerid'];
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thông tin</h2>

        <div style="width:auto;margin:50px;padding:30px;border:1px solid #ddd;text-align: center;">
            <?php
            $get_customer = $customer->show_customer($id);
            if ($get_customer) {
                while ($result = $get_customer->fetch_assoc()) {
            ?>
                    <form action="" method="post">
                        <table class="form">
                            <tr>
                                <td style="font-weight: 700;font-size: 20px;">Họ và Tên</td>
                                <td>:</td>
                                <td style="font-size: 16px;"><?php echo $result['name'] ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: 700;font-size: 20px;">Số điện thoại</td>
                                <td>:</td>
                                <td style="font-size: 16px;"><?php echo $result['phone'] ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: 700;font-size: 20px;">Địa chỉ</td>
                                <td>:</td>
                                <td  style="font-size: 16px;"><?php echo $result['address'] ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: 700;font-size: 20px;">Thành phố</td>
                                <td>:</td>
                                <td  style="font-size: 16px;"><?php echo $result['city'] ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: 700;font-size: 20px;">Đất nước</td>
                                <td>:</td>
                                <td  style="font-size: 16px;"><?php echo $result['country'] ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: 700;font-size: 20px;">Zipcode</td>
                                <td>:</td>
                                <td  style="font-size: 16px;"><?php echo $result['zipcode'] ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: 700;font-size: 20px;">Email</td>
                                <td>:</td>
                                <td  style="font-size: 16px;"><?php echo $result['email'] ?></td>
                            </tr>
                        </table>
                    </form>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>
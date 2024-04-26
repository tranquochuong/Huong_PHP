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
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $customer_id = Session::get('customer_id');
    $insertOrder = $cart->insertOrder('customer_id');
    $delCart = $cart->dell_all_cart();
    header('Location:success.php');
}
?>

<form action="" method="POST">
    <div class="main">
        <div class="content">
            <div class="section group">
                <h2 style="color:green;font-size: 40px;font-weight:700;text-align:center;">Đặt hàng thành công!!</h2>
                <?php
                $customer_id = Session::get('customer_id');
                $get_amount = $cart->getAmountprice($customer_id);
                if ($get_amount) {
                    $amount = 0;
                    while ($result = $get_amount->fetch_assoc()) {
                        $price = $result['price'];
                        $amount += $price;
                    }
                }
                ?>
                    <div style="background-color: antiquewhite;border:1px solid red;text-align:center;padding: 20px;">
                        <p style="font-weight: bold;font-size: 20px;">Tổng tiền bàn đã mua: <?php echo $fm->format_currency($total = $amount * 0.1 + $amount).' '.'VNĐ' ?> </p><br>
                        <p >Chúng tôi sẽ liên lạc sớm nhất có thể. Vui lòng check lại đơn hàng của bạn <a style="font-style: italic;color:blue;text-decoration: underline;" href="orderdetails.php">tại đây</a></p>
                    </div>
            </div>
        </div>
</form>

<?php
include_once 'include/footer.php';
?>
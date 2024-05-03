<?php
include_once 'include/header.php';
?>
<?php
$check_login = Session::get('customer_login');
if ($check_login == false) {
    header('Location:login.php');
}
?>

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Trang thanh toán</h3>
                    </h3>
                </div>
                <div class="clear"></div>
                <div class="wrapper wrapper_custorm">
                    <h3 class="payment">Chọn phương thức thanh toán</h3>
                    <p>                    
                        <a class="payment_href" href="cash_pay.php">Tiền mặt</a>
                        <a class="payment_href" href="donhangthanhtoanonline.php">Thanh toán Online</a>
                    </p>
                    <div class="clear"></div>
                    <span>
                        <a class="btn-back" href="cart.php">Quay lại</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'include/footer.php';
?>
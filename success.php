<?php
include_once 'include/header.php';
?>

<?php
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
	$customer_id = Session::get('customer_id');
    $insertOrder = $cart -> insertOrder('customer_id');
    $delCart = $cart -> dell_all_cart();
    header('Location:success.php');
} 
?>

<form action="" method="POST">
<div class="main">
    <div class="content">
        <div class="section group">
            <h2 style="color:green;font-size: 40px;font-weight:700;text-align:center;">Đặt hàng thành công!!</h2>
        </div>
    </div>
</form>

<?php
include_once 'include/footer.php';
?>
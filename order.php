<?php
include_once 'include/header.php';
// include_once 'include/slider.php';
?>
<?php
$check_login = Session::get('customer_login');
if ($check_login == false) {
    header('Location:login.php');
}
?>
<style>
    .not_found {
        display: inline;
        font-size: 7vw !important;
        color: red !important;
        font-weight: 600 !important;
    }
</style>

<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <div>
                    <h2 class="not_found">Trang đặt hàng</h2>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php
include_once 'include/footer.php';
?>
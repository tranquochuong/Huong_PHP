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
<?php
if (isset($_GET['cartid'])) {
    $cartId = $_GET['cartid'];
    $delCart = $cart->del_Cart($cartId);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $cartId = $_POST['cartId'];
    $quantity = $_POST['quantity'];
    $update_quantity = $cart->update_quantity_cart($quantity, $cartId);
    if ($quantity = 0) {
        $delCart = $cart->del_Cart($cartId);
    }
}
?>
<?php
// if(!isset($_GET['id'])) {
// 	echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
// }
?>

<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2 style="font-size: 50px; color:lightblue;display:inline;">Thanh toán Online</h2><br>
                <?php
                if (isset($update_quantity)) {
                    echo $update_quantity;
                }

                if (isset($delCart)) {
                    echo $delCart;
                }
                ?>
                <table class="tblone">
                    <tr>
                        <th width="20%">Product Name</th>
                        <th width="10%">Image</th>
                        <th width="15%">Price</th>
                        <th width="25%">Quantity</th>
                        <th width="20%">Total Price</th>
                        <th width="10%">Action</th>
                    </tr>
                    <?php
                    $get_product_cart = $cart->get_product_cart();
                    if ($get_product_cart) {
                        $subtotal = 0;
                        $qty = 0;
                        while ($result_product_cart = $get_product_cart->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo $result_product_cart['productName'] ?></td>
                                <td><img src="admin/uploads/<?php echo $result_product_cart['image'] ?>" alt="" /></td>
                                <td><?php echo $fm->format_currency($result_product_cart['price']) . " " . "VNĐ " ?></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="cartId" min='0' value="<?php echo $result_product_cart['cartId'] ?>" />
                                        <input type="number" name="quantity" value="<?php echo $result_product_cart['quantity'] ?>" />
                                        <input type="submit" name="submit" value="Update" />
                                    </form>
                                </td>
                                <td>
                                    <?php
                                    $total = $result_product_cart['price'] * $result_product_cart['quantity'];
                                    echo $fm->format_currency($total) . " " . "VNĐ";
                                    ?>
                                </td>
                                <td><a onclick="return confirm('Bạn có muốn xoá không?')" href="?cartid=<?php echo $result_product_cart['cartId'] ?>">X</a></td>
                            </tr>
                    <?php
                            $subtotal += $total;
                            $qty = $qty + $result_product_cart['quantity'];
                        }
                    }
                    ?>
                </table>
                <?php
                if ($check_item_card) {
                ?>
                    <table style="float:right;text-align:left;" width="40%">
                        <tr>
                            <th>Sub Total : </th>
                            <td><?php
                                echo $fm->format_currency($subtotal) . " " . "VNĐ";
                                Session::set('sum', $subtotal);
                                Session::set('qty', $qty);
                                ?></td>
                        </tr>
                        <tr>
                            <th>VAT (10%): </th>
                            <td><?php
                                $vat = $subtotal * 0.1;
                                echo $fm->format_currency($vat) . " " . "VNĐ" ?></td>
                        </tr>
                        <tr>
                            <th>Grand Total :</th>
                            <td><?php
                                $gtotal = $subtotal + $vat;
                                echo $fm->format_currency($gtotal) . " " . "VNĐ" ?></td>
                        </tr>
                    </table>
                <?php
                } else {
                    echo '<span class="danger">Giỏ hàng của bạn hiện giờ đang trống!! Vui lòng chọn sản phẩm!!</span>';
                } ?>
            </div>

            <?php
            $check_cart = $cart->check_item_cart();
            if (Session::get('customer_id') == true && $check_cart) {
            ?>
                <center>
                    <form action="payment_gateways_vnpay.php" method="POST">
                        <input type="hidden" name="total_congthanhtoan" value="<?php echo $gtotal ?>">
                        <button class="btn btn-success" onclick="pay()">Thanh toán bằng VNPAY</button>
                    </form>
                </center>
                <p></p>
                <center>
                    <form action="payment_gateways_momo.php" method="POST">
                        <input type="hidden" name="total_congthanhtoan" value="<?php echo $gtotal ?>">
                        <button class="btn btn-success" name="captureWallet">Thanh toán QR MOMO</button>
                    </form>
                </center>
                <p></p>
                <center>
                    <form action="payment_gateways_momo.php" method="POST">
                        <input type="hidden" name="total_congthanhtoan" value="<?php echo $gtotal ?>">
                        <button class="btn btn-success" name="payWithATM">Thanh toán ATM MOMO</button>
                    </form>
                </center>
                <p></p>
                <center>
                    <form action="payment_gateways_onepay.php" method="POST">
                        <input type="hidden" name="total_congthanhtoan" value="<?php echo $gtotal ?>">
                        <button class="btn btn-success">Thanh toán ONEPAY</button>
                    </form>
                </center>
            <?php
            } else {
            ?>
                <p class="btn btn-thanhtoan">
                    <a href="cart.php">Quay về giỏ hàng</a>
                </p>
            <?php
            }
            ?>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php
include_once 'include/footer.php';
?>
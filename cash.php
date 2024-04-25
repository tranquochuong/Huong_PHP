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
    $insertOrder = $cart -> insertOrder($customer_id);
    $delCart = $cart -> dell_all_cart();
    header('Location:success.php');
} 
?>

<form action="" method="POST">
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="heading">
                <h3>Thanh toán tiền mặt</h3>
            </div>
            <div class="clear"></div>
            <div class="content-payment">
                <div class="box-left">
                    <div class="cartpage">
                        <h3 style="font-size: 50px; color:lightblue;display:inline;">Giỏ hàng của bạn</h3>
                        <?php
                        if (isset($update_quantity)) {
                            echo $update_quantity;
                        }

                        if (isset($delCart)) {
                            echo $delCart;
                        }
                        ?>
                        <table class="tblone" style="border-bottom: 1px solid #666;">
                            <tr>
                                <th width="10%">STT</th>
                                <th width="30%">Product Name</th>
                                <th width="25%">Price</th>
                                <th width="15%">Quantity</th>
                                <th width="20%">Total Price</th>
                            </tr>
                            <?php
                            $get_product_cart = $cart->get_product_cart();
                            if ($get_product_cart) {
                                $subtotal = 0;
                                $qty = 0;
                                $i = 0;
                                while ($result_product_cart = $get_product_cart->fetch_assoc()) {
                                    $i++;
                            ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $result_product_cart['productName'] ?></td>
                                        <td><?php echo $result_product_cart['price'] . ' ' . 'VNĐ' ?></td>
                                        <td><?php echo $result_product_cart['quantity']  ?></td>
                                        <td>
                                            <?php
                                            $total = $result_product_cart['price'] * $result_product_cart['quantity'];
                                            echo $total . ' ' . 'VNĐ';
                                            ?>
                                        </td>
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
                            <table style="float:right;text-align:left;padding:20px;" width="40%">
                                <tr>
                                    <th>Sub Total : </th>
                                    <td><?php
                                        echo $subtotal . ' ' . 'VNĐ';
                                        Session::set('sum', $subtotal);
                                        Session::set('qty', $qty);
                                        ?></td>
                                </tr>
                                <tr>
                                    <th>VAT (10%) : </th>
                                    <td><?php echo $subtotal * 0.1 . ' ' . 'VNĐ' ?></td>
                                </tr>
                                <tr>
                                    <th>Grand Total :</th>
                                    <td><?php echo ($subtotal + $subtotal * 0.1) . ' ' . 'VNĐ' ?></td>
                                </tr>
                            </table>
                        <?php
                        } else {
                            echo '<span class="danger">Giỏ hàng của bạn hiện giờ đang trống!! Vui lòng chọn sản phẩm!!</span>';
                        } ?>
                    </div>
                </div>
                <div class="box-right">
                    <table class="tblone">
                        <?php
                        $id = Session::get('customer_id');
                        $get_customer = $customer->show_customer($id);
                        if ($get_customer) {
                            while ($result_customer = $get_customer->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td style="font-weight: bold;">Name</td>
                                    <td><?php echo $result_customer['name'] ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Địa chỉ</td>
                                    <td><?php echo $result_customer['address'] ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Thành Phố</td>
                                    <td><?php echo $result_customer['city'] ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Đất nước</td>
                                    <td><?php echo $result_customer['country'] ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Zipcode</td>
                                    <td><?php echo $result_customer['zipcode'] ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Số điện thoại</td>
                                    <td><?php echo $result_customer['phone'] ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Email</td>
                                    <td><?php echo $result_customer['email'] ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><a href="editprofile.php">Thay đổi thông tin</a></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div><br>
    <center><a href="?orderid=order" class="submit_order">Order Now</a></center><br><br>
</div>
</form>

<?php
include_once 'include/footer.php';
?>
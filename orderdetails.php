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
$cart = new cart();
if (isset($_GET['confirmid'])) {
    $id = $_GET['confirmid'];
    $time = $_GET['time'];
    $price = $_GET['price'];

    $confirmCustomer = $cart->confirmCustomer($id, $time, $price);
}
?>

<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2 style="font-size: 50px; color:lightblue;display:inline;">Chi tiết đặt hàng của bạn!</h2><br>
                <table class="tblone">
                    <tr>
                        <th width="5%">STT</th>
                        <th width="15%">Product Name</th>
                        <th width="20%">Image</th>
                        <th width="10%">Quantity</th>
                        <th width="15%">Price</th>
                        <th width="15%">Date_Order</th>
                        <th width="10%">Status</th>
                        <th width="10%">Action</th>
                    </tr>

                    <?php
                    $customer_id = Session::get('customer_id');
                    $get__cart_ordered = $cart->get__cart_ordered($customer_id);
                    if ($get__cart_ordered) {
                        $i = 0;
                        while ($result = $get__cart_ordered->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $result['productName'] ?></td>
                                <td><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></td>
                                <td> <?php echo $result['quantity']  ?></td>
                                <td> <?php echo $fm ->format_currency($result['price']).' '.'VNĐ'  ?></td>
                                <td> <?php echo $fm->formatDate($result['date_order']) ?></td>
                                <td>
                                    <?php
                                    if ($result['status'] == '0') {
                                        echo 'Đang xử lý....';
                                    } elseif ($result['status'] == '1') {
                                    ?>
                                    <span>Đang vận chuyển...</span>
                                    <?php
                                    } elseif ($result['status'] == '2') {
                                        echo 'Đã nhận hàng';
                                    }
                                    ?>
                                </td>

                                    <?php
                                        if ($result['status'] == '0') {
                                    ?>
                                            <td><?php echo 'N/A'; ?></td>;
                                    <?php
                                        } elseif ($result['status'] == '1') {
                                    ?>
                                            <td>
                                                <a onclick="return confirm('Bạn đã nhận hàng chưa? Nếu nhận rồi vui lòng nhấn OK!')" 
                                                href="?confirmid=<?php echo $customer_id ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">
                                                Bạn đã nhận được hàng chưa?</a>
                                            </td>
                                    <?php
                                        }elseif ($result['status'] == '2') {
                                    ?>
                                        <td>Đã nhận hàng</td>
                                    <?php
                                        }
                                    ?>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
            </div>
            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php
include_once 'include/footer.php';
?>
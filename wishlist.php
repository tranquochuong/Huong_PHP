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
if (isset($_GET['productid'])) {
    $productid = $_GET['productid'];
    $delWishlist = $product->del_Wishlist($productid);
}
// 	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
// 		$cartId = $_POST['cartId'];
// 		$quantity = $_POST['quantity'];
// 		$update_quantity = $cart ->update_quantity_cart($quantity,$cartId);
// 		if($quantity = 0) {
// 			$delCart = $cart->del_Cart($cartId);
// 		}
// 	}
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
                <h2 style="font-size: 50px; color:lightblue;display:inline;">Danh mục yêu thích của bạn</h2><br>
                <?php
                if (isset($delWishlist)) {
                    echo $delWishlist;
                }
                ?>
                <table class="tblone">
                    <tr>
                        <th width="5%">STT</th>
                        <th width="25%">Product Name</th>
                        <th width="30%">Image</th>
                        <th width="10%">Price</th>
                        <th width="10%">View</th>
                        <th width="10%">Action</th>
                    </tr>
                    <?php
                    $customer_id = Session::get('customer_id');
                    $get_product_wishlist = $product->get_product_wishlist($customer_id);
                    if ($get_product_wishlist) {
                        $i = 0;
                        while ($result_product_wishlist = $get_product_wishlist->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $result_product_wishlist['productName'] ?></td>
                                <td><img src="admin/uploads/<?php echo $result_product_wishlist['image'] ?>" alt="" /></td>
                                <td><?php echo $fm ->format_currency($result_product_wishlist['price']).' '.'VNĐ' ?></td>
                                <td><a href="details.php?productid=<?php echo $result_product_wishlist['productId'] ?>">Xem</a></td>
                                <td>
                                    <a onclick="return confirm('Bạn có muốn xoá không?')" href="?productid=<?php echo $result_product_wishlist['productId'] ?>">Xoá</a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
            </div>
            <div class="shopping">
                <center>
                    <div class="shopleft" style="width: 100%;">
                        <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                    </div>
                </center>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php
include_once 'include/footer.php';
?>
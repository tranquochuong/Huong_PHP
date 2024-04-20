<?php
include_once 'include/header.php';
include_once 'include/slider.php';
?>


<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>Your Cart</h2>
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
						while ($result_product_cart = $get_product_cart->fetch_assoc()) {
					?>
							<tr>
								<td><?php echo $result_product_cart['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result_product_cart['image'] ?>" alt="" /></td>
								<td><?php echo $result_product_cart['price']  ?></td>
								<td>
									<form action="" method="post">
										<input type="number" name="quantity" value="<?php echo $result_product_cart['quantity'] ?>" />
										<input type="submit" name="submit" value="Update" />
									</form>
								</td>
								<td>
									<?php
									$total = $result_product_cart['price'] * $result_product_cart['quantity'];
									echo $total;
									?>
								</td>
								<td><a href="">X</a></td>
							</tr>
					<?php
							$subtotal += $total;
						}
					}
					?>
				</table>
				<table style="float:right;text-align:left;" width="40%">
					<tr>
						<th>Sub Total : </th>
						<td><?php echo $subtotal ?></td>
					</tr>
					<tr>
						<th>VAT : </th>
						<td><?php echo $subtotal * 0.1 ?></td>
					</tr>
					<tr>
						<th>Grand Total :</th>
						<td><?php echo ($subtotal + $subtotal * 0.1) ?></td>
					</tr>
				</table>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="login.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
include_once 'include/footer.php';
?>
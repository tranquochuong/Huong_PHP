<?php
include_once 'include/header.php';
?>

<?php
if (!isset($_GET['proId']) || $_GET['proId'] == NULL) {
	echo "<script>window.location = '404.php' </script>";
} else {
	$id = $_GET['proId'];
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
	$quantity = $_POST['quantity'];
	$addToCart = $cart ->addToCart($quantity,$id);
}
?>

<div class="main">
	<div class="content">
		<div class="section group">
			<?php
			$getprodct_details = $product->getdetails($id);
			if ($getprodct_details) {
				while ($result_details = $getprodct_details->fetch_assoc()) {
			?>
					<div class="cont-desc span_1_of_2">
						<div class="grid images_3_of_2">
							<img src="admin/uploads/<?php echo $result_details['image'] ?>" alt="" />
						</div>
						<div class="desc span_3_of_2">
							<h2><?php echo $result_details['productName'] ?></h2>
							<p><?php echo $fm ->textShorten($result_details['productdesc'], 150) ?></p>
							<div class="price">
								<p>Price: <span><?php echo $result_details['price']." VND" ?></span></p>
								<p>Category: <span><?php echo $result_details['catName'] ?></span></p>
								<p>Brand:<span><?php echo $result_details['brandName'] ?></span></p>
								<p>Type:
									<span>
									<?php
									if ($result_details['type'] == 1) {
										echo 'Nổi bật';
									} else {
										echo 'Không nổi bật';
									}
									?>
									</span>
								</p>
							</div>
							<div class="add-cart">
								<form action="" method="post">
									<input type="number" class="buyfield" name="quantity" value="1" min="1" />
									<input type="submit" class="buysubmit" name="submit" value="Buy Now" />
								</form>
							</div>
						</div>
						<div class="product-desc">
							<h2>Product Details</h2>
							<p><?php echo $fm ->textShorten($result_details['productdesc'], 300) ?></p>
						</div>

					</div>
			<?php
				}
			}
			?>
			<div class="rightsidebar span_3_of_1">
				<h2>CATEGORIES</h2>
				<ul>
					<li><a href="productbycat.php">Mobile Phones</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>

<?php
include_once 'include/footer.php';
?>
<?php
include_once 'include/header.php';
?>

<?php
if (!isset($_GET['productid']) || $_GET['productid'] == NULL) {
	// echo "<script>window.location = '404.php' </script>";
} else {
	$id = $_GET['productid'];
}

$customer_id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])) {

	$productid = $_POST['productid'];

	$insertCompare = $product->insertCompare($productid, $customer_id);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wishlist'])) {

	$productid = $_POST['productid'];

	$insertWishlist = $product->insertWishlist($productid, $customer_id);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

	$quantity = $_POST['quantity'];

	$addToCart = $cart->addToCart($quantity, $id);
}

if((isset($_POST['submit_comment'])) && (isset($_POST['submit_comment']))) {
	$id = $_GET['productid'];
	$comment = $customer -> insert_comment($id);
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
							<p><?php echo $fm->textShorten($result_details['productdesc'], 150) ?></p>
							<div class="price">
								<p>Price: <span><?php echo $fm ->format_currency($result_details['price']).' '."VNĐ" ?></span></p>
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
									<input type="submit" class="buysubmit" name="submit" value="Mua hàng" />
								</form>
								<?php
								if (isset($addToCart)) {
									echo $addToCart;
								}
								?>
							</div>
							<div class="add-cart">
								<form action="" method="POST">
									<input type="hidden" name="productid" value="<?php echo $result_details['productId'] ?>">

									<?php
									$check_login = Session::get('customer_login');
									if ($check_login == false) {
										echo '';
									} else {
										echo '<input type="submit" class="buysubmit" name="compare" value="So sánh sản phẩm" /><br>';
									}
									?>
									<?php
									if (isset($insertCompare)) {
										echo $insertCompare;
									}
									?>
								</form>
							</div>
							<div class="add-cart">
								<form action="" method="POST">
									<input type="hidden" name="productid" value="<?php echo $result_details['productId'] ?>">

									<?php
									$check_login = Session::get('customer_login');
									if ($check_login == false) {
										echo '';
									} else {
										echo '<input type="submit" class="buysubmit" name="wishlist" value="Thêm vào danh sách yêu thích" /><br>';
									}
									?>
									<?php
									if (isset($insertWishlist)) {
										echo $insertWishlist;
									}
									?>
								</form>
							</div>
						</div>
						<div class="product-desc">
							<h2>Chi tiết</h2>
							<p><?php echo $fm->textShorten($result_details['productdesc'], 300) ?></p>
						</div>
					</div>
			<?php
				}
			}
			?>
			<div class="rightsidebar span_3_of_1">
				<h2>Danh mục</h2>
				<?php
				$getAllcat = $cat->showCat_front();
				if ($getAllcat) {
					while ($result_getCat = $getAllcat->fetch_assoc()) {
				?>
						<ul>
							<li><a href="productbycat.php?catId=<?php echo $result_getCat['catId'] ?>
					"><?php echo $result_getCat['catName'] ?></a></li>
						</ul>
				<?php
					}
				}
				?>
			</div>
		</div>
		<div class="comment" style="margin: 20px;">
			<div class="row">
			 <?php
			 	if(isset($comment)){
					echo $comment;
				}
			 ?>
				<div class="col-md-8">
					<h4>Ý kiến sản phẩm</h4>
					<form action="" method="POST">
						<p><input type="text" placeholder="Họ Tên" name="hoten" class="form-control"></p>
						<p><textarea rows="5" style="resize: none;" name="comment" placeholder="Nhập bình luận..." class="form-control"></textarea></p>
						<p><input type="submit" class="btn btn-success" name="submit_comment" value="Gửi"></p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include_once 'include/footer.php';
?>
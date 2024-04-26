<?php
include_once 'include/header.php';
?>
<?php
if (!isset($_GET['catId']) || $_GET['catId'] == NULL) {
	echo "<script>window.location = '404.php' </script>";
} else {
	$id = $_GET['catId'];
}
?>
<div class="main">
	<div class="content">
		<?php
		$getNameByCat = $cat->get_name_cat($id);
		if ($getNameByCat) {
			while ($result_name_cat = $getNameByCat->fetch_assoc()) {
		?>
				<div class="content_top">
					<div class="heading">
						<h3>
							<?php echo $result_name_cat['catName'] ?>
						</h3>
					</div>

					<div class="clear"></div>
				</div>
		<?php
			}
		}
		?>
		<div class="section group">
			<?php
			$get_cat_product = $cat->get_cat_product($id);
			if ($get_cat_product) {
				while ($result_cat_product = $get_cat_product->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php"><img src="admin/uploads/<?php echo $result_cat_product['image'] ?>" alt="" /></a>
						<h2><?php echo $result_cat_product['productName'] ?></h2>
						<p><?php echo $result_cat_product['productdesc'] ?></p>
						<p><span class="price"><?php echo $result_cat_product['price'] ?></span></p>
						<div class="button"><span><a href="details.php" class="details">Chi tiêt</a></span></div>
					</div>
			<?php
				}
			}else {
				echo '<span class="danger">Không có sản phẩm</span>';
			}
			?>
		</div>



	</div>
</div>
<?php
include_once 'include/footer.php';
?>
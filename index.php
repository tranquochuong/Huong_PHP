<?php 
	include_once 'include/header.php';
	include_once 'include/slider.php';
?>

<div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Sản phẩm nổi bậc</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			<?php
				$product_feathered = $product -> getproduct_feathered();
				if($product_feathered) {
					while($result_feathered = $product_feathered ->fetch_assoc()){

					?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.html"><img src="admin/uploads/<?php echo $result_feathered['image'] ?>" alt="" /></a>
					 <h2><?php echo $result_feathered['productName'] ?></h2>
					 <p><?php echo $fm ->textShorten($result_feathered['productdesc'], 50) ?></p>
					 <p><span class="price"><?php echo $fm ->format_currency($result_feathered['price'])." VND" ?></span></p>
				     <div class="button"><span><a href="details.php?productid=<?php echo $result_feathered['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
				<?php
					}
				}
			?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>Sản phẩm mới</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php
				$product_new = $product -> getproduct_new();
				if($product_new) {
					while($result_new = $product_new ->fetch_assoc()){

					?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.html"><img src="admin/uploads/<?php echo $result_new['image'] ?>" alt="" /></a>
					 <h2><?php echo $result_new['productName'] ?></h2>
					 <p><span class="price"><?php echo $fm ->format_currency($result_new['price'])." VND" ?></span></p>
				     <div class="button"><span><a href="details.php?productid=<?php echo $result_new['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
				<?php
					}
				}
			?>
			</div>
    </div>
 </div>

 <?php 
	include_once 'include/footer.php';
?>
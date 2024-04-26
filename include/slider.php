<div class="header_bottom">
	<div class="header_bottom_left">
		<div class="section group">
			<?php
			$getLastestDell = $product->get_last_dell();
			if ($getLastestDell) {
				while ($result_dell = $getLastestDell->fetch_assoc()) {

			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?productid=<?php echo $result['productId'] ?>"> <img src="admin/uploads/<?php echo $result_dell['image'] ?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2><?php echo $result_dell['productName'] ?></h2>
							<p><?php echo $result_dell['productdesc'] ?></p>
							<div class="button"><span><a href="details.php?productid=<?php echo $result_dell['productId'] ?>">Add to cart</a></span></div>
						</div>
					</div>
			<?php
				}
			}
			?>
			<?php
			$getLastestHp = $product->get_last_hp();
			if ($getLastestHp) {
				while ($result_hp = $getLastestHp->fetch_assoc()) {
			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?productid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result_hp['image'] ?>" alt=""></a>
						</div>
						<div class="text list_2_of_1">
							<h2><?php echo $result_hp['productName'] ?></h2>
							<p><?php echo $result_hp['productdesc'] ?></p>
							<div class="button"><span><a href="details.php?productid=<?php echo $result_hp['productId'] ?>">Add to cart</a></span></div>
						</div>
				<?php
				}
			}
				?>
					</div>
		</div>
		<div class="section group">
			<?php
			$getLastestIphone = $product->get_last_iphone();
			if ($getLastestIphone) {
				while ($result_iphone = $getLastestIphone->fetch_assoc()) {

			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?productid=<?php echo $result['productId'] ?>"> <img src="admin/uploads/<?php echo $result_iphone['image'] ?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2><?php echo $result_iphone['productName'] ?></h2>
							<p><?php echo $result_iphone['productdesc'] ?></p>
							<div class="button"><span><a href="details.php?productid=<?php echo $result_iphone['productId'] ?>">Add to cart</a></span></div>
						</div>
					</div>
			<?php
				}
			}
			?>

			<?php
			$getLastestSamsung = $product->get_last_samsung();
			if ($getLastestSamsung) {
				while ($result_samsung = $getLastestSamsung->fetch_assoc()) {

			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?productid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result_samsung['image'] ?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2><?php echo $result_samsung['productName'] ?></h2>
							<p><?php echo $result_samsung['productdesc'] ?></p>
							<div class="button"><span><a href="details.php?productid=<?php echo $result_samsung['productId'] ?>">Add to cart</a></span></div>
						</div>
					</div>
			<?php
				}
			}
			?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="header_bottom_right_images">
		<!-- FlexSlider -->

		<section class="slider">
			<div class="flexslider">
				<ul class="slides">
					<?php
					$getAllslider = $slider->showAllSlider();
					if ($getAllslider) {
						while ($result_All_slider = $getAllslider->fetch_assoc()) {
					?>
							<li><img style="width:70%;height:30%;margin:auto;" src="admin/uploads/<?php echo $result_All_slider['sliderImage'] ?>" alt="" /></li>
					<?php
						}
					}
					?>
				</ul>
			</div>
		</section>
		<!-- FlexSlider -->
	</div>
	<div class="clear"></div>
</div>
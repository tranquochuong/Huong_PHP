<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/slider.php'; ?>

<?php
$slider = new slider();

if (isset($_GET['sliderid']) && (isset($_GET['type']))) {
	$id = $_GET['sliderid'];
	$type = $_GET['type'];
	$updateType = $slider->updateType($id, $type);
}

if (isset($_GET['delid'])) {
	$id = $_GET['delid'];
	$delSlider = $slider->del_Slider($id);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Danh sách Slider</h2>
		<div class="block">
			<?php
			if (isset($delSlider)) {
				echo $delSlider;
			}
			?>
			<?php
			if (isset($updateType)) {
				echo $updateType;
			}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>STT</th>
						<th>Tên slider</th>
						<th>Ảnh Slider</th>
						<th>Loại</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$getSlider = $slider->showSlider();
					if ($getSlider) {
						$i = 0;
						while ($result_slider = $getSlider->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $result_slider['sliderName'] ?></td>
								<td><img src="uploads/<?php echo $result_slider['sliderImage'] ?>" height="40px" width="60px" /></td>
								<td>
									<?php
									if ($result_slider['type'] == 1) {
									?>
										<a href="?sliderid=<?php echo $result_slider['sliderId'] ?>&type=0">Bật</a>
									<?php
									} else {
									?>
										<a href="?sliderid=<?php echo $result_slider['sliderId'] ?>&type=1">Tắt</a>
									<?php
									}
									?>
								</td>
								<td>
									<a href="?delid=<?php echo $result_slider['sliderId'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xoá!');">Xoá</a>
								</td>
							</tr>
					<?php

						}
					}
					?>
				</tbody>
			</table>

		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>
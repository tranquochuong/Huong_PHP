<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php
$brand = new brand();
if (isset($_GET['delId'])) {
	$id = $_GET['delId'];
	$delBrand = $brand->del_Brand($id);
}
?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Thương Hiệu</h2>
		<div class="block">
        <?php 
                    if(isset($delBrand)) {
                        echo $delBrand;
                    }
                ?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>STT</th>
						<th>Tên Thương Hiệu</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$show_brand = $brand->showBrand();
					if (isset($show_brand)) {
						$i = 0;
						while ($result = $show_brand->fetch_assoc()) {
							$i++;
					?>
							<tr class="even gradeC">
								<td><?php echo $i ?></td>
								<td><?php echo $result['brandName'] ?></td>
								<td>
									<a href="brandedit.php?brandId=<?php echo $result['brandId'] ?>">Sửa</a>
									||
									<a onclick="return confirm('Bạn có muốn xoá không?')" href="?delId=<?php echo $result['brandId'] ?>">Xoá</a>
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
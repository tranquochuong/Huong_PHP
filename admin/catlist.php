<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php'; ?>
<?php
$cat = new category();
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Category List</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>STT</th>
						<th>Tên danh mục</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$show_cat = $cat->showCat();
					if (isset($show_cat)) {
						$i = 0;
						while ($result = $show_cat->fetch_assoc()) {
							$i++;
					?>
							<tr class="even gradeC">
								<td><?php echo $i ?></td>
								<td><?php echo $result['catName'] ?></td>
								<td><a href="catedit.php?catId=<?php echo $result['catId'] ?>">Edit</a> || <a href="?catId=<?php echo $result['catId'] ?>">Delete</a></td>
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
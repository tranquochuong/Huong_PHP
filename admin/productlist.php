<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php include '../classes/product.php'; ?>
<?php include_once '../helpers/format.php'; ?>

<?php
$product = new product();
$fm = new Format();

if (isset($_GET['productId'])) {
	$id = $_GET['productId'];
	$delProduct = $product->del_Product($id);
}
?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Danh sách sản phẩm</h2>
		<div class="block">
		<?php 
                if(isset($delProduct)) {
                        echo $delProduct;
                    }
                ?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>STT</th>
						<th>Tên Sản phẩm</th>
						<th>Danh mục</th>
						<th>Thương hiệu</th>
						<th>Mô tả</th>
						<th>Giá</th>
						<th>Ảnh</th>
						<th>Loại</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$productlist = $product->showProduct();
					if ($productlist) {
						$i=0;
						while ($result = $productlist->fetch_assoc()) {
							$i++;
					?>
							<tr class="gradeA">
								<td>
									<?php
									echo $i
									?>
								</td>
								<td>
									<?php
									echo $result['productName']
									?>
								</td>
								<td>
									<?php
									echo $result['catName']
									?>
								</td>
								<td>
									<?php
									echo $result['brandName']
									?>
								</td>
								<td>
									<?php
									echo $fm->textShorten($result['productdesc'], 50)
									?>
								</td>
								<td>
									<?php
									echo  $result['price']
									?>
								</td>
								<td>
									<?php
									if ($result['type'] == 1) {
										echo 'Nổi bật';
									} else {
										echo 'Không nổi bật';
									}
									?>
								</td>
								<td>
									<img src="uploads/<?php echo $result['image']?>" alt="" style="width: 100px;height: 100px;">
								</td>
								<td><a href="productedit.php?productId=<?php echo $result['productId'] ?>">Sửa</a> 
								|| 
								<a onclick="return confirm('Bạn có muốn xoá không?')" href="?productId=<?php echo $result['productId'] ?>">Xoá</a>
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
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/cart.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
$cart = new cart();
if (isset($_GET['shiftid'])) {
	$id = $_GET['shiftid'];
	$time = $_GET['time'];
	$price = $_GET['price'];

	$statusOrder = $cart->statusOrder($id, $time, $price);
}

if (isset($_GET['delid'])) {
	$id = $_GET['delid'];
	$time = $_GET['time'];
	$price = $_GET['price'];

	$delOrder = $cart->delOrder($id, $time, $price);
}
?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Inbox</h2>
		<?php
		if (isset($statusOrder)) {
			echo $statusOrder;
		}
		?>
		<?php
		if (isset($delOrder)) {
			echo $delOrder;
		}
		?>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>STT</th>
						<th>THời gian đặt</th>
						<th>Sản phẩm</th>
						<th>Số lượng</th>
						<th>Giá</th>
						<th>ID khách hàng</th>
						<th>Địa chỉ</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$cart = new cart();
					$fm = new Format();
					$get_inbox_cart = $cart->getInboxCart();
					if ($get_inbox_cart) {
						$i = 0;
						while ($result = $get_inbox_cart->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $fm->formatDate($result['date_order']) ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><?php echo $result['quantity'] ?></td>
								<td><?php echo $result['price'] . ' ' . 'VNĐ' ?></td>
								<td><?php echo $result['customer_Id'] ?></td>
								<td>
									<a href="customer.php?customerid=<?php echo $result['customer_Id'] ?>">Thông tin</a>
								</td>
									<?php
									if ($result['status'] == '0') {
									?>
										<td>
											<a style="padding:5px 36px;background-color:lightgreen;border-radius:3px;border:none;color:white" 
											onclick="return confirm('Nếu xử lý xong!! Click để chuyển sang đơn vị vận chuyển')" 
											href="?shiftid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Chờ xử lý...</a>
										</td>
									<?php
									} elseif($result['status'] == '1') {
									?>
										<td>
											<a style="padding: 5px 9px;background-color:gray;border-radius:3px;border:none;color:white">Đang vận chuyển...</a>
										</td>
									<?php
									} else{
									?>
										<td>
											<a style="padding: 5px 63px;background-color:red;border-radius:3px;border:none;color:white" 
											onclick="return confirm('Bạn có muốn xoá không?')" 
											href="?delid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">
											Xoá</a>
										</td>
									<?php
										}
									?>
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
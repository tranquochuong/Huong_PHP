<?php
include_once 'include/header.php';
?>
<?php
$check_login = Session::get('customer_login');
if ($check_login) {
	header('Location:order.php');
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {

	$insertCustomer = $customer->insert_Customer($_POST);
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {

	$loginCustomer = $customer->login_Customer($_POST);
}
?>

<div class="main">
	<div class="content">

		<!-- Đăng nhập -->

		<div class="login_panel">
			<h3>Đã có tài khoản</h3>
			<p>Đăng nhập</p>
			<?php
			if (isset($loginCustomer)) {
				echo $loginCustomer;
			}
			?>
			<form action="" method="POST">
				<input type="text" name="email" class="field" placeholder="Nhập email...">
				<input type="password" name="password" placeholder="Nhập mật khẩu..">
				<p class="note">Quên mật khẩu <a href="#">Tại đây</a></p>
				<div class="buttons">
					<div>
						<input class="btn" type="submit" name="login" value="Đăng nhập">
					</div>
				</div>
			</form>
		</div>

		<!-- Đăng ký -->

		<div class="register_account">
			<h3>Đăng ký</h3>
			<?php
			if (isset($insertCustomer)) {
				echo $insertCustomer;
			}
			?>
			<form action="" method="POST">
				<table>
					<tbody>
						<tr>
							<td>
								<div>
									<input type="text" name="name" placeholder="Nhập họ tên...">
								</div>

								<div>
									<input type="text" name="city" placeholder="Nhập họ city...">
								</div>

								<div>
									<input type="text" name="zipcode" placeholder="Nhập họ zipcode...">
								</div>
								<div>
									<input type="text" name="email" placeholder="Nhập họ email...">
								</div>
							</td>
							<td>
								<div>
									<input type="text" name="address" placeholder="Nhập họ address...">
								</div>
								<div>
									<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
										<option value="null">Chọn đất nước</option>
										<option value="VN">Việt Nam</option>

									</select>
								</div>

								<div>
									<input type="text" name="phone" placeholder="Nhập họ phone...">
								</div>

								<div>
									<input type="text" name="password" placeholder="Nhập họ password...">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="search">
					<div>
						<input class="btn" type="submit" name="register" value="Tạo tài khoản">
					</div>
				</div>
				<p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
				<div class="clear"></div>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</div>
</div>
<?php
include_once 'include/footer.php';
?>
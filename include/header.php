<?php
include 'lib/session.php';
Session::init();
?>
<?php
include_once 'lib/database.php';
include_once 'helpers/format.php';

spl_autoload_register(function ($className) {
	include_once "classes/" . $className . ".php";
});

$db = new Database();
$fm = new Format();
$cart = new cart();
$user = new user();
$cat = new category();
$product = new product();
$brand = new brand();
$customer = new customer();
$slider = new slider();
?>
<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE HTML>

<head>
	<title>Store Website</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
	<script src="js/jquerymain.js"></script>
	<script src="js/script.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/nav.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript" src="js/nav-hover.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

	<?php
	include_once 'include/script-header.php'
	?>

</head>

<body>
	<div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			<div class="header_top_right">
				<div class="search_box">
					<form action="search.php" method="POST">
						<input type="text" placeholder="Tìm kiếm sản phẩm" name="tukhoa">
						<input type="submit" name="search" value="Tìm kiếm">
					</form>
				</div>
				<div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
							<span class="cart_title">Giỏ hàng</span>
							<span class="no_product">
								<?php

								$check_item_card = $cart->check_item_cart();
								if ($check_item_card) {
									$sum = Session::get("sum");
									$qty = Session::get("qty");
									echo '('.$fm->format_currency($sum) . ' ' . 'vnd' . '-' . 'SL' . ' ' . $qty.')';
								} else {
									echo '(Trống)';
								}
								?>
							</span>
						</a>
					</div>
				</div>
			</div>
			<?php
			if (isset($_GET['customer_id'])) {
				$delCart = $cart->dell_all_cart();
				$customer_id = $_GET['customer_id'];
				$delCompare = $product->dell_all_compare($customer_id);
				$delCompare = $product->dell_all_wishlist($customer_id);
				Session::destroy();
			}
			?>
			<div class="login">
				<?php
				$check_login = Session::get('customer_login');
				if ($check_login == false) {
					echo '<a href="login.php">Đăng nhập</a></div>';
				} else {
					echo '<a href="?customer_id=' . Session::get('customer_id') . '">Đăng xuất</a></div>';
				}
				?>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="menu">
			<ul id="dc_mega-menu-orange" class="dc_mm-orange">
				<li><a href="index.php">Home</a></li>
				<li><a href="products.php">Products</a> </li>
				<li><a href="topbrands.php">Top Brands</a></li>
				<?php
				$check_cart = $cart->check_item_cart();
				if ($check_cart == false) {
					echo '';
				} else {
					echo '<li><a href="cart.php">Cart</a></li>';
				}
				?>
				<?php
				$customer_id = Session::get('customer_id');
				$check_order = $cart->check_order($customer_id);
				if ($check_order == false) {
					echo '';
				} else {
					echo '<li><a href="orderdetails.php">Ordered</a></li>';
				}
				?>
				<?php
				$check_login = Session::get('customer_login');
				if ($check_login) {
					echo '<li><a href="compare.php">Compare</a> </li></li>';
				}
				?>
				<?php
				$check_login = Session::get('customer_login');
				if ($check_login) {
					echo '<li><a href="wishlist.php">Wishlist</a> </li></li>';
				}
				?>
				<li><a href="contact.php">Contact</a> </li>
				<?php
				$check_login = Session::get('customer_login');
				if ($check_login == false) {
					echo '';
				} else {
					echo '<li><a href="profile.php">Profile</a> </li>';
				}
				?>
				<div class="clear"></div>
			</ul>
		</div>
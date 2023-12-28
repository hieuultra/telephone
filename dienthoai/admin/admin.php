<?php
if (!defined('hang')) {
	die('ban truy cap sai cach');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mobile Shop</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/bootstrap-table.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<!--Icons-->
	<script src="js/lumino.glyphs.js"></script>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php"><span>Vinacase</span>Shop</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<svg class="glyph stroked male-user">
								<use xlink:href="#stroked-male-user"></use>
							</svg>
							<?php
								// $mail = $_SESSION['mail'];
								// $pass = $_SESSION['pass'];
								$sql = "SELECT * FROM user WHERE user_mail='$mail' AND user_pass='$pass'";
								$query = mysqli_query($conn, $sql);
								$row = mysqli_fetch_array($query);
								if ($row['user_level'] == 1) {echo "Admin";} else {echo "Customer";}
							?>
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="index.php?page_layout=account">
									<svg class="glyph stroked male-user">
										<use xlink:href="#stroked-male-user"></use>
									</svg> Hồ sơ
								</a>
							</li>
							<li>
								<a href="output.php">
									<svg class="glyph stroked cancel">
										<use xlink:href="#stroked-cancel"></use>
									</svg> Đăng xuất
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
		<?php
			$row = $_GET['page_layout']; ?>
			<li <?php if ($_GET['page_layout'] == "dashboard") { ?> class="active" <?php } ?>>
				<a href="index.php?page_layout=dashboard">
					<svg class="glyph stroked dashboard-dial">
						<use xlink:href="#stroked-dashboard-dial"></use>
					</svg> Dashboard
				</a>
			</li>
			<?php if (defined("admin")) { ?>
				<li <?php if ($_GET['page_layout'] == "user" || $_GET['page_layout'] == "add_user" || $_GET['page_layout'] == "edit_user") { ?> class="active" <?php } ?>>
					<a href="index.php?page_layout=user">
						<svg class="glyph stroked male user ">
							<use xlink:href="#stroked-male-user" />
						</svg>Quản lý thành viên
					</a>
				</li>
			<?php } ?>
			<li <?php if ($_GET['page_layout'] == "category" || $_GET['page_layout'] == "add_category" || $_GET['page_layout'] == "edit_category") { ?> class="active" <?php } ?>>
				<a href="index.php?page_layout=category">
					<svg class="glyph stroked open folder">
						<use xlink:href="#stroked-open-folder" />
					</svg>Quản lý danh mục
				</a>
			</li>
			<li <?php if ($_GET['page_layout'] == "product" || $_GET['page_layout'] == "add_product" || $_GET['page_layout'] == "edit_product") { ?> class="active" <?php } ?>>
				<a href="index.php?page_layout=product">
					<svg class="glyph stroked bag">
						<use xlink:href="#stroked-bag"></use>
					</svg>Quản lý sản phẩm
				</a>
			</li>
			<li <?php if ($_GET['page_layout'] == "order") { ?> class="active" <?php } ?>>
				<a href="index.php?page_layout=order">
				<svg class="glyph stroked app-window-with-content">
						<use xlink:href="#stroked-app-window-with-content"></use>
					</svg>Quản lý đơn hàng
				</a>
			</li>
			<li <?php if ($_GET['page_layout'] == "comment") { ?> class="active" <?php } ?>>
				<a href="index.php?page_layout=comment">
					<svg class="glyph stroked two messages">
						<use xlink:href="#stroked-two-messages" />
					</svg> Quản lý bình luận</a>
			</li>

			<li <?php if ($_GET['page_layout'] == "setting" || $_GET['page_layout'] == "setting_title" || $_GET['page_layout'] == "add_title" || $_GET['page_layout'] == "edit_title" || $_GET['page_layout'] == "setting_footer" || $_GET['page_layout'] == "add_footer1" || $_GET['page_layout'] == "edit_footer1" || $_GET['page_layout'] == "number_product" || $_GET['page_layout'] == "number_comment" || $_GET['page_layout'] == "logo") { ?> class="active" <?php } ?>>
				<a href="index.php?page_layout=setting">
					<svg class="glyph stroked gear">
						<use xlink:href="#stroked-gear" />
					</svg> Cấu hình
				</a>
			</li>
		</ul>

	</div>
	<!--/.sidebar-->
	<!-- master page -->
	<?php
	if (isset($_GET['page_layout'])) {
		switch ($_GET['page_layout']) {
			case 'order':
				include_once('modules/order/order.php');
				break;
			case 'product':
				include_once('modules/product/product.php');
				break;
			case 'add_product':
				include_once('modules/product/add_product.php');
				break;
			case 'edit_product':
				include_once('modules/product/edit_product.php');
				break;
			case 'category':
				include_once('modules/category/category.php');
				break;
			case 'add_category':
				include_once('modules/category/add_category.php');
				break;
			case 'edit_category':
				include_once('modules/category/edit_category.php');
				break;
			case 'user':
				include_once('modules/user/user.php');
				break;
			case 'add_user':
				include_once('modules/user/add_user.php');
				break;
			case 'edit_user':
				include_once('modules/user/edit_user.php');
				break;
			case 'dashboard':
				include_once('dashboard.php');
				break;

			case 'comment':
				include_once('modules/comment/comment.php');
				break;
			case "account":
				include_once("modules/account/account.php");
				break;
			case "setting_footer":
				include_once("modules/footer/setting_footer.php");
				break;
			case "setting":
				include_once("modules/setting/setting.php");
				break;
			case "add_footer1":
				include_once("modules/footer/add_footer1.php");
				break;
			case "edit_footer1":
				include_once("modules/footer/edit_footer1.php");
				break;
			case "setting_title":
				include_once("modules/title/setting_title.php");
				break;
			case "add_title":
				include_once("modules/title/add_title.php");
				break;
			case "edit_title":
				include_once("modules/title/edit_title.php");
				break;
			case "number_product":
				include_once("modules/setting/number_product.php");
				break;
			case "number_comment":
				include_once("modules/setting/number_comment.php");
				break;
			case "logo":
				include_once("modules/setting/logo.php");
				break;
		}
	} else {
		header('location: index.php?page_layout=dashboard');
	}
	?>
</body>

</html>
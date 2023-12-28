<?php
ob_start();
session_start();
include_once('admin/modules/connect/connect.php');
?>
<script>
    if (window.history.replaceState) {
		window.history.replaceState(null, null, window.location.href);
	}
</script>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>
        <?php
        $query = mysqli_query($conn, "SELECT*FROM title");
        $row = mysqli_fetch_array($query);
        if (isset($_GET['giohang'])) {
            echo $row['cart'];
        }
        elseif (isset($_GET['kq'])) { // title success
            echo $row['success'];
        }
        elseif (isset($_GET['keyword'])) {  // title search
            echo $row['search'];
        }
        if (!isset($_GET['giohang']) && !isset($_GET['kq']) && !isset($_GET['keyword']) && !isset($_GET['id']) && !isset($_GET['id_category'])) {
            echo $row['trang_chu'];
        }
        if (isset($_GET['id'])) {   // title SP
            $id = $_GET['id'];
            $query = mysqli_query($conn, "SELECT*FROM product WHERE prd_id='$id'");
            $row = mysqli_fetch_array($query);
            echo $row['prd_title'];
        }
        if (isset($_GET['id_category'])) {  // title category
            $cat_id = $_GET['id_category'];
            $query = mysqli_query($conn, "SELECT*FROM category WHERE cat_id='$cat_id'");
            $row = mysqli_fetch_array($query);
            echo $row['title'];
        }
        ?>
    </title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- product -->
    <link rel="stylesheet" href="css/product.css">
    <!-- cart -->
    <link rel="stylesheet" href="css/cart.css">
    <!-- category -->
    <link rel="stylesheet" href="css/category.css">
    <!-- search -->
    <link rel="stylesheet" href="css/search.css">
    <!-- success -->
    <link rel="stylesheet" href="css/success.css">
</head>
<body>
    <!--	Header	-->
    <div id="header">
        <div class="container">
            <div class="row">
                <div id="logo" class="col-lg-3 col-md-3 col-sm-12">
                    <?php
                    //logo
                    include_once('modules/logo/logo.php')
                    ?>
                </div>
                <div id="search" class="col-lg-6 col-md-6 col-sm-12">
                    <?php
                    //search
                    include_once('modules/search/search_box.php');
                    ?>
                </div>
                <div id="cart" class="col-lg-3 col-md-3 col-sm-12">
                    <?php
                    //cart
                    include_once('modules/cart/cart_lotify.php');
                    ?>
                </div>
            </div>
        </div>
        <!-- Toggler/collapsibe Button -->
        <?php include_once('modules/button/button.php');?>
    </div>
    <!--	End Header	-->
    <!--	Body	-->
    <div id="body">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <?php
                    //menu
                    include_once('modules/menu/menu.php');
                    ?>
                </div>
            </div>
            <div class="row">
                <div id="main" class="col-lg-8 col-md-12 col-sm-12">
                    <!--	Slider	-->
                    <?php
                    //slide
                    include_once('modules/slide/slide.php');
                    ?>
                    <!--	End Slider	-->
                    <?php
                    //master page
                    if (isset($_GET['page_layout'])) {
                        $page_layout = $_GET['page_layout'];
                        switch ($page_layout) {
                            case 'product':
                                include_once('modules/product/product.php');
                                break;
                            case 'search':
                                include_once('modules/search/search.php');
                                break;
                            case 'cart':
                                include_once('modules/cart/cart.php');
                                break;
                            case 'category':
                                include_once('modules/menu/category.php');
                                break;
                            case 'success':
                                include_once('modules/cart/success.php');
                                break;
                        }
                    } else {
                        include_once('modules/product/feature.php');
                        include_once('modules/product/latest.php');
                    }
                    ?>
                </div>
                <div id="sidebar" class="col-lg-4 col-md-12 col-sm-12">
                    <?php
                    include_once('modules/banner/banner.php');
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!--	End Body	-->
    <div id="footer-top">
        <div class="container">
            <div class="row">
                <div id="logo-2" class="col-lg-3 col-md-6 col-sm-12">
                    <?php
                    //logo_footer
                    include_once('modules/logo/logo_footer.php')
                    ?>
                </div>
                <div id="address" class="col-lg-3 col-md-6 col-sm-12">
                    <?php
                    //address
                    include_once('modules/address/address.php');
                    ?>
                </div>
                <div id="service" class="col-lg-3 col-md-6 col-sm-12">
                    <?php
                    //service
                    include_once('modules/service/service.php');
                    ?>
                </div>
                <div id="hotline" class="col-lg-3 col-md-6 col-sm-12">
                    <?php
                    //hotline
                    include_once('modules/hotline/hotline.php');
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!--	Footer	-->
    <div id="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <?php
                    //end_footer
                    include_once('modules/footer/end_footer.php');
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!--	End Footer	-->
</body>
</html>
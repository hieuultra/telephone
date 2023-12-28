<script>
    function buyNow() {
        document.getElementById("buy-now").submit()
    }
</script>
<?php

if (isset($_SESSION['cart'])) {
    if (isset($_POST['sbm'])) {
        foreach ($_POST['qtt'] as $prd_id => $qtt) {
            $_SESSION['cart'][$prd_id] = $qtt;
        }
    }
    $arr_id = [];
    $prd_total = [];
    foreach ($_SESSION['cart'] as $prd_id => $qtt) {
        $arr_id[] = $prd_id;
        $prd_total[] = $qtt;
    }
    $str_id = implode(" ,", $arr_id);

    $sql = "SELECT * FROM product WHERE prd_id IN($str_id)";
    $query = mysqli_query($conn, $sql);
?>
    <!--	Cart	-->
    <div id="my-cart">
        <div class="row">
            <div class="cart-nav-item col-lg-7 col-md-7 col-sm-12">Thông tin sản phẩm</div>
            <div class="cart-nav-item col-lg-2 col-md-2 col-sm-12">Tùy chọn</div>
            <div class="cart-nav-item col-lg-3 col-md-3 col-sm-12">Giá</div>
        </div>
        <form method="post">
            <?php
            $total_price_all = 0;
            while ($row = mysqli_fetch_array($query)) {
                $total_price = $_SESSION['cart'][$row['prd_id']] * $row['prd_price'];
                $total_price_all += $total_price;
            ?>
                <div class="cart-item row">
                    <div class="cart-thumb col-lg-7 col-md-7 col-sm-12">
                        <img src="admin/img/product/<?php echo $row['prd_image']; ?>">
                        <h4><?php echo $row['prd_name']; ?></h4>
                    </div>
                    <div class="cart-quantity col-lg-2 col-md-2 col-sm-12">
                        <input name="qtt[<?php echo $row['prd_id']; ?>]" type="number" id="quantity" class="form-control form-blue quantity" value=<?php echo $_SESSION['cart'][$row['prd_id']]; ?> min="1">
                    </div>
                    <div class="cart-price col-lg-3 col-md-3 col-sm-12"><b><?php echo number_format($total_price, 0, '', '.'); ?> đ</b><a href="modules/cart/cart_dell.php?prd_id=<?php echo $row['prd_id']; ?>">Xóa</a></div>

                </div>
            <?php } ?>
            <div class="row">
                <div class="cart-thumb col-lg-7 col-md-7 col-sm-12">
                    <button id="update-cart" class="btn btn-success" type="submit" name="sbm">Cập nhật giỏ hàng</button>
                </div>
                <div class="cart-total col-lg-2 col-md-2 col-sm-12"><b>Tổng cộng:</b></div>
                <div class="cart-price col-lg-3 col-md-3 col-sm-12"><b><?php echo  number_format($total_price_all, 0, '', '.'); ?>đ</b></div>
            </div>
        </form>

    </div>
    <!--	End Cart	-->
    <?php
    if (isset($_POST["sb"])    ) {
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $email = $_POST["mail"];
        $address = $_POST["add"];
        $product_id = serialize($arr_id);
        $prd_total = serialize($prd_total);

        $sql_insert = "INSERT INTO orders(
            full_name,
            email,
            address,
            phone_number,
            product_id,
            total_product,
            total_price,
            status
        ) VALUE(
            '$name',
            '$email',
            '$address',
            $phone,
            '$product_id',
            '$prd_total',
            $total_price_all,
            0
        )";
        // echo "<pre>";
        // print_r($sql_insert);die();
        mysqli_query($conn, $sql_insert);
        unset($_SESSION['cart']);
        header('location:index.php?page_layout=success&kq=1');
    }else{
        // die('hahah');
    }
    ?>
    <div id="customer">
        <form id="buy-now" method="post">
            <div class="row">

                <div id="customer-name" class="col-lg-4 col-md-4 col-sm-12">
                    <input placeholder="Họ và tên (bắt buộc)" type="text" name="name" class="form-control" required>
                </div>
                <div id="customer-phone" class="col-lg-4 col-md-4 col-sm-12">
                    <input placeholder="Số điện thoại (bắt buộc)" type="text" name="phone" class="form-control" required>
                </div>
                <div id="customer-mail" class="col-lg-4 col-md-4 col-sm-12">
                    <input placeholder="Email (bắt buộc)" type="text" name="mail" class="form-control" required>
                </div>
                <div id="customer-add" class="col-lg-12 col-md-12 col-sm-12">
                    <input placeholder="Địa chỉ nhà riêng hoặc cơ quan (bắt buộc)" type="text" name="add" class="form-control" required>
                </div>

            </div>
            <div class="row">
                <div class="by-now col-lg-6 col-md-6 col-sm-12">
                    <button name="sb">
                        <b>Mua ngay</b>
                        <span>Giao hàng tận nơi siêu tốc</span>
                    </a>
                </div>
                <div class="by-now col-lg-6 col-md-6 col-sm-12">
                    <a href="#">
                        <b>Trả góp Online</b>
                        <span>Vui lòng call (+84) 352 860 701</span>
                    </a>
                </div>
            </div>
        </form>
    </div>
<?php } else { ?>
    <div class="alert alert-danger mt-3">Giỏ hàng không có sản phẩm</div>
<?php }
?>
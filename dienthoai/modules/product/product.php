<?php
$id = $_GET['id'];
$sql = "SELECT*FROM product WHERE prd_id=$id";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);

?>
<div id="product">
    <div id="product-head" class="row">
        <div id="product-img" class="col-lg-6 col-md-6 col-sm-12">
            <img src="admin/img/product/<?php echo $row['prd_image']; ?>">
        </div>
        <div id="product-details" class="col-lg-6 col-md-6 col-sm-12">
            <h1><?php echo $row['prd_name']; ?></h1>
            <ul>
                <li><span>Bảo hành:</span><?php echo $row['prd_warranty']; ?></li>
                <li><span>Đi kèm:</span><?php echo $row['prd_accessories']; ?></li>
                <li><span>Tình trạng:</span><?php echo $row['prd_new']; ?></li>
                <li><span>Khuyến Mại:</span><?php echo $row['prd_promotion']; ?></li>
                <li id="price">Giá Bán (chưa bao gồm VAT)</li>
                <li id="price-number"><?php echo number_format($row['prd_price'], 0, '', '.'); ?> đ</li>
                <li id="status1" class="badge badge-<?php if ($row['prd_status'] == 1) {
                                                        echo "success";
                                                    } else {
                                                        echo "danger";
                                                    } ?>"><?php if ($row['prd_status'] == 1) {
                                                                echo 'Còn hàng';
                                                            } else {
                                                                echo 'Hết hàng';
                                                            } ?></li>
            </ul>
            <?php
                if($row['prd_status'] == 1) { ?>
                    <div id="add-cart"><a href="modules/cart/cart_add.php?prd_id=<?php echo $row['prd_id']; ?>">Mua ngay</a></div>
                <?php } ?>
        
        </div>
    </div>
    <div id="product-body" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3>Đánh giá về <?php echo $row['prd_name']; ?></h3>
            <p>
                <?php echo $row['prd_details']; ?>
            </p>
        </div>
    </div>

    <!--	Comment	-->
    <div id="comment" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3>Bình luận sản phẩm</h3>
            <form method="post">
                <div class="form-group">
                    <label>Tên:</label>
                    <input placeholder="Nhập tên..." name="comm_name" required type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input placeholder="Nhập email..." name="comm_mail" required type="email" class="form-control" id="pwd">
                </div>
                <div class="form-group">
                    <label>Nội dung:</label>
                    <textarea placeholder="Nhập nội dung..." name="comm_details" required rows="8" class="form-control"></textarea>
                </div>
                <!-- <div style="display: none" class="form-group"> -->
                <div class="form-group">
                    <input placeholder="Nhập mã để thêm bình luận..." type="text" name="input" class="form-control">
                    <img src="captcha.php" title="" alt="" />
                </div>
                <button type="submit" name="sbm" class="btn btn-primary">Gửi</button>
            </form>
        </div>
    </div>
    <!--	End Comment	-->

    <!--	Comments List	-->
    <?php
    $query = mysqli_query($conn, "SELECT*FROM setting");
    $row = mysqli_fetch_array($query);
    $id = $_GET["id"];
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }
    $row_per_page = 5;
    if($row['number_comment']) {
        $row_per_page = $row['number_comment'];
    }
    $per_row = $page * $row_per_page - $row_per_page;
    $total_row = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM comment WHERE prd_id='$id'"));
    $total_page = ceil($total_row / $row_per_page);
    $list_page = " ";
    // previous_page
    $previous_page = $page - 1;
    if ($previous_page <= 1) {
        $previous_page = 1;
    }
    $list_page = '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&id=' . $id . '&page=' . $previous_page . '">Trang trước</a></li>';
    //end previous_page
    if (!isset($_GET['page'])) {
        for ($i = 1; $i <= $total_page; $i++) {
            if ($i == 1) {
                $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=product&id=' . $id . '&page=' . $i . '">' . $i . '</a></li>';
            }
            for ($i = 2; $i <= $total_page; $i++) {
                $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&id=' . $id . '&page=' . $i . '">' . $i . '</a></li>';
            }
        }
    } else {
        for ($i = 1; $i <= $total_page; $i++) {
            if ($i == $_GET['page']) {
                $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=product&id=' . $id . '&page=' . $i . '">' . $i . '</a></li>';
            } else {
                $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&id=' . $id . '&page=' . $i . '">' . $i . '</a></li>';
            }
        }
    }
    //page_next
    $page_next = $page + 1;
    if ($page_next > $total_page) {
        $page_next = $total_page;
    }
    $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&id=' . $id . '&page=' . $page_next . '">Trang sau</a></li>';
    $sql = "SELECT*FROM comment WHERE prd_id = $id LIMIT $per_row, $row_per_page";
    $query = mysqli_query($conn, $sql);
    if ($total_row > 0) {
    ?>
        <div id="comments-list" class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <?php
                while ($row = mysqli_fetch_array($query)) { ?>
                    <div class="comment-item">
                        <ul>
                            <li><b><?php echo $row['comm_name']; ?></b></li>
                            <li><?php echo $row['comm_date']; ?></li>
                            <li>
                                <p><?php echo $row['comm_details']; ?></p>
                            </li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } else { ?>
        <div id="comments-list" class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="alert alert-dark" role="alert">
                    Hiện chưa có bình luận nào!
                </div>
            </div>
        </div>

    <?php } ?>
    <?php
    if (isset($_POST['sbm'])) {
        $comm_name = $_POST['comm_name'];
        $comm_mail = $_POST['comm_mail'];
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $comm_date = date("Y-m-d H:i:s");
        $comm_details = $_POST['comm_details'];
        //ngăn spam BL
        // session_start();
        $input = $_POST['input'];
        // if(isset($_SESSION['captcha'])){
        if ($input == $_SESSION['captcha']) {
            $sql = "INSERT INTO comment(
                prd_id,
                comm_name,
                comm_date,
                comm_mail,
                comm_details
            ) VALUE(
                '$id',
                '$comm_name',
                '$comm_date',
                '$comm_mail',
                '$comm_details'
            )";
            mysqli_query($conn, $sql);
            header("refresh: 0.1");
        }
        // YC Nhập Tay
        // if($input == $_SESSION['captcha']){}
    }
    ?>
    <!--	End Comments List	-->
</div>
<!--	End Product	-->
<?php if ($total_row > 0) { ?>
    <div id="pagination">
        <ul class="pagination">
            <?php
            echo $list_page;
            ?>
        </ul>
    </div>
<?php  } ?>
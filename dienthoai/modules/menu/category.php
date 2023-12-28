<?php
// category
if (isset($_GET['id_category'])) {
    $cat_id = $_GET['id_category'];
    $cat_name = $_GET['cat_name'];
    $sql = "SELECT*FROM category WHERE cat_id='$cat_id'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    // product
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $row_per_page = 6;
    $per_row = $page * $row_per_page - $row_per_page;
    $sql_pt = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM product WHERE cat_id='$cat_id'"));
    $toltal_page = ceil($sql_pt / $row_per_page);
    $list_page = " ";
    //page prv 
    $page_prv = $page - 1;
    if ($page_prv < 1) {
        $page_prv = 1;
    }
    $list_page = '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&id_category=' . $row['cat_id'] . '&cat_name=' . $cat_name . '&page=' . $page_prv . '">Trang trước</a></li>';
    // in dam so trang hien tai
    if (!isset($_GET['page'])) {
        for ($i = 1; $i <= $toltal_page; $i++) {
            if ($i == 1) {
                $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=category&id_category=' . $row['cat_id'] . '&cat_name=' . $cat_name . '&page=' . $i . '">' . $i . '</a></li>';
            }
            for ($i = 2; $i <= $toltal_page; $i++) {
                $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&id_category=' . $row['cat_id'] . '&cat_name=' . $cat_name . '&page=' . $i . '">' . $i . '</a></li>';
            }
        }
    } else {
        for ($i = 1; $i <= $toltal_page; $i++) {
            if ($i == $_GET['page']) {
                $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=category&id_category=' . $row['cat_id'] . '&cat_name=' . $cat_name . '&page=' . $i . '">' . $i . '</a></li>';
            }
            if ($i != $_GET['page']) {
                $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&id_category=' . $row['cat_id'] . '&cat_name=' . $cat_name . '&page=' . $i . '">' . $i . '</a></li>';
            }
        }
    }
    //page next
    $page_next = $page + 1;
    if ($page_next > $toltal_page) {
        $page_next = $toltal_page;
    }
    $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&id_category=' . $row['cat_id'] . '&cat_name=' . $cat_name . '&page=' . $page_next . '">Trang sau</a></li>';
    $sql_prd = "SELECT*FROM product WHERE cat_id='$cat_id' ORDER BY prd_id ASC LIMIT $per_row, $row_per_page";
    $query_prd = mysqli_query($conn, $sql_prd);
    // $row_prd = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM product WHERE cat_id='$cat_id'"))
?>
    <!--	List Product	-->
    <div class="products">
        <h3><?php echo $row['cat_name']; ?> (hiện có <?php echo $sql_pt ?> sản phẩm)</h3>
        <?php
        $i = 0;
        while ($row_prd = mysqli_fetch_array($query_prd)) {
            if ($i == 0) { ?>
                <div class="product-list card-deck">
                <?php } ?>
                <div class="product-item card text-center">
                    <a href="index.php?page_layout=product&id=<?php echo $row_prd['prd_id']; ?>"><img src="admin/img/product/<?php echo $row_prd['prd_image']; ?>"></a>
                    <h4><a href="index.php?page_layout=product&id=<?php echo $row_prd['prd_id']; ?>"><?php echo $row_prd['prd_name']; ?></a></h4>
                    <p>Giá Bán: <span><?php echo number_format($row_prd['prd_price'], 0, '', '.'); ?> đ</span></p>
                </div>
                <?php
                $i++;
                if ($i == 3) {
                    $i = 0;
                ?>
                </div>
            <?php }
            }
            if ($i % 3 != 0) { ?>
    </div> <?php } ?>
</div>
<!--	End List Product	-->
<?php if ($sql_pt > 0) { ?>
    <div id="pagination">
        <ul class="pagination">
            <?php
            echo $list_page;
            ?>
        </ul>
    </div>
<?php  } ?>
<?php } ?>
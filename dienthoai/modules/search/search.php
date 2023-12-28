<!--	List Product	-->
<?php

if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
    
}else {
    $keyword = $_GET['keyword'];
}
if($keyword==null){
    header('location: index.php');
}
//phan trang TK
$arr_keyword = explode(" ", $keyword);
$str_keyword = "%" . implode("%", $arr_keyword) . "%";
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$row_per_page = 3;
$per_row = $page * $row_per_page - $row_per_page;
echo $toltal_row = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM product WHERE prd_name LIKE '$str_keyword'"));
echo $toltal_page = ceil($toltal_row / $row_per_page);
$list_page = " ";
$page_previous = $page - 1;
if ($page_previous <= 1) {
    $page_previous = 1;
}
$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=search&keyword=' . $keyword . '&page=' . $page_previous . '">Trang trước</a></li>';
// in dam so trang hien tai
if (!isset($_GET['page'])) {
    for ($i = 1; $i <= $toltal_page; $i++) {
        if ($i == 1) {
            $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=search&keyword=' . $keyword . '&page=' . $i . '">' . $i . '</a></li>';
        }
        for ($i = 2; $i <= $toltal_page; $i++) {
            $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=search&keyword=' . $keyword . '&page=' . $i . '">' . $i . '</a></li>';
        }
    }
} else {
    for ($i = 1; $i <= $toltal_page; $i++) {
        if ($i == $_GET['page']) {
            $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=search&keyword=' . $keyword . '&page=' . $i . '">' . $i . '</a></li>';
        }
        if ($i != $_GET['page']) {
            $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=search&keyword=' . $keyword . '&page=' . $i . '">' . $i . '</a></li>';
        }
    }
}
$page_next = $page + 1;
if ($page_next >= $toltal_page) {
    $page_next = $toltal_page;
}
$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=search&keyword=' . $keyword . '&page=' . $page_next . '">Trang sau</a></li>';
$sql = "SELECT*FROM product WHERE prd_name LIKE '$str_keyword' LIMIT $per_row, $row_per_page";
$query = mysqli_query($conn, $sql);
// dem SP
// $numrow_cat = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM product WHERE prd_name LIKE '$str_keyword'"));
$rows = mysqli_num_rows($query);
?>
<div class="products">
    <div id="search-result">Kết quả tìm kiếm với sản phẩm <span><?php echo $keyword . '( ' . $toltal_row . ' ' . 'sản phẩm )'; ?></span></div>
    <?php
    $i = 0;
    while ($row = mysqli_fetch_array($query)) {
        if ($i == 0) { ?>
            <div class="product-list card-deck">
            <?php } ?>
            <div class="product-item card text-center">
                <a href="index.php?page_layout=product&id=<?php echo $row['prd_id']; ?>"><img src="admin/img/product/<?php echo $row['prd_image']; ?>"></a>
                <h4><a href="index.php?page_layout=product&id=<?php echo $row['prd_id']; ?>"><?php echo $row['prd_name']; ?></a></h4>
                <p>Giá Bán: <span><?php echo number_format($row['prd_price'], 0, '', '.'); ?> đ</span></p>
            </div>
            <?php
            $i++;
            if ($i == 3) {
                $i = 0;
            ?>
            </div>
        <?php }
        }
        if ($rows % 3 != 0) { ?>
</div> <?php } ?>
</div>
<!--	End List Product	-->
<?php if ($toltal_row > 0) { ?>
    <div id="pagination">
        <ul class="pagination">
            <?php
            echo $list_page;
            ?>
        </ul>
    </div>
<?php  } ?>
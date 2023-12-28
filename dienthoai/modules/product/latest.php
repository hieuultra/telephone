<style>
    .couponcode:hover .coupontooltip {
        display: block;
        opacity: 0.8;
    }
    .coupontooltip {
        display: none;
        background: #cfd4da;
        padding: 10px;
        position: absolute;
        color: #3a3636;
        text-align: left;
        border-radius: 5%;
        border: 1px solid #222;
        width: 200px;
        height: 180px;
        /* overflow: auto; */
        overflow: hidden;
    }
    .coupontooltip ul {
        padding: 0;
    }
    .coupontooltip ul li {
        list-style: none;
    }
    .product-item:hover img {
        opacity: 1 !important;
    }
    @media (max-width:567px) {
        .coupontooltip {
            top: -9999px;
            left: -9999px;
        }
        .product-item:hover img {
            opacity: 0.5 !important;
        }
    }
</style>

<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$row_per_page = 6;
$per_row = $page * $row_per_page - $row_per_page;

$sql = "SELECT*FROM product ORDER BY prd_id DESC LIMIT $per_row, $row_per_page";
$query = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($query);
?>
<div class="products">
    <h3>Sản phẩm moi nhat</h3>
    <?php
    $i = 0;
    while ($row = mysqli_fetch_array($query)) {
        if ($i == 0) { ?>
            <div class="product-list card-deck">
            <?php } ?>
            <div class="product-item card text-center ">
                <a href="index.php?page_layout=product&id=<?php echo $row['prd_id']; ?>" class="couponcode">
                    <div class="coupontooltip">
                        <ul>
                            <li>Tên sản phẩm: <?php echo $row['prd_name']; ?></li>
                            <li>Giá: <?php echo $row['prd_price']; ?></li>
                            <li>Bảo hành: <?php echo $row['prd_warranty']; ?></li>
                            <li>Phụ kiện đi kèm: <?php echo $row['prd_accessories']; ?></li>
                            <li>Tình trạng: <?php echo $row['prd_new']; ?></li>
                            <li>Khuyến mại: <?php echo $row['prd_promotion']; ?></li>
                        </ul>
                    </div>
                    <img src="admin/img/product/<?php echo $row['prd_image']; ?>">
                </a>
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
<script>
    function show(elem) {
        /* added argument */
        elem.style.display = "block"; /* changed variable to argument */
    }

    function hide(elem) {
        /* added argument */
        elem.style.display = ""; /* changed variable to argument */
    }
</script>
<?php
$query=mysqli_query($conn, "SELECT*FROM setting");
$row=mysqli_fetch_array($query);
if(isset($_GET['page'])){
    $page=$_GET['page'];
}else{
    $page=1;
}
$row_per_page= $row['number_product'];
$per_row=$page*$row_per_page-$row_per_page;
$sql="SELECT*FROM product WHERE prd_featured=1 ORDER BY prd_id DESC LIMIT $per_row, $row_per_page";
$query=mysqli_query($conn, $sql);
$rows=mysqli_num_rows($query);
?>
<div class="products">
    <h3>Sản phẩm nổi bật</h3>
    <?php
    $i=0;
    while($row=mysqli_fetch_array($query)){
        if($i==0){?>
            <div class="product-list card-deck">
        <?php } ?>
        <div class="product-item card text-center">
            <a href="index.php?page_layout=product&id=<?php echo $row['prd_id']; ?>"><img src="admin/img/product/<?php echo $row['prd_image'];?>"></a>
            <h4><a href="index.php?page_layout=product&id=<?php echo $row['prd_id']; ?>"><?php echo $row['prd_name'];?></a></h4>
            <p>Giá Bán: <span><?php echo number_format($row['prd_price'], 0, '', '.'); ?> đ</span></p>
        </div>
        <?php
        $i++;
        if($i==3){
            $i=0;
        ?>
    </div>
    <?php } }
    if ($rows % 3 != 0) { ?> </div> <?php }?>
</div>
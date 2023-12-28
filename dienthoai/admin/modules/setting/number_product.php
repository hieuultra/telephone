<?php
if (!defined('hang')) {
    die('Bạn không có quyền truy cập file quản lý số sản phẩm một trang');
}

$sql_prd = "SELECT number_product FROM setting LIMIT 1";
$data = mysqli_fetch_array(mysqli_query($conn, $sql_prd));

if (isset($_POST['sbm'])) {
    $number_product = $_POST['number_product'];
    if(empty($data)) {
        $sql = "INSERT INTO setting (number_product) VALUES ('$number_product')";
    }else {
        $sql = "UPDATE setting SET number_product='$number_product'";
    }
    mysqli_query($conn, $sql);
    $show = '<div class="alert alert-success">Đã cấu hình thành công !</div>';
    $data = mysqli_fetch_array(mysqli_query($conn, $sql_prd));

}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="">Quản lý sản phẩm một trang</a></li>
        </ol>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý sản phẩm một trang</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-8">
                        <?php
                        if (isset($show)) {
                            echo $show;
                        }
                        ?>
                        <form role="form" method="post">
                            <div class="form-group">
                                <label>Số sản phẩm một trang:</label>
                                <input value="<?php if(!empty($data['number_product'])) {echo $data['number_product'];} ?>" required type="text" name="number_product" class="form-control" placeholder="Số sản phẩm một trang...">
                            </div>
                            <button type="submit" name="sbm" class="btn btn-success">Hoàn tất</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.col-->
    </div>
    <!--/.main-->
<?php
if (!defined('hang')) {
    die('Bạn không có quyền truy cập file quản lý số bình luận sản phẩm một trang');
}

$sql_cm = "SELECT number_comment FROM setting LIMIT 1";
$data = mysqli_fetch_array(mysqli_query($conn, $sql_cm));

if (isset($_POST['sbm'])) {
    $number_comment = $_POST['number_comment'];
    if(empty($data)) {
        $sql = "INSERT INTO setting (number_comment) VALUES ('$number_comment')";
    }else {
        $sql = "UPDATE setting SET number_comment='$number_comment'";
    }
    mysqli_query($conn, $sql);
    $show = '<div class="alert alert-success">Đã cấu hình thành công !</div>';
    $data = mysqli_fetch_array(mysqli_query($conn, $sql_cm));
}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="">Quản lý số bình luận sản phẩm một trang</a></li>
        </ol>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý số bình luận sản phẩm một trang</h1>
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
                                <label>Số số bình luận sản phẩm một trang:</label>
                                <input value="<?php if(!empty($data['number_comment'])) {echo $data['number_comment'];} ?>" required type="text" name="number_comment" class="form-control" placeholder="Số số bình luận sản phẩm một trang...">
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
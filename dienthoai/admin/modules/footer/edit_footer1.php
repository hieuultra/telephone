<?php
if (!defined('hang')) {
    die('ban truy cap sai cach');
}
$footer_id = $_GET['id'];
$logo_web = $_GET['name'];
$sql = "SELECT * FROM footer WHERE id = '$footer_id' AND logo_footer = '$logo_web'";

$query=mysqli_query($conn, $sql);
$row=mysqli_fetch_array($query);
if (isset($_POST['sbm'])) {
    //logo
    if($logo = $_FILES['logo']['name'] !=''){
        $logo = $_FILES['logo']['name'];
        $tmp_name=$_FILES['logo']['tmp_name'];
        move_uploaded_file($tmp_name,'img/footer/'.$logo);
    }else{
        $logo = $row['logo_footer'];
    }
    $content_logo = $_POST['content_logo'];
    //address
    $address = $_POST['address'];
    $content_address = $_POST['content_address'];
    //service
    $service = $_POST['service'];
    $content_servive = $_POST['content_service'];
    //hotline
    $hotline = $_POST['hotline'];
    $content_hotline = $_POST['content_hotline'];
    $sql_add = "UPDATE footer SET 
    logo_footer ='$logo',
    conten_logo='$content_logo',
    adress='$address',
    content_address='$content_address',
    service='$service',
    content_service='$content_servive',
    hotline='$hotline',
    content_hotline='$content_hotline'
    WHERE id='$footer_id'";
    unlink("img/footer/$logo_web");
    mysqli_query($conn, $sql_add);
    header("location: index.php?page_layout=setting_footer");
}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg>
                </a>
            </li>
            <li><a href="index.php?page_layout=product">Quản lý chân trang websise</a></li>
            <li class="active">Sửa chân trang1</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sửa chân trang1</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        <form role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Logo</label>
                                <input name="logo" type="file">
                                <br>
                                <div>
                                    <img width="300px" class="img-fluid" src="img/footer/<?php echo $row['logo_footer']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nội dung Logo</label>
                                <textarea id="logo" required name="content_logo" class="form-control" rows="3"><?= $row['conten_logo']?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Địa Chỉ</label>
                                <input required name="address" type="text" class="form-control" value="<?php echo $row['adress']?>">
                            </div>
                            <div class="form-group">
                                <label>Nội dung địa chỉ</label>
                                <textarea id="address" required name="content_address" class="form-control" rows="3"><?php echo $row['content_address']?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Dịch vụ</label>
                                <input required name="service" type="text" value="<?php echo $row['service']?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nội dung dịch vụ</label>
                                <textarea id="service" required name="content_service" class="form-control" rows="3"><?php echo $row['content_service']?></textarea>
                            </div>
                            <div class="form-group">
                                <label>HotLine</label>
                                <input required name="hotline" type="text" class="form-control" value="<?php echo $row['hotline']?>">
                            </div>
                            <div class="form-group">
                                <label>Nội dung HotLine</label>
                                <textarea required id="hotline" name="content_hotline" class="form-control" rows="3"><?php echo $row['content_hotline']?></textarea>
                            </div>
                            <button name="sbm" type="submit" class="btn btn-success">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace("logo_footer");
    CKEDITOR.replace("adress");
    CKEDITOR.replace("service");
    CKEDITOR.replace("hotline");
    CKEDITOR.replace("content_logo");
    CKEDITOR.replace("content_address");
</script>
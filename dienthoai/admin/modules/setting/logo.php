<?php
if (!defined('hang')) {
    die('ban truy cap sai cach');
}
$sql_logo = "SELECT logo_web FROM setting LIMIT 1";
$data = mysqli_fetch_array(mysqli_query($conn, $sql_logo));

?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="">Quản lý logo</a></li>
            <li class="active">Thêm logo</li>
        </ol>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-8">
                        <!-- <div class="alert alert-danger">Danh mục đã tồn tại !</div> -->
                        <?php
                        if (isset($_POST['sbm'])) {
                            $logo = $_FILES['logo']['name'];
                            if(!empty($logo)) {
                                $tmp_name = $_FILES['logo']['tmp_name'];
                                if ($_FILES["logo"]["type"] == "image/jpeg" || $_FILES["logo"]["type"] == "image/png" || $_FILES["logo"]["type"] == "image/gif") {
                                    $query = mysqli_query($conn, "SELECT * FROM setting");
                                    $row = mysqli_fetch_array($query);
                                    if (isset($row['logo_web'])) {
                                        $del = $row['logo_web'];
                                        unlink("img/logo/$del");
                                    }
                                    move_uploaded_file($tmp_name, "img/logo/" . $logo);
                                    
                                    if(empty($data)) {
                                        $sql = "INSERT INTO setting (logo_web) VALUES ('$logo')";
                                    }else {
                                        $sql = "UPDATE setting SET logo_web='$logo'";
                                    }
                                    mysqli_query($conn, $sql);
                                    $success = '<div class="alert alert-success">Đã cấu hình thành công logo cho website</div>';
                                    $data = mysqli_fetch_array(mysqli_query($conn, $sql_logo));
                                } else {
                                    $error = '<div class="alert alert-danger">Anh khonghop le! Hay chon duoi anh co dang jpeg, png, gif</div>';
                                }
                            }  
                        }
                        ?>
                        <form role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <?php
                                if (isset($error)) {
                                    echo $error;
                                }
                                if (isset($success)) {
                                    echo $success;
                                }
                                ?>
                                <label>Logo Website</label>
                                <input name="logo" type="file">
                                <br>
                                <?php if(!empty($data['logo_web'])) { ?>
                                    <img src="<?= 'img/logo/' . $data['logo_web'] ?>" width="300px">
                                <?php } ?>
                            </div>
                            <button name="sbm" type="submit" class="btn btn-success">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
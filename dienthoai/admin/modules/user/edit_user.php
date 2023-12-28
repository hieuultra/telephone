<?php
if(!defined('hang')){
    die('ban truy cap sai cach');
}
$user_id = $_GET['id'];
$sql_user = " SELECT * FROM user WHERE user_id = '$user_id'";
$query_user = mysqli_query($conn, $sql_user);
$row_user = mysqli_fetch_array($query_user);

if(isset($_POST['sbm'])){
    $user_full = $_POST['user_full'];
    $user_mail = $_POST['user_mail'];
    $user_pass = $_POST['user_pass'];
    $user_re_pass = $_POST['user_re_pass'];
    $user_level = $_POST['user_level'];

    $errors = [];
    
    if ($user_pass == $user_re_pass) {
        if(empty($user_pass)) {
            $sql = "UPDATE user SET user_full = '$user_full', user_mail = '$user_mail', user_level = '$user_level' WHERE user_id = '$user_id'";
        }else{
            $sql = "UPDATE user SET user_full = '$user_full', user_mail = '$user_mail', user_pass = '$user_pass', user_level = '$user_level' WHERE user_id = '$user_id'";
        }
        $query=mysqli_query($conn, $sql);
        header('location: index.php?page_layout=user');
    }else{
        $errors['pass'] = "Mật khẩu nhập lại không đúng!";
    }  
}
?>			
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li><a href="">Quản lý thành viên</a></li>
            <li class="active"><?= $row_user['user_full'];?></li>
        </ol>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thành viên: <?= $row_user['user_full'];?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-8">
                    
                    <?php if(isset($errors)){ ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error) { ?>
                                <p><?= $error ?></p>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <form role="form" method="post">
                        <div class="form-group">
                            <label>Họ & Tên <span class="text-danger">*</span></label>
                            <input type="text" name="user_full" required class="form-control" value="<?= $row_user['user_full'];?>" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="text" name="user_mail" required value="<?= $row_user['user_mail'];?>" class="form-control">
                        </div>                       
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input type="password" name="user_pass"  value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nhập lại mật khẩu</label>
                            <input type="password" name="user_re_pass" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Quyền</label>
                            <select name="user_level" class="form-control">
                                <option <?php if($row_user['user_level']==1){ echo 'selected';}?> value=1>Admin</option>
                                <option <?php if($row_user['user_level']==2){ echo 'selected';}?> value=2>Member</option>
                            </select>
                        </div>
                        <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>


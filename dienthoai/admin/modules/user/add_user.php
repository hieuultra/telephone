<?php
if (!defined('hang')) {
    die('ban truy cap sai cach');
}

if(isset($_POST['sbm'])){
    $user_full = $_POST['user_full'];
    $user_mail = $_POST['user_mail'];
    $user_pass = $_POST['user_pass'];
    $user_re_pass = $_POST['user_re_pass'];
    $user_level = $_POST['user_level'];

    $errors = [];
    if ($user_pass == $user_re_pass) {
        $user_pass = $_POST["user_pass"];
    } else {
        $errors['pass'] = "Mật khẩu nhập lại không đúng!";
    }

    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE user_mail = '$user_mail'")) == 0) {
        if ($user_pass == $user_re_pass) {
            $user_mail = $_POST["user_mail"];
            $sql_user = "INSERT INTO user( user_full, user_mail, user_pass, user_level) value('$user_full', '$user_mail', '$user_pass', '$user_level')";
            mysqli_query($conn, $sql_user);
            header("location: index.php?page_layout=user");
        }
    } else {
        $errors['mail'] = "Email đã tồn tại!";
    }
}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="">Quản lý thành viên</a></li>
            <li class="active">Thêm thành viên</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm thành viên</h1>
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
                        
                        <form role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Họ & Tên <span class="text-danger">*</span></label>
                                <input name="user_full" required class="form-control" placeholder="" value="<?= isset($_POST['user_full']) ? $_POST['user_full'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input name="user_mail" required type="text" class="form-control"
                                value="<?= isset($_POST['user_mail']) ? $_POST['user_mail'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu <span class="text-danger">*</span></label>
                                <input name="user_pass" required type="password" class="form-control" value="<?= isset($_POST['user_pass']) ? $_POST['user_pass'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu <span class="text-danger">*</span></label>
                                <input name="user_re_pass" required type="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Quyền</label>
                                <select name="user_level" class="form-control">
                                    <option value=1>Admin</option>
                                    <option value=2>Member</option>
                                </select>
                            </div>
                            <button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
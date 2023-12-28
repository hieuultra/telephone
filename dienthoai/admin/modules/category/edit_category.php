<?php
if(!defined('hang')){
    die('ban truy cap sai cach');
}

$cat_id = $_GET['id'];

$sql_all_cate = "SELECT * FROM category WHERE cat_id != $cat_id";
$query_all_cate = mysqli_query($conn, $sql_all_cate);
$row_all_cate = mysqli_fetch_all($query_all_cate);

$sql = "SELECT * FROM category WHERE cat_id = $cat_id";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);

$is_isset_category = false;

if(isset($_POST['sbm'])){
    $cat_name = $_POST['cat_name'];
    $title = $_POST['title'];
    foreach ($row_all_cate as $key => $category) {
        if($category[1] == $cat_name) {
            $is_isset_category = true;
        }
    }
    if($is_isset_category){
        $errors['cat_name'] = "Tên danh mục đã tồn tại!";
    }else{
        $sql_UPDATE = "UPDATE category SET cat_name = '$cat_name', title = '$title' WHERE cat_id = '$cat_id'";
        mysqli_query($conn, $sql_UPDATE);
        header('location: index.php?page_layout=category');
    }
    
}
?>			
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li><a href="">Quản lý danh mục</a></li>
            <li class="active"><?= $row['cat_name'];?></li>
        </ol>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh mục:<?= $row['cat_name'];?></h1>
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
                                <label>Tên danh mục <span class="text-danger">*</span></label>
                                <input type="text" name="cat_name" required value="<?= $row['cat_name'];?>" class="form-control" placeholder="Tên danh mục...">
                            </div>
                            <div class="form-group">
                                <label>Title danh mục <span class="text-danger">*</span></label>
                                <input type="text" name="title" required value="<?= $row['title'];?>" class="form-control" placeholder="Tên danh mục...">
                            </div>
                            <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


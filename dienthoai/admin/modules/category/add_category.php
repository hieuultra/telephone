<?php
if (!defined('hang'))
{
    die('ban truy cap sai cach');
}
if (isset($_POST['sbm']))
{
    $cat_name = $_POST['cat_name'];
    $cat_title = $_POST['cat_title'];
    $sql = "SELECT * FROM category WHERE cat_name = '$cat_name'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);

    $errors = [];

    if ($row["cat_name"] != $cat_name){
        $cat_name = $_POST["cat_name"];
        $sql_category = "INSERT INTO category(cat_name, title) VALUE ('$cat_name', '$cat_title')"; 
        mysqli_query($conn, $sql_category);
        header("location: index.php?page_layout=category");   
    }else{
        $errors['cat_name'] = "Tên danh mục sản phẩm đã tồn tại!";
    }
}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="">Quản lý danh mục</a></li>
            <li class="active">Thêm danh mục</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm danh mục</h1>
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
                                <input required type="text" name="cat_name" class="form-control" placeholder="Tên danh mục...">
                            </div>
                            <div class="form-group">
                                <label>Title danh mục <span class="text-danger">*</span></label>
                                <input required type="text" name="cat_title" class="form-control" placeholder="Title danh mục...">
                            </div>
                            <button type="submit" name="sbm" class="btn btn-success">Thêm mới</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

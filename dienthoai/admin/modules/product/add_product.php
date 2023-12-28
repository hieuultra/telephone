<?php
if (!defined('hang')) {
    die('ban truy cap sai cach');
}
if (isset($_POST['sbm'])) {
    $prd_name = $_POST['prd_name'];
    $prd_price = $_POST['prd_price'];
    $prd_warranty = $_POST['prd_warranty'];
    $prd_accessories = $_POST['prd_accessories'];
    $prd_promotion = $_POST['prd_promotion'];
    $prd_new = $_POST['prd_new'];

    $prd_image = $_FILES['prd_image']['name'];
    $tmp_name = $_FILES['prd_image']['tmp_name'];
    $cat_id = $_POST['cat_id'];
    $prd_status = $_POST['prd_status'];
    if (isset($_POST['prd_featured'])) {
        $prd_featured = $_POST['prd_featured'];
    } else {
        $prd_featured = 0;
    }
    $prd_details = $_POST['prd_details'];
    if ($_POST['title'] == "") {
        $title = $_POST['prd_name'];
    } else {
        $title = $_POST['title'];
    }
    $sql = "INSERT INTO product(
        prd_name,
        prd_price,
        prd_warranty,
        prd_accessories,
        prd_promotion,
        prd_new,
        prd_title,
        prd_image,
        cat_id,
        prd_status,
        prd_featured,
        prd_details
    ) VALUE(
        '$prd_name',
        '$prd_price',
        '$prd_warranty',
        '$prd_accessories',
        '$prd_promotion',
        '$prd_new',
        '$title',
        '$prd_image',
        '$cat_id',
        '$prd_status',
        '$prd_featured',
        '$prd_details'
    )";
    if ($_FILES["prd_image"]["type"] != "image/jpeg" || $_FILES["prd_image"]["type"] != "image/png" || $_FILES["prd_image"]["type"] != "image/gif") {
        $error = '<div class="alert alert-danger">Ảnh không hợp lệ! Hãy chọn ảnh có định dạng jpeg, png, gif</div>';
    }
    if (mysqli_num_rows(mysqli_query($conn, "SELECT*FROM product WHERE prd_name ='$prd_name'")) == 0) {
        if ($_FILES["prd_image"]["type"] == "image/jpeg" || $_FILES["prd_image"]["type"] == "image/png" || $_FILES["prd_image"]["type"] == "image/gif") {
            move_uploaded_file($tmp_name, "img/product/" . $prd_image);
            mysqli_query($conn, $sql);
            header("location: index.php?page_layout=product");
        }
    } else {
        $error_name = '<div class="alert alert-danger">Tên sản phẩm đã tồn tại !</div>';
    }
}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="index.php?page_layout=product">Quản lý sản phẩm</a></li>
            <li class="active">Thêm sản phẩm</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm sản phẩm</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-6">
                        <form role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <?php
                                if (isset($error_name)) {
                                    echo $error_name;
                                }
                                ?>
                                <input required name="prd_name" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input required name="prd_price" type="number" min="0" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Bảo hành</label>
                                <input name="prd_warranty" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Phụ kiện</label>
                                <input name="prd_accessories" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Khuyến mãi</label>
                                <input name="prd_promotion" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Tình trạng</label>
                                <input name="prd_new" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <input name="title" type="text" class="form-control">
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ảnh sản phẩm</label>
                            <?php if (isset($error)) { echo $error;} ?>
                            <input required name="prd_image" type="file">
                        </div>
                        <div class="form-group">
                            <label>Danh mục</label>
                            <select name="cat_id" class="form-control">
                                <?php
                                $sql = "SELECT*FROM category ORDER BY cat_id ASC";
                                $query = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($query)) { ?>
                                    <option value=<?php echo $row['cat_id'] ?>><?php echo $row['cat_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select name="prd_status" class="form-control">
                                <option value=1 selected>Còn hàng</option>
                                <option value=0>Hết hàng</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sản phẩm nổi bật</label>
                            <div class="checkbox">
                                <label>
                                    <input name="prd_featured" type="checkbox" value=1>Nổi bật
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mô tả sản phẩm</label>
                            <textarea required name="prd_details" class="form-control" rows="3"></textarea>
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
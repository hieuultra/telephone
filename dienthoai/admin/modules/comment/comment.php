<?php
    if(isset($_POST["update"])){
        $order_id = $_POST['order_id'];
        $sql_up = "UPDATE orders SET status = 1 WHERE order_id = $order_id";
        mysqli_query($conn, $sql_up);
    }
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a>
            </li>
            <li><a href="index.php?page_layout=product">Quản lý bình luận</a></li>
            <li class="active">Danh sách bình luận</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách Bình luận</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table data-toolbar="#toolbar" data-toggle="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sản phẩm</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Thời gian bình luận</th>
                                <th>Nội dung bình luận</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 13px">
                            <?php
                            if (isset($_GET["page"])) {
                                $page = $_GET["page"];
                            } else {
                                $page = 1;
                            }
                            $row_per_page = 5;
                            $per_rows = $page * $row_per_page - $row_per_page;
                            $total_rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM comment"));
                            $total_pages = ceil($total_rows / $row_per_page);
                            $list_page = " ";
                            $page_prev = $page - 1;
                            if ($page_prev <= 1) {
                                $page_prev = 1;
                            }
                            $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=comment&page=' . $page_prev . '">&laquo;</a></li>';
                            // in dam so trang hien tai
                            if (!isset($_GET['page'])) {
                                for ($i = 1; $i <= $total_pages; $i++) {
                                    if ($i == 1) {
                                        $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=comment&page=' . $i . '">' . $i . '</a></li>';
                                    }
                                    for ($i = 2; $i <= $total_pages; $i++) {
                                        $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=comment&page=' . $i . '">' . $i . '</a></li>';
                                    }
                                }
                            } else {
                                for ($i = 1; $i <= $total_pages; $i++) {
                                    if ($i == $_GET['page']) {
                                        $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=comment&page=' . $i . '">' . $i . '</a></li>';
                                    }
                                    if ($i != $_GET['page']) {
                                        $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=comment&page=' . $i . '">' . $i . '</a></li>';
                                    }
                                }
                            }
                            //page next
                            $page_next = $page + 1;
                            if ($page_next > $total_pages) {
                                $page_next = $total_pages;
                            }
                            $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=comment&page=' . $page_next . '">&raquo;</a></li>';
                            // echo $list_page;
                            $sql = "SELECT * FROM comment INNER JOIN product ON comment.prd_id=product.prd_id ORDER BY comm_id DESC LIMIT $per_rows, $row_per_page";
                            $query = mysqli_query($conn, $sql);
                            // mysqli_fetch_array($query);
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td style=""><?php echo $row['comm_id'] ?></td>
                                    <td style=""><?php echo $row['prd_name'] ?></td>
                                    <td style=""><?php echo $row['comm_name'] ?></td>
                                    <td><?php echo $row['comm_mail'] ?></td>
                                    <td><?php echo $row['comm_date'] ?></td>
                                    <td><?php echo $row['comm_details'] ?></td>
                                    <td style="">
                                    <a href="del_comment.php?id=<?php echo $row['comm_id'];?>" class="btn btn-danger">
                                        <i class="glyphicon glyphicon-remove"></i>
                                    </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php echo $list_page; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>
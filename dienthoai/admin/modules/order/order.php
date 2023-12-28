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
            <li><a href="index.php?page_layout=product">Quản lý đơn hàng</a></li>
            <li class="active">Danh sách đơn hàng</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách đơn hàng</h1>
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
                                <th>Tên khách hàng</th>
                                <th>Email</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Sản phẩm</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
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
                            $total_rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM orders"));
                            $total_pages = ceil($total_rows / $row_per_page);
                            $list_page = " ";
                            $page_prev = $page - 1;
                            if ($page_prev <= 1) {
                                $page_prev = 1;
                            }
                            $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=order&page=' . $page_prev . '">&laquo;</a></li>';
                            // in dam so trang hien tai
                            if (!isset($_GET['page'])) {
                                for ($i = 1; $i <= $total_pages; $i++) {
                                    if ($i == 1) {
                                        $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=order&page=' . $i . '">' . $i . '</a></li>';
                                    }
                                    for ($i = 2; $i <= $total_pages; $i++) {
                                        $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=order&page=' . $i . '">' . $i . '</a></li>';
                                    }
                                }
                            } else {
                                for ($i = 1; $i <= $total_pages; $i++) {
                                    if ($i == $_GET['page']) {
                                        $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=order&page=' . $i . '">' . $i . '</a></li>';
                                    }
                                    if ($i != $_GET['page']) {
                                        $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=order&page=' . $i . '">' . $i . '</a></li>';
                                    }
                                }
                            }
                            //page next
                            $page_next = $page + 1;
                            if ($page_next > $total_pages) {
                                $page_next = $total_pages;
                            }
                            $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=order&page=' . $page_next . '">&raquo;</a></li>';
                            // echo $list_page;
                            $sql = "SELECT * FROM orders ORDER BY order_id DESC LIMIT $per_rows, $row_per_page";
                            $query = mysqli_query($conn, $sql);
                            // mysqli_fetch_array($query);
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td style=""><?php echo $row['order_id'] ?></td>
                                    <td style=""><?php echo $row['full_name'] ?></td>
                                    <td style=""><?php echo $row['email'] ?></td>
                                    <td><?php echo $row['address'] ?></td>
                                    <td><?php echo $row['phone_number'] ?></td>
                                    <td>
                                        <?php
                                            $prdIds = implode(',', unserialize($row['product_id']));
                                            $sql_prd = "SELECT * FROM product WHERE prd_id IN ($prdIds)";
                                            $query_prd = mysqli_query($conn, $sql_prd);
                                            $total_prd = unserialize($row['total_product']);
                                            $i = 0;
                                        ?>
                                        <?php while ($row_prd = mysqli_fetch_array($query_prd)) { ?>
                                            <p>- <strong><?= $row_prd['prd_name'] ?></strong> x <?= $total_prd[$i] ?></p>
                                            <?php $i++ ?>
                                        <?php } ?>
                                    </td>
                                    <td style=""><?php echo number_format($row['total_price'], 0, ",", ".") ?>đ</td>
                                    <td style="">
                                        <form action="" method="POST">
                                            <input type="hidden" name="order_id" value="<?= $row['order_id'] ?>">
                                            <button name="update" style="padding: 8px 12px; border: none; " class="label label-<?= $row['status'] ? 'success' : 'danger' ?>">
                                                <?= $row['status'] ? 'Đã xử lý' : 'Xử lý' ?>
                                            </button>
                                        </form>
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
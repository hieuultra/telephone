<?php
include_once('admin/modules/connect/connect.php');
$sql_check = "SELECT*FROM footer";
$query_check = mysqli_query($conn, $sql_check);
$row_check = mysqli_fetch_array($query_check);
echo $del = $row_check['logo'];
echo unlink("admin/img/footer/$del");

?>
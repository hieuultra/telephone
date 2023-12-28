<?php
session_start();
include_once('modules/connect/connect.php');
if(isset($_SESSION['mail'])&& isset($_SESSION['pass'])){
    $id=$_GET['id'];
    $name=$_GET['name'];
    $sql="DELETE FROM footer WHERE id=$id";
    mysqli_query($conn, $sql);
    unlink("img/footer/$name");
    $insert = "INSERT INTO footer (id) VALUES (1)";
    mysqli_query($conn, $insert);
    header('location: index.php?page_layout=setting_footer');
}
else{
    die("Ban khong co quyen");
}
?>

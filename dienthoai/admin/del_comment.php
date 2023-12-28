<?php
session_start();
include_once('modules/connect/connect.php');
if(isset($_SESSION['mail'])&& isset($_SESSION['pass'])){
    $comment_id=$_GET['id'];
    $sql="DELETE FROM comment WHERE comm_id='$comment_id'";
    mysqli_query($conn, $sql);
    header('location: index.php?page_layout=comment');
}
?>
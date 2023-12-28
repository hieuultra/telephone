<?php
$sql="SELECT*FROM setting";
$query=mysqli_query($conn, $sql);
$row=mysqli_fetch_array($query);
?>
<h1><a href="index.php"><img class="img-fluid" src="admin/img/logo/<?php echo $row['logo_web'];?>"></a></h1>
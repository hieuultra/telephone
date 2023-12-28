<?php
// $arr[0][0]='HTML';
// $arr[0][1]='CSS';
// $arr[1][0]='JS';
// $arr[1][1]='PHP';

// $arr[0][0][0]='HTML';
// $arr[0][0][1]='CSS';

// $arr[1][0][0]='HTML';
// $arr[1][1][0]='CSS';

// $arr[5][1][2][8][6]='HTML';
// $arr[5][1][2][2][6]='php';

// $arr=array(
//     array('HTML', 'CSS'),
//     array('JS', 'PHP')
// );
// foreach($arr[1] as $vl){
//     echo $vl."<br/>";
// }


$_SESSION['cart'][3]=2;
$_SESSION['cart'][5]=1;

$_SESSION['cart']['mail']='ABC';
$_SESSION['cart']['mail']='DEF';
//ct tong quat
$_SESSION['cart']['prd_id']='qtt';
echo count($_SESSION['cart']);
?>
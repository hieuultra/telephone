<?php
session_start();
$string = md5(time());
$string = substr($string, 0, 4);
$_SESSION['captcha'] = $string;
$img = imagecreate(150, 50);
$background = imagecolorallocate($img, 0, 0, 0);
$text_color = imagecolorallocate($img, 255, 255, 255);
// imagefilledrectangle($img, 0, 0, 5, 38, $background);
$font = dirname(__FILE__) . '/font/f.ttf';
imagettftext($img, 25 ,10, 40, 40, $text_color, $font, $string);
// imagestring($img, 4, 50, 15, $string, $text_color);
header("Content-type: image/png");
imagepng($img);
imagedestroy($img);
?>
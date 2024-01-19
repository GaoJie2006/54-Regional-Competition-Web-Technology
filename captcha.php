<?php
session_start();
$width = 60;
$height = 40;

$image = imagecreatetruecolor($width, $height);
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);

$text = str_pad(rand(0,9999),4,"0",STR_PAD_LEFT);
$_SESSION['captcha'] = $text;

$font = "ARIAL.TTF";
imagefilledrectangle($image,0,0,$white-1,$height-1,$white);
imagefttext($image,20,0,0,30,$black,$font,$text);

header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
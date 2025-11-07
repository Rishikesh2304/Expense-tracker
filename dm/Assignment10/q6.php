<?php
// Q6: Create and Draw Graphics Dynamically (GD)
$width = 300; $height = 200;
$img = imagecreate($width, $height);
$bg = imagecolorallocate($img, 255, 255, 255);
$red = imagecolorallocate($img, 255, 0, 0);
$green = imagecolorallocate($img, 0, 200, 0);
$blue = imagecolorallocate($img, 0, 0, 255);
imagerectangle($img, 20, 20, 120, 120, $red);
imagefilledellipse($img, 200, 80, 100, 60, $green);
imageline($img, 0, $height-1, $width-1, 0, $blue);
header('Content-Type: image/png');
imagepng($img);
imagedestroy($img);
?>

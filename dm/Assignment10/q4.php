<?php
// Q4: Simple CAPTCHA image using GD
session_start();
$captcha = strval(rand(1000, 9999));
$_SESSION['captcha'] = $captcha;
$w = 100; $h = 40;
$image = imagecreate($w, $h);
$bg = imagecolorallocate($image, 255, 255, 255);
$noise_color = imagecolorallocate($image, 200, 200, 200);
$text_color = imagecolorallocate($image, 0, 0, 0);
for ($i=0;$i<6;$i++) {
    imageline($image, rand(0,$w), rand(0,$h), rand(0,$w), rand(0,$h), $noise_color);
}
imagestring($image, 5, 18, 10, $captcha, $text_color);
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
?>

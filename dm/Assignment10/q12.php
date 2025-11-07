<?php
// Q12: Dynamic Image Banner with Timestamp
$w = 600; $h = 100;
$img = imagecreate($w, $h);
$bg = imagecolorallocate($img, 240, 240, 240);
$black = imagecolorallocate($img, 0, 0, 0);
$text = "Generated on " . date("Y-m-d H:i:s");
$font = 5;
$tw = imagefontwidth($font) * strlen($text);
$th = imagefontheight($font);
$x = ($w - $tw) / 2;
$y = ($h - $th) / 2;
imagestring($img, $font, $x, $y, $text, $black);
header('Content-Type: image/png');
imagepng($img);
imagedestroy($img);
?>

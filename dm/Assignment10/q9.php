<?php
// Q9: Color Palette Manipulation - random colored shapes using GD
$w = 300; $h = 300;
$img = imagecreatetruecolor($w, $h);
$bg = imagecolorallocate($img, 255, 255, 255);
imagefilledrectangle($img, 0, 0, $w, $h, $bg);
for ($i=0; $i<12; $i++) {
    $color = imagecolorallocate($img, rand(0,255), rand(0,255), rand(0,255));
    $x = rand(10, $w-10);
    $y = rand(10, $h-10);
    $rx = rand(15, 60);
    $ry = rand(15, 60);
    imagefilledellipse($img, $x, $y, $rx, $ry, $color);
}
header('Content-Type: image/png');
imagepng($img);
imagedestroy($img);
?>

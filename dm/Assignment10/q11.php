<?php
// Q11: Generate Gradient Image
$w = 300; $h = 200;
$img = imagecreatetruecolor($w, $h);
for ($x = 0; $x < $w; $x++) {
    $r = (int)($x * 255 / $w);
    $g = 100;
    $b = 255 - $r;
    $col = imagecolorallocate($img, $r, $g, $b);
    imageline($img, $x, 0, $x, $h, $col);
}
header('Content-Type: image/png');
imagepng($img);
imagedestroy($img);
?>

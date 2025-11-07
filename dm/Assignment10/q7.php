<?php
// Q7: Add Text on an Image (watermark)
// If sample.jpg not present, script creates a fallback image.
$sourcePath = __DIR__ . '/sample.jpg';
if (!file_exists($sourcePath)) {
    $img = imagecreatetruecolor(400, 200);
    $bg = imagecolorallocate($img, 230, 230, 230);
    imagefilledrectangle($img, 0, 0, 400, 200, $bg);
    $text = "No sample.jpg found";
    $black = imagecolorallocate($img, 0, 0, 0);
    imagestring($img, 5, 10, 90, $text, $black);
} else {
    $img = imagecreatefromjpeg($sourcePath);
    $blue = imagecolorallocate($img, 0, 0, 255);
    imagestring($img, 5, 10, 10, "VIT Chennai", $blue);
}
header('Content-Type: image/jpeg');
imagejpeg($img, null, 85);
imagedestroy($img);
?>

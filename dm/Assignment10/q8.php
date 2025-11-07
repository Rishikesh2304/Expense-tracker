<?php
// Q8: Image Resizing and Scaling (upload + resize keeping aspect ratio)
$resizedUrl = '';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $f = $_FILES['image'];
    if ($f['error'] === UPLOAD_ERR_OK) {
        $info = getimagesize($f['tmp_name']);
        if ($info === false) {
            $message = "Invalid image.";
        } else {
            list($w, $h, $type) = $info;
            $maxWidth = 400;
            if ($w > $maxWidth) {
                $ratio = $maxWidth / $w;
                $newW = (int)($w * $ratio);
                $newH = (int)($h * $ratio);
            } else {
                $newW = $w; $newH = $h;
            }
            switch ($type) {
                case IMAGETYPE_JPEG: $src = imagecreatefromjpeg($f['tmp_name']); break;
                case IMAGETYPE_PNG:  $src = imagecreatefrompng($f['tmp_name']); break;
                case IMAGETYPE_GIF:  $src = imagecreatefromgif($f['tmp_name']); break;
                default: $src = null; break;
            }
            if (!$src) {
                $message = "Unsupported image type.";
            } else {
                $dst = imagecreatetruecolor($newW, $newH);
                if ($type == IMAGETYPE_PNG || $type == IMAGETYPE_GIF) {
                    imagecolortransparent($dst, imagecolorallocatealpha($dst, 0, 0, 0, 127));
                    imagealphablending($dst, false);
                    imagesavealpha($dst, true);
                }
                imagecopyresampled($dst, $src, 0,0,0,0, $newW, $newH, $w, $h);
                $targetDir = __DIR__ . '/uploads/';
                if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);
                $safe = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', basename($f['name']));
                $outPath = $targetDir . 'resized_' . $safe;
                imagejpeg($dst, $outPath, 85);
                imagedestroy($src);
                imagedestroy($dst);
                $resizedUrl = 'uploads/' . 'resized_' . $safe;
            }
        }
    } else {
        $message = "Upload error: " . $f['error'];
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Q8 - Resize Image</title></head>
<body>
    <h1>Q8: Resize Image</h1>
    <?php if ($message): ?><p style="color:red;"><?php echo htmlspecialchars($message); ?></p><?php endif; ?>
    <form method="post" enctype="multipart/form-data" action="Q8_resize_image.php">
        <input type="file" name="image" accept="image/*" required><br><br>
        <button type="submit">Upload & Resize</button>
    </form>
    <?php if ($resizedUrl): ?>
        <h2>Resized Image</h2>
        <img src="<?php echo htmlspecialchars($resizedUrl); ?>" style="max-width:600px;">
    <?php endif; ?>
</body>
</html>

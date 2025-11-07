<?php
// Q5: Embedding and Displaying an Uploaded Image
// Ensure "uploads/" exists and is writable
$uploadedUrl = '';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $targetDir = __DIR__ . '/uploads/';
    if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);
    $f = $_FILES['file'];
    if ($f['error'] === UPLOAD_ERR_OK) {
        $info = getimagesize($f['tmp_name']);
        if ($info === false) {
            $message = "Uploaded file is not a valid image.";
        } else {
            $safeName = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', basename($f['name']));
            $dest = $targetDir . $safeName;
            if (move_uploaded_file($f['tmp_name'], $dest)) {
                $uploadedUrl = 'uploads/' . $safeName;
            } else {
                $message = "Failed to move uploaded file.";
            }
        }
    } else {
        $message = "Upload error code: " . $f['error'];
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Q5 - Upload Image</title></head>
<body>
    <h1>Q5: Upload an Image</h1>
    <?php if ($message): ?><p style="color:red;"><?php echo htmlspecialchars($message); ?></p><?php endif; ?>
    <form method="post" enctype="multipart/form-data" action="Q5_upload_image.php">
        <input type="file" name="file" accept="image/*" required><br><br>
        <button type="submit">Upload</button>
    </form>
    <?php if ($uploadedUrl): ?>
        <h2>Uploaded Image</h2>
        <img src="<?php echo htmlspecialchars($uploadedUrl); ?>" style="max-width:400px;">
    <?php endif; ?>
</body>
</html>

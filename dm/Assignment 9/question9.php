<?php
$originalFile = __DIR__ . '/data.txt';

if (!file_exists($originalFile)) {
    die("Error: Original file 'data.txt' not found in " . __DIR__);
}

$dateTime = date("Y-m-d_H-i-s");
$fileInfo = pathinfo($originalFile);
$backupFile = $fileInfo['dirname'] . '/' . $fileInfo['filename'] . '_' . $dateTime . '.' . $fileInfo['extension'];

$result = copy($originalFile, $backupFile);

if ($result) {
    echo "Backup created successfully: " . basename($backupFile);
    echo "<br>Full path: " . $backupFile;
} else {
    echo "Error: Could not create backup in folder " . $fileInfo['dirname'];
}
?>


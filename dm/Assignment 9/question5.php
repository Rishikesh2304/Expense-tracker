<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


$username = "admin";
$action = "Logged In";
$timestamp = date("Y-m-d H:i:s");
$logEntry = "$username – $timestamp – $action" . PHP_EOL;

file_put_contents("access.log", $logEntry, FILE_APPEND);

echo "<h2>Access Log</h2>";
echo "<pre>";

if (file_exists("access.log")) {
    $logs = file("access.log", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($logs as $line) {
        echo htmlspecialchars($line) . "\n";
    }
} else {
    echo "Log file not found.";
}

echo "</pre>";
?>






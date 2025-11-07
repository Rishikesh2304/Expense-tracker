<?php
$inputFile  = __DIR__ . '/data.txt';
$outputFile = __DIR__ . '/numbers.txt';

if (!file_exists($inputFile)) {
    $sampleText = "Call me at 9876543210 or at office 9123456789. Old: 12345";
    file_put_contents($inputFile, $sampleText);
}

$data = file_get_contents($inputFile);
preg_match_all('/\b[6-9][0-9]{9}\b/', $data, $matches);

$numbers = array_values(array_unique($matches[0]));

echo "<h3>Extracted Mobile Numbers:</h3>";
if (!empty($numbers)) {
    echo "<ul>";
    foreach ($numbers as $num) {
        echo "<li>$num</li>";
    }
    echo "</ul>";
    file_put_contents($outputFile, implode(PHP_EOL, $numbers) . PHP_EOL);
    echo "<p>Saved " . count($numbers) . " number(s) to numbers.txt</p>";
} else {
    echo "<p>No valid mobile numbers found.</p>";
    file_put_contents($outputFile, "");
}
?>






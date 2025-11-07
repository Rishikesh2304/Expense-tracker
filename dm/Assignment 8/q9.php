<?php
$temperatures = array(
    78, 60, 62, 68, 71, 68, 73, 85, 66, 64, 76, 63, 75, 76,
    73, 68, 62, 73, 72, 65, 74, 62, 62, 65, 64, 68, 73, 75, 79, 73
);

$average = array_sum($temperatures) / count($temperatures);
echo "Average Temperature is : " . round($average, 1) . "<br>";
$unique_temps = array_unique($temperatures);
sort($unique_temps);
$lowest = array_slice($unique_temps, 0, 5);
$highest = array_slice($unique_temps, -5);

echo "List of seven lowest temperatures : " . implode(", ", $lowest) . "<br>";
echo "List of seven highest temperatures : " . implode(", ", $highest) . "<br>";
?>

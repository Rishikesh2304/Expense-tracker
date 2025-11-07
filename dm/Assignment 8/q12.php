<?php
echo "Numbers divisible by 4 betwwen 200 and 250:<br>";
$numbers = range(200, 250);
$divBy4 = array_filter($numbers, fn($n) => $n % 4 === 0);
echo implode(",", $divBy4);
?>


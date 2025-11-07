<?php
$x = array(1, 2, 3, 4, 5);
echo "Original Array:<br>";
var_dump($x);
echo"<br><br>";
unset($x[3]);
$x = array_values($x);
echo "Array after deletion<br>";
var_dump($x);
?>


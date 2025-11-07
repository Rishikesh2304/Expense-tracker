<?php
$array = array(1, 2, 3, 4, 5);

echo "Original array :<br>";
foreach ($array as $value) {
    echo $value . " ";
}
echo "<br><br>";
$position = 3;
array_splice($array, $position, 0, '$');

echo "After inserting '\$' the array is :<br>";
foreach ($array as $value) {
    echo $value . " ";
}
?>


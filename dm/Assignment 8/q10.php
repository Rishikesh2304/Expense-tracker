
<?php
$array1 = array(array(77, 87), array(23, 45));
$array2 = array("w3resource", "com");

$result = array();

for ($i = 0; $i < count($array1); $i++) {
    $result[$i] = array_merge(array($array2[$i]), $array1[$i]);
}

print_r($result);
?>


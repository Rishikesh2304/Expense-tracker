<?php
$people = array("Sophia" => "31", "Jacob" => "41", "William" => "39", "Ramesh" => "40");

asort($people);
echo "a) Ascending order sort by value:<br>";
foreach ($people as $key => $value) {
    echo "$key => $value<br>";
}
echo "<br><br>";

ksort($people);
echo "b) Ascending order sort by key:<br>";
foreach ($people as $key => $value) {
    echo "$key => $value<br>";
}
echo "<br><br>";

arsort($people);
echo "c) Descending order sort by value:<br>";
foreach ($people as $key => $value) {
    echo "$key => $value<br>";
}
echo "<br><br>";

krsort($people);
echo "d) Descending order sort by key:<br>";
foreach ($people as $key => $value) {
    echo "$key => $value<br>";
}
?>


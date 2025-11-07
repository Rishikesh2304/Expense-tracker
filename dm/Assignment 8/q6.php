<?php
$json = '{
    "Title": "The Cuckoos Calling",
    "Author": "Robert Galbraith",
    "Detail": {
        "Publisher": "Little Brown"
    }
}';

$data = json_decode($json, true);

echo "Title : " . $data['Title'] . "<br>";
echo "Author : " . $data['Author'] . "<br>";
echo "Publisher : " . $data['Detail']['Publisher'] . "<br>";
?>


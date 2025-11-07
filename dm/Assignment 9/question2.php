<?php
$lines = file("products.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$products = [];

foreach ($lines as $line) {
    list($name, $price) = explode(",", $line);
    $products[$name] = (int)$price;
}

asort($products); 

echo "<table border='1' cellpadding='5' cellspacing='0'>
<tr><th>Product</th><th>Price</th></tr>";
foreach ($products as $name => $price) {
    echo "<tr><td>$name</td><td>$price</td></tr>";
}
echo "</table>";
?>

<?php

class EmptyArrayException extends Exception {}


function calculateAverage($numbers) {
    if (empty($numbers)) {
        throw new EmptyArrayException("No numbers provided");
    }
    return array_sum($numbers) / count($numbers);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = $_POST["numbers"]; 
    $numbers = explode(",", $input); 

    try {
        $avg = calculateAverage($numbers);
        echo "Average of numbers is: " . $avg;
    } catch (EmptyArrayException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>


<form method="post">
    Enter numbers separated by comma: <input type="text" name="numbers" required>
    <button type="submit">Calculate</button>
</form>

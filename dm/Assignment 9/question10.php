<?php
$inputFile = __DIR__ . '/students.txt';
$errorFile = __DIR__ . '/errors.log';

if (!file_exists($inputFile)) {
    die("Error: students.txt not found");
}

$students = file($inputFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$validRecords = [];
$invalidRecords = [];

foreach ($students as $line) {
    $parts = explode(",", $line);

    if (count($parts) != 3) {
        $invalidRecords[] = $line;
        continue;
    }

    list($name, $email, $dob) = array_map('trim', $parts);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $invalidRecords[] = $line;
        continue;
    }

    $birth = DateTime::createFromFormat('Y-m-d', $dob);
    if (!$birth) {
        $invalidRecords[] = $line;
        continue;
    }

    $today = new DateTime();
    $age = $today->diff($birth)->y;

    $validRecords[] = [
        'name' => $name,
        'email' => $email,
        'age' => $age
    ];
}

if (!empty($invalidRecords)) {
    file_put_contents($errorFile, implode(PHP_EOL, $invalidRecords) . PHP_EOL, FILE_APPEND);
}

echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Name</th><th>Email</th><th>Age</th></tr>";

foreach ($validRecords as $student) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($student['name']) . "</td>";
    echo "<td>" . htmlspecialchars($student['email']) . "</td>";
    echo "<td>" . $student['age'] . "</td>";
    echo "</tr>";
}

echo "</table>";
?>

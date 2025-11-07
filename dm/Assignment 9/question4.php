<?php
class PasswordException extends Exception {}

function validatePassword($password) {
    if (strlen($password) < 8) throw new PasswordException("Password must be at least 8 characters");
    if (!preg_match("/[A-Z]/", $password)) throw new PasswordException("Password must contain at least one uppercase letter");
    if (!preg_match("/[0-9]/", $password)) throw new PasswordException("Password must contain at least one digit");
    if (!preg_match("/[@#$%]/", $password)) throw new PasswordException("Password must contain at least one special character (@, #, $, %)");
    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"];

    try {
        validatePassword($password);
        echo "<p style='color:green;'>Password is valid!</p>";
    } catch (PasswordException $e) {
        echo "<p style='color:red;'>Error: " . $e->getMessage() . "</p>";
    }
}
?>

<form method="post">
    Enter Password: <input type="password" name="password" required>
    <button type="submit">Check</button>
</form>

<?php
// Q13: Personalized Greeting Using Sessions
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
    $_SESSION['name'] = trim($_POST['name']);
    header('Location: Q13_greet.php');
    exit;
}
$name = $_SESSION['name'] ?? 'Student';
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Q13 - Greeting</title></head>
<body>
    <h1>Hello, <?php echo htmlspecialchars($name); ?>! Welcome to the PHP lab.</h1>
    <form method="post" action="Q13_greet.php">
        <label>Set your name: <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>"></label>
        <button type="submit">Save</button>
    </form>
    <p><a href="Q13_greet_clear.php">Clear Name</a></p>
</body>
</html>

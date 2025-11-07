<?php
// Q2: Session-Based Login Authentication (login form + processing)
session_start();
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user'] ?? '';
    $pass = $_POST['pass'] ?? '';
    // Demo credentials: admin / 1234
    if ($user === 'admin' && $pass === '1234') {
        $_SESSION['user'] = 'admin';
        header('Location: Q2_welcome.php');
        exit;
    } else {
        $err = 'Invalid credentials.';
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Q2 - Login</title></head>
<body>
    <h1>Q2: Login</h1>
    <?php if ($err): ?><p style="color:red;"><?php echo htmlspecialchars($err); ?></p><?php endif; ?>
    <form method="post" action="Q2_login.php">
        <label>Username: <input type="text" name="user" required></label><br><br>
        <label>Password: <input type="password" name="pass" required></label><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>

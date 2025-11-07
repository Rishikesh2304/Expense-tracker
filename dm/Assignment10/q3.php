<?php
// Q3: Remember Me Functionality with Cookies
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    if (!empty($_POST['remember'])) {
        // store for 30 days
        setcookie('username', $username, time() + 60*60*24*30, "/");
    } else {
        setcookie('username', '', time() - 3600, "/");
    }
    $_SESSION['user'] = $username ?: 'Guest';
    header('Location: Q3_remember_me.php');
    exit;
}
$cookieUser = $_COOKIE['username'] ?? '';
$welcome = $_SESSION['user'] ?? ($cookieUser ?: 'Guest');
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Q3 - Remember Me</title></head>
<body>
    <h1>Q3: Remember Me</h1>
    <p>Welcome <?php echo htmlspecialchars($welcome); ?></p>
    <form method="post" action="Q3_remember_me.php">
        <label>Username: <input type="text" name="username" value="<?php echo htmlspecialchars($cookieUser); ?>"></label><br><br>
        <label><input type="checkbox" name="remember" value="1"> Remember Me</label><br><br>
        <button type="submit">Save</button>
    </form>
    <p><a href="Q3_remember_clear.php">Clear Remembered Username</a></p>
</body>
</html>

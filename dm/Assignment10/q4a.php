<?php
// Q4: CAPTCHA verification form
session_start();
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = trim($_POST['captcha'] ?? '');
    if (isset($_SESSION['captcha']) && $input === $_SESSION['captcha']) {
        $msg = "CAPTCHA verified successfully.";
    } else {
        $msg = "Wrong CAPTCHA. Try again.";
    }
    unset($_SESSION['captcha']);
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Q4 - CAPTCHA</title></head>
<body>
    <h1>Q4: CAPTCHA Demo</h1>
    <?php if ($msg): ?><p><?php echo htmlspecialchars($msg); ?></p><?php endif; ?>
    <form method="post" action="Q4_captcha_form.php">
        <p><img src="Q4_captcha_image.php" alt="CAPTCHA image"></p>
        <label>Enter CAPTCHA: <input type="text" name="captcha" required></label><br><br>
        <button type="submit">Verify</button>
    </form>
</body>
</html>

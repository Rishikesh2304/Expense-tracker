<?php
// Q1: Cookie-Based Visit Counter
if (isset($_COOKIE['visits'])) {
    $count = intval($_COOKIE['visits']) + 1;
} else {
    $count = 1;
}
setcookie('visits', $count, time() + 3600, "/");
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Q1 - Visit Counter</title></head>
<body>
    <h1>Q1: Cookie-Based Visit Counter</h1>
    <p>Welcome! You have visited this page <?php echo $count; ?> time<?php echo $count>1 ? 's' : ''; ?>.</p>
    <p><a href="Q1_cookie_counter.php">Refresh</a> | <a href="Q1_cookie_reset.php">Reset</a></p>
</body>
</html>

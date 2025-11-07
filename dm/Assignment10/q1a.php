<?php
// Q1 helper: reset visits cookie
setcookie('visits', '', time() - 3600, "/");
header('Location: Q1_cookie_counter.php');
exit;
?>

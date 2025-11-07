<?php
// Q3 helper: clear remembered username cookie
setcookie('username', '', time() - 3600, "/");
header('Location: Q3_remember_me.php');
exit;
?>

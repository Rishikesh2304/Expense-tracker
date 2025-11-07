<?php
session_start();
unset($_SESSION['name']);
header('Location: Q13_greet.php');
exit;
?>

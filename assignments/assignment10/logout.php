<?php
session_start();

unset($_SESSION['status']);
unset($_SESSION['name']);
unset($_SESSION['user_status']);
setcookie(session_name(), '', time() - 3600, '/');
session_destroy();

header("Location: index.php");
exit;
?>

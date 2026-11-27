<?php
session_start();
session_destroy();

// hapus cookie remember me
setcookie("userID", "", time() - 3600, "/");

header("Location: login.php");
exit;
?>
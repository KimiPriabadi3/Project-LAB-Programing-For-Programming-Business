<?php
session_start();
include "config/koneksi.php";
include "cek_cookie.php";
$halaman = "home";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L&W - Home</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "navbar.php"; ?>

    <h1>Home</h1>

    <?php include "footer.php"; ?>
</body>

</html>
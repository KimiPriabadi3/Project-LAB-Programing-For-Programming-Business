<?php
session_start();
include "config/koneksi.php";
include "cek_cookie.php";

if (!isset($_SESSION['userRole']) || $_SESSION['userRole'] != "admin") {
    header("Location: login.php");
    exit;
}

$halaman = "dashboard";
?>
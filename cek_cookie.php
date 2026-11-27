<?php
// kalau belum login tapi ada cookie userID (remember me), login otomatis
if (!isset($_SESSION['userRole']) && isset($_COOKIE['userID'])) {
    $idCookie = mysqli_real_escape_string($conn, $_COOKIE['userID']);
    $queryCookie = mysqli_query($conn, "SELECT * FROM users WHERE userID = '$idCookie'");
    $userCookie = mysqli_fetch_assoc($queryCookie);

    if ($userCookie) {
        $_SESSION['userID'] = $userCookie['userID'];
        $_SESSION['userName'] = $userCookie['userName'];
        $_SESSION['userRole'] = $userCookie['userRole'];
    }
}
?>
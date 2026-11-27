<?php
session_start();
include "config/koneksi.php";
include "cek_cookie.php";
$halaman = "register";

// kalau sudah login, tidak perlu register lagi
if (isset($_SESSION['userRole'])) {
    header("Location: index.php");
    exit;
}

$username = "";
$email = "";
$usernameError = "";
$emailError = "";
$passwordError = "";
$confirmError = "";

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    // dipakai di query, supaya tanda kutip tidak merusak query
    $usernameSql = mysqli_real_escape_string($conn, $username);
    $emailSql = mysqli_real_escape_string($conn, $email);

    $valid = true;

    // validasi username
    if ($username == "") {
        $usernameError = "Username harus diisi";
        $valid = false;
    } else if (strlen($username) < 5 || strlen($username) > 20) {
        $usernameError = "Username harus 5 - 20 karakter";
        $valid = false;
    } else {
        $cekUsername = mysqli_query($conn, "SELECT * FROM users WHERE userName = '$usernameSql'");
        if (mysqli_num_rows($cekUsername) > 0) {
            $usernameError = "Username sudah dipakai";
            $valid = false;
        }
    }

    // validasi email
    if ($email == "") {
        $emailError = "Email harus diisi";
        $valid = false;
    } else if (substr($email, -10) != "@gmail.com") {
        $emailError = "Email harus berakhiran @gmail.com";
        $valid = false;
    } else {
        $cekEmail = mysqli_query($conn, "SELECT * FROM users WHERE userEmail = '$emailSql'");
        if (mysqli_num_rows($cekEmail) > 0) {
            $emailError = "Email sudah dipakai";
            $valid = false;
        }
    }

    // validasi password
    if ($password == "") {
        $passwordError = "Password harus diisi";
        $valid = false;
    } else if (strlen($password) < 8) {
        $passwordError = "Password minimal 8 karakter";
        $valid = false;
    }

    // validasi confirm password
    if ($confirm != $password) {
        $confirmError = "Confirm password harus sama dengan password";
        $valid = false;
    }

    // kalau semua benar, simpan ke database
    if ($valid) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($conn, "INSERT INTO users (userName, userEmail, userPassword, userRole) VALUES ('$usernameSql', '$emailSql', '$hash', 'member')");
        header("Location: login.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L&W - Register</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "navbar.php"; ?>

    <section id="form-section">
        <form method="post" action="register.php" class="form-box">
            <h2>Register</h2>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo $username; ?>">
                <span class="error-msg"><?php echo $usernameError; ?></span>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="<?php echo $email; ?>">
                <span class="error-msg"><?php echo $emailError; ?></span>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-box">
                    <input type="password" id="password" name="password">
                    <span class="eye" onclick="togglePassword('password')">👁</span>
                </div>
                <span class="error-msg"><?php echo $passwordError; ?></span>
            </div>

            <div class="form-group">
                <label for="confirm">Confirm Password</label>
                <div class="password-box">
                    <input type="password" id="confirm" name="confirm">
                    <span class="eye" onclick="togglePassword('confirm')">👁</span>
                </div>
                <span class="error-msg"><?php echo $confirmError; ?></span>
            </div>

            <button type="submit" name="register">REGISTER</button>
            <p class="form-link">Already have an account? <a href="login.php">Login here.</a></p>
        </form>
    </section>

    <?php include "footer.php"; ?>

    <script src="script.js"></script>
</body>

</html>
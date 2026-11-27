<?php
session_start();
include "config/koneksi.php";
include "cek_cookie.php";
$halaman = "login";

// kalau sudah login, langsung ke halaman masing-masing
if (isset($_SESSION['userRole'])) {
    if ($_SESSION['userRole'] == "admin") {
        header("Location: admin_dashboard.php");
    } else {
        header("Location: index.php");
    }
    exit;
}

$email = "";
$emailError = "";
$passwordError = "";
$loginError = "";

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $emailSql = mysqli_real_escape_string($conn, $email);

    $valid = true;

    // validasi email dan password harus diisi
    if ($email == "") {
        $emailError = "Email harus diisi";
        $valid = false;
    }

    if ($password == "") {
        $passwordError = "Password harus diisi";
        $valid = false;
    }

    // cek ke database
    if ($valid) {
        $query = mysqli_query($conn, "SELECT * FROM users WHERE userEmail = '$emailSql'");
        $user = mysqli_fetch_assoc($query);

        if ($user && password_verify($password, $user['userPassword'])) {
            // simpan data user di session
            $_SESSION['userID'] = $user['userID'];
            $_SESSION['userName'] = $user['userName'];
            $_SESSION['userRole'] = $user['userRole'];

            // kalau remember me dicentang, simpan userID di cookie selama 7 hari
            if (isset($_POST['remember'])) {
                setcookie("userID", $user['userID'], time() + (60 * 60 * 24 * 7), "/");
            }

            // admin ke dashboard, member ke home
            if ($user['userRole'] == "admin") {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: index.php");
            }
            exit;
        } else {
            $loginError = "Email atau password salah";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L&W - Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "navbar.php"; ?>

    <section id="form-section">
        <form method="post" action="login.php" class="form-box">
            <h2>Login</h2>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
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

            <div class="remember">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember Me</label>
            </div>

            <span class="error-msg" id="login-error"><?php echo $loginError; ?></span>

            <button type="submit" name="login">LOGIN</button>
            <p class="form-link"><a href="register.php">Register a new account.</a></p>
        </form>
    </section>

    <?php include "footer.php"; ?>

    <script src="script.js"></script>
</body>

</html>
<?php

if (isset($_SESSION['userRole'])) {
    $role = $_SESSION['userRole'];
} else {
    $role = "guest";
}


if (!isset($halaman)) {
    $halaman = "";
}
?>
<nav>
    <?php if ($role == "admin") { ?>
        <a id="logo" href="admin_dashboard.php">L&amp;W</a>
    <?php } else { ?>
        <a id="logo" href="index.php">L&amp;W</a>
    <?php } ?>

    <div id="nav-links">
        <?php if ($role == "admin") { ?>
            <a href="admin_dashboard.php" class="<?php if ($halaman == 'dashboard') { echo 'active'; } ?>">DASHBOARD</a>
            <a href="admin_products.php" class="<?php if ($halaman == 'products') { echo 'active'; } ?>">PRODUCTS</a>
            <a href="admin_brands.php" class="<?php if ($halaman == 'brands') { echo 'active'; } ?>">BRANDS</a>
            <a href="admin_transactions.php" class="<?php if ($halaman == 'transactions') { echo 'active'; } ?>">TRANSACTIONS</a>
        <?php } else { ?>
            <a href="index.php" class="<?php if ($halaman == 'home') { echo 'active'; } ?>">HOME</a>
            <a href="catalog.php" class="<?php if ($halaman == 'catalog') { echo 'active'; } ?>">CATALOG</a>
            <?php if ($role == "member") { ?>
                <a href="history.php" class="<?php if ($halaman == 'history') { echo 'active'; } ?>">HISTORY</a>
            <?php } ?>
        <?php } ?>
    </div>

    <div id="nav-right">
        <?php if ($role == "guest") { ?>
            <a href="login.php">LOGIN</a>
            <a href="register.php" id="btn-register">REGISTER</a>
        <?php } else { ?>
            <span>Halo, <?php echo $_SESSION['userName']; ?></span>
            <?php if ($role == "member") { ?>
                <a href="cart.php">CART</a>
            <?php } ?>
            <a href="logout.php">LOGOUT</a>
        <?php } ?>
    </div>
</nav>
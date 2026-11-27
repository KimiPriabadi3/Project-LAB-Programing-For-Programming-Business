<?php
session_start();
include "config/koneksi.php";
include "cek_cookie.php";

// admin tidak boleh buka halaman member
if (isset($_SESSION['userRole']) && $_SESSION['userRole'] == "admin") {
    header("Location: admin_dashboard.php");
    exit;
}

$halaman = "catalog";

// ambil search dan filter dari URL
$search = "";
$brandFilter = 0;

if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
}
if (isset($_GET['brand'])) {
    $brandFilter = (int)$_GET['brand'];
}

$searchSafe = mysqli_real_escape_string($conn, $search);

// query produk + nama brand
$query = "SELECT products.*, brands.brandName
          FROM products
          JOIN brands ON products.brandID = brands.brandID
          WHERE products.productName LIKE '%$searchSafe%'";

if ($brandFilter > 0) {
    $query .= " AND products.brandID = $brandFilter";
}

$query .= " ORDER BY products.productID";
$result = mysqli_query($conn, $query);

// daftar brand untuk dropdown
$brands = mysqli_query($conn, "SELECT * FROM brands ORDER BY brandName");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog | L&amp;W</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="catalog.css">
</head>
<body>
    <?php include "navbar.php"; ?>

    <section id="catalog-section">
        <h1>Catalog Parfum</h1>

        <form method="GET" action="catalog.php" id="filter-form">
            <input type="text" name="search" placeholder="Cari nama parfum..." value="<?php echo htmlspecialchars($search); ?>">

            <select name="brand">
                <option value="0">Semua Brand</option>
                <?php while ($b = mysqli_fetch_assoc($brands)) { ?>
                    <option value="<?php echo $b['brandID']; ?>" <?php if ($brandFilter == $b['brandID']) { echo "selected"; } ?>>
                        <?php echo htmlspecialchars($b['brandName']); ?>
                    </option>
                <?php } ?>
            </select>

            <button type="submit">Cari</button>
        </form>

        <?php if (mysqli_num_rows($result) == 0) { ?>
            <p id="kosong">Produk tidak ditemukan.</p>
        <?php } ?>

        <div id="product-list">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="product-card">
                    <a href="product_detail.php?id=<?php echo $row['productID']; ?>">
                        <img src="asset/product/<?php echo htmlspecialchars($row['productImage']); ?>" alt="<?php echo htmlspecialchars($row['productName']); ?>">
                        <p class="brand"><?php echo htmlspecialchars($row['brandName']); ?></p>
                        <h3><?php echo htmlspecialchars($row['productName']); ?></h3>
                        <p class="price">Rp <?php echo number_format($row['productPrice'], 0, ',', '.'); ?></p>
                    </a>
                    <?php if ($row['productStock'] == 0) { ?>
                        <p class="habis">Stok habis</p>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </section>

    <?php include "footer.php"; ?>
</body>
</html>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../koneksi/koneksi.php");
if (isset($_SESSION['username']) && is_array($_SESSION['username'])) {
    $user = $_SESSION['username'];
    $query_keranjang = mysqli_query($con, "SELECT * FROM keranjang WHERE id_user = '$user[id_user]'");
    $data_keranjang = mysqli_fetch_assoc($query_keranjang);
    $jumlah_barang_keranjang = 0;

    if ($data_keranjang) {
        $query_detail_keranjang = mysqli_query($con, "SELECT SUM(jumlah) AS total_barang FROM detail_keranjang WHERE id_keranjang = '$data_keranjang[id_keranjang]'");
        $data_detail_keranjang = mysqli_fetch_assoc($query_detail_keranjang);
        $jumlah_barang_keranjang = $data_detail_keranjang['total_barang'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>TOMASS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/script.js"></script>

    <style>
    .navbar {
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.3);
        background-color: #fff;
    }

    .navbar-brand img {
        max-height: 40px;
    }

    .navbar-nav .nav-link {
        color: #333;
    }

    .navbar-nav .nav-link:hover {
        color: #007bff;
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 5px;
        padding: 8px;
    }

    .btn-primary {
        border-radius: 5px;
        margin-left: 10px;
    }

    #userActions .nav-item {
        margin-right: 15px;
    }

    #cartIcon img {
        height: 20px;
        margin-right: 5px;
    }

    .dropdown-menu {
        border: 1px solid rgba(0, 0, 0, 0.1);
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
    }
    .header-logo {
        display: flex;
        align-items: center;
    }

    .logo ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .logo img {
        max-height: 40px;
        margin-right: 10px;
        margin-left: 10px;
    }
</style>

</head>


<body>
    <!-- nav Logo-->
    <nav class="navbar navbar-expand-lg ftco_navbar ftco-navbar-light mb-2" id="ftco-navbar">
        <div class="header-logo">
            <div class="logo">
                <ul>
                    <a href="../public/index.php">
                        <img src="../assets/image/logoHeader.png" alt="">
                    </a>
                </ul>
            </div>
        </div>

        <!-- nav Search-->
        <div class="collapse navbar-collapse" id="navbarNav">
            <form class="d-flex mx-auto" action="index.php" method="GET">
                <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search"
                    style="width: 500px; border: 1px solid #ced4da; border-radius: 5px; padding: 8px;">
                <button class="btn btn-outline-success" style="border-radius: 5px; margin-left: 10px;" type="submit"><svg
                        xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                        class="bi bi-search" viewBox="0 0 15 15">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                </button>
            </form>
        </div>

        <!-- nav Menu-->
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="../public/index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="../public/about.php" class="nav-link">About</a></li>
                <ul class="navbar-nav ms-auto" id="userActions">
                    <?php if (isset($_SESSION['username'])): ?>
                        <li class="nav-item" id="cartIcon">
                            <a class="nav-link" href="../proses/keranjang.php">
                                <img src="../assets/image/cart.png" alt="Keranjang" style="height: 20px;">
                                <?php if ($jumlah_barang_keranjang > 0): ?>
                                    <span class="badge bg-danger">
                                        <?= htmlspecialchars($jumlah_barang_keranjang); ?>
                                    </span>
                                <?php endif; ?>
                            </a>
                        </li>
                        <li class="nav-item dropdown" id="accountDropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="accountText" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= htmlspecialchars($user['username']); ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="accountDropdown">
                                <a class="dropdown-item" href="../proses/riwayat_pesanan.php">Pesanan saya</a>
                                <a class="dropdown-item" href="../proses/logout_proses.php">Logout</a>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="nav-item dropdown" id="accountDropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="accountText" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Login | Register
                            </a>
                            <div class="dropdown-menu" aria-labelledby="accountDropdown">
                                <a class="dropdown-item" href="../public/login.php">Login</a>
                                <a class="dropdown-item" href="../public/login.php">Register</a>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
        </div>
    </nav>
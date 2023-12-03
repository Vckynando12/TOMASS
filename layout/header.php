<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login'])) {
    header('location: ../public/login.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Tomass</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
/* CSS for hover effect */
.nav-item.dropdown:hover .dropdown-menu {
    display: block;
}
.nav-item.dropdown .dropdown-menu {
    margin-right: 10px; /* Adjust the margin as needed */
}

    </style>
</head>


<body>
    <!---NAVBAR--->
    <div class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #618264;">
            <!-- Navbar Brand/navbar atas-->
            <a class="navbar-brand ps-3" href="../admin/index.php"><img src="../assets/image/logoHeader.png"></a>
            <!-- Sidebar Toggle/pembuka penutup navbar samping-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                    class="fas fa-bars"></i></button>

            <!-- Navbar/akun-->
            <ul class="navbar-nav ms-auto ms-auto me-0 me-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user fa-fw"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <!-- <li><a class="dropdown-item" href="#!">Pengaturan</a></li> -->
                        <li><a class="dropdown-item" href="../proses/logout_proses.php">Keluar</a></li>
                    </ul>
                </li>
            </ul>
            <ul></ul>
        </nav>
        <!---Navbar samping-->
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark " id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="Pembelian.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Pembelian
                            </a>
                            <a class="nav-link" href="penjualan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Penjualan
                            </a>
                            <!-- <a class="nav-link" href="laporan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Laporan
                            </a> -->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#collapseLayoutsPenjualan" aria-expanded="false" aria-controls="collapseLayoutsPenjualan">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Laporan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutsPenjualan" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="laporan_penjualan.php">Penjualan</a>
                                    <a class="nav-link" href="laporan_pembelian.php">Pembelian</a>
                                    <div class="dropdown dropright">
                                    </div>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#collapseLayoutsMaster" aria-expanded="false" aria-controls="collapseLayoutsMaster">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Master
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutsMaster" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="m_barang.php">Barang</a>
                                    <a class="nav-link" href="m_supplier.php">Supplier</a>
                                    <a class="nav-link" href="m_user.php">User</a>
                                    <div class="dropdown dropright">
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
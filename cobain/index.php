<?php
require '../koneksi/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard - Admin</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>


<body>
    <!---NAVBAR--->
    <div class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #B0D9B1;">
            <!-- Navbar Brand/navbar atas-->
            <a class="navbar-brand ps-3" href="index.html">TOMASS</a>
            <!-- Sidebar Toggle/pembuka penutup navbar samping-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                    class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search..." aria-label="Search..."
                        aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                            class="fas fa-search"></i></button>
                </div>
            </form>

            <!-- Navbar/akun-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Pengaturan</a></li>
                        <li><a class="dropdown-item" href="#!">Keluar</a></li>
                    </ul>
                </li>
            </ul>
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
                            <a class="nav-link" href="index.php?halaman=pembelian">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="index.php?halaman=penjualan">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Penjualan
                            </a>
                            <a class="nav-link" href="index.php?halaman=laporan">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Laporan
                            </a>
                            <a class="nav-link" href="index.php?halaman=master_barang">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Master Barang
                            </a>
                            <a class="nav-link" href="index.php?halaman=master_supplier">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Master Supplier
                            </a>
                            <a class="nav-link" href="index.php?halaman=master_user">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Master User
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <div class="container-fluid px-4">
                    <?php
                    if (isset($_GET['halaman'])) {
                        if ($_GET['halaman'] == "barang masuk") {
                            include 'barang_masuk.php';
                        } elseif ($_GET['halaman'] == "penjualan") {
                            include 'penjualan.php';
                        } elseif ($_GET['halaman'] == "laporan") {
                            include 'laporan.php';
                        } elseif ($_GET['halaman'] == "master_barang") {
                            include 'm_barang.php';
                        } elseif ($_GET['halaman'] == "master_supplier") {
                            include 'm_supplier.php';
                        } elseif ($_GET['halaman'] == "master_user") {
                            include 'm_user.php';
                        } else {
                            include 'dashboard.php';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="../assets/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="../assets/js/datatables-simple-demo.js"></script>
</body>

</html>
<?php
session_start();

include("../koneksi/koneksi.php");

$user = isset($_SESSION['username']) && is_array($_SESSION['username']) ? $_SESSION['username'] : null;
$jumlah_barang_keranjang = 0;

if ($user) {
    $query_keranjang = mysqli_query($con, "SELECT * FROM keranjang WHERE id_user = '{$user['id_user']}'");
    $data_keranjang = mysqli_fetch_assoc($query_keranjang);

    $ppQuery = "SELECT pp FROM user WHERE id_user = '{$user['id_user']}'";
    $ppResult = mysqli_query($con, $ppQuery);

    if ($ppResult) {
        $ppData = mysqli_fetch_assoc($ppResult);

        if ($ppData['pp']) {
            $ppImage = base64_encode($ppData['pp']);
        } else {
            $ppImage = base64_encode(file_get_contents('https://bootdey.com/img/Content/avatar/avatar1.png'));
        }
    } else {
        $ppImage = base64_encode(file_get_contents('https://bootdey.com/img/Content/avatar/avatar1.png'));
    }


    if ($data_keranjang) {
        $query_detail_keranjang = mysqli_query($con, "SELECT SUM(jumlah) AS total_barang FROM detail_keranjang WHERE id_keranjang = '{$data_keranjang['id_keranjang']}'");
        $data_detail_keranjang = mysqli_fetch_assoc($query_detail_keranjang);
        $jumlah_barang_keranjang = $data_detail_keranjang['total_barang'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tomass</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../assets/image/logo.ico">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/nav.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <script src="https://kit.fontawesome.com/c79e220d71.js" crossorigin="anonymous"></script>

</head>

<body>
<nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:info@company.com">niswahayun8@gmail.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="https://api.whatsapp.com/send?phone=6285781937953">0857-8193-7953</a>
                </div>
                <div>
                    <a class="text-light" href="" target="_blank" rel="sponsored"><i class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="" target="_blank"><i class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="" target="_blank"><i class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="" target="_blank"><i class="fab fa-linkedin fa-sm fa-fw"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a href="../public/index.php">
                <img src="../assets/image/logoHeader.png" alt="">
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../public/home3.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../public/index.php">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../public/about.php">About</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex my-2">
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                        <i class="fa fa-fw fa-search text-dark mr-2"></i>
                    </a>
                    <a class="nav-icon position-relative text-decoration-none" href="../proses/keranjang.php">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                        <?php if ($jumlah_barang_keranjang > 0): ?>
                            <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"><?= $jumlah_barang_keranjang; ?></span>
                        <?php endif; ?>
                    </a>
                    <?php if ($user): ?>
                        <a class="nav-icon position-relative text-decoration-none" href="#" id="accountDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php if ($ppImage): ?>
                                <img src="data:image/jpeg;base64,<?php echo $ppImage; ?>" alt="Profile Picture" class="rounded-circle" width="30" height="30">
                            <?php else: ?>
                                <i class="fa fa-fw fa-user text-dark mr-3"></i>
                            <?php endif; ?>
                            <?= htmlspecialchars($user['username']); ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="accountDropdown">
                            <a class="dropdown-item" href="../proses/riwayat_pesanan.php">Pesanan saya</a>
                            <a class="dropdown-item" href="../proses/akun.php">setting</a>
                            <a class="dropdown-item" href="../proses/logout_proses.php">Logout</a>
                        </div>
                    <?php else: ?>
                        <a class="nav-icon position-relative text-decoration-none" href="#" id="accountDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-fw fa-user text-dark mr-3"></i>
                            <?php if ($jumlah_barang_keranjang > 0): ?>
                                <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"><?= $jumlah_barang_keranjang; ?></span>
                            <?php endif; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="accountDropdown">
                            <a class="dropdown-item" href="../public/login.php">Login</a>
                            <a class="dropdown-item" href="../public/login.php">Register</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Header -->

    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php" method="GET" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="query" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Popper Core library -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>

    <script src="../assets/jquery-1.11.0.min.js"></script>
    <script src="../assets/js/script.js"></script>

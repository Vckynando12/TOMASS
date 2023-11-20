<?php
session_start();
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
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/script.js"></script>

    <nav class="navbar navbar-expand-lg navbar-light bg-light navstyle">
    <div class="container-fluid mx-3 my-1">
        <a class="navbar-brand" href="#">TOMASS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            </ul>
                <form class="d-flex mx-auto" action="../public/index.php" method="GET">
                    <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search" style="width: 500px;">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            <ul class="navbar-nav ms-auto" id="userActions">
                <?php if (isset($_SESSION['username'])) : ?>
                    <li class="nav-item" id="cartIcon">
                        <a class="nav-link" href="../proses/keranjang.php">
                            <img src="../assets/image/cart.png" alt="Keranjang" style="height: 20px;">
                            <?php if ($jumlah_barang_keranjang > 0) : ?>
                                <span class="badge bg-danger"><?= htmlspecialchars($jumlah_barang_keranjang); ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item dropdown" id="accountDropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="accountText" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= htmlspecialchars($user['username']); ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="accountDropdown">
                            <a class="dropdown-item" href="../proses/logout_proses.php">Logout</a>
                        </div>
                    </li>
                <?php else : ?>
                    <li class="nav-item dropdown" id="accountDropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="accountText" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Login | Register
                        </a>
                        <div class="dropdown-menu" aria-labelledby="accountDropdown">
                            <a class="dropdown-item" href="../public/login.php">Login</a>
                            <a class="dropdown-item" href="#">Register</a>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
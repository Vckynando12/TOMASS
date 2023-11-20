<?php
include("../koneksi/koneksi.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php");
    exit();
}
$id_user_login = $_SESSION['user_id'];
$query_order_history = mysqli_query($con, "SELECT p.id_penjualan, p.tanggal_penjualan, p.total_penjualan
                                            FROM penjualan p
                                            WHERE p.id_user = '$id_user_login'
                                            ORDER BY p.tanggal_penjualan DESC");
$order_history = mysqli_fetch_all($query_order_history, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="keranjang.php">Keranjang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="riwayat_pesanan.php">Riwayat Pesanan</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <?php if ($order_history) : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal Pesanan</th>
                            <th>Total Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_history as $order) : ?>
                            <tr>
                                <td><strong><?= $order['tanggal_penjualan']; ?></strong></td>
                                <td><strong><?= $order['total_penjualan']; ?></strong></td>
                                <td><a href="../proses/struk.php?id_penjualan=<?= $order['id_penjualan']; ?>" class="btn btn-info">Lihat Pesanan</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>Belum ada riwayat pesanan.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

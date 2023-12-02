<?php
include("../koneksi/koneksi.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['login'])) {
    header('location: ../public/login.php');
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
    <style>
        body {
            background-color: #f8f9fa;
        }

        .nav-link {
            color: white;
        }

        .card {
            margin-top: 10px;
        }

        .card-header {
            background-color: #82ae46;
            color: #fff;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .btn-view-order {
            background-color: #007bff;
            /* Blue button color */
            border-color: #007bff;
            color: #fff;
        }
    </style>
</head>

<body>
        <?php
        include '../proses/header.php';
        ?>
        <div class="card text-center">
            <div class="card-body">
                <?php if ($order_history): ?>
                    <table class="table table-bordered table-striped"> <!-- Added Bootstrap table classes -->
                        <thead>
                            <tr>
                                <th>Tanggal Pesanan</th>
                                <th>Total Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order_history as $order): ?>
                                <tr>
                                    <td>
                                        <?= $order['tanggal_penjualan']; ?>
                                    </td>
                                    <td>Rp
                                        <?= number_format($order['total_penjualan']); ?>
                                    </td>
                                    <td>
                                        <a href="../proses/struk.php?id_penjualan=<?= $order['id_penjualan']; ?>"
                                            class="btn btn-info btn-view-order">Lihat Pesanan</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center">Belum ada riwayat pesanan.</p>
                <?php endif; ?>
            </div>
        </div>
</body>

</html>
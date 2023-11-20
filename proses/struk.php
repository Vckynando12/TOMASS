<?php
include("../koneksi/koneksi.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php");
    exit();
}

$id_user_login = $_SESSION['user_id'];
$query_penjualan = mysqli_query($con, "SELECT * FROM penjualan WHERE id_user = '$id_user_login' ORDER BY id_penjualan DESC LIMIT 1");
$penjualan = mysqli_fetch_assoc($query_penjualan);

if ($penjualan) {
    $id_penjualan = $penjualan['id_penjualan'];

    // $query_detail_penjualan = mysqli_query($con, "SELECT * FROM detail_penjualan WHERE id_penjualan = '$id_penjualan'");
    // $detail_penjualan = mysqli_fetch_all($query_detail_penjualan, MYSQLI_ASSOC);
    $query_detail_penjualan = mysqli_query($con, "SELECT dp.*, b.harga_jual, b.nama_barang FROM detail_penjualan dp
                                               INNER JOIN barang b ON dp.id_barang = b.id_barang
                                               WHERE dp.id_penjualan = '$id_penjualan'");
    $detail_penjualan = mysqli_fetch_all($query_detail_penjualan, MYSQLI_ASSOC);
    $query_pembayaran = mysqli_query($con, "SELECT * FROM pembayaran WHERE id_pembayaran = '$id_penjualan'");
    $pembayaran = mysqli_fetch_assoc($query_pembayaran);
    $status_pembayaran = ($pembayaran['status'] == '1') ? 'Disetujui' : 'Menunggu Persetujuan';
    $total_bayar = $pembayaran['total_bayar'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Struk Pembayaran</h2>

        <?php if ($penjualan) : ?>
            <p><strong>ID Penjualan:</strong> <?= $id_penjualan; ?></p>
            <p><strong>Tanggal Penjualan:</strong> <?= $penjualan['tanggal_penjualan']; ?></p>

            <h3>Daftar Pesanan</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($detail_penjualan as $index => $detail) : ?>
                    <tr>
                        <td><?= $index + 1; ?></td>
                        <td><?= $detail['nama_barang']; ?></td>
                        <td><?php echo isset($detail['harga_jual']) ? $detail['harga_jual'] : ''; ?></td>
                        <td><?= $detail['jumlah']; ?></td>
                        <td><?= $detail['subtotal']; ?></td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>

            <h3>Total Pembayaran: <?= $total_bayar; ?></h3>

            <p><strong>Status Pembayaran:</strong> <?= $status_pembayaran; ?></p>

            <p>Terima kasih telah berbelanja!</p>

            <a href="../proses/keranjang.php" class="btn btn-primary">Kembali Berbelanja</a>

        <?php else : ?>
            <p>Data penjualan tidak ditemukan.</p>
        <?php endif; ?>
    </div>
</body>
</html>

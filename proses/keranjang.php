<?php
include("../koneksi/koneksi.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php");
    exit();
}
$id_user_login = $_SESSION['user_id'];
$query_total_harga = mysqli_query($con, "SELECT SUM(total) AS total_harga FROM detail_keranjang WHERE id_keranjang IN (SELECT id_keranjang FROM keranjang WHERE id_user = $id_user_login)");
$total_harga_result = mysqli_fetch_assoc($query_total_harga);
$total_harga = $total_harga_result['total_harga'];
$query_keranjang = mysqli_query($con, "SELECT * FROM keranjang WHERE id_user = $id_user_login");
$keranjang = mysqli_fetch_assoc($query_keranjang);

if ($keranjang) {
    $id_keranjang = $keranjang['id_keranjang'];
    $query_detail_keranjang = mysqli_query($con, "SELECT dk.*, b.nama_barang, b.harga_jual, b.gambar FROM detail_keranjang dk
                                                   INNER JOIN barang b ON dk.id_barang = b.id_barang
                                                   WHERE dk.id_keranjang = '$id_keranjang'");
    $detail_keranjang = mysqli_fetch_all($query_detail_keranjang, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>  
    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="keranjang.php">keranjang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="riwayat_pesanan.php">Riwayat Pesanan</a>
            </li>
            </ul>
        </div>
        <div class="card-body">
        <?php if ($keranjang) : ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detail_keranjang as $detail) : ?>
                                <tr>
                                    <td><img src="data:image/jpeg;base64,<?= base64_encode($detail['gambar']); ?>" alt="Produk" style="max-width: 50px;"></td>
                                    <td><?= $detail['nama_barang']; ?></td>
                                    <td>
                                        <form action="../proses/update_cart.php" method="post">
                                            <input type="hidden" name="id_detail_keranjang" value="<?= $detail['id_detail_keranjang']; ?>">
                                            <input type="number" name="jumlah" value="<?= $detail['jumlah']; ?>" min="1">
                                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                                        </form>
                                    </td>
                                    <td><?= $detail['harga_jual']; ?></td>
                                    <td><?= $detail['total']; ?></td>
                                    <td>
                                        <a href="../proses/update_cart.php?id_detail_keranjang=<?= $detail['id_detail_keranjang']; ?>&action=delete" class="btn btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <p>Total Harga: <?= $total_harga; ?></p>

                    <form action="../proses/checkout.php" method="post">
                        <a href="../public/index.php" class="btn btn-primary">Lanjutkan Belanja</a>
                        <button type="submit" name="checkout" class="btn btn-success">Checkout</button>
                    </form>

                <?php else : ?>
                    <p>Keranjang belanja Anda kosong.</p>
                <?php endif; ?>
        </div>
    </div>
</body>
</html>

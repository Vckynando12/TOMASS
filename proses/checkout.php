<!-- DONE -->
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

$query_total_harga = mysqli_query($con, "SELECT SUM(total) AS total_harga FROM detail_keranjang WHERE id_keranjang IN (SELECT id_keranjang FROM keranjang WHERE id_user = $id_user_login)");
$total_harga_result = mysqli_fetch_assoc($query_total_harga);
$total_harga = $total_harga_result['total_harga'];

$query_keranjang = mysqli_query($con, "SELECT * FROM keranjang WHERE id_user = $id_user_login");
$keranjang = mysqli_fetch_assoc($query_keranjang);

if ($keranjang) {
    $id_keranjang = $keranjang['id_keranjang'];
    $query_detail_keranjang = mysqli_query($con, "SELECT dk.*, b.nama_barang, b.harga_jual FROM detail_keranjang dk
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
    <title>Checkout</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Checkout</h2>
        <?php if ($keranjang): ?>
            <h3 class="text-center">Daftar Pesanan</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Kuantitas</th>
                        <th scope="col">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detail_keranjang as $index => $detail): ?>
                        <tr>
                            <th scope="row">
                                <?= $index + 1; ?>
                            </th>
                            <td>
                                <?= $detail['nama_barang']; ?>
                            </td>
                            <td>
                                <?= number_format($detail['harga_jual']); ?>
                            </td>
                            <td>
                                <?= $detail['jumlah']; ?>
                            </td>
                            <td>
                                <?= number_format($detail['total']); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h4 class="text-center">Grand Total:
                <?= $total_harga; ?>
            </h4>

            <div class="row mt-5">
                <!-- Bagian Data Diri (Sebelah Kiri) -->
                <div class="col-md-6 mb-3">
                    <h4 class="title">Silahkan isi form di bawah ini</h4>
                    <form class="row g-3" action="../proses/proses_checkout.php" method="post"
                        enctype="multipart/form-data">
                        <div class="col-md-12">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>

                        <div class="col-md-12">
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <input type="text" class="form-control" id="provinsi" name="provinsi" required>
                        </div>

                        <div class="col-md-12">
                            <label for="kota" class="form-label">Kota</label>
                            <input type="text" class="form-control" id="kota" name="kota" required>
                        </div>

                        <div class="col-md-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                        </div>

                        <div class="col-md-12">
                            <label for="kode_pos" class="form-label">Kode Pos</label>
                            <input type="text" class="form-control" id="kode_pos" name="kode_pos" required>
                        </div>

                        <div class="col-md-12">
                            <label for="exampleInputFile" class="form-label">Bukti Transfer</label><br>
                            <!-- <input type="file" id="exampleInputFile" name="bukti_tf"> -->
                            <input type="file" id="exampleInputFile" name="bukti_tf">
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary" name="order_now">Order Now</button>
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="window.location.href='../proses/keranjang.php'">Cancel</button>
                        </div>
                    </form>
                </div>

                <!-- Bagian Rincian Pembayaran (Sebelah Kanan) -->
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">Rincian Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Nominal Pembayaran:
                                    <?= number_format($total_harga); ?>
                                </li>
                                <li class="list-group-item text-primary">Nominal Transfer:
                                    <?= number_format($total_harga); ?>
                                </li>
                                <li class="list-group-item">Nomor rekening:
                                    <ul>
                                        <li>BCA : 2630833518</li>
                                        <li>Nama : DIMAS FAJAR KATON PRAYOGO</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
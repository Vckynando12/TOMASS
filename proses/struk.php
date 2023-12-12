<?php
session_start();
include("../koneksi/koneksi.php");

if (!isset($_SESSION['login'])) {

    header('location: ../public/login.php');

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

    $status_pembayaran = ($pembayaran['status'] == '1') ? 'Disetujui' : (($pembayaran['status'] == '2') ? 'Ditolak' : 'Menunggu Persetujuan');

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

    <link rel="stylesheet" href="../assets/css/struk.css">

</head>



<body>

    <div class="container mt-5 mb-3">

        <div class="d-flex justify-content-center mb-3">

            <img src="../assets/image/logoHeader.png" alt="Logo Toko" width="150">

        </div>

        <h5 class="text-center">Struk Pembayaran</h5>



        <?php if ($penjualan): ?>

            <p class="mb-3"><strong>ID Penjualan:</strong>

                <?= $id_penjualan; ?>

            </p>

            <p class="mb-3"><strong>Tanggal Penjualan:</strong>

                <?= $penjualan['tanggal_penjualan']; ?>

            </p>



            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>No</th>

                        <!-- <th>Gambar</th> -->

                        <th>Nama Barang</th>

                        <th>Harga</th>

                        <th>Qty</th>

                        <th>Sub Total</th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($detail_penjualan as $index => $detail): ?>

                        <tr>

                            <td>

                                <?= $index + 1; ?>

                            </td>
                            <td>

                                <?= $detail['nama_barang']; ?>

                            </td>

                            <td>

                                <?php echo isset($detail['harga_jual']) ? $detail['harga_jual'] : ''; ?>

                            </td>

                            <td>

                                <?= $detail['jumlah']; ?>

                            </td>

                            <td>

                                <?= $detail['subtotal']; ?>

                            </td>

                        </tr>

                    <?php endforeach; ?>



                </tbody>

            </table>

            <hr>

            <h4 class="text-center">Total Pembayaran:

                <?= $total_bayar; ?>

            </h4>

            <hr>

            <p class="text-center"><strong>Status Pesanan:</strong>

                <?= $status_pembayaran; ?>

            </p>

            <p class="text-center">Terima kasih telah berbelanja!</p>

            <a href="../public/index.php" class="btn btn-primary">Kembali Berbelanja</a>



        <?php else: ?>

            <p class="text-center">Data penjualan tidak ditemukan.</p>

        <?php endif; ?>

    </div>

</body>



</html>
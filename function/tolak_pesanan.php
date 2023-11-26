<?php
include("../koneksi/koneksi.php");

if (isset($_POST['id_penjualan'])) {
    $idPenjualan = $_POST['id_penjualan'];

    $queryUpdateStatus = mysqli_query($con, "UPDATE pembayaran SET status = '2' WHERE id_pembayaran = '$idPenjualan'");

    if ($queryUpdateStatus) {
        echo "Pesanan dengan ID $idPenjualan berhasil ditolak.";
    } else {
        echo "Gagal menolak pesanan.";
    }
} else {
    echo "Parameter id_penjualan tidak ditemukan.";
}
?>

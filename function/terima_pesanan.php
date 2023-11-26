<?php
include("../koneksi/koneksi.php");

if (isset($_POST['id_penjualan'])) {
    $idPenjualan = $_POST['id_penjualan'];

    $queryUpdateStatus = mysqli_query($con, "UPDATE pembayaran SET status = '1' WHERE id_pembayaran = '$idPenjualan'");

    if ($queryUpdateStatus) {
        echo "Pesanan dengan ID $idPenjualan berhasil diterima.";
    } else {
        echo "Gagal menerima pesanan.";
    }
} else {
    echo "Parameter id_penjualan tidak ditemukan.";
}
?>

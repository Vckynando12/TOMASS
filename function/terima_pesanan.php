<?php
include("../koneksi/koneksi.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['login'])) {
    header('location: ../public/login.php');
    exit();
}
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

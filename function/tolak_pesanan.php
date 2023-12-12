<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    echo "<script>window.location.href = '../public/login.php';</script>";
    exit();
}

include("../koneksi/koneksi.php");


if (isset($_POST['id_penjualan'])) {

    $idPenjualan = $_POST['id_penjualan'];



    // Ambil detail penjualan

    $queryDetailPenjualan = mysqli_query($con, "SELECT * FROM detail_penjualan WHERE id_penjualan = '$idPenjualan'");

    $detailPenjualan = mysqli_fetch_all($queryDetailPenjualan, MYSQLI_ASSOC);



    // Tambahkan kembali jumlah barang yang sebelumnya dikurangkan

    foreach ($detailPenjualan as $detail) {

        $idBarang = $detail['id_barang'];

        $jumlah = $detail['jumlah'];



        // Ambil stok saat ini

        $queryStok = mysqli_query($con, "SELECT stok FROM barang WHERE id_barang = '$idBarang'");

        $stokSekarang = mysqli_fetch_assoc($queryStok)['stok'];



        // Tambahkan jumlah barang yang dikembalikan

        $newStok = $stokSekarang + $jumlah;



        // Update stok barang di database

        mysqli_query($con, "UPDATE barang SET stok = '$newStok' WHERE id_barang = '$idBarang'");

    }



    // Update status pesanan menjadi ditolak

    $queryUpdateStatus = mysqli_query($con, "UPDATE pembayaran SET status = '2' WHERE id_pembayaran = '$idPenjualan'");



    if ($queryUpdateStatus) {

        echo "Pesanan dengan ID $idPenjualan berhasil ditolak dan jumlah barang dikembalikan.";

    } else {

        echo "Gagal menolak pesanan.";

    }

} else {

    echo "Parameter id_penjualan tidak ditemukan.";

}

?>


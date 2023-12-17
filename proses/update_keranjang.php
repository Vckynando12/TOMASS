<?php
session_start();
include("../koneksi/koneksi.php");

$user = isset($_SESSION['username']) && is_array($_SESSION['username']) ? $_SESSION['username'] : null;

$jumlah_barang_keranjang = 0;

if ($user) {
    $query_keranjang = mysqli_query($con, "SELECT * FROM keranjang WHERE id_user = '{$user['id_user']}'");
    $data_keranjang = mysqli_fetch_assoc($query_keranjang);

    if ($data_keranjang) {
        $query_detail_keranjang = mysqli_query($con, "SELECT SUM(jumlah) AS total_barang FROM detail_keranjang WHERE id_keranjang = '{$data_keranjang['id_keranjang']}'");
        $data_detail_keranjang = mysqli_fetch_assoc($query_detail_keranjang);
        $jumlah_barang_keranjang = $data_detail_keranjang['total_barang'];
    }
}

echo json_encode(['success' => true, 'itemCount' => $jumlah_barang_keranjang]);
?>

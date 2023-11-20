<?php
session_start();
include('../koneksi/koneksi.php');

if (isset($_POST['update'])) {
    $id_detail_keranjang = $_POST['id_detail_keranjang'];
    $jumlah = $_POST['jumlah'];

    if ($jumlah < 1) {
        $jumlah = 1;
    }
    $queryGetProduct = mysqli_query($con, "SELECT b.harga_jual FROM detail_keranjang dk
                                            INNER JOIN barang b ON dk.id_barang = b.id_barang
                                            WHERE dk.id_detail_keranjang = '$id_detail_keranjang'");
    $dataProduct = mysqli_fetch_assoc($queryGetProduct);
    $total_harga = $jumlah * $dataProduct['harga_jual'];
    $queryUpdate = mysqli_query($con, "UPDATE detail_keranjang SET jumlah = '$jumlah', total = '$total_harga' WHERE id_detail_keranjang = '$id_detail_keranjang'");
    $queryGetCartId = mysqli_query($con, "SELECT id_keranjang FROM detail_keranjang WHERE id_detail_keranjang = '$id_detail_keranjang'");
    $dataCartId = mysqli_fetch_assoc($queryGetCartId);
    $queryCalculateTotal = mysqli_query($con, "SELECT SUM(total) as total_harga FROM detail_keranjang WHERE id_keranjang = '$dataCartId[id_keranjang]'");
    $totalHargaResult = mysqli_fetch_assoc($queryCalculateTotal);
    $totalHarga = $totalHargaResult['total_harga'];

    mysqli_query($con, "UPDATE keranjang SET total_harga = '$totalHarga' WHERE id_keranjang = '$dataCartId[id_keranjang]'");
}

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id_detail_keranjang'])) {
    $id_detail_keranjang = $_GET['id_detail_keranjang'];
    $queryDelete = mysqli_query($con, "DELETE FROM detail_keranjang WHERE id_detail_keranjang = '$id_detail_keranjang'");
}

header('Location: keranjang.php');
exit();
?>
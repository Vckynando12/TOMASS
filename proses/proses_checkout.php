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
    $query_detail_keranjang = mysqli_query($con, "SELECT dk.*, b.nama_barang, b.harga_jual FROM detail_keranjang dk
                                                   INNER JOIN barang b ON dk.id_barang = b.id_barang
                                                   WHERE dk.id_keranjang = '$id_keranjang'");
    $detail_keranjang = mysqli_fetch_all($query_detail_keranjang, MYSQLI_ASSOC);

    // Proses checkout
    $nama = mysqli_real_escape_string($con, $_POST['nama']);
    $provinsi = mysqli_real_escape_string($con, $_POST['provinsi']);
    $kota = mysqli_real_escape_string($con, $_POST['kota']);
    $alamat = mysqli_real_escape_string($con, $_POST['alamat']);
    $kode_pos = mysqli_real_escape_string($con, $_POST['kode_pos']);

    // Insert the "nama" into the detail_penjualan table
    $query_insert_penjualan = mysqli_query($con, "INSERT INTO penjualan (id_user, tanggal_penjualan, total_penjualan) VALUES ('$id_user_login', NOW(), '$total_harga')");
    $id_penjualan = mysqli_insert_id($con); 

    foreach ($detail_keranjang as $detail) {
        $id_barang = $detail['id_barang'];
        $jumlah = $detail['jumlah'];
        $subtotal = $detail['total'];

        mysqli_query($con, "INSERT INTO detail_penjualan (id_penjualan, id_barang, jumlah, subtotal, provinsi, kota, alamat, kode_pos, nama) VALUES ('$id_penjualan', '$id_barang', '$jumlah', '$subtotal', '$provinsi', '$kota', '$alamat', '$kode_pos', '$nama')");
    }

    mysqli_query($con, "INSERT INTO pembayaran (id_pembayaran, tgl_bayar, total_bayar, status) VALUES ('$id_penjualan', NOW(), '$total_harga', '0')");
    mysqli_query($con, "DELETE FROM keranjang WHERE id_keranjang = '$id_keranjang'");
    mysqli_query($con, "DELETE FROM detail_keranjang WHERE id_keranjang = '$id_keranjang'");

    header("Location: ../proses/struk.php?id_penjualan=$id_penjualan");
    exit();

} else {
    echo "Keranjang belanja Anda kosong.";
}
?>

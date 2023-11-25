<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['login'])) {
    header('location: ../public/login.php');
    exit();
}
require '../koneksi/koneksi.php';
// HAPUS BARANG
if (isset($_GET['hapus_kode'])) {
    $id_barang_hapus = $_GET['hapus_kode'];

    $delete_query = "DELETE FROM barang WHERE id_barang = '$id_barang_hapus'";
    $delete_result = mysqli_query($con, $delete_query);

    if ($delete_result) {
        header("Location: ../admin/m_barang.php");
        exit();
    } else {
        echo "Gagal menghapus barang.";
    }
}
?>
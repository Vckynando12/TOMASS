<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    echo "<script>window.location.href = '../public/login.php';</script>";
    exit();
}

require '../koneksi/koneksi.php';

// FUNGSI BARANG



$randomNumber = rand(100, 999);

$format = "B" . $randomNumber;



//Menambah Barang Baru 

if (isset($_POST['kirim'])) {

    $nama_barang = $_POST['nama_barang'];

    $harga_jual = $_POST['harga_jual'];

    $harga_beli = $_POST['harga_beli'];

    $stok = $_POST['stok'];

    $satuan = $_POST['satuan'];

    $id_barang = $format;



    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {

        $gambar_temp = $_FILES['gambar']['tmp_name'];

        $gambar = addslashes(file_get_contents($gambar_temp));

    } else {

        echo "Upload gambar gagal.";

        exit();

    }



    $addtotable = mysqli_query($con, "INSERT INTO barang (id_barang, nama_barang, harga_jual, harga_beli, stok, satuan, gambar) VALUES ('$id_barang','$nama_barang','$harga_jual','$harga_beli','$stok','$satuan','$gambar')");



    if ($addtotable) {

        header('location: ../admin/m_barang.php');

    } else {

        echo 'Gagal';

        header('location:../admin/m_barang.php');

    }

}

?>


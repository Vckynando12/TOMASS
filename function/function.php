<?php
require '../koneksi/koneksi.php';

//Menambah Barang 
if (isset($_POST['addnewbarang'])) {
    $nama_barang = $_POST['nama_barang'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    $satuan = $_POST['satuan'];
    $gambar = $_POST['gambar'];

    $addtotable = mysqli_query($con, "insert into barang (nama_barang, harga_jual, harga_beli, stok, satuan, gambar) values ('$nama_barang','$harga_jual','$harga_beli','$stok','$satuan','$gambar')");
    if ($addtotable) {
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}
?>
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











// Menambahkan barang baru
//if (isset($_POST['kirim'])) {
//$nama_barang = $_POST['nama_barang'];
//$harga_jual = $_POST['harga_jual'];
//$harga_beli = $_POST['harga_beli'];
//$stok = $_POST['stok'];
//$satuan = $_POST['satuan'];
// $gambar = $_POST['gambar'];

// $addtotable = mysqli_query($con, "insert into pembelian(tanggal_pembelian,id_user,id_supplier,total_pembelian)
values('','$tanggal_pembelian','$id_user','$id_supplier','$total_pembelian')");
// if ($addtootable) {
// header('location:masuk.php');
// } else {
// echo 'Gagal';
// header('location:masuk.php');
// }
//}



//if (isset($_POST['kirim'])) {
//$temp = '../produk/';
//$id_barang = $_POST['id_barang'];
//$nama_barang = $_POST['nama_barang'];
//$harga_jual = $_POST['harga_jual'];
//$harga_beli = $_POST['harga_beli'];
//$stok = $_POST['stok'];
//$satuan = $_POST['satuan'];
//$img = $_FILES['gambar']['name'];
//move_uploaded_file($_FILES['gambar']['tmp_name'], $temp . $img);
//$sql = $con->query("INSERT INTO barang
VALUES('','$nama_barang','$harga_jual','$harga_beli','$stok','$satuan','$img')");
//if ($sql) {
// echo "
<script>alert('Data berhasil disimpan');</script>";
//} else {
// echo "
<script>alert('Data gagal disimpan');</script>";
// }

//}
?>
<?php
require '../koneksi/koneksi.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['login'])) {
    header('location: ../public/login.php');
    exit();
}

// if (isset($_GET['kode'])) {
//     $id_barang = $_GET['kode'];
//     $product = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM barang WHERE id_barang = '$id_barang'"));

//     if (!$product) {
//         echo "Barang tidak ditemukan.";
//         exit();
//     }
// } else {
//     echo "ID produk tidak tersedia.";
//     exit();
// }

// if (isset($_POST['update_produk'])) {
//     $nama_barang = $_POST['nama_barang'];
//     $harga_jual = $_POST['harga_jual'];
//     $harga_beli = $_POST['harga_beli'];
//     $stok = $_POST['stok'];
//     $satuan = $_POST['satuan'];
//     $gambar_temp = $_FILES['gambar']['tmp_name'];

//     if (!empty($gambar_temp)) {
//         $gambar = addslashes(file_get_contents($gambar_temp));
//         $update_query = "UPDATE barang SET nama_barang = '$nama_barang', harga_jual = '$harga_jual', harga_beli = '$harga_beli', stok = '$stok', satuan = '$satuan', gambar = '$gambar' WHERE id_barang = '$id_barang'";
//     } else {
//         $update_query = "UPDATE barang SET nama_barang = '$nama_barang', harga_jual = '$harga_jual', harga_beli = '$harga_beli', stok = '$stok', satuan = '$satuan' WHERE id_barang = '$id_barang'";
//     }

//     $result = mysqli_query($con, $update_query);

//     if ($result) {
//         // echo "<script>window.location.href = '../admin/m_barang.php';</script>";
//         exit();
//     } else {
//         echo "Gagal memperbarui produk.";
//     }
// }

// EDIT BARANG
if (isset($_GET['kode'])) {
    $id_barang = $_GET['kode'];
    // var_dump($id_barang);
    $query = mysqli_query($con, "SELECT * FROM barang WHERE id_barang = '$id_barang'");
    $product = mysqli_fetch_assoc($query);

    if (!$product) {
        echo "Barang tidak ditemukan.";
        exit();
    }
} else {
    echo "ID produk tidak tersedia.";
    exit();
}

if (isset($_POST['update_produk'])) {
    $nama_barang = $_POST['nama_barang'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    $satuan = $_POST['satuan'];
    $gambar_temp = $_FILES['gambar']['tmp_name'];

    if (!empty($gambar_temp)) {
        $gambar = addslashes(file_get_contents($gambar_temp));
        $update_query = "UPDATE barang SET nama_barang = '$nama_barang', harga_jual = '$harga_jual', harga_beli = '$harga_beli', stok = '$stok', satuan = '$satuan', gambar = '$gambar' WHERE id_barang = '$id_barang'";
    } else {
        $update_query = "UPDATE barang SET nama_barang = '$nama_barang', harga_jual = '$harga_jual', harga_beli = '$harga_beli', stok = '$stok', satuan = '$satuan' WHERE id_barang = '$id_barang'";
    }

    $result = mysqli_query($con, $update_query);

    if ($result) {
        echo "<script>window.location.href = '../admin/m_barang.php';</script>";
        exit();
    } else {
        echo "Gagal memperbarui produk.";
    }
}

?>
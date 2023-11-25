<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login'])) {
    header('location: ../public/login.php');
    exit();
}

// include '../layout/header.php';
require '../koneksi/koneksi.php';

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$randomNumber = rand(10, 9999);
$id_pembelian = "PB" . $randomNumber;
$randomNumber2 = rand(10, 9999);
$id_detail_pembelian = "DP" . $randomNumber2;

$resultSupplier = mysqli_query($con, "SELECT * FROM supplier");

if (isset($_POST['add_pembelian'])) {
    $id_user_login = $_SESSION['user_id'];
    $id_supplier = $_POST['id_supplier'];
    $tanggal_pembelian = $_POST['tanggal_pembelian'];
    $total_pembelian = 10;

    // Use multi-query to insert into 'pembelian' and 'detail_pembelian' tables
    $query = "INSERT INTO pembelian (id_pembelian, tanggal_pembelian, id_user, id_supplier, total_pembelian) 
              VALUES ('$id_pembelian', '$tanggal_pembelian', '$id_user_login', '$id_supplier', '$total_pembelian');";

    $query .= "INSERT INTO detail_pembelian (id_detail_pembelian, id_pembelian, id_barang, nama_barang, tanggal_kadaluarsa, jumlah, subtotal) 
               VALUES ('$id_detail_pembelian', '$id_pembelian', '$id_barang', '$nama_barang', '$tanggal_kadaluarsa', '$jumlah', '$subtotal');";

    // Execute the multi-query
    $result = mysqli_multi_query($con, $query);

    if ($result) {
        echo json_encode(['success' => true, 'id_pembelian' => $id_pembelian]);

        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menambahkan pembelian.']);
        exit();
    }
}
?>
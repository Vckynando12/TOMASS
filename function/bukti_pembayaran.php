<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    echo "<script>window.location.href = '../public/login.php';</script>";
    exit();
}

require '../koneksi/koneksi.php';

if (isset($_GET['id_penjualan'])) {

    $id_penjualan = $_GET['id_penjualan'];



    $query_pembayaran = mysqli_query($con, "SELECT * FROM pembayaran WHERE id_pembayaran = '$id_penjualan'");

    $pembayaran = mysqli_fetch_assoc($query_pembayaran);



    if ($pembayaran && !empty($pembayaran['bukti_tf'])) {

        $base64Image = base64_encode($pembayaran['bukti_tf']);

        $imgSrc = "data:image/jpeg;base64,{$base64Image}";

        echo "<div style='display: flex; justify-content: center; align-items: center; height: 100vh;'>";

        echo "<img src='{$imgSrc}' style='max-height: 600px; max-width: 600px; width: auto; height: auto; object-fit: cover; item' alt='Bukti Pembayaran'>";

        echo "</div>";

    } else {

        echo "Bukti pembayaran tidak ditemukan.";

    }

} else {

    echo "Parameter id_penjualan tidak ditemukan.";

}

?>



<?php

// if (session_status() == PHP_SESSION_NONE) {

//     session_start();

// }

// if (!isset($_SESSION['login'])) {

//     header('location: ../public/login.php');

//     exit();

// }

// require '../koneksi/koneksi.php';



// if (isset($_GET['id_penjualan'])) {

//     $id_penjualan = $_GET['id_penjualan'];



//     $query_pembayaran = mysqli_query($con, "SELECT * FROM pembayaran WHERE id_pembayaran = '$id_penjualan'");

//     $pembayaran = mysqli_fetch_assoc($query_pembayaran);



//     if ($pembayaran && !empty($pembayaran['bukti_tf'])) {

//         // Tentukan jenis konten sebagai gambar JPEG

//         header('Content-Type: image/jpeg');

        

//         // Tetapkan nama file sebagai "bukti_pembayaran.jpg"

//         header('Content-Disposition: attachment; filename="bukti_pembayaran.jpg');



//         // Encode data blob menjadi base64 sebelum dikirimkan

//         echo base64_encode($pembayaran['bukti_tf']);

//     } else {

//         echo "Bukti pembayaran tidak ditemukan.";

//     }

// } else {

//     echo "Parameter id_penjualan tidak ditemukan.";

// }

// ?>








<?php
session_start();
include('../koneksi/koneksi.php');

if (!isset($_SESSION['login'])) {

    $response['success'] = false;

    $response['message'] = 'Harap login terlebih dahulu.';

    $response['redirect'] = '../public/login.php';

    echo json_encode($response);

    die();

}

if (isset($_POST['productId']) && isset($_POST['quantity'])) {

    if (!isset($_SESSION['cart_request_in_progress']) || !$_SESSION['cart_request_in_progress']) {

        $_SESSION['cart_request_in_progress'] = true;

        $productId = $_POST['productId'];

        $quantity = $_POST['quantity'];

        $queryCheck = mysqli_query($con, "SELECT * FROM keranjang WHERE id_user = '$_SESSION[user_id]'");

        $dataKeranjang = mysqli_fetch_assoc($queryCheck);



        if ($dataKeranjang) {

            $idKeranjang = $dataKeranjang['id_keranjang'];

            $queryCalculateTotal = mysqli_query($con, "SELECT SUM(total) as total_harga FROM detail_keranjang WHERE id_keranjang = '$idKeranjang'");

            $totalHargaResult = mysqli_fetch_assoc($queryCalculateTotal);

            $totalHarga = $totalHargaResult['total_harga'];



            mysqli_query($con, "UPDATE keranjang SET total_harga = '$totalHarga' WHERE id_keranjang = '$idKeranjang'");

            

            $queryCheckItem = mysqli_query($con, "SELECT * FROM detail_keranjang WHERE id_keranjang = '$idKeranjang' AND id_barang = '$productId'");

            $dataItem = mysqli_fetch_assoc($queryCheckItem);



            if ($dataItem) {

                $newQuantity = $dataItem['jumlah'] + $quantity;

                $queryUpdateCart = mysqli_query($con, "UPDATE detail_keranjang SET jumlah = '$newQuantity', total = jumlah * (SELECT harga_jual FROM barang WHERE id_barang = '$productId') WHERE id_keranjang = '$idKeranjang' AND id_barang = '$productId'");

                

            } else {

                $queryAddToCart = mysqli_query($con, "INSERT INTO detail_keranjang (id_keranjang, id_barang, jumlah, total) VALUES ('$idKeranjang', '$productId', '$quantity', '$quantity' * (SELECT harga_jual FROM barang WHERE id_barang = '$productId'))");

            }

        } else {

            $totalHarga = 0;

            $queryCreateCart = mysqli_query($con, "INSERT INTO keranjang (id_user, total_harga) VALUES ('$_SESSION[user_id]', '$totalHarga')");

            $idKeranjang = mysqli_insert_id($con);

            $queryAddToCart = mysqli_query($con, "INSERT INTO detail_keranjang (id_keranjang, id_barang, jumlah, total) VALUES ('$idKeranjang', '$productId', '$quantity', '$quantity' * (SELECT harga_jual FROM barang WHERE id_barang = '$productId'))");

        }

        $_SESSION['cart_request_in_progress'] = false;

    }

    $response['success'] = true;

    $response['message'] = 'Barang berhasil ditambahkan ke keranjang.';



    echo json_encode($response);

    die();

} else {

    $response['success'] = false;

    $response['message'] = 'Parameter tidak lengkap.';

    echo json_encode($response);

    die();

}

?>
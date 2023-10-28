<?php
<<<<<<< HEAD
error_reporting(1);
$server = "localhost";
$username = "root";
$password = "";
$db = "tomas";
$koneksi = mysqli_connect($server, $username, $password, $db);
//pastikan urutan pemanggilan variabel nya sama.

//untuk cek jika koneksi gagal ke database
if(mysqli_connect_errno()) {
    echo "Koneksi gagal : ".mysqli_connect_error();
}else{
    echo"koneksi berhasil";
}
=======
    $con = mysqli_connect("localhost", "root", "", "tomass");

    //Check connection
    if (mysqli_connect_errno()) {
        echo "Tidak terhubung ke MySQL".mysqli_connect_errno();
        exit();
    }
>>>>>>> 2103b3e1d9d1b8e7f69def37950feb4cebc809e4
?>
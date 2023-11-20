<?php
include("../koneksi/koneksi.php");

$search_query = isset($_GET['query']) ? mysqli_real_escape_string($con, $_GET['query']) : '';
$query_products = mysqli_query($con, "SELECT * FROM barang WHERE nama_barang LIKE '%$search_query%'");
$products = mysqli_fetch_all($query_products, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
<?php 
include '../proses/header.php';
include '../public/home.php';
?>
</body>
</html>
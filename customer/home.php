<?php
    //require '../proses/session.php';
    session_start();
    // if($_SESSION['login']==false){
    //     header("location: ../proses/login_proses.php");
    // }
    include '../public/header1.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOMASS | Toko Bahan Kue Murah Meriah</title>
    <link rel="stylesheet" href="../assets/css/header.css">
</head>
<body>
    <h2>Halo <?php echo $_SESSION['username']; ?></h2>
    <button><a href="../proses/login_proses.php">logout
    </button>
</body>
</html>
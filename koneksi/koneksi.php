<?php
    $con = mysqli_connect("localhost", "mifbmyh1_tomass", "WSImif2023", "mifbmyh1_tomass");
    if (mysqli_connect_errno()) {
        echo "Tidak terhubung ke MySQL".mysqli_connect_errno();
        exit();
    }
?>
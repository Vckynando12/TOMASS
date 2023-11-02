<?php

    $con = mysqli_connect("localhost", "root", "", "tomas");

    //Check connection
    if (mysqli_connect_errno()) {
        echo "Tidak terhubung ke MySQL".mysqli_connect_errno();
        exit();
    }
?>

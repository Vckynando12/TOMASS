<?php
    session_start();
    if($_SESSION['login']==false){
        header('location: login_proses.php');
    }
?>

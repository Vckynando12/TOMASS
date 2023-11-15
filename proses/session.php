<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('../proses/login_proses.php');
    exit; // Penting untuk menghentikan eksekusi kode selanjutnya setelah mengarahkan pengguna.
}
?>
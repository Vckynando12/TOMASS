<?php
include '../layout/header.php';
require '../koneksi/koneksi.php';

?>

<div id="layoutSidenav_content">
    <div class="container-fluid px-4">
        <h2 class="mt-4">Detail Barang Masuk</h2>

        <?php
        // Periksa apakah kunci 'id_pembelian' ada dan tidak kosong di $_GET
        if (isset($_GET['id_pembelian']) && !empty($_GET['id_pembelian'])) {
            // Gunakan mysqli_real_escape_string untuk mencegah SQL injection
            $id_pembelian = $con->real_escape_string($_GET['id_pembelian']);

            $ambil = $con->query("SELECT * FROM pembelian JOIN supplier ON pembelian.id_supplier=supplier.id_supplier WHERE pembelian.id_pembelian='$id_pembelian'");

            // Periksa apakah ada hasil yang ditemukan
            if ($ambil->num_rows > 0) {
                $detail = $ambil->fetch_assoc();
                // Tambahkan logika Anda di sini untuk menampilkan detail barang masuk
                echo '<pre>';
                print_r($detail);
                echo '</pre>';
            } else {
                echo 'Pembelian tidak ditemukan';
            }
        } else {
            echo 'ID Pembelian tidak valid';
        }
        ?>
    </div>
</div>
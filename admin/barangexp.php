<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    echo "<script>window.location.href = '../public/login.php';</script>";
    exit();
}

include '../layout/header.php';

require '../koneksi/koneksi.php';

?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<div id="layoutSidenav_content">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Barang Kadaluarsa</h1>
	<ol class="breadcrumb mb-4">

            <li class="breadcrumb-item active">Barang kadaluarsa</li>

        </ol>
        <hr>
        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple" class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Tanggal Kadaluarsa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $resultkadaluarsa = mysqli_query($con, "SELECT barang_kadaluarsa.*, barang.nama_barang, jumlah_barang
                        FROM barang_kadaluarsa
                        JOIN barang ON barang_kadaluarsa.id_barang = barang.id_barang");

                        while ($rowexpired = mysqli_fetch_assoc($resultkadaluarsa)) {
                            echo "<tr>";
                            echo "<td>{$rowexpired['id_barang_kadaluarsa']}</td>";
                            echo "<td>{$rowexpired['id_barang']}</td>";
                            echo "<td>{$rowexpired['nama_barang']}</td>";
                            echo "<td>{$rowexpired['jumlah_barang']}</td>";
                            echo "<td>{$rowexpired['tanggal_kadaluarsa']}</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

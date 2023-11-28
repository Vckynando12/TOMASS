<?php
require '../koneksi/koneksi.php';

if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
    $result = mysqli_query($con, "SELECT * FROM barang WHERE id_barang LIKE '%$keyword%' OR nama_barang LIKE '%$keyword%'");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='barang-item' data-id_barang='{$row['id_barang']}' data-nama_barang='{$row['nama_barang']}'>{$row['nama_barang']}</div>";
        }
    } else {
        echo "Barang tidak ditemukan. <a href='m_barang.php'>Tambah Barang</a>";
    }
}
?>

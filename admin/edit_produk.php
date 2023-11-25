<!-- DONE -->

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['login'])) {
    header('location: ../public/login.php');
    exit();
}
include '../layout/header.php';
require '../koneksi/koneksi.php';

if (isset($_GET['kode'])) {
    $id_barang = $_GET['kode'];
    $product = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM barang WHERE id_barang = '$id_barang'"));

    if (!$product) {
        echo "Barang tidak ditemukan.";
        exit();
    }
} else {
    echo "ID produk tidak tersedia.";
    exit();
}
?>
<div id="layoutSidenav_content">
    <div class="container-fluid px-4">
        <h1>Edit Barang</h1>
        <form action="../function/edit.php?kode=<?= $product['id_barang']; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" class="form-control" name="nama_barang" value="<?= $product['nama_barang']; ?>" required>
            </div>
            <div class="form-group">
                <label for="harga_jual">Harga Jual</label>
                <input type="number" class="form-control" name="harga_jual" value="<?= $product['harga_jual']; ?>" required>
            </div>
            <div class="form-group">
                <label for="harga_beli">Harga Beli</label>
                <input type="number" class="form-control" name="harga_beli" value="<?= $product['harga_beli']; ?>" required>
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" class="form-control" name="stok" value="<?= $product['stok']; ?>" required>
            </div>
            <div class="form-group">
                <label for="satuan">Satuan</label>
                <input type="text" class="form-control" name="satuan" value="<?= $product['satuan']; ?>" required>
            </div>
            <div class="form-group">
                <label for="gambar">Gambar</label>
                <input type="file" class="form-control" name="gambar">
            </div>
            <div class="form-group">
                <img src="data:image/jpeg;base64,<?= base64_encode($product['gambar']); ?>" alt="Product Image" style="max-width: 200px;">
            </div>
            <button type="submit" class="btn btn-primary" name="update_produk">Update Barang</button>
        </form>
    </div>
</div>
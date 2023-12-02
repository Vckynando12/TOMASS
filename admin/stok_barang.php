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
// Generate kode material
$Kode_barang = mysqli_query($con, "SELECT id_barang FROM barang ORDER BY id_barang DESC");
$data = mysqli_fetch_assoc($Kode_barang);
$randomNumber = rand(100, 9999);
$format = "B" . $randomNumber;
?>
<div id="layoutSidenav_content">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Stok Barang Hampir Habis</h1>
        <hr>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">
            Tambah
        </button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode Barang</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Harga Jual</th>
                    <th scope="col">Harga Beli</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($con, "SELECT * FROM barang WHERE stok <= 10");
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td>
                            <?= $no; ?>
                        </td>
                        <td>
                            <?= $row['id_barang']; ?>
                        </td>
                        <td>
                            <?= $row['nama_barang']; ?>
                        </td>
                        <td>Rp.
                            <?= number_format($row['harga_jual']); ?>
                        </td>
                        <td>Rp.
                            <?= number_format($row['harga_beli']); ?>
                        </td>
                        <td>
                            <?= $row['stok']; ?>
                        </td>
                        <td>
                            <?= $row['satuan']; ?>
                        </td>
                        <td><img src="data:image/jpeg;base64,<?= base64_encode($row['gambar']); ?>" width="100"></td>
                        <td>
                            <a href="edit_produk.php?kode=<?= $row['id_barang']; ?>" class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i>Edit</a>
                            <a href="../function/hapus.php?hapus_kode=<?= $row['id_barang']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus barang?')">Hapus</a>
                        </td>
                    </tr>
                    <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Tambah Barang Masuk</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form method="post" action="../function/tambah.php" enctype="multipart/form-data">
        <div class="modal-body">
          <label for="exampleInputEmail1">Kode Barang</label>
          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Produk" disabled value="<?= $format; ?>">
          <input type="hidden" name="id_barang" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Produk" value="<?= $format; ?>">
          <br>
          <label for="exampleInputEmail1">Nama Barang</label>
          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="..." name="nama_barang">
          <br>
          <label for="exampleInputEmail1">Harga Jual</label>
          <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Rp" name="harga_jual">
          <br>
          <label for="exampleInputEmail1">Harga Beli</label>
          <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Rp." name="harga_beli">
          <br>
          <label for="exampleInputEmail1">Jumlah</label>
          <input type="number" class="form-control" id="exampleInputEmail1" placeholder="" name="stok">
          <br>
          <label for="exampleInputEmail1">Satuan</label>
          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="satuan">
          <br>
          <label for="exampleInputFile">Pilih Gambar</label>
          <br>
          <input type="file" id="exampleInputFile" name="gambar">
          <br>
          <br>
          <button type="submit" class="btn btn-primary" name="kirim">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

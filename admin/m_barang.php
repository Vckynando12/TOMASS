<?php
include '../layout/header.php';
require '../koneksi/koneksi.php';

?>

<div id="layoutSidenav_content">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Barang</h1>
        <hr>

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
                $result = mysqli_query($con, "SELECT * FROM barang");
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
                            <a href="edit_produk.php?kode=<?= $row['id_barang']; ?>" class="btn btn-warning"><i
                                    class="glyphicon glyphicon-edit"></i>Edit</a>
                            <a href="proses/del_produk.php?kode=<?= $row['id_barang']; ?>" class="btn btn-danger"
                                onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                    class="glyphicon glyphicon-trash"></i>Hapus</a>
                        </td>
                    </tr>
                    <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
        <a href="tm_pembelian.php" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Tambah
            Produk</a>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php

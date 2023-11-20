<div class="container mt-5">
    <h2 class="mb-4">Data Barang</h2>
    <table class="table table-border-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga Jual</th>
                <th>Harga Beli</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = 1; ?>
            <?php $ambil = $con->query("SELECT * FROM barang"); ?>
            <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <?php echo $nomor; ?>
                    </td>
                    <td>
                        <? echo $pecah['id_barang']; ?>
                    </td>
                    <td>
                        <? echo $pecah['nama_barang']; ?>
                    </td>
                    <td>
                        <? echo $pecah['harga_jual']; ?>
                    </td>
                    <td>
                        <? echo $pecah['harga_beli']; ?>
                    </td>
                    <td>
                        <? echo $pecah['stok']; ?>
                    </td>
                    <td>
                        <? echo $pecah['satuan']; ?>
                    </td>
                    <td>
                        <? echo $pecah['gambar']; ?>
                    </td>
                    <td>
                        <a href="" class="btn-danger btn">Hapus</a>
                        <a href="" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
                <?php $nomor++; ?>
            <?php } ?>
        </tbody>
    </table>
</div>

// Membuat Kode barang
$Kode_barang = mysqli_query($con, "SELECT id_barang FROM barang ORDER BY id_barang DESC");
$data = mysqli_fetch_assoc($Kode_barang);

$format = "B%04d"; // Format kode menggunakan sprintf

if ($data && isset($data['id_barang'])) {
$num = substr($data['id_barang'], 1, 4);
$add = (int) $num + 1;
$format = sprintf($format, $add);
} else {
$format = sprintf($format, 1);
}
?>

<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang Masuk</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <form method="post"></form>
            <div class="modal-body">
                <input type="text" name="namabarang" placeholder="nama barang" class="form-control" require>
                <br>
                <input type="num" name="hargajual" placeholder="Rp." class="form-control" require>
                <br>
                <input type="num" name="hargabeli" placeholder="Rp." class="form-control" require>
                <br>
                <input type="Jumlah" name="jumlah" placeholder="jumlah" class="form-control" require>
                <br>
                <input type="text" name="satuan" placeholder="satuan" class="form-control" require>
                <br>
                <input type="text" name="gambar" placeholder="gambar" class="form-control" require>
                <br>
                <button type="submit" class="btn btn-success" name="addnewbarang">Submit</button>
            </div>
        </div>
    </div>
</div>
</div>
<?php include '../layout/footer.php'; ?>
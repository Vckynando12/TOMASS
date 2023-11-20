<div class="container mt-5">
    <h2 class="mb-4">Data Supplier</h2>
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
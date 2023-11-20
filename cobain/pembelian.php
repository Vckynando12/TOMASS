<h2>Data pembelian</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>no</th>
            <th>Nama Pelanggan</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Aksi</th>

        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM pembelian JOIN user ON pembelian.id_user=user.id_user"); ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td>
                    <?php echo $nomor; ?>
                </td>
                <td>
                    <?php echo $pecah['nama_user']; ?>
                </td>
                <td>
                    <?php echo $pecah['tanggal_pembelian']; ?>
                </td>
                <td>
                    <?php echo $pecah['total_pembelian']; ?>
                </td>
                <td>
                    <a href="index.php?halaman=detail&id=<?php echo $pecah['id_pembelian']; ?>"
                        class="btn btn-info">Detail</a>

                </td>
            </tr>
            <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>
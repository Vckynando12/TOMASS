<?php
include '../layout/header.php';
require '../koneksi/koneksi.php';
?>

<div id="layoutSidenav_content">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Penjualan</h1>
        <hr>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">
            Tambah
        </button>
        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Penjualan</th>
                            <th>Nama Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nomor = 1;
                        $ambil = $con->query("SELECT * FROM penjualan JOIN user ON penjualan.id_user=user.id_user");
                        while ($pecah = $ambil->fetch_assoc()) {
                            ?>
                            <tr>
                                <td>
                                    <?= $nomor++; ?>
                                </td>
                                <td>
                                    <?= $pecah['id_penjualan']; ?>
                                </td>
                                <td>
                                    <?= $pecah['username']; ?>
                                </td>
                                <td>
                                    <?= $pecah['tanggal_penjualan']; ?>
                                </td>
                                <td>
                                    <?= $pecah['total_penjualan']; ?>
                                </td>
                                <td>
                                    <a href="detail_penjualan.php" class="btn btn-info">Detail</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- The Modal -->
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
                                <input type="text" name="namabarang" placeholder="nama barang" class="form-control"
                                    require>
                                <br>
                                <input type="num" name="hargajual" placeholder="Rp." class="form-control" require>
                                <br>
                                <input type="num" name="hargabeli" placeholder="Rp." class="form-control" require>
                                <br>
                                <input type="Jumlah" name="jumlah" placeholder="jumlah" class="form-control" require>
                                <br>
                                <input type="text" name="satuan" placeholder="satuan" class="form-control" require>
                                <br>
                                <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include '../layout/footer.php'; ?>
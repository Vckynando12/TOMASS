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

<?php
include '../layout/header.php';
require '../koneksi/koneksi.php';
?>

<div id="layoutSidenav_content">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pembelian</h1>
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
                            <th>Kode Pembelian</th>
                            <th>Tanggal pembelian</th>
                            <th>User</th>
                            <th>Nama Supplier</th>
                            <th>Total Pembelian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
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

                                <select name="barangnya" class="form-control">
                                    <?php
                                    $ambildata = mysqli_query($con, "select * from barang");
                                    while ($fetcharray = mysqli_fetch_array($ambildata)) {
                                        $namabarangnya = $fetcharray['nama_barang'];
                                        $idbarangnya = $fetcharray['id_barang'];
                                    }
                                    ?>
                                    <option value="<?= $idbarangnya; ?>">
                                        <?= $namabarangnya; ?>
                                    </option>
                                </select>
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
    <?php include '../layout/footer.php'; ?>
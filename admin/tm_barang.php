<?php
include '../layout/header.php';
include 'function.php';


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


<div id="layoutSidenav_content">
    <div class="container mt-5">
        <h2 style="width: 100%; border-bottom: 4px solid gray"><b>Tambah Barang</b></h2>

        <form action="m_barang.php" method="POST" enctype="multipart/form-data">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kode Barang</label>
                        <input type="text" class="form-control" id="exampleInputEmail1"
                            placeholder="Masukkan Nama Produk" disabled value="<?= $format; ?>">
                        <input type="hidden" name="id_barang" class="form-control" id="exampleInputEmail1"
                            placeholder="Masukkan Nama Produk" value="<?= $format; ?>">
                    </div>
                </div>
            </div>
            <br>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Barang</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="..."
                        name="nama_barang">
                    <br>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Harga Jual</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Rp"
                                name="harga_jual">
                            <br>
                            <label for="exampleInputEmail1">Harga Beli</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Rp."
                                name="harga_beli">
                            <br>
                            <label for="exampleInputEmail1">Jumlah</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" placeholder=""
                                name="stok">
                            <br>
                            <label for="exampleInputEmail1">Satuan</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                name="satuan">

                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleInputFile">Pilih Gambar</label>
                        <br>
                        <input type="file" id="exampleInputFile" name="gambar">
                    </div>
                    <br>

                    <div class="col-md-6">
                        <button type="submit" name="kirim" class="btn btn-success btn-block"><i
                                class="glyphicon glyphicon-plus-sign"></i> Tambah</button>
                        <a href="m_barang.php" class="btn btn-danger btn-block">Cancel</a>
                    </div>
                </div>
        </form>
    </div>
</div>
</div>
<?php include '../layout/footer.php'; ?>
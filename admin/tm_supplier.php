<?php
include '../layout/header.php';

// Generate kode material
$kode_query = mysqli_query($con, "SELECT id_supplier FROM supplier ORDER BY id_supplier DESC");
$data = mysqli_fetch_assoc($kode_query);

$format = "SPL%04d"; // Format kode menggunakan sprintf

if ($data && isset($data['id_supplier'])) {
    $num = substr($data['id_supplier'], 1, 4);
    $add = (int) $num + 1;
    $format = sprintf($format, $add);
} else {
    $format = sprintf($format, 1);
}
?>

<div id="layoutSidenav_content">
    <div class="container mt-5">
        <h2 style="width: 100%; border-bottom: 4px solid gray"><b>Tambah Supplier</b></h2>

        <form action="proses/tm_produk.php" method="POST" enctype="multipart/form-data">
            <br>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kode Supplier</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" disabled
                            value="<?= $format; ?>">
                    </div>
                </div>
            </div>
            <br>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Supplier</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="..." name="text">
                    <br>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="..."
                                name="alamat">
                            <br>
                            <label for="exampleInputEmail1">Telepon</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" placeholder="..."
                                name="telepon">
                        </div>
                    </div>
                    <br>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success btn-block"><i
                                class="glyphicon glyphicon-plus-sign"></i>
                            Tambah</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include '../layout/footer.php'; ?>
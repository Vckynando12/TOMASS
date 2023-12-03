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

// hapus
if (isset($_GET['page']) && isset($_GET['kode'])) {
    $kode = $_GET['kode'];
    $result = mysqli_query($con, "DELETE FROM supplier WHERE id_supplier = '$kode'");

    if ($result) {
        echo "
		<script>
		window.location = 'm_supplier.php';
		alert('DATA BERHASIL DI HAPUS');
		</script>
		";
    }
}

// tambah
$randomNumber = rand(10, 9999);
$format = "S" . $randomNumber;
if (isset($_POST['add'])) {
    $namasupp = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $telpon = $_POST['telpon'];

    $result = mysqli_query($con, "INSERT INTO supplier (id_supplier, nama_supplier, alamat, telpon) VALUES ('$format', '$namasupp', '$alamat', '$telpon')");

    if ($result) {
        echo "
            <script>
            alert('DATA BERHASIL DITAMBAHKAN');
            window.location = 'm_supplier.php';
            </script>
        ";
    } else {
        echo "Gagal menambahkan supplier.";
    }
}

?>


<div id="layoutSidenav_content">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data supplier</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Master/Supplier</li>
        </ol>
        <hr>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">
            Tambah
        </button>
        <div class="card-body">
            <br>
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode Supplier</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Telepon</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($con, "SELECT * FROM supplier order by id_supplier asc");
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>

                            <th scope="row">
                                <?php echo $no; ?>
                            </th>
                            <td>
                                <?= $row['id_supplier']; ?>
                            </td>
                            <td>
                                <?= $row['nama_supplier']; ?>
                            </td>
                            <td>
                                <?= $row['alamat']; ?>
                            </td>
                            <td>
                                <?= $row['telpon']; ?>
                            </td>
                            <td>
                                <a href="m_supplier.php?kode=<?php echo $row['id_supplier']; ?>&page=del"
                                    class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data ?')"> <i
                                        class="glyphicon glyphicon-trash"></i>Hapus</a>
                            </td>
                        </tr>
                        <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>

        </div>
        <!-- Button trigger modal -->

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
                    <form action="m_supplier.php" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="text" name="nama_supplier" placeholder="nama supplier" class="form-control"
                                require>
                            <br>
                            <input type="num" name="alamat" placeholder="Alamat" class="form-control" require>
                            <br>
                            <input type="num" name="telpon" placeholder="Nomor tlp" class="form-control" require>
                            <br>
                            <button type="submit" class="btn btn-primary" name="add">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../layout/footer.php'; ?>
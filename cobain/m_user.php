<?php
include '../layout/header.php';
require '../koneksi/koneksi.php';

if (isset($_GET['page'])) {
    $kode = $_GET['kode'];
    $result = mysqli_query($conn, "DELETE FROM customer WHERE kode_customer = '$kode'");

    if ($result) {
        echo "
		<script>
		alert('DATA BERHASIL DIHAPUS');
		window.location = 'm_customer.php';
		</script>
		";
    }
}

?>


<div id="layoutSidenav_content">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data User</h1>
        <hr>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama User</th>
                    <th scope="col">Email</th>
                    <th scope="col">Username</th>
                    <th scope="col">password</th>
                    <th scope="col">Telepon</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($con, "SELECT * FROM user");
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td>
                            <?= $no; ?>
                        </td>
                        <td>
                            <?= $row['Nama']; ?>
                        </td>
                        <td>
                            <?= $row['email']; ?>
                        </td>
                        <td>
                            <?= $row['username']; ?>
                        </td>
                        <td>
                            <?= $row['password']; ?>
                        </td>
                        <td>
                            <?= $row['telpon']; ?>
                        </td>
                        <td>
                            <a href="edit_produk.php?kode=<?= $row['id_user']; ?>" class="btn btn-warning"><i
                                    class="glyphicon glyphicon-edit"></i>Edit</a>
                            <a href="proses/del_produk.php?kode=<?= $row['id_user']; ?>" class="btn btn-danger"
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
        <a href="tm_barang.php" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Tambah User</a>
    </div>
</div>
</div>
</div>
</div>
<?php include '../layout/footer.php'; ?>
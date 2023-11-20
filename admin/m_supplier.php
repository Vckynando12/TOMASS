<?php
include '../layout/header.php';
require '../koneksi/koneksi.php';

if (isset($_GET['page'])) {
    $kode = $_GET['id_supplier'];
    $result = mysqli_query($con, "DELETE FROM supplier WHERE id_supplier = '$kode'");

    if ($result) {
        echo "
		<script>
		alert('DATA BERHASIL DI HAPUS');
		window.location = 'm_user.php';
		</script>
		";
    }
}

?>


<div id="layoutSidenav_content">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data supplier</h1>
        <hr>

        <table class="table table-striped">
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
                        <td><a href="m_supplier.php?kode=<?php echo $row['id_supplier']; ?>&page=del" class="btn btn-danger"
                                onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                    class="glyphicon glyphicon-trash"></i>Hapus </a></td>
                    </tr>
                    <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>

    </div>
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
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
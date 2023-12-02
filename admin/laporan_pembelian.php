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

$date = date('Y-m-d');

if (isset($_POST['submit'])) {
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];
}
?>

<style type="text/css">
    @media print {
        .print {
            display: none !important;
        }
    }
</style>

<div id="layoutSidenav_content">
    <div class="container-fluid px-4">
        <h2 style=" width: 100%; border-bottom: 4px solid gray; padding-bottom: 5px;"><b>Laporan Pembelian</b></h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Laporan/Pembelian</li>
        </ol>
        <div class="row print">
            <div class="col-md-9">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <table>
                        <tr>
                            <td><input type="date" name="date1" class="form-control" value="<?= $date; ?>"></td>
                            <td>&nbsp; - &nbsp;</td>
                            <td><input type="date" name="date2" class="form-control" value="<?= $date; ?>"></td>
                            <td> &nbsp;</td>
                            <td><input type="submit" name="submit" class="btn btn-primary" value="Tampilkan"></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="col-md-3">
                <form action="exp_pembelian.php" method="POST">
                    <table>
                        <tr>
                            <td><input type="hidden" name="date1" class="form-control" value="<?= $date1; ?>"></td>
                            <td><input type="hidden" name="date2" class="form-control" value="<?= $date2; ?>"></td>
                            <!-- <td><button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-save-file"></i> Export to Excel</button></td> -->
                            <td> &nbsp;</td>
                            <td><a href="" onclick="window.print()" class="btn btn-default"><i class="glyphicon glyphicon-print"></i> Cetak</a></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <table class="table table-striped">
            <tr>
                <th>No</th>
                <th>Tanggal Pembelian</th>
                <th>Supplier</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>

            <?php
            if (isset($_POST['submit'])) {
                $result = mysqli_query($con, "SELECT p.tanggal_pembelian, s.nama_supplier, dp.nama_barang, dp.jumlah, dp.subtotal
                                FROM pembelian p
                                INNER JOIN detail_pembelian dp ON p.id_pembelian = dp.id_pembelian
                                INNER JOIN supplier s ON p.id_supplier = s.id_supplier
                                WHERE p.tanggal_pembelian BETWEEN '$date1' AND '$date2'");

                $no = 1;
                $total = 0;

                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $row['tanggal_pembelian']; ?></td>
                        <td><?= $row['nama_supplier']; ?></td>
                        <td><?= $row['nama_barang']; ?></td>
                        <td><?= $row['jumlah']; ?></td>
                        <td><?= $row['subtotal']; ?></td>
                    </tr>
            <?php
                    $total += $row['subtotal'];
                    $no++;
                }
            ?>
                <tr>
                    <td colspan="5" class="text-right"><b>Total Pembelian = <?= $total; ?></b></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

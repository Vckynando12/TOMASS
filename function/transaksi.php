<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    echo "<script>window.location.href = '../public/login.php';</script>";
    exit();
}

include '../layout/header.php';

include 'function.php';

require '../koneksi/koneksi.php';

?>



<div id="layoutSidenav_content">

    <div class="container-fluid px-4">

        <h1 class="mt-4">Data Barang Masuk</h1>

        <hr>

        <table class="table table-striped">

            <thead>

                <tr>

                    <th scope="col">No</th>

                    <th scope="col">Kode Pembelian</th>

                    <th scope="col">Tanggal Pembelian</th>

                    <th scope="col">User</th>

                    <th scope="col">Nama Supplier</th>

                    <th scope="col">Total Pembelian</th>

                    <th scope="col">Aksi</th>

                </tr>

            </thead>

            <tbody>

                <?php

                $no = 1;

                $result = mysqli_query($con, "SELECT * FROM pembelian JOIN user ON pembelian.id_user=user.id_user");

                while ($row = mysqli_fetch_assoc($result)) {

                    ?>

                    <tr>

                        <td>

                            <?= $no; ?>

                        </td>

                        <td>

                            <?= $row['id_pembelian']; ?>

                        </td>

                        <td>

                            <?= $row['tanggal_pembelian']; ?>

                        </td>

                        <td>

                            <?= $row['id_user']; ?>

                        </td>

                        <td>

                            <?= $row['id_supplier']; ?>

                        </td>

                        <td>

                            <?= $row['total_pembelian']; ?>

                        </td>

                        <td>

                        <td>

                            <a href="detail_pembelian.php" class="btn btn-info">Detail</a>

                        </td>

                    </tr>

                    <?php

                    $no++;

                }

                ?>



            </tbody>

        </table>

        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">

            Tambah Barang

        </button>

    </div>



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

                    <input type="text" name="namabarang" placeholder="nama barang" class="form-control" require>

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

                <?php include '../layout/footer.php'; ?>
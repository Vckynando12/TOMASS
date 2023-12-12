<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    echo "<script>window.location.href = '../public/login.php';</script>";
    exit();
}

include '../layout/header.php';

require '../koneksi/koneksi.php';

?>



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>

    $(document).ready(function () {

        $('.btn-detail').click(function () {

            var idPenjualan = $(this).data('idpenjualan');

            $.ajax({

                type: "GET",

                url: "../function/get_detail_penjualan.php",

                data: { id_penjualan: idPenjualan },

                success: function (data) {

                    $("#modal-body-detail").html(data);

                }

            });

            $('#myModal2').modal('show');

        });

    });

</script>



<div id="layoutSidenav_content">

    <div class="container-fluid px-4">

        <h1 class="mt-4">Pesanan Baru</h1>

        <hr>

        <div class="card mb-4">

            <div class="card-body">

                <table id="datatablesSimple" class="table">

                    <thead>

                        <tr>

                            <!-- <th>No</th> -->

                            <th>Kode Penjualan</th>

                            <th>Nama Pelanggan</th>

                            <th>Tanggal</th>

                            <th>Total</th>

                            <th>Status Pesanan</th>

                            <th>Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php

                    $nomor = 1;

                    $ambil = $con->query("SELECT * FROM penjualan 

                      JOIN user ON penjualan.id_user=user.id_user 

                      LEFT JOIN pembayaran ON penjualan.id_penjualan = pembayaran.id_pembayaran

                      WHERE COALESCE(pembayaran.status, 0) = 0

                      ORDER BY penjualan.tanggal_penjualan DESC");



                    while ($pecah = $ambil->fetch_assoc()) {

                        $id_penjualan = $pecah['id_penjualan'];



                        $status_pembayaran = 'Menunggu Persetujuan';



                        if (isset($pecah['status'])) {

                            $status_pembayaran = ($pecah['status'] == '1') ? 'Disetujui' : (($pecah['status'] == '2') ? 'Ditolak' : 'Menunggu Persetujuan');

                        }

                        ?>

                        <tr>

                            <td><?= $pecah['id_penjualan']; ?></td>

                            <td><?= $pecah['username']; ?></td>

                            <td><?= $pecah['tanggal_penjualan']; ?></td>

                            <td><?= $pecah['total_penjualan']; ?></td>

                            <td><?= $status_pembayaran; ?></td>

                            <td>

                                <?php echo "<button class='btn btn-primary btn-sm btn-detail' data-bs-toggle='modal' data-bs-target='#myModal2' data-idpenjualan='{$pecah['id_penjualan']}'>Detail</button>";?>

                            </td>

                        </tr>

                    <?php } ?>



                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>



<!-- Modal show Detail penjualan -->

<div class="modal fade" id="myModal2">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title">Detail penjualan</h4>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body" id="modal-body-detail">

            </div>

        </div>

    </div>

</div>
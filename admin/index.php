<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    echo "<script>window.location.href = '../public/login.php';</script>";
    exit();
}

require '../koneksi/koneksi.php';

include '../layout/header.php';



$query = "SELECT 

            SUM(dp.jumlah * (b.harga_jual - b.harga_beli)) AS keuntungan_hari_ini

          FROM 

            penjualan p

          JOIN 

            detail_penjualan dp ON p.id_penjualan = dp.id_penjualan

          JOIN 

            barang b ON dp.id_barang = b.id_barang

          LEFT JOIN 

            pembayaran py ON p.id_penjualan = py.id_pembayaran

          WHERE 

            DATE(p.tanggal_penjualan) = CURDATE() AND py.status = '1'";



$result = mysqli_query($con, $query);



if ($result) {

    $row = mysqli_fetch_assoc($result);

    $keuntungan_hari_ini = $row['keuntungan_hari_ini'];

} else {

    // Handle error jika query tidak berhasil

    $keuntungan_hari_ini = 0;

}

?>



<div id="layoutSidenav_content">

    <div class="container-fluid px-4">

        <h1 class="mt-4">Dashboard</h1>

        <ol class="breadcrumb mb-4">

            <li class="breadcrumb-item active">Dashboard</li>

        </ol>

        <div class="row">

            <div class="col-xl-4 col-md-6">

                <div class="card bg-primary text-white mb-4">

                    <div class="card-body">Barang Hampir habis</div>

                    <div class="card-footer d-flex align-items-center justify-content-between">

                        <a class="small text-white stretched-link" href="stok_barang.php">View

                            Details</a>

                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>

                    </div>

                </div>

            </div>



            <div class="col-xl-4 col-md-6">

                <div class="card text-white mb-4 d-flex align-items-center justify-content-center" style="background-color: #618264;">

                    <div class="card-body mb-2">

                        <strong>Keuntungan hari ini</strong>

                    </div>

                    <div class=" d-flex align-items-center justify-content-center mb-2">

                        <strong class="small text-white stretched-link" href="#">
    				Rp. <?= $keuntungan_hari_ini !== null ? number_format($keuntungan_hari_ini, 0, ',', '.') : '0'; ?>
			</strong>

                    </div>

                </div>

            </div>



            <div class="col-xl-4 col-md-6">

                <div class="card bg-warning text-white mb-4">

                    <div class="card-body">Pesanan Baru</div>

                    <div class="card-footer d-flex align-items-center justify-content-between">

                        <a class="small text-white stretched-link" href="pesanan_baru.php">View Details</a>

                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>

                    </div>

                </div>

            </div>

            

        </div>

        <div class="card mb-4">

            <div class="card-header">

                <i class="fas fa-chart-bar me-1"></i>

                Chart

            </div>

            <div class="card-body">

            <iframe title="Report Section" width="955" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiNTM1OGFjYTktMzhjOC00NTMzLTgxMDktZDgwYWFmZGE5ODY5IiwidCI6IjUyNjNjYzgxLTU5MTItNDJjNC1hYmMxLWQwZjFiNjY4YjUzMCIsImMiOjEwfQ%3D%3D" frameborder="0" allowFullScreen="true"></iframe>

            </div>

        </div>

    </div>

</div>
<?php
include '../proses/header.php';
include "../koneksi/koneksi.php";

$search_query = isset($_GET['query']) ? mysqli_real_escape_string($con, $_GET['query']) : '';

$query_products = mysqli_query($con, "SELECT * FROM barang WHERE nama_barang LIKE '%$search_query%'");

$products = mysqli_fetch_all($query_products, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>

<body">
    <!-- Carousel -->
    <!-- <div id="carouselExampleIndicators" class="carousel slide mt-4" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../assets/image/1.png" class="d-block img-fluid" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../assets/image/2.png" class="d-block img-fluid" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div> -->
<!-- Mulai Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="../assets/image/produk1.png" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <h1 class="h1 text-success"><b>Tomass</b> eCommerce</h1>
                            <h3 class="h2">Pusat Belanja Bahan Baku Kue Terlengkap</h3>
                            <p>
                                Tomass eCommerce mengkhususkan diri dalam menyediakan bahan baku kue berkualitas tinggi
                                dan terjangkau, mulai dari pewarna makanan dan berbagai bahan lainnya hingga perkakas dan
                                peralatan cetak kue. Kunjungi toko fisik kami yang berlokasi di Jl. Raya Kesamben, Desa
                                Kesamben, Kecamatan Kesamben, Kabupaten Jombang. Kami menawarkan berbagai macam bahan baku
                                berkualitas tinggi untuk menghidupkan kreasi kuliner Anda.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="../assets/image/produk2.png" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">Bahan Berkualitas</h1>
                            <h3 class="h2">Memberikan yang Terbaik untuk Kreasi Kuliner Anda</h3>
                            <p>
                                Di Tomass, kami menghadirkan bahan baku terbaik untuk memastikan produk roti Anda
                                memiliki kualitas tertinggi. Komitmen kami terhadap keunggulan mencakup setiap produk
                                yang kami tawarkan, menjadikan kami destinasi utama untuk semua kebutuhan memasak Anda.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="../assets/image/produk3.png" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">Kunjungi Kami Hari Ini</h1>
                            <h3 class="h2">Temukan Dunia Keunggulan Pembuatan Kue</h3>
                            <p>
                                Tomass eCommerce mengundang Anda untuk menjelajahi toko kami dan meningkatkan
                                pengalaman memasak Anda. Temukan segala yang Anda butuhkan, mulai dari bahan baku premium
                                hingga perkakas profesional untuk membuat kue. Bergabunglah dengan kami dalam perjalanan
                                kreativitas kuliner dan biarkan Tomass menjadi mitra terpercaya Anda dalam membuat kue.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
</div>
<!-- Akhir Banner Hero -->



    <?php include '../proses/produk_slider.php'; ?>
    <?php include '../public/home.php'; ?>

    <script src="../assets/jquery-1.11.0.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

<?php include '../proses/footer.php'; ?>

</html>

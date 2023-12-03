<?php
include("../koneksi/koneksi.php");
include '../proses/header.php';

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
    <style>
        #carouselExampleIndicators {
        width: 95%;
        margin: auto;
        border-radius: 15px;
        overflow: hidden;
        /* box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.3); */
    }

    .carousel-inner img {
        width: 100%;
        border-radius: 15px;
    }
    </style>
</head>

<body style="background-color: #FFFFFF;
background-image: linear-gradient(0deg, #FFFFFF 0%, #B5FFFC 100%);">
    <!--Carousel-->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="../assets/image/1.png" class="d-block img-fluid" alt="...">
        </div>
        <div class="carousel-item">
            <img src="../assets/image/2.png" class="d-block img-fluid" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<?php
include '../proses/produk_slider.php'
?>
<?php
include '../public/home.php';
?>
<script src="../assets/bootstrap/js/bootstrap.bundle.js"></script>
<script src="../assets/bootstrap/js/bootstrap.bundle.js"></script>
</body>

<?php
include '../proses/footer.php';
?>

</html>
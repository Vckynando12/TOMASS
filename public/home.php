<?php
include("../koneksi/koneksi.php");
$search_query = isset($_GET['query']) ? mysqli_real_escape_string($con, $_GET['query']) : '';

// Menggunakan fungsi CURRENT_DATE() untuk mendapatkan tanggal hari ini
$query_products = mysqli_query($con, "SELECT * FROM barang WHERE nama_barang LIKE '%$search_query%' AND id_barang NOT IN (
    SELECT id_barang FROM detail_pembelian WHERE tanggal_kadaluarsa <= CURRENT_DATE()
)");

$products = mysqli_fetch_all($query_products, MYSQLI_ASSOC);
?>



<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css"> 
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
<link href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" rel="stylesheet"/>
<link rel="stylesheet" href="../assets/css/card.css">
<style>
    .box-affix {
            padding: 15px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .bg-affix2 {
            background-color: #e2e3e5;
        }
        .line1 {
            width: 20px;
            height: 3px;
            background-color: #007bff;
            margin-bottom: 10px;
        }
        .wrap-affix {
        position: relative;
        top: 170px;
        padding: 8px 32px;
        }

        .bg-affix1 {
            background: rgb(0, 98, 73);
            background: rgb(0, 57, 98);
            background: linear-gradient(
                210deg,
                rgb(0, 98, 84) 0%,
                rgba(82, 158, 150, 1) 100%
            );
        }

        .bg-affix2 {
            background: rgb(0, 98, 73);
            background: rgb(0, 57, 98);
            background: linear-gradient(
                210deg,
                rgba(212, 250, 222, 1) 0%,
                rgba(82, 158, 150, 1) 50%
            );
        }


        .box-affix {
        display: inline-block;
        width: 216px;
        height: 64px;
        padding: 6px 8px;
        margin-right: 10px;
        border: none;
        border-radius: 8px;
        color: #fff;
        }

        .line1 {
        background-color: #fff;
        height: 4px;
        width: 40px;
        }

        .card {
        box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px;
        border-radius: 12px;
        }

        .card-body {
        padding: 10px;
        }

        .affix {
        width: 100%;
        background-color: white;
        top: 110px;
        z-index: 9999999;
        left: 0;
        height: 76px;
        padding-left: 32px;
        }

        .btn-green {
        color: #03ac0e;
        border: 1px solid #03ac0e;
        background-color: transparent;
        padding: 10px 70px;
        font-size: 20px;
        font-weight: bold;
        }
        /* Tambahkan CSS berikut */
.row.no-gutters {
    margin-right: 0;
    margin-left: 0;
}

.col-md-3.no-gutters {
    padding-right: 0;
    padding-left: 0;
}

</style>
<div class="container mt-2">
    <div class="row no-gutters">
        <div class="position-relative mr-3 box-affix bg-affix2">
            <div class="line1"></div>
            <h4>For You</h4>
        </div>
        <?php foreach ($products as $product): ?>
            <div class="col-md-3 mb-3 no-gutters">
                <div class="wsk-cp-product">
                    <div class="wsk-cp-img">
                        <?php
                        $imageData = base64_encode($product['gambar']);
                        $imageSrc = 'data:image/jpeg;base64,' . $imageData;
                        ?>
                        <img src="<?= $imageSrc; ?>" alt="<?= $product['nama_barang']; ?>" class="img-responsive custom-image" />
                    </div>
                    <div class="wsk-cp-text">
                        <div class="category">
                            <span><?= $product['nama_barang']; ?></span>
                        </div>
                        <div class="description-prod">
                            <p class="mt-2">Stock: <?= $product['stok'] . ' ' . $product['satuan']; ?></p>
                        </div>
                        <div class="card-footer">
                            <div class="wcf-left"><span class="price">Rp. <?= number_format($product['harga_jual']); ?></span></div>
                            <div class="wcf-right"><a href="#" class="buy-btn add-to-cart" data-product-id="<?= $product['id_barang']; ?>"><i class="zmdi zmdi-shopping-basket"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>
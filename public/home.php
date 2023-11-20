<?php
include("../koneksi/koneksi.php");

$search_query = isset($_GET['query']) ? mysqli_real_escape_string($con, $_GET['query']) : '';
$query_products = mysqli_query($con, "SELECT * FROM barang WHERE nama_barang LIKE '%$search_query%'");
$products = mysqli_fetch_all($query_products, MYSQLI_ASSOC);
?>

<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/style.css">
<div class="container mt-5">
    <div class="row">
        <?php foreach ($products as $product) : ?>
            <div class="col-md-4 mb-4">
                <div class="card" style="width: 200px; margin-bottom: 20px;">
                    <?php
                    $imageData = base64_encode($product['gambar']);
                    $imageSrc = 'data:image/jpeg;base64,' . $imageData;
                    ?>
                    <img src="<?= $imageSrc; ?>" class="card-img-top custom-image" style="height: 200px; width: 200px;" alt="<?= $product['nama_barang']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product['nama_barang']; ?></h5>
                        <p class="card-text">Price: <?= $product['harga_jual']; ?></p>
                        <p class="card-text">Stock: <?= $product['stok']; ?> <?= $product['satuan']; ?></p>
                        <button class="btn btn-primary add-to-cart" data-product-id="<?= $product['id_barang']; ?>">Add to Cart</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
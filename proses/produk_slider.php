<?php
include("../koneksi/koneksi.php");
$search_query = isset($_GET['query']) ? mysqli_real_escape_string($con, $_GET['query']) : '';
$query_products = mysqli_query($con, "SELECT * FROM barang WHERE nama_barang LIKE '%$search_query%'");
$products = mysqli_fetch_all($query_products, MYSQLI_ASSOC);
?>


<div class="tcb-product-slider mt-5">
    <div class="container">
    <div class="position-relative mr-3 box-affix bg-affix2">
        <div class="line1"></div>
        <h4>Spesial Diskon</h4>
    </div>
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php
            $counter = 0;
            $productsChunked = array_chunk($products, 4);
            foreach ($productsChunked as $productGroup):
            ?>
                <div class="carousel-item <?= $counter === 0 ? 'active' : ''; ?>">
                    <div class="row">
                        <?php foreach ($productGroup as $product): ?>
                            <div class="col-md-3">
                                <div class="card cardp">
                                    <div class="tcb-product-item">
                                        <div class="tcb-product-photo">
                                            <a href="" class="add-to-cart" data-product-id="<?= $product['id_barang']; ?>">
                                                <img src="<?= 'data:image/jpeg;base64,' . base64_encode($product['gambar']); ?>" class="card-img-top product-image" alt="<?= $product['nama_barang']; ?>">
                                            </a>
                                        </div>
                                        <div class="tcb-product-info mt-2 mb-4">
                                            <div class="tcb-product-title">
                                                <strong><?= $product['nama_barang']; ?></strong>
                                            </div>
                                            <!-- <div class="tcb-product-rating">
                                                <a href="#">(<?= $product['stok']; ?> Stok)</a>
                                            </div>
                                            <div class="tcb-hline"></div> -->
                                            <div class="tcb-product-price">
                                                Rp. <?= $product['harga_jual']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php
                $counter++;
            endforeach;
            ?>
        </div>
        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    </div>
</div>

<style>
.cardp {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    border: 2px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.product-image {
    max-width: 200px;
    max-height: 200px;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.tcb-product-info {
    height: 100%;
}

</style>



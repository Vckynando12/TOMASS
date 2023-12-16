<?php
include("../koneksi/koneksi.php");

$productsPerPage = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $productsPerPage;

$search_query = isset($_GET['query']) ? mysqli_real_escape_string($con, $_GET['query']) : '';

// Fetch products with pagination
$query_products = mysqli_query($con, "SELECT * FROM barang 
    WHERE nama_barang LIKE '%$search_query%' 
    AND id_barang NOT IN (
        SELECT id_barang FROM detail_pembelian WHERE tanggal_kadaluarsa <= CURRENT_DATE()
    ) AND stok > 0
    LIMIT $offset, $productsPerPage");

$products = mysqli_fetch_all($query_products, MYSQLI_ASSOC);

// Count total products for pagination
$totalProductsQuery = mysqli_query($con, "SELECT COUNT(*) as total FROM barang 
    WHERE nama_barang LIKE '%$search_query%' 
    AND id_barang NOT IN (
        SELECT id_barang FROM detail_pembelian WHERE tanggal_kadaluarsa <= CURRENT_DATE()
    ) AND stok > 0");

$totalProducts = mysqli_fetch_assoc($totalProductsQuery)['total'];
$totalPages = ceil($totalProducts / $productsPerPage);
?>


<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="../assets/css/product.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .box-affix {
            padding: 15px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin-bottom: 30px;
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
</style>

<div class="untree_co-section product-section before-footer-section">
  <div class="container">
    <div class="row">
      <div class="position-relative mr-3 box-affix bg-affix2">
        <div class="line1"></div>
        <h4>For You</h4>
      </div>
      <?php foreach ($products as $product): ?>
        <div class="col-12 col-md-4 col-lg-3 mb-5">
          <div class="product-item">
            <?php
            $imageData = base64_encode($product['gambar']);
            $imageSrc = 'data:image/jpeg;base64,' . $imageData;
            ?>
            <img src="<?= $imageSrc; ?>" alt="<?= $product['nama_barang']; ?>" class="img-fluid product-thumbnail" style="height: 250px;" />
            <h3 class="product-title"><?= $product['nama_barang']; ?></h3>
            <strong class="product-price">Rp. <?= number_format($product['harga_jual']); ?></strong>
            <span class="icon-cross">
              <img src="../assets/image/cross.svg" class="img-fluid add-to-cart" data-product-id="<?= $product['id_barang']; ?>">
            </span>
          </div>
        </div> 
      <?php endforeach; ?>
    </div>
  </div>
<!-- Pagination links -->
<div class="container">
    <div class="row">
        <div class="col-12">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?query=<?= $search_query ?>&page=<?= $page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo; Previous</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                        <a class="page-link" href="?query=<?= $search_query ?>&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?query=<?= $search_query ?>&page=<?= $page + 1 ?>" aria-label="Next">
                            <span aria-hidden="true">Next &raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
</div>
		
	</body>

</html>

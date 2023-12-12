<?php
session_start();
if (!isset($_SESSION['login'])) {
	echo "<script>window.location.href = '../public/login.php';</script>";
    exit();
}

include("../koneksi/koneksi.php");

$id_user_login = $_SESSION['user_id'];

$query_total_harga = mysqli_query($con, "SELECT SUM(total) AS total_harga FROM detail_keranjang WHERE id_keranjang IN (SELECT id_keranjang FROM keranjang WHERE id_user = $id_user_login)");

$total_harga_result = mysqli_fetch_assoc($query_total_harga);

$total_harga = $total_harga_result['total_harga'];

$query_keranjang = mysqli_query($con, "SELECT * FROM keranjang WHERE id_user = $id_user_login");

$keranjang = mysqli_fetch_assoc($query_keranjang);



if ($keranjang) {

    $id_keranjang = $keranjang['id_keranjang'];

    $query_detail_keranjang = mysqli_query($con, "SELECT dk.*, b.nama_barang, b.harga_jual, b.gambar FROM detail_keranjang dk

                                                   INNER JOIN barang b ON dk.id_barang = b.id_barang

                                                   WHERE dk.id_keranjang = '$id_keranjang'");

    $detail_keranjang = mysqli_fetch_all($query_detail_keranjang, MYSQLI_ASSOC);

}

?>



<!DOCTYPE html>

<html lang="en">

<head>

    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">

    <script src="https://kit.fontawesome.com/c79e220d71.js" crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">



    <title>Bootstrap 5 Shopping Cart</title>

</head>

<body>

<?php

include '../proses/header.php';

?>

<section class="h-100 h-custom">

    <div class="container h-100 py-5">

        <div class="row d-flex justify-content-center align-items-center h-100">

            <div class="col">



                <div class="table-responsive">

                <?php if ($keranjang) : ?>

                    <table class="table">

                        <thead>

                        <tr>

                            <th scope="col" class="h5">Shopping Bag</th>

                            <th scope="col">Nama</th>

                            <th scope="col">Jumlah</th>

                            <th scope="col">Harga Satuan</th>

                            <th scope="col">Total Harga</th>

                            <th scope="col">Aksi</th>

                        </tr>

                        </thead>

                        <tbody>

                        <?php foreach ($detail_keranjang as $detail) : ?>

                        <tr>

                            <th scope="row">

                                <div class="d-flex align-items-center">

                                    <img src="data:image/jpeg;base64,<?= base64_encode($detail['gambar']); ?>" alt="Produk" style="max-width: 50px;" class="img-fluid rounded-3">

                                </div>

                            </th>

                            <td class="align-middle">

                                <p class="mb-0" style="font-weight: 500;"><?= $detail['nama_barang']; ?></p>

                            </td>

                            <td class="align-middle">

                                <div class="d-flex flex-row">

                                    <button class="btn btn-link px-2" onclick="handleQuantity('<?= $detail['id_detail_keranjang']; ?>', -1)">

                                        <i class="fas fa-minus"></i>

                                    </button>



                                    <input id="quantityInput<?= $detail['id_detail_keranjang']; ?>" min="1" name="quantity" value="<?= $detail['jumlah']; ?>" type="number"

                                        class="form-control form-control-sm" style="width: 50px;" />



                                    <button class="btn btn-link px-2" onclick="handleQuantity('<?= $detail['id_detail_keranjang']; ?>', 1)">

                                        <i class="fas fa-plus"></i>

                                    </button>

                                </div>

                            </td>

                            <td class="align-middle">

                                <p class="mb-0" style="font-weight: 500;"><?= number_format($detail['harga_jual']); ?></p>

                            </td>

                            <td class="align-middle">

                                <p class="mb-0" style="font-weight: 500;"><?= number_format($detail['total']); ?></p>

                            </td>

                            <td class="align-middle">

                                <a href="../proses/update_cart.php?id_detail_keranjang=<?= $detail['id_detail_keranjang']; ?>&action=delete" class="btn"><i class="fa-solid fa-trash-can"></i></a>

                            </td>

                        </tr>

                        <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

                

                <div class="card shadow-2-strong mb-5 mb-lg-0" style="border-radius: 16px;">

                    <div class="card-body p-4">



                        <div class="row">

                            <div class="col-md-6 col-lg-4 col-xl-3 mb-4 mb-md-0">

                                <form>



                                    <div class="d-flex flex-row pb-3">

                                        <div class="d-flex align-items-center pe-2">

                                            <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel1v" value="" aria-label="..." checked/>

                                        </div>

                                        <div class="rounded border w-100 p-3">

                                            <p class="d-flex align-items-center mb-0">

                                                <i class="fa-regular fa-credit-card fa-2x text-dark pe-2"></i>Transfer

                                            </p>

                                        </div>

                                    </div>



                                    <div class="d-flex flex-row pb-3">

                                        <div class="d-flex align-items-center pe-2">

                                            <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel1v" value="" aria-label="..." />

                                        </div>

                                        <div class="rounded border w-100 p-3">

                                            <p class="d-flex align-items-center mb-0">

                                                <i class="fa-regular fa-money-bill-1 fa-2x text-dark pe-2"></i>Cash

                                            </p>

                                        </div>

                                    </div>

                                    

                                </form>

                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-6">

                                <!-- <div class="row">

                                    <div class="col-12 col-xl-6">

                                        <div class="form-outline mb-4 mb-xl-5">

                                            <input type="text" id="typeName" class="form-control form-control-lg"

                                                   size="17" placeholder="John Smith"/>

                                            <label class="form-label" for="typeName">Name on card</label>

                                        </div>

                                    </div>

                                    <div class="col-12 col-xl-6">

                                        <div class="form-outline mb-4 mb-xl-5">

                                            <input type="text" id="typeText" class="form-control form-control-lg"

                                                   size="17" placeholder="1111 2222 3333 4444" minlength="19" maxlength="19"/>

                                            <label class="form-label" for="typeText">Card Number</label>

                                        </div>

                                    </div>

                                </div> -->

                            </div>

                            <div class="col-lg-4 col-xl-3">

                                <div class="d-flex justify-content-between" style="font-weight: 500;">

                                    <p class="mb-2">Subtotal</p>

                                    <p class="mb-2">Rp. <?= number_format($total_harga); ?></p>

                                </div>



                                <div class="d-flex justify-content-between" style="font-weight: 500;">

                                    <p class="mb-0">Pajak</p>

                                    <p class="mb-0">Rp. 0</p>

                                </div>



                                <hr class="my-4">



                                <div class="d-flex justify-content-between mb-4" style="font-weight: 500;">

                                    <p class="mb-2">Total (termasuk pajak) </p>

                                    <p class="mb-2">Rp. <?= number_format($total_harga); ?></p>

                                </div>

                                

                                <form action="../proses/checkout.php" method="post">

                                    <!-- <a href="../public/index.php" class="btn btn-secondary btn-continue-shopping">Lanjutkan Belanja</a> -->

                                    <!-- <button type="submit" name="checkout" class="btn btn-success btn-checkout">Checkout</button> -->

                                    

                                    <button type="submit" class="btn btn-primary btn-block btn-lg checkout" name="checkout">

                                        <div class="d-flex justify-content-between">

                                            <span>Checkout</span>

                                            <!-- <span><?= $total_harga; ?></span> -->

                                        </div>

                                    </button>

                                </form>

                                

                            </div>

                        </div>



                    </div>

                </div>

                <?php else : ?>

                    <p>Keranjang belanja Anda kosong.</p>

                <?php endif; ?>

            </div>

        </div>

    </div>

</section>



<script src="../assets/bootstrap/js/bootstrap.min.js"></script>

<script>

    function handleQuantity(id, step) {

        const inputElement = document.getElementById('quantityInput' + id);

        const currentValue = parseInt(inputElement.value);

        const newValue = currentValue + step;



        if (newValue < 1) {

            inputElement.value = 1;

        } else {

            inputElement.value = newValue;

            updateCart(id, inputElement.value);

        }

    }



    function updateCart(id, newValue) {

        const form = document.createElement('form');

        form.action = '../proses/update_cart.php';

        form.method = 'post';



        const inputIdField = document.createElement('input');

        inputIdField.type = 'hidden';

        inputIdField.name = 'id_detail_keranjang';

        inputIdField.value = id;

        form.appendChild(inputIdField);



        const jumlahField = document.createElement('input');

        jumlahField.type = 'number';

        jumlahField.name = 'jumlah';

        jumlahField.value = newValue;

        form.appendChild(jumlahField);



        const submitButton = document.createElement('button');

        submitButton.type = 'submit';

        submitButton.name = 'update';

        submitButton.style.display = 'none';

        form.appendChild(submitButton);



        document.body.appendChild(form);

        submitButton.click();

    }

</script>





</body>

</html>


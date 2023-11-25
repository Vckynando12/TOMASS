<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login'])) {
    header('location: ../public/login.php');
    exit();
}

include '../layout/header.php';
require '../koneksi/koneksi.php';

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$id_pembelian = $_SESSION['id_pembelian'];

$randomNumber2 = rand(10, 9999);
$id_detail_pembelian = "DP" . $randomNumber2;

if (isset($_POST['add_detail_pembelian'])) {
    $id_pembelian = $_POST['id_pembelian'];
    $tanggal_kadaluarsa = $_POST['tanggal_kadaluarsa'];
    $jumlah = $_POST['jumlah'];
    $subtotal = $_POST['subtotal'];
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];

    $resultCheckBarang = mysqli_query($con, "SELECT * FROM barang WHERE id_barang = '$id_barang'");
    $rowCheckBarang = mysqli_fetch_assoc($resultCheckBarang);

    if ($rowCheckBarang) {
        $resultUpdateStok = mysqli_query($con, "UPDATE barang SET stok = stok + '$jumlah' WHERE id_barang = '$id_barang'");
        if (!$resultUpdateStok) {
            echo "Gagal menambahkan stok barang.";
            exit();
        }
    } else {
        $resultTambahBarang = mysqli_query($con, "INSERT INTO barang (id_barang, nama_barang, stok) VALUES ('$id_barang', '$nama_barang', '$jumlah')");
        if (!$resultTambahBarang) {
            echo "Gagal menambahkan barang baru.";
            exit();
        }
    }
    $resultDetailPembelian = mysqli_query($con, "INSERT INTO detail_pembelian (id_detail_pembelian, id_pembelian, id_barang, nama_barang, tanggal_kadaluarsa, jumlah, subtotal) VALUES ('$id_detail_pembelian', '$id_pembelian', '$id_barang', '$nama_barang', '$tanggal_kadaluarsa', '$jumlah', '$subtotal')");
    if ($resultDetailPembelian) {
        $resultUpdatePembelian = mysqli_query($con, "UPDATE pembelian SET total_pembelian = total_pembelian + '$subtotal' WHERE id_pembelian = '$id_pembelian'");
        if ($resultUpdatePembelian) {
            echo json_encode(['success' => true]);
            echo "<script>window.location.href = '../admin/pembelian.php';</script>";
            exit();
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal mengupdate total pembelian.']);
            exit();
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menambahkan detail pembelian.']);
        exit();
    }
}
?>

<link rel="stylesheet" href="../assets/css/style.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="../assets/js/script.js"></script>
<script>
    $(document).ready(function() {
        $("#btnSearchBarang").on("click", function() {
            var keyword = $("#search_barang").val();
            $.ajax({
                url: "../function/pencarian_barang.php",
                method: "POST",
                data: { keyword: keyword },
                success: function(response) {
                    $("#result").html(response);
                }
            });
        });
        $(document).on("click", ".barang-item", function() {
            var id_barang = $(this).data("id_barang");
            var nama_barang = $(this).data("nama_barang");

            $("#id_barang").val(id_barang);
            $("#nama_barang").val(nama_barang);
            $("#result").html("");
            $("#search_barang").val("");
        });
    });
</script>

<div id="layoutSidenav_content">
    <div class="container-fluid px-4">
        <h1>Edit Barang</h1>
            <form action="add_pembelian.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <label for="search_barang">Cari Barang:</label>
                    <div class="input-group">
                        <input type="text" name="search_barang" id="search_barang" class="form-control">
                        <button type="button" class="btn btn-primary" id="btnSearchBarang">Cari</button>
                    </div>
                    <span id="result"></span>
                    <br>
                    <label for="id_barang">ID Barang:</label>
                    <input type="text" name="id_barang" id="id_barang" class="form-control" required>
                    <br>
                    <label for="nama_barang">Nama Barang:</label>
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
                    <br>
                    <label for="tanggal_kadaluarsa">Tanggal Kadaluarsa:</label>
                    <input type="date" name="tanggal_kadaluarsa" class="form-control" required>
                    <br>
                    <label for="jumlah">Jumlah:</label>
                    <input type="number" name="jumlah" class="form-control" required>
                    <br>
                    <label for="subtotal">Subtotal:</label>
                    <input type="number" name="subtotal" class="form-control" required>
                    <br>
                    <input type="hidden" name="id_pembelian" value="<?= $id_pembelian; ?>">
                    <button type="submit" class="btn btn-primary" id="btn-detailPembelian" name="add_detail_pembelian">Submit</button>
                </div>
            </form>
    </div>
</div>
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

$randomNumber = rand(10, 9999);
$id_pembelian = "PB" . $randomNumber;

$resultSupplier = mysqli_query($con, "SELECT * FROM supplier");

$_SESSION['id_pembelian'] = $id_pembelian;

if (isset($_POST['add_pembelian'])) {
    $id_user_login = $_SESSION['user_id'];
    $id_supplier = $_POST['id_supplier'];
    $tanggal_pembelian = $_POST['tanggal_pembelian'];
    $total_pembelian = 0;

    $resultPembelian = mysqli_query($con, "INSERT INTO pembelian (id_pembelian, tanggal_pembelian, id_user, id_supplier, total_pembelian) VALUES ('$id_pembelian', '$tanggal_pembelian', '$id_user_login', '$id_supplier', '$total_pembelian')");

    if ($resultPembelian) {
        // echo "<script>window.location.href = '../admin/add_pembelian.php?id_pembelian=$id_pembelian';</script>";
        // exit();
        echo json_encode(['success' => true, 'id_pembelian' => $id_pembelian]);
        echo "<script>window.location.href = '../admin/add_pembelian.php?id_pembelian=" . urlencode($id_pembelian) . "';</script>";
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menambahkan pembelian.']);
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
        <h1 class="mt-4">Data Pembelian</h1>
        <hr>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">
            Tambah
        </button>
    <table class="table">
        <thead>
            <tr>
                <th>ID Pembelian</th>
                <th>ID User</th>
                <th>ID Supplier</th>
                <th>Tanggal Pembelian</th>
                <th>Total Pembelian</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $resultPembelian = mysqli_query($con, "SELECT * FROM pembelian");
            while ($rowPembelian = mysqli_fetch_assoc($resultPembelian)) {
                echo "<tr>";
                echo "<td>{$rowPembelian['id_pembelian']}</td>";
                echo "<td>{$rowPembelian['id_user']}</td>";
                echo "<td>{$rowPembelian['id_supplier']}</td>";
                echo "<td>{$rowPembelian['tanggal_pembelian']}</td>";
                echo "<td>{$rowPembelian['total_pembelian']}</td>";
                echo "<td><button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#myModal2' onclick='showDetail(\"{$rowPembelian['id_pembelian']}\")'>Detail</button></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    </div>
</div>

<!-- modal tambah pembelian -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang Masuk</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <form method="post" enctype="multipart/form-data" id="formPembelian">
                <div class="modal-body">
                    <label for="id_supplier">Pilih Supplier:</label>
                    <select name="id_supplier" class="form-control" required>
                        <?php while ($rowSupplier = mysqli_fetch_assoc($resultSupplier)) : ?>
                            <option value="<?= $rowSupplier['id_supplier']; ?>"><?= $rowSupplier['nama_supplier']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <br>
                    <label for="tanggal_pembelian">Tanggal Pembelian:</label>
                    <input type="date" name="tanggal_pembelian" class="form-control" required>
                    <br>
                    <button type="submit" class="btn btn-primary" id="btn-detailPembelian" name="add_pembelian">Next</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal show Detail Pembelian -->
<div class="modal fade" id="myModal2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Pembelian barang</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
                <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID Pembelian</th>
                            <th>Nama Barang</th>
                            <th>Tanggal Kadaluarsa</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $resultDetailPembelian = mysqli_query($con, "SELECT * FROM detail_pembelian");
                        while ($rowDetailPembelian = mysqli_fetch_assoc($resultDetailPembelian)) {
                            echo "<tr>";
                            echo "<td>{$rowDetailPembelian['id_detail_pembelian']}</td>";
                            echo "<td>{$rowDetailPembelian['id_pembelian']}</td>";
                            echo "<td>{$rowDetailPembelian['nama_barang']}</td>";
                            echo "<td>{$rowDetailPembelian['tanggal_kadaluarsa']}</td>";
                            echo "<td>{$rowDetailPembelian['jumlah']}</td>";
                            echo "<td>{$rowDetailPembelian['subtotal']}</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>

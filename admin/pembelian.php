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
        echo "<script>window.location.href = '../admin/add_pembelian.php';</script>";
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

    $(document).ready(function () {
        $('.btn-detail').click(function () {
            var idPembelian = $(this).data('idpembelian');
            $.ajax({
                type: "GET",
                url: "../function/get_detail_pembelian.php",
                data: { id_pembelian: idPembelian },
                success: function (data) {
                    $("#modal-body-detail").html(data);
                }
            });
            $('#myModal2').modal('show');
        });

        $(document).on("click", ".btn-delete-item", function () {
            var idPembelian = $(this).data("idpembelian");
            var idItem = $(this).data("iditem");

            if (confirm("Apakah Anda yakin ingin menghapus item ini?")) {
                $.ajax({
                    type: "POST",
                    url: "../function/delete_item_pembelian.php",
                    data: { id_pembelian: idPembelian, id_item: idItem },
                    success: function (response) {
                        var result = JSON.parse(response);
                        alert(result.message);
                        if (result.success) {
                            location.reload();
                        }
                    },
                    error: function (error) {
                        console.error("Error saat menghapus item: " + error);
                        alert("Error saat menghapus item: " + error);
                    }
                });
            }

        });
    });
</script>
<script src="https://kit.fontawesome.com/c79e220d71.js" crossorigin="anonymous"></script>
<div id="layoutSidenav_content">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Pembelian</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pembelian</li>
        </ol>
        <hr>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">
            Tambah
        </button>
    <table class="table">
        <thead>
            <tr>
                <th>ID Pembelian</th>
                <th>Nama User</th>
                <th>Nama Supplier</th>
                <th>Tanggal Pembelian</th>
                <th>Total Pembelian</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $resultPembelian = mysqli_query($con, "SELECT pembelian.*, user.Nama, supplier.nama_supplier 
        FROM pembelian
        JOIN user ON pembelian.id_user = user.id_user
        JOIN supplier ON pembelian.id_supplier = supplier.id_supplier");
    
        while ($rowPembelian = mysqli_fetch_assoc($resultPembelian)) {
            echo "<tr>";
            echo "<td>{$rowPembelian['id_pembelian']}</td>";
            echo "<td>{$rowPembelian['Nama']}</td>";
            echo "<td>{$rowPembelian['nama_supplier']}</td>";
            echo "<td>{$rowPembelian['tanggal_pembelian']}</td>";
            echo "<td>{$rowPembelian['total_pembelian']}</td>";
            echo "<td><button class='btn btn-primary btn-sm btn-detail' data-bs-toggle='modal' data-bs-target='#myModal2' data-idpembelian='{$rowPembelian['id_pembelian']}'>Detail</button></td>";
            echo "</tr>";
            }
        ?>
        </tbody>
    </table>
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
            <div class="modal-body" id="modal-body-detail">
                <!-- <a class="btn"><i class="fa-solid fa-trash-can"></i></a> -->
            </div>
        </div>
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

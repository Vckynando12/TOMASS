<?php
require '../koneksi/koneksi.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login'])) {
    header('location: ../public/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_pembelian']) && isset($_POST['id_item'])) {
    $idPembelian = $_POST['id_pembelian'];
    $idItem = $_POST['id_item'];

    mysqli_autocommit($con, false);

    $deleteDetailQuery = "DELETE FROM detail_pembelian WHERE id_pembelian = ? AND id_detail_pembelian = ?";
    $deletePembelianQuery = "DELETE FROM pembelian WHERE id_pembelian = ?";
    $getDetailQuery = "SELECT id_barang, jumlah FROM detail_pembelian WHERE id_pembelian = ?";
    
    // update stok barang
    $updateStockQuery = "UPDATE barang SET stok = stok - ? WHERE id_barang = ?";

    try {
        $stmtGetDetail = mysqli_prepare($con, $getDetailQuery);
        if (!$stmtGetDetail) {
            throw new Exception("Prepare statement error for getting details.");
        }
        mysqli_stmt_bind_param($stmtGetDetail, "s", $idPembelian);
        mysqli_stmt_execute($stmtGetDetail);
        $resultDetails = mysqli_stmt_get_result($stmtGetDetail);

        $stmtDetail = mysqli_prepare($con, $deleteDetailQuery);
        $stmtPembelian = mysqli_prepare($con, $deletePembelianQuery);

        if (!$stmtDetail || !$stmtPembelian) {
            throw new Exception("Prepare statement error.");
        }

        mysqli_stmt_bind_param($stmtDetail, "ss", $idPembelian, $idItem);
        mysqli_stmt_bind_param($stmtPembelian, "s", $idPembelian);

        if (!mysqli_stmt_execute($stmtDetail) || !mysqli_stmt_execute($stmtPembelian)) {
            throw new Exception("Execution error.");
        }
        while ($rowDetail = mysqli_fetch_assoc($resultDetails)) {
            $stmtUpdateStock = mysqli_prepare($con, $updateStockQuery);
            if (!$stmtUpdateStock) {
                throw new Exception("Prepare statement error for updating stock.");
            }
            mysqli_stmt_bind_param($stmtUpdateStock, "is", $rowDetail['jumlah'], $rowDetail['id_barang']);
            if (!mysqli_stmt_execute($stmtUpdateStock)) {
                throw new Exception("Execution error while updating stock.");
            }
            mysqli_stmt_close($stmtUpdateStock);
        }

        mysqli_commit($con);

        echo json_encode(['success' => true, 'message' => 'Data berhasil di hapus!']);

    } catch (Exception $e) {
        mysqli_rollback($con);

        echo json_encode(['success' => false, 'message' => 'Failed to delete item and associated purchase']);

    } finally {
        mysqli_stmt_close($stmtDetail);
        mysqli_stmt_close($stmtPembelian);
        mysqli_stmt_close($stmtGetDetail);

        mysqli_autocommit($con, true);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>

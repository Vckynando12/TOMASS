<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['login'])) {
    header('location: ../public/login.php');
    exit();
}
require '../koneksi/koneksi.php';

if (isset($_GET['id_penjualan'])) {
    $idPenjualan = $_GET['id_penjualan'];

    // Gunakan prepared statement untuk mencegah SQL injection
    $stmt = mysqli_prepare($con, "SELECT * FROM detail_penjualan WHERE id_penjualan = ?");
    mysqli_stmt_bind_param($stmt, "s", $idPenjualan);
    mysqli_stmt_execute($stmt);
    $resultDetailPenjualan = mysqli_stmt_get_result($stmt);

    echo "<table class='table'>";
    echo "<thead>
            <tr>
                <th>ID</th>
                <th>ID penjualan</th>
                <th>ID Barang</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>";

    while ($rowDetailPenjualan = mysqli_fetch_assoc($resultDetailPenjualan)) {
        echo "<tr>";
        echo "<td>{$rowDetailPenjualan['id_detail_penjualan']}</td>";
        echo "<td>{$rowDetailPenjualan['id_penjualan']}</td>";
        echo "<td>{$rowDetailPenjualan['id_barang']}</td>";
        echo "<td>{$rowDetailPenjualan['jumlah']}</td>";
        echo "<td>{$rowDetailPenjualan['subtotal']}</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";

    // Tutup statement
    mysqli_stmt_close($stmt);
} else {
    echo "Parameter id_Penjualan tidak ditemukan.";
}
?>

<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    echo "<script>window.location.href = '../public/login.php';</script>";
    exit();
}

require '../koneksi/koneksi.php';



if (isset($_GET['id_pembelian'])) {

    $idPembelian = $_GET['id_pembelian'];



    // Gunakan prepared statement untuk mencegah SQL injection

    $stmt = mysqli_prepare($con, "SELECT * FROM detail_pembelian WHERE id_pembelian = ?");

    mysqli_stmt_bind_param($stmt, "s", $idPembelian);

    mysqli_stmt_execute($stmt);

    $resultDetailPembelian = mysqli_stmt_get_result($stmt);



    echo "<table class='table'>";

    echo "<thead>

            <tr>

                <th>ID Pembelian</th>

                <th>Nama Barang</th>

                <th>Tanggal Kadaluarsa</th>

                <th>Jumlah</th>

                <th>Subtotal</th>

            </tr>

        </thead>

        <tbody>";



        while ($rowDetailPembelian = mysqli_fetch_assoc($resultDetailPembelian)) {

            echo "<tr>";

            echo "<td>{$rowDetailPembelian['id_pembelian']}</td>";

            echo "<td>{$rowDetailPembelian['nama_barang']}</td>";

            echo "<td>{$rowDetailPembelian['tanggal_kadaluarsa']}</td>";

            echo "<td>{$rowDetailPembelian['jumlah']}</td>";

            echo "<td>{$rowDetailPembelian['subtotal']}</td>";

            echo "<td><button class='btn btn-sm btn-delete-item' data-idpembelian='{$idPembelian}' data-iditem='{$rowDetailPembelian['id_detail_pembelian']}'><i class='fa-solid fa-trash-can'></i></button></td>";

            echo "</tr>";

        }

        



    echo "</tbody></table>";



    // Tutup statement

    mysqli_stmt_close($stmt);

} else {

    echo "Parameter id_pembelian tidak ditemukan.";

}

?>


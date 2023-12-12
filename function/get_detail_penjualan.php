<?php
session_start();
require '../koneksi/koneksi.php';
if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    echo "<script>window.location.href = '../public/login.php';</script>";
    exit();
}


if (isset($_GET['id_penjualan'])) {

    $id_penjualan = $_GET['id_penjualan'];



    $query_penjualan = mysqli_query($con, "SELECT * FROM penjualan WHERE id_penjualan = '$id_penjualan'");

    $penjualan = mysqli_fetch_assoc($query_penjualan);



    if ($penjualan) {

        $id_penjualan = $penjualan['id_penjualan'];



        $query_detail_penjualan = mysqli_query($con, "SELECT dp.*, b.harga_jual, b.nama_barang FROM detail_penjualan dp

                                               INNER JOIN barang b ON dp.id_barang = b.id_barang

                                               WHERE dp.id_penjualan = '$id_penjualan'");



$detail_penjualan = array();

while ($row = mysqli_fetch_assoc($query_detail_penjualan)) {

    $detail_penjualan[] = $row;

}



echo "<table class='table'>";

echo "<thead>

        <tr>

            <th>ID Penjualan</th>

            <th>Nama Barang</th>

            <th>Harga</th>

            <th>Qty</th>

            <th>Subtotal</th>

        </tr>

    </thead>

    <tbody>";



if (!empty($detail_penjualan)) {

    foreach ($detail_penjualan as $index => $detail) {

        echo "<tr>";

        echo "<td>{$id_penjualan}</td>";

        echo "<td>{$detail['nama_barang']}</td>";

        echo "<td>{$detail['harga_jual']}</td>";

        echo "<td>{$detail['jumlah']}</td>";

        echo "<td>{$detail['subtotal']}</td>";

        echo "</tr>";

    }

} else {

    echo "<tr><td colspan='5'>No details found</td></tr>";

}



echo "</tbody></table>";



echo "<a href='../function/bukti_pembayaran.php?id_penjualan={$id_penjualan}' target='_blank' class='btn btn-primary btn-sm'>Lihat Bukti Pembayaran</a>";



        echo "<div class='row mt-3'>

                <div class='col'>

                    <button class='btn btn-danger btn-sm' onclick='tolakPesanan(\"{$id_penjualan}\")'>Tolak Pesanan</button>

                    <button class='btn btn-success btn-sm' onclick='terimaPesanan(\"{$id_penjualan}\")'>Terima Pesanan</button>

                </div>

              </div>";

    } else {

        echo "Data penjualan tidak ditemukan.";

    }

} else {

    echo "Parameter id_penjualan tidak ditemukan.";

}

?>
<script>

    function tolakPesanan(idPenjualan) {

        $.ajax({

            type: "POST",

            url: "../function/tolak_pesanan.php", 

            data: { id_penjualan: idPenjualan },

            success: function (response) {

                console.log("Pesanan ditolak: " + response);

                // alert("Pesanan berhasil di tolak")

                location.reload()

            },

            error: function (error) {

                console.error("Error saat menolak pesanan: " + error);

                alert("Error saat menolak pesanan: " + error)

            }

        });

    }



    function terimaPesanan(idPenjualan) {

        $.ajax({

            type: "POST",

            url: "../function/terima_pesanan.php",

            data: { id_penjualan: idPenjualan },

            success: function (response) {

                console.log("Pesanan diterima: " + response);

                // alert("Pesanan berhasil di terima");

                $('#myModal2').modal('hide');

                location.reload();

            },

            error: function (error) {

                console.error("Error saat menerima pesanan: " + error);

                alert("Error saat menerima pesanan: " + error);

            }

        });

    }

</script>


<?php
    $con = mysqli_connect("localhost", "mifbmyh1_tomass", "WSImif2023", "mifbmyh1_tomass");
    if (mysqli_connect_errno()) {
        echo "Tidak terhubung ke MySQL" . mysqli_connect_errno();
        exit();
    }

    $query_penjualan = "SELECT * FROM penjualan";
    $result_penjualan = mysqli_query($con, $query_penjualan);

    $query_detail_penjualan = "SELECT * FROM detail_penjualan";
    $result_detail_penjualan = mysqli_query($con, $query_detail_penjualan);

    $query_barang = "SELECT * FROM barang";
    $result_barang = mysqli_query($con, $query_barang);

    $query_pembelian = "SELECT * FROM pembelian";
    $result_pembelian = mysqli_query($con, $query_pembelian);

    $query_detail_pembelian = "SELECT * FROM detail_pembelian";
    $result_detail_pembelian = mysqli_query($con, $query_detail_pembelian);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keperluan chart admin</title>
<style>
#container {
    position: absolute;
    margin: auto;
    width: 100vw;
    height: 80pt;
    top: 0;
    bottom: 0;

    filter: url(#threshold) blur(0.6px);
}

#text1,
#text2 {
    position: absolute;
    width: 100%;
    display: inline-block;

    font-family: "Raleway", sans-serif;
    font-size: 80pt;

    text-align: center;

    user-select: none;
}
</style>

</head>
<body>
<div id="container">
    <span id="text1"></span>
    <span id="text2"></span>
</div>

<svg id="filters">
    <defs>
        <filter id="threshold">
            <feColorMatrix in="SourceGraphic" type="matrix" values="1 0 0 0 0
                  0 1 0 0 0
                  0 0 1 0 0
                  0 0 0 255 -140" />
        </filter>
    </defs>
</svg>

    <h1>Data Detail Penjualan</h1>

    <table border="1">
        <tr>
            <th>ID Detail Penjualan</th>
            <th>ID Penjualan</th>
            <th>ID Barang</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
            <th>Nama</th>
            <th>Provinsi</th>
            <th>Kota</th>
            <th>Alamat</th>
            <th>Kode Pos</th>
        </tr>
        <?php
            while ($row_detail_penjualan = mysqli_fetch_assoc($result_detail_penjualan)) {
                echo "<tr>";
                echo "<td>{$row_detail_penjualan['id_detail_penjualan']}</td>";
                echo "<td>{$row_detail_penjualan['id_penjualan']}</td>";
                echo "<td>{$row_detail_penjualan['id_barang']}</td>";
                echo "<td>{$row_detail_penjualan['jumlah']}</td>";
                echo "<td>{$row_detail_penjualan['subtotal']}</td>";
                echo "<td>{$row_detail_penjualan['nama']}</td>";
                echo "<td>{$row_detail_penjualan['provinsi']}</td>";
                echo "<td>{$row_detail_penjualan['kota']}</td>";
                echo "<td>{$row_detail_penjualan['alamat']}</td>";
                echo "<td>{$row_detail_penjualan['kode_pos']}</td>";
                echo "</tr>";
            }
        ?>
    </table>
<h1>Data Penjualan</h1>

    <table border="1">
        <tr>
            <th>ID Penjualan</th>
            <th>ID User</th>
            <th>Tanggal Penjualan</th>
            <th>Total Penjualan</th>
        </tr>
        <?php
            while ($row_penjualan = mysqli_fetch_assoc($result_penjualan)) {
                echo "<tr>";
                echo "<td>{$row_penjualan['id_penjualan']}</td>";
                echo "<td>{$row_penjualan['id_user']}</td>";
                echo "<td>{$row_penjualan['tanggal_penjualan']}</td>";
                echo "<td>{$row_penjualan['total_penjualan']}</td>";
                echo "</tr>";
            }
        ?>
    </table>

    <h1>Data Barang</h1>

    <table border="1">
        <tr>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Harga Jual</th>
            <th>Harga Beli</th>
            <th>Stok</th>
            <th>Satuan</th>
        </tr>
        <?php
            while ($row_barang = mysqli_fetch_assoc($result_barang)) {
                echo "<tr>";
                echo "<td>{$row_barang['id_barang']}</td>";
                echo "<td>{$row_barang['nama_barang']}</td>";
                echo "<td>{$row_barang['harga_jual']}</td>";
                echo "<td>{$row_barang['harga_beli']}</td>";
                echo "<td>{$row_barang['stok']}</td>";
                echo "<td>{$row_barang['satuan']}</td>";
                echo "</tr>";
            }
        ?>
    </table>

<h1>Data Pembelian</h1>
    <table border="1">
        <!-- Table headers -->
        <tr>
            <th>ID Pembelian</th>
            <th>ID User</th>
            <th>ID Supplier</th>
            <th>Tanggal Pembelian</th>
            <th>Total Pembelian</th>
        </tr>
        <!-- Table rows -->
        <?php
            while ($row_pembelian = mysqli_fetch_assoc($result_pembelian)) {
                echo "<tr>";
                echo "<td>{$row_pembelian['id_pembelian']}</td>";
                echo "<td>{$row_pembelian['id_user']}</td>";
                echo "<td>{$row_pembelian['id_supplier']}</td>";
                echo "<td>{$row_pembelian['tanggal_pembelian']}</td>";
                echo "<td>{$row_pembelian['total_pembelian']}</td>";
                echo "</tr>";
            }
        ?>
    </table>

    <h1>Data Detail Pembelian</h1>
    <table border="1">
        <!-- Table headers -->
        <tr>
            <th>ID Detail Pembelian</th>
            <th>ID Pembelian</th>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Tanggal Kadaluarsa</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
        <!-- Table rows -->
        <?php
            while ($row_detail_pembelian = mysqli_fetch_assoc($result_detail_pembelian)) {
                echo "<tr>";
                echo "<td>{$row_detail_pembelian['id_detail_pembelian']}</td>";
                echo "<td>{$row_detail_pembelian['id_pembelian']}</td>";
                echo "<td>{$row_detail_pembelian['id_barang']}</td>";
                echo "<td>{$row_detail_pembelian['nama_barang']}</td>";
                echo "<td>{$row_detail_pembelian['tanggal_kadaluarsa']}</td>";
                echo "<td>{$row_detail_pembelian['jumlah']}</td>";
                echo "<td>{$row_detail_pembelian['subtotal']}</td>";
                echo "</tr>";
            }
        ?>
    </table>

<script>
const elts = {
    text1: document.getElementById("text1"),
    text2: document.getElementById("text2")
};

const texts = [
    "NGAPAIN",
    "ANDA \ud83e\udef5",
    "BUKA",
    "HALAMAN",
    "WEBSITE",
    "YANG",
    "INI",
    "\uD83D\uDE21 \uD83D\uDE21 \uD83D\uDE21",
    "INI",
"HANYA",
"UNTUK",
"KEPERLUAN",
"CHART",
"POWER BI",
"SAJA",
"TERIMAKASIH",
"\uD83D\uDE12",
"LAH...",
"AYO KELUAR",
"NGAPAIN MASIH DI SINI",
"\uD83D\uDE11",
];

const morphTime = 1;
const cooldownTime = 0.25;

let textIndex = texts.length - 1;
let time = new Date();
let morph = 0;
let cooldown = cooldownTime;

elts.text1.textContent = texts[textIndex % texts.length];
elts.text2.textContent = texts[(textIndex + 1) % texts.length];

function doMorph() {
    morph -= cooldown;
    cooldown = 0;

    let fraction = morph / morphTime;

    if (fraction > 1) {
        cooldown = cooldownTime;
        fraction = 1;
    }

    setMorph(fraction);
}

function setMorph(fraction) {
    elts.text2.style.filter = `blur(${Math.min(8 / fraction - 8, 100)}px)`;
    elts.text2.style.opacity = `${Math.pow(fraction, 0.4) * 100}%`;

    fraction = 1 - fraction;
    elts.text1.style.filter = `blur(${Math.min(8 / fraction - 8, 100)}px)`;
    elts.text1.style.opacity = `${Math.pow(fraction, 0.4) * 100}%`;

    elts.text1.textContent = texts[textIndex % texts.length];
    elts.text2.textContent = texts[(textIndex + 1) % texts.length];
}

function doCooldown() {
    morph = 0;

    elts.text2.style.filter = "";
    elts.text2.style.opacity = "100%";

    elts.text1.style.filter = "";
    elts.text1.style.opacity = "0%";
}

function animate() {
    requestAnimationFrame(animate);

    let newTime = new Date();
    let shouldIncrementIndex = cooldown > 0;
    let dt = (newTime - time) / 1000;
    time = newTime;

    cooldown -= dt;

    if (cooldown <= 0) {
        if (shouldIncrementIndex) {
            textIndex++;
        }

        doMorph();
    } else {
        doCooldown();
    }
}

animate();
</script>

</body>
</html>

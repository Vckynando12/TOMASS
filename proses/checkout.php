<?php
// include("../koneksi/koneksi.php");

// session_start();

// // Pengecekan apakah pengguna sudah login
// if (!isset($_SESSION['user_id'])) {
//     header("Location: ../public/login.php"); // Ganti dengan path menuju halaman login
//     exit();
// }

// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkout'])) {
//     $id_user_login = $_SESSION['user_id'];

//     // Ambil data keranjang dan detail keranjang seperti pada halaman keranjang.php
//     $query_keranjang = mysqli_query($con, "SELECT * FROM keranjang WHERE id_user = $id_user_login");
//     $keranjang = mysqli_fetch_assoc($query_keranjang);

//     if ($keranjang) {
//         $id_keranjang = $keranjang['id_keranjang'];
//         $query_detail_keranjang = mysqli_query($con, "SELECT * FROM detail_keranjang WHERE id_keranjang = '$id_keranjang'");
//         $detail_keranjang = mysqli_fetch_all($query_detail_keranjang, MYSQLI_ASSOC);

//         // Lakukan logika checkout di sini, misalnya:
//         // - Buat data penjualan baru
//         // - Simpan detail penjualan dari detail_keranjang
//         // - Hitung total harga
//         // - Hapus data dari detail_keranjang

//         $total_harga = $keranjang['total_harga'];

//         // Simpan data penjualan
//         $query_penjualan = mysqli_query($con, "INSERT INTO penjualan (id_user, total_penjualan) VALUES ('$id_user_login', '$total_harga')");

//         if ($query_penjualan) {
//             // Ambil ID penjualan yang baru dibuat
//             $id_penjualan = mysqli_insert_id($con);

//             // Simpan detail penjualan
//             foreach ($detail_keranjang as $detail) {
//                 $id_barang = $detail['id_barang'];
//                 $jumlah = $detail['jumlah'];
//                 $total_barang = $detail['total_barang'];

//                 mysqli_query($con, "INSERT INTO detail_penjualan (id_penjualan, id_barang, jumlah, subtotal) VALUES ('$id_penjualan', '$id_barang', '$jumlah', '$total_barang')");
//             }

//             // Hapus data dari detail_keranjang setelah checkout
//             mysqli_query($con, "DELETE FROM detail_keranjang WHERE id_keranjang = '$id_keranjang'");

//             echo "Checkout berhasil! Terima kasih atas pembelian Anda.";

//             // Setelah berhasil checkout, redirect ke halaman sukses atau lainnya
//             // Ganti pathnya sesuai kebutuhan
//             header("Location: ../public/index.php");
//             exit();
//         } else {
//             echo "Checkout gagal. Silakan coba lagi.";
//         }
//     } else {
//         echo "Keranjang belanja kosong.";
//     }
// } else {
//     // Redirect jika bukan POST request
//     header("Location: ../path/ke/halaman/keranjang.php");
//     exit();
// }
?>
<?php
include("../koneksi/koneksi.php");
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php"); 
    exit();
}
$id_user_login = $_SESSION['user_id'];

$query_total_harga = mysqli_query($con, "SELECT SUM(total) AS total_harga FROM detail_keranjang WHERE id_keranjang IN (SELECT id_keranjang FROM keranjang WHERE id_user = $id_user_login)");
$total_harga_result = mysqli_fetch_assoc($query_total_harga);
$total_harga = $total_harga_result['total_harga'];

$query_keranjang = mysqli_query($con, "SELECT * FROM keranjang WHERE id_user = $id_user_login");
$keranjang = mysqli_fetch_assoc($query_keranjang);

if ($keranjang) {
    $id_keranjang = $keranjang['id_keranjang'];
    $query_detail_keranjang = mysqli_query($con, "SELECT dk.*, b.nama_barang, b.harga_jual FROM detail_keranjang dk
                                                   INNER JOIN barang b ON dk.id_barang = b.id_barang
                                                   WHERE dk.id_keranjang = '$id_keranjang'");
    $detail_keranjang = mysqli_fetch_all($query_detail_keranjang, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Checkout</h2>
        <?php if ($keranjang) : ?>
            <h3>Daftar Pesanan</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detail_keranjang as $index => $detail) : ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= $detail['nama_barang']; ?></td>
                            <td><?= $detail['harga_jual']; ?></td>
                            <td><?= $detail['jumlah']; ?></td>
                            <td><?= $detail['total']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h3>Grand Total: <?= $total_harga; ?></h3>
            <h3>Pastikan Pesanan Anda Sudah Benar</h3>

            <form action="../proses/proses_checkout.php" method="post">
                <label for="nama">Nama</label>
                <input type="text" name="nama" required>

                <label for="provinsi">Provinsi</label>
                <input type="text" name="provinsi" required>

                <label for="kota">Kota</label>
                <input type="text" name="kota" required>

                <label for="alamat">Alamat</label>
                <textarea name="alamat" rows="" required></textarea>

                <label for="kode_pos">Kode Pos</label>
                <input type="text" name="kode_pos" required>

                <button type="submit" name="order_now" class="btn btn-success">Order Now</button>
                <button type="button" class="btn btn-danger" onclick="window.location.href='../proses/keranjang.php'">Cancel</button>
            </form>
        <?php else : ?>
            <p>Keranjang belanja Anda kosong.</p>
        <?php endif; ?>
    </div>
</body>
</html>


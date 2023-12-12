<?php
include('../koneksi/koneksi.php');

if (isset($_GET['token'])) {
    $verifikasiToken = $_GET['token'];

    // Periksa apakah token verifikasi sesuai
    $checkVerification = "SELECT * FROM user WHERE verifikasi_token='$verifikasiToken'";
    $result = mysqli_query($con, $checkVerification);

    if ($result->num_rows > 0) {
        $updateVerification = "UPDATE user SET verifikasi_token = NULL, verified = TRUE WHERE verifikasi_token = '$verifikasiToken'";
        mysqli_query($con, $updateVerification);

        echo '<script>alert("Verifikasi berhasil. Anda sekarang dapat masuk."); window.location.href = "../public/login.php";</script>';
    } else {
        echo '<script>alert("Verifikasi gagal. Token tidak valid atau sudah digunakan.");</script>';
    }
} else {
    echo '<script>alert("Parameter tidak valid.");</script>';
}
?>

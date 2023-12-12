<?php

include('../koneksi/koneksi.php');

if (isset($_POST['daftarbtn'])) {
    $userMail = $_POST['email'];
    $userPass = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $userName = $_POST['username'];
    $usernl = $_POST['nama'];
    $userTel = $_POST['telepon'];

    $cek_akun = "SELECT * FROM user WHERE email='$userMail'";
    $result1 = mysqli_query($con, $cek_akun);

    if ($result1->num_rows > 0) {
        echo '<script>alert("Akun sudah terdaftar. Silahkan gunakan email yang lain.")</script>';
    } else {
        $verifikasi_token = md5(uniqid(rand(), true));
        $tambah_akun = "INSERT INTO user (Nama, email, username, password, telpon, level, verifikasi_token, verified) 
                VALUES ('$usernl', '$userMail', '$userName', '$userPass', '$userTel', 2, '$verifikasi_token', 0)";

        $result2 = mysqli_query($con, $tambah_akun);

        if ($result2 === TRUE) {
            $subject = "Verifikasi Akun Anda";
            $message = "Klik link berikut untuk verifikasi akun Anda: https://tomass.mifb.myhost.id/proses/verifikasi.php?token=$verifikasi_token";
            mail($userMail, $subject, $message);

            echo '<script>alert("Berhasil mendaftar. Silahkan cek email Anda untuk verifikasi."); window.location.href = "../public/login.php";</script>';
        } else {
            echo '<script>alert("Gagal mendaftar. Silahkan coba lagi."); window.location.href = "../public/register.php";</script>';
        }
    }
}

?>

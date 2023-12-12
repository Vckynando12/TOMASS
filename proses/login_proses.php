<?php
session_start();
require '../koneksi/koneksi.php';

if (isset($_POST['loginbtn'])){
    $email  = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $query = mysqli_query($con, "SELECT * FROM user WHERE email='$email'");
    $countdata = mysqli_num_rows($query);
    $data = mysqli_fetch_assoc($query);

    if($countdata > 0){
        if($data['verified'] == 1){
            if(password_verify($password, $data['password'])){
                $_SESSION['username'] = $data;
                $_SESSION['login'] = true;
                $_SESSION['user_id'] = $data['id_user'];
                $_SESSION['level'] = $data['level'];

                if($data['level'] == 1){
                    header('location: ../admin/index.php');
                    exit();
                }
                elseif($data['level'] == 2) {
                    header('location: ../public/index.php');
                    exit();
                }
            }
            else{
                $password_error = true;
                $_SESSION['message'] = "Password salah, silakan coba lagi.";
                $_SESSION['redirect'] = true;
            }
        }
        else{
            $_SESSION['message'] = "Akun belum terverifikasi. Silakan verifikasi akun Anda melalui email terlebih dahulu.";
            $_SESSION['redirect'] = true;
        }
    }
    else{
        $account_not_found = true;
        $_SESSION['message'] = "Akun tidak ditemukan. Silakan periksa kembali email Anda.";
    }
}

if (isset($_SESSION['message'])) {
    echo "<script>alert('{$_SESSION['message']}'); setTimeout(function(){ window.location.href = '../public/login.php'; }, 500);</script>";
    unset($_SESSION['message']);
    unset($_SESSION['redirect']);
}
?>

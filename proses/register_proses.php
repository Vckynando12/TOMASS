<?php
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/register.css">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <div class="main d-flex flex-column form-control justify-content-center align-items-center">
        <div class="register-box p-5 shadow">
            <form action="" method="post">
            <h2>Register</h2>
                    <div class="h-100">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" 
                        id="email" placeholder="Masukkan email">

                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" 
                        id="username" placeholder="Masukkan username">

                        <label for="telepon">No. Telepon</label>
                        <input type="text" class="form-control" name="telepon" 
                        id="telepon" placeholder="Nomor telepon">

                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" 
                        id="password" >

                        <label for="password">Konfirmasi Password</label>
                        <input type="password" class="form-control" name="password" 
                        id="password" >

                        <label for="alamat">Alamat</label>
                        <input type="text-area" class="form-control" name="alamat" 
                        id="username" placeholder="Masukkan alamat lengkap">
                    </div>
                    <div class="button-container">
                        <center>
                            <button class="btn btn-success mt-3" type="submit" name="daftarbtn">Register</button>
                        </center>
                    </div>
                    <div class="link text-center">
                    <a href="login_proses.php" class="text-dark">Sudah punya akun?Login</a>
                    </div>
            </form>
        </div>
        <div class="mt-3" style="width: 500px;">
            <?php
            require '../koneksi/koneksi.php';
                if(isset($_POST['daftarbtn'])) {
                    $userMail = $_POST['email'];
                    $userPass = $_POST['password'];
                    $userName = $_POST['username'];
                    $userTel = $_POST['telepon'];
                    $userAlamat = $_POST['alamat'];

                
                    $query = "INSERT INTO user VALUES (NULL, '$userMail', '$userName', '$userPass', '$userTel', '$userAlamat', 2)";
                    $result = mysqli_query($con, $query);
                    if($result == true ){
                        header('Location: login_proses.php');
                    }else{
                        header('Location: register.php');
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>
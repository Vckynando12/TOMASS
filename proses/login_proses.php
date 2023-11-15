<?php
    session_start();
    require '../koneksi/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <section class="login d-flex">
        <div class="login-left w-50 h-100">
            <img src="../assets/image/bgKue3.webp" class="d-inline-block h-100 w-100">
        </div>
        <div class="login-right w-50 h-100">
        <div class="row align-items-center justify-content-center h-100">
                <div class="col-6">
                    <div class="login-form">
                        <form action="" method="post">
                        <h1 class="text-center">LOGIN</h1>
                            <div>
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" 
                                id="email" placeholder="Masukkan email">

                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" 
                                id="password" placeholder="Masukkan kata sandi">
                                <div class="text-center">
                                <a href="lupa_password.php" class="text-decoration text-dark">Lupa password?</a>
                                </div>
                            </div>
                            <div class="button-container">
                                <center>
                                    <button class="btn mt-3 text-white" type="submit" name="loginbtn">Masuk</button>
                                    <a href="register_proses.php" class="btn mt-3 text-white" type="submit">Daftar</a>
                                </center>
                            </div>
                        </form>
                    </div>

                    <div class="mt-3" style="width: 500px;">
                        <?php
                        if (isset($_POST['loginbtn'])){
                            $email  = htmlspecialchars($_POST['email']);
                            $password = htmlspecialchars($_POST['password']);

                            $query = mysqli_query($con, "SELECT * FROM user WHERE email='$email'");
                            $countdata = mysqli_num_rows($query);
                            $data = mysqli_fetch_assoc($query);

                            if($countdata>0){
                                $hashed = password_hash($data['password'], PASSWORD_BCRYPT);
                                if(password_verify($password, $hashed)){
                                    $_SESSION['email'] = $data['email'];
                                    $_SESSION['username'] = $data['username'];
                                    $_SESSION['level'] = $data['level'];
                                    if($data['level'] == 1){
                                        header('location: ../admin/index.php');
                                        exit();
                                    }
                                    elseif($data['level']==2) {
                                        header('location: ../customer/home.php');
                                        exit();
                                    }
                                    $_SESSION['login'] = true;
                                }
                                else{
                                    ?>
                                    <div class="alert alert-danger" role="alert">
                                        Password salah
                                    </div>
                                    <?php
                                }
                            }
                            else{
                                ?>
                                <div class="alert alert-warning" role="alert">
                                    Akun tidak tersedia
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
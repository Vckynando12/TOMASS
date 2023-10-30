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
</head>

<style>
    .main{
        height: 100vh;
    }

    .login-box{
        width: 500px;
        height: 300px;
        box-sizing: border-box;
        border-radius: 10px;
    }
    .button-container{
        display: flexbox;
    }
    .button{
        padding: 10px 20px;
        margin-right: 10px;
        border: none;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
    }
</style>
<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login-box p-5 shadow">
            <form action="" method="post">
                <div>
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" 
                    id="email">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" 
                    id="password">
                </div>
                <div>
                    <a href="lupa_password">Lupa password?</a>
                </div>
                <div class="button-container">
                    <button class="btn btn-success mt-3" type="submit" name="loginbtn">Login</button>
                    <button class="btn btn-success mt-3" type="submit" name="daftarbtn">Register</button>
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
                            header('location: ../admin/dashboard_admin.php');
                            exit();
                        }
                        elseif($data['level']==2) {
                            header('location: dashboard_karyawan.php');
                            exit();
                        }
                        elseif($data['level']==3){
                            header('location: home.php');
                            exit();
                        }
                        $_SESSION['login'] = true;
                    }
                    else{
                        ?>
                        <div class="alert alert-warning" role="alert">
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
</body>
</html>
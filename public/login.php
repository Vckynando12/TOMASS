<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
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
    .button-container {
        display: flex;
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
            <form action="../proses/login_proses.php" method="post">
                <div>
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
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
                if (isset($password_error)){
                    echo '<div class="alert alert-warning" role="alert">Password salah</div>';
                }
                elseif (isset($account_not_found)){
                    echo '<div class="alert alert-warning" role="alert">Akun tidak tersedia</div>';
                }
            ?>
        </div>
    </div>
    
</body>
</html>
<?php
    require '../koneksi/koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode verifikasi</title>
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/kode_otp.css">
</head>

<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <section class="pwd d-flex">
        <div class="pwd-left w-50 h-100">
            <img src="../assets/image/bgKue3.webp" class="d-inline-block h-100 w-100">
        </div>
        <div class="pwd-right w-50 h-100">
        <div class="row align-items-center justify-content-center h-100">
                <div class="col-6">
                    <div class="pwd-form">
                        <form action="" method="post">
                        <h1 class="text-center">FORGOT PASSWORD</h1>
                            <div>
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" 
                                id="email" placeholder="Enter your email">
                            </div>
                            <div class="button-container">
                                <a href="kode_otp.php" class="btn mt-3 text-white" type="submit">Lanjut</a>
                            </div>
                        </form>
                    </div>

                    <div>
                        <?php
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
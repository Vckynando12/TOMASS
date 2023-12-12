<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    echo "<script>window.location.href = '../public/login.php';</script>";
    exit();
}

include '../layout/header.php';

require '../koneksi/koneksi.php';



// hapus

if (isset($_GET['page']) && isset($_GET['kode'])) {

    $kode = $_GET['kode'];

    $result = mysqli_query($con, "DELETE FROM user WHERE id_user = '$kode'");



    if ($result) {

        echo "

		<script>

		window.location = 'm_user.php';

		alert('DATA BERHASIL DI HAPUS');

		</script>

		";

    }

}



// tambah

// $randomNumber = rand(10, 9999);

// $format = "S" . $randomNumber;

if (isset($_POST['add'])) {

    $namauser = $_POST['Nama'];

    $email = $_POST['email'];

    $username = $_POST['username'];

    $pass = $_POST['password'];

    $telpon = $_POST['telpon'];

    $level = $_POST['level'];



    $result = mysqli_query($con, "INSERT INTO user (Nama, email, username, password, telpon, level) VALUES ('$namauser', '$email', '$username', '$pass', '$telpon', '$level')");



    if ($result) {

        echo "

            <script>

            alert('DATA BERHASIL DITAMBAHKAN');

            window.location = 'm_user.php';

            </script>

        ";

    } else {

        echo "Gagal menambahkan user.";

    }

}



?>





<div id="layoutSidenav_content">

    <div class="container-fluid px-4">

        <h1 class="mt-4">Data User</h1>

        <ol class="breadcrumb mb-4">

            <li class="breadcrumb-item active">Master/User</li>

        </ol>

        <hr>

        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">

            Tambah

        </button>

        <div class="card-body">

            <br>

            <table id="datatablesSimple">

                <thead>

                    <tr>

                        <th scope="col">No</th>

                        <!-- <th scope="col">Kode User</th> -->

                        <th scope="col">Nama</th>

                        <th scope="col">Email</th>

                        <th scope="col">Username</th>

                        <th scope="col">Password</th>

                        <th scope="col">Telpon</th>

                        <th scope="col">Level</th>

                        <th scope="col">Action</th>

                    </tr>

                </thead>

                <tbody>

                    <?php

                    $result = mysqli_query($con, "SELECT * FROM user order by id_user asc");

                    $no = 1;

                    while ($row = mysqli_fetch_assoc($result)) {

                        ?>

                        <tr>

                            <th scope="row">

                                <?php echo $no; ?>

                            </th>

                            <td>

                                <?= $row['Nama']; ?>

                            </td>

                            <td>

                                <?= $row['email']; ?>

                            </td>

                            <td>

                                <?= $row['username']; ?>

                            </td>

                            <td>

                                <?= $row['password']; ?>

                            </td>

                            <td>

                                <?= $row['telpon']; ?>

                            </td>

                            <td>

                                <?= $row['level']; ?>

                            </td>

                            <td><a href="m_user.php?kode=<?php echo $row['id_user']; ?>&page=del" class="btn btn-danger"

                                    onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i

                                        class="glyphicon glyphicon-trash"></i>Hapus </a></td>

                        </tr>

                        <?php

                        $no++;

                    }

                    ?>

                </tbody>

            </table>



        </div>

        <!-- Button trigger modal -->



        <!-- The Modal -->

        <div class="modal fade" id="myModal">

            <div class="modal-dialog">

                <div class="modal-content">



                    <!-- Modal Header -->

                    <div class="modal-header">

                        <h4 class="modal-title">Tambah Barang Masuk</h4>

                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                    </div>



                    <!-- Modal body -->

                    <form action="m_user.php" method="post" enctype="multipart/form-data">

                        <div class="modal-body">

                            <input type="text" name="Nama" placeholder="nama user" class="form-control" require>

                            <br>

                            <input type="email" name="email" placeholder="Email" class="form-control" require>

                            <br>

                            <input type="num" name="username" placeholder="Username" class="form-control" require>

                            <br>

                            <input type="Jumlah" name="password" placeholder="Password" class="form-control" require>

                            <br>

                            <input type="number" name="telpon" placeholder="Telpon" class="form-control" require>

                            <br>

                            <label for="level">Level:</label>

                            <input type="number" name="level" placeholder="1 (admin) 2(user)" class="form-control"

                                required pattern="[1-2]" title="Masukkan nilai 1 atau 2">

                            <br>

                            <button type="submit" class="btn btn-primary" name="add">Submit</button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../layout/footer.php'; ?>
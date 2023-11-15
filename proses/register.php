<?php
    session_start();
    require '../koneksi/koneksi.php';
    include 'header.php'
?>
<link rel="stylesheet" href="../assets/bootstrap/bootstrap.min.css">

<div class="container" style="padding-bottom: 250px;">
	<form action="proses/register.php" method="POST">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputPassword1">Nama</label>
					<input type="text" class="form-control" id="exampleInputPassword1" placeholder="Nama" name="nama" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputPassword1">Email</label>
					<input type="email" class="form-control" id="exampleInputPassword1" placeholder="Email" name="email" required>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputPassword1">username</label>
					<input type="text" class="form-control" id="exampleInputPassword1" placeholder="Username" name="username" required >
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputPassword1">No Tepl</label>
					<input type="text" class="form-control" id="exampleInputPassword1" placeholder="+62" name="telp" required >
				</div>
			</div>

		</div>


		<div class="row">
			
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputPassword1">Konfirmasi Password</label>
					<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Konfirmasi Password" name="konfirmasi" required>
				</div>
			</div>
		</div>
		<br>
		<button type="submit" class="btn btn-success">Register</button>
		<div class="button-container"><a href="login_proses.php" class="btn btn-success mt-3">Kembali Login</a>
	</form>
</div>

<?php 
	include '../proses/footer.php';
 ?>
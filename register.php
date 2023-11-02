<?php
    session_start();
    require '../koneksi/koneksi.php';
?>
<link rel="stylesheet" href="../assets/bootstrap/bootstrap.min.css">
<div class="container" style="padding-bottom: 250px;">
	<h2 style=" width: 100%; border-bottom: 4px "><b>Register</b></h2>
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
	</form>
</div>

<?php
$kode = mysqli_query($conn, "SELECT ID from wp_users order by ID desc");
$data = mysqli_fetch_assoc($kode);
$num = substr($data['kode_customer'], 1, 4);

$add = (int) $num + 1;
if(strlen($add) == 1){
	$format = "C000".$add;
}else if(strlen($add) == 2){
	$format = "C00".$add;
}
else if(strlen($add) == 3){
	$format = "C0".$add;
}else{
	$format = "C".$add;
}

$nama = $_POST['user_login'];
$username = $_POST['user_nicename'];
$password = $_POST['user_pass'];
$email = $_POST['user_email'];
$konfirmasi = $_POST['konfirmasi'];



$hash = password_hash($password, PASSWORD_DEFAULT);

if($password == $konfirmasi){
	$cek = mysqli_query($conn, "SELECT user_nicename from wp_users where user_nicename = '$username'");;
	$jml = mysqli_num_rows($cek);

	if($jml == 1){
		echo "
		<script>
		alert('USERNAME SUDAH DIGUNAKAN');
		window.location = '../register.php';
		</script>
		";
		die;
	}

	$result = mysqli_query($conn, "INSERT INTO wp_users VALUES('$format','$nama', '$email', '$username', '$hash')");
	if($result){
		echo "
		<script>
		alert('REGISTER BERHASIL');
		window.location = '../user_login.php';
		</script>
		";
	}

}else{
	echo "
	<script>
	alert('KONFIRMASI PASSWORD TIDAK SAMA');
	window.location = '../register.php';
	</script>
	";
}


?>

<?php
    include 'header.php';
?>


<div class="container" style="padding-bottom: 250px;">
		<h2 style=" width: 100%; border-bottom: 4px solid #ff8680"><b>Login</b></h2>

<form action="proses/login.php" method="POST">
		<div class="form-group">
			<label for="exampleInputEmail1">username</label>
			<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Username" name="username" style="width: 500px;">
		</div>
		
		<div class="form-group">
			<label for="exampleInputEmail1">Password</label>
			<input type="password" class="form-control" id="exampleInputEmail1" placeholder="Password" name="pass" style="width: 500px;">
		</div>
		<button type="submit" class="btn btn-success">Login</button>
		<a href="register.php" class="btn btn-primary">Daftar</a>
	</form>
</div>
<style>
    .main{
        height: 75vh;
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
        </div>
    </div>
</body>
</html>

<?php 
	include '../proses/footer.php';
 ?>

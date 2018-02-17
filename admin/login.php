<?php session_start(); ?>


<!DOCKTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>admin log in</title>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="style.css" rel="text/css" type="text/css"/>
	</head>
	<body>
	<?php include("../include/head.php"); ?>
		
		<form method="post" action="login.php">
			<div class="maindiv">
			<img class="logo" src="../include/logo.jpg" alt="logo" height="80px" width="80px" align="center">
					<div class="head"> 
					<h1>Admin Log in</h1></div>
					
				 <div id="container">
				<p> User Name</p>
				 <input type ="text" name="username"> 
				 
				<p>Password </p>
				<input type="password" name="userpass"><br/>
		
				<input type="submit" name="login" value="Login"><br/>
				<a id="forgotpass" href="#">Forgot password?</a>
				</div>
				</div>
		</form>
	
		
	</body>
<html>
<?php 

	
	if(isset($_POST['login'])){

		require_once('../include/dbconnect.php');
		
		$user_name= mysqli_real_escape_string($conn,$_POST['username']);
		$user_password= mysqli_real_escape_string($conn,$_POST['userpass']);
		
		

		$encrpt= md5($user_password);
		
		$query= "select * from admin_login where username = '$user_name' AND password='$user_password'";
		
		$run= mysqli_query($conn,$query);
		
		if(mysqli_num_rows($run)>0){
			
			$_SESSION['username']=$user_name;
			
			echo "<script>window.open('index.php','_self')</script>";
		}
		else{
			
			echo "<script>alert('username or password incorrect')</script>";
			exit();
		}

		mysqli_close($conn);
	}


?>
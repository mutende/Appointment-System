<?php session_start(); ?>


<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>counsellor log in</title>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="style.css" rel="text/css" type="text/css"/>
	</head>
	<body>
	<?php include("../include/adminhead.php"); ?>
		
		<form method="post" action="login.php">
			<div class="maindiv">
			<img class="logo" src="../images/logo.jpg" alt="logo" height="80px" width="80px" align="center">
					<div class="head"> 
					<h1>Counsellor Log in</h1></div>
					
				 <div id="container">
				<p> User Name</p>
				 <input type ="text" name="username" required> 
				 
				<p>Password </p>
				<input type="password" name="userpass" required><br/>
		
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
		
		$user_nam= mysqli_real_escape_string($conn,$_POST['username']);
		$user_password= mysqli_real_escape_string($conn,$_POST['userpass']);
		
		

		$encrpt= md5($user_password);
		
		$query= "select * from counsellors where users = '$user_nam' AND pass='$user_password'";
		
		$run= mysqli_query($conn,$query);
		
		if(mysqli_num_rows($run)>0){
			
			$_SESSION['users']=$user_nam;
			
			echo "<script>window.open('index.php','_self')</script>";
		}
		else{
			
			echo "<script>alert('username or password incorrect')</script>";
			exit();
		}

		mysqli_close($conn);
	}


?>
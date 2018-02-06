<?php
session_start();

if(!isset($_SESSION['username'])){
	
	header("location: login.php");
	
}
else{

?>
<!DOCKTYPE HTML>
<html>
	<head>
		<title>home</title>
		<link href="style.css" rel="text/css" type="text/css"/>
	</head>
	<body>
	<?php include("../include/head.php"); ?>
	<?php include("adminnavbar.php");?>
	<h2>Welcome <?php $_SESSION['username'];?></h2>
		
	</body>
<html>
<?php } ?>
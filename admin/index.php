<?php
session_start();

$dean =$_SESSION['user'];

if(!isset($dean)){
	
	header("location: login.php");
	
}
else{

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>home</title>
		<link href="style.css" rel="text/css" type="text/css"/>
	</head>
	<body>
	<?php include("../include/adminhead.php"); ?>
	<?php include("../include/adminnavbar.php");?>
	<h2>Welcome <?php $dean;?></h2>
		
	</body>
<html>
<?php } ?>
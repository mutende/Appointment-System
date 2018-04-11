<?php
session_start();

$counsellor = $_SESSION['users'];
if(!isset($counsellor)){
	
	
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
	<?php include("../include/counsellornavbar.php");?>
	<h2>Welcome <?php $counsellor;?></h2>
		
	</body>
<html>
<?php } ?>
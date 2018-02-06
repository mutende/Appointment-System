<?php
session_start();

if(!isset($_SESSION['username'])){
	
	header("location: login.php");
	
}
else{

?>
<! DOCKTYPE HTML>
<html>
<head>
<title>print logs</title>
<link href="style.css" rel="stylesheet" type="text/css" media="all">
</head>	

	<?php include("../include/head.php"); ?>
	<?php include("adminnavbar.php");?>
	
</body>
</html>
<?php } ?>
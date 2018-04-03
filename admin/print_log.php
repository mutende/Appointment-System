<?php
session_start();

if(!isset($_SESSION['user'])){
	
	header("location: login.php");
	
}
else{

?>
<!DOCTYPE HTML>
<html>
<head>
<title>print logs</title>
<link href="style.css" rel="stylesheet" type="text/css" media="all">
</head>	

	<?php include("../include/head.php"); ?>
	<?php include("../include/adminnavbar.php");?>
	
</body>
</html>
<?php } ?>
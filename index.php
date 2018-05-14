<?php
session_start();

if(!isset($_SESSION['regNo'])){
	
	header("location: login.php");
	
}
else{
	?>


<!DOCTYPE HTML>
<HTML lang="en">
	<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>home</title>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link  rel="stylesheet" href="styleindex.css" type="text/css" media="all">
	</head>
<body>
	<div><?php include("include/head.php");?>
	<div><?php include("include/navindex.php");?></div>
	<div id="homemaindiv"></div>
	
	<!--<script src="bootstrap/js/bootstrap.min.js"></script>-->
</body>

</HTML>
<?php } ?>

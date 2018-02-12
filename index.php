<?php
session_start();

if(!isset($_SESSION['username'])){
	
	header("location: login.php");
	
}
else{
	?>


<!DOCKTYPE HTML>
<HTML>
<head>
	<title>home</title>
		<link  rel="stylesheet" href="styles.css" type="text/css" media="all">
</head>
<body>
	<div><?php include("include/head.php");?>
	<div><?php include("navbar.php");?></div>
	<div id="homemaindiv"></div>
	
</body>

</HTML>
<?php } ?>
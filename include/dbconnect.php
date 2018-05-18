<?php

DEFINE ('host','127.0.0.1');
DEFINE ('user','root');
DEFINE ('pass','hackEd56');
DEFINE ('name', 'appointment_details');

	$conn = mysqli_connect(host,user,pass,name) or 
		die('Errror in connection '.mysqli_connect_error());
?>
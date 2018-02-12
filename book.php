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
		<title>book appointment</title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	<?php include("include/head.php");?>
	<?php include("navbar.php");?>
		
		<div id="bookcontent">
		<form action="#" method="post">
		<label>Pick Counsellor</label><br>
		<select name="counsellor">
			<option value="null">--NONE--</option>
			<option value="counsellor 1"> counsellor 1 </option>
			<option value="counsellor 2"> counsellor 2 </option>
			<option value="counsellor 3"> counsellor 3 </option>
			<option value="counsellor 4"> counsellor 4 </option>
			<option value="counsellor 5"> counsellor 5 </option>
			<option value="counsellor 6"> counsellor 6 </option>
			<option value="counsellor 7"> counsellor 7 </option>
			<option value="counsellor 8"> counsellor 8 </option>
		</select><br>
		
		<label>Pick Date </label><br>
		<input type="date" name="date" placeholder="YYYY/MM/DD"><br>
		
		<label>Time</label><br>
		<div id="picktimentime">
		
			<input type="time" name="settime"/>
			</div>
			<label>Office</label><br/>
			<select name="office">
			<option value="null"> --NONE--</option>
			<option value="Office A"> Office A</option>
			<option value="Office B"> Office B</option>
			</select><br><br>
			<input type="submit" name="check" value="Book"/>


<?php
if(isset($_POST['check'])){
		
	//declare our variables
	$cnslr_no = $_POST['counsellor'];	
	$date = date($_POST['date']);
	$time = date($_POST['settime']);
	$cnslr_office = $_POST['office'];
	
	//get the time and appointment needs to end
	$ftimenew= date('H:i:s',(strtotime($time)+ 60*45));
	
	//the stopage time
	$stop_time =date('17:30:00');
	
	//starting time
	$begin_work = date('08:30:00');
	
	//get the end of working hours per day(it icreases the user selected time by 45 min)
	$passed_working_time= ($time= date('H:i:s',(strtotime($time)+ 60*45)));

	//get the back exact time the user requested
	$time =date('H:i:s',(strtotime($time)- 60*45));
	
	//query to insert into appointmentment datbase
		$insert_query = "insert into appoitment_details(counsellor_no,date,time,en_time,office)
			
			values('$cnslr_no','$date','$time','$ftimenew','$cnslr_office')";

	//query to serach the database
	$search_if_exist = "select  counsellor_no, date, time, office from appoitment_details where date='".$date."' AND (time BETWEEN '".$time."' AND '".$ftimenew."')";
	
	//connect to database
	require_once('include/dbconnect.php');
	
	//query to serach from database
	$execute_query = mysqli_query($conn, $search_if_exist);

	//what to be done after searching the database
	if($execute_query){
		
		
}//close the if isset bracket
?>

	</body>
</html>


<?php } ?>
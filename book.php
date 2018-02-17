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
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>book appointment</title>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
	//query to serach the database
	$search_if_exist = "select  cnsl_nm, dt, tm, en_tm ,ofc from sessions where dt='".$date."' AND (tm BETWEEN '".$time."' AND '".$ftimenew."')";
	
	//sql query to insert into appointments table
	$insert_query = "insert into appoitment_details(counsellor_no,date,time,en_time,office)
			
	values('$cnslr_no','$date','$time','$ftimenew','$cnslr_office')";
	
	//insert some information to session table to see successful appointments
	$create_session = "insert into sessions(cnsl_nm,dt,tm,en_tm,ofc)value
	('$cnslr_no','$date','$time','$ftimenew','$cnslr_office')";

	//connect to database
	require_once('include/dbconnect.php');

	//run databse serach 
	$run_search= mysqli_query($conn,$search_if_exist);

	while($row=mysqli_fetch_array($run_search)){

		$fcnsl_nm = $row['cnsl_nm'];
		$fdt = $row['dt'];
		$ftm = $row['tm'];
		$fen_tm=$row['en_tm'];
		$fofc= $row['ofc'];

	if($run_search){
	
	if(($cnslr_no=='null') or empty($date) or ($cnslr_office=='null')){
		
		echo "<script> alert('Some fields are Empty')</script>";
		exit();
	}
		// if a student books an appointment after or before working hours then woooo echo an error
	else 
		if(($passed_working_time>$stop_time) or ($time<$begin_work )){
		
		echo "<script>alert('select time between 08:30:00 and 16:45:00 snd get attended to. Try again')</script>";
		exit();
	}
	else 
	if(($fdt==$date) && (($time>=$ftm && $time<=$fen_tm) && $cnslr_no==$fcnsl_nm)){

		echo "<script>alert('The time selected for the counselor on that date is unavailable.Change Date counsellor or Time')</script>";
		echo "<script>window.open('book.php','_self')<>";
		exit();
	}
	
		else{
			
			//if the query is successful
			if(mysqli_query($conn,$insert_query)){
				
				echo "<script>alert('fisrt check Successful')</script>";
				//if connection is successful
			if(mysqli_query($conn,$create_session)){
				
				
						// notify student that the appointment is successful
				echo "<script>alert('Booked appointment successful')</script>";
				echo "<script>window.open('book.php','_self')</script>";
				
			}else{
				//else if there was an error in inserting into sessions table echo it out
				die('Error to connect in session table'.mysqli_error($conn));
			}
			
			//if there was an error in connecting to appointments table echo some error
		}else{
			die('Errror to connect in appointment details table'.mysqli_error($conn));
			
		}
		}
	}


	
	else{
		
		//validation
		if(($cnslr_no=='null') or empty($date) or ($cnslr_office=='null')){
		
			echo "<script> alert('Some fields are Empty')</script>";
			exit();
		}
		else 
		if(($passed_working_time>$stop_time) or ($time<$begin_work )){
		
		echo "<script>alert('select time between 08:30:00 and 16:45:00 snd get attended to. Try again')</script>";
		exit();
	}

	else{

		if(mysqli_query($conn,$insert_query)){
			
			echo "<script>alert('fisrt check Successful')</script>";
		
		if(mysqli_query($conn,$create_session)){
			
			echo "<script>alert('Booked appointment successful')</script>";
			echo "<script>window.open('book.php','_self')</script>";
			
		}else{
			
			die('Error to connect in session table'.mysqli_error($conn));
		}
		
	}else{
		die('Errror to connect in appointment details table'.mysqli_error($conn));
		
	}


			}
		}
	}//close the while loop
}


?>

	</body>
</html>

<?php } ?>
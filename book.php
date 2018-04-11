<?php
session_start();

$student = $_SESSION['regNo'];

if(!isset($student)){
	
	header("location: login.php");
	
}


else{

	?>
	

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>book appointment</title>
		<link href="css/stylebook.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/datepicker.css">
		<script type="text/javascript" src="jquery/jquery-3.3.1.js"></script>
   		 <script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
    	<script type="text/javascript" src="js/bootstrap.bundle.js"></script>

	</head>
	<body>
	<?php include("include/head.php");?>
	<?php include("include/navbar.php");?>
		
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
		<input type="text" name="date" placeholder="YYYY/MM/DD"><br>
		<?php include('include/datepicker.php');?>
		
		<label>Time</label><br>
		<div id="picktimentime">
		
			<input type="time" name="settime"/>
			</div>
			<br><br>
			<input type="submit" name="check" value="Book"/>

			
			<div id="showsessions">
			<form action="book.php" method="POST">
				

			<h3>Booked Sessions On the Selected Date</h3>
			
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed">
						<tr>
							<th>Date</th>
							<th>Counsellor</th>
							<th>Start Time</th>
							<th>Endtime</th>
			
						</tr>



			



<?php
if(isset($_POST['check'])){
		
	//declare our variables
	$cnslr_no = $_POST['counsellor'];	
	$date = date($_POST['date']);
	$time = date($_POST['settime']);
	
	
	//get the time and appointment needs to end
	$ftimenew= date('H:i:s',(strtotime($time)+ 60*45));
	
	//the stopage working hourtime
	//DEFINE('$stop_time','date('17:30:00')');
	$stop_time =date('17:30:00');
	
	//starting time
	//DEFINE('$begin_work','date('08:30:00')');
	$begin_work = date('08:30:00');
	
	//get the end of working hours per day(it icreases the user selected time by 45 min)
	$passed_working_time= ($time= date('H:i:s',(strtotime($time)+ 60*45)));

	//get the back exact time the user requested
	$time =date('H:i:s',(strtotime($time)- 60*45));

	//queries to search the database
		$search_if_exist = "select * from sessions where  date= '$date' AND 
						(counsellor = '$cnslr_no' AND ((st_time BETWEEN '$time' AND '$ftimenew') OR (en_time BETWEEN '$time' AND '$ftimenew' )))";

			$search_date = "select * from sessions where  date= '$date'";

	
	//create an appointment session
	$create_session = "insert into sessions(studentReg, counsellor, date, st_time, en_time) values
					('$student','$cnslr_no','$date','$time','$ftimenew')";

	//connect to database
	require_once('include/dbconnect.php');

	//run databse serach 
	$run_search= mysqli_query($conn, $search_if_exist);

	$count= mysqli_num_rows($run_search);

	$run_search_date = mysqli_query($conn, $search_date);


		if($count==0){

			if(($passed_working_time>$stop_time) or ($time<$begin_work )){

				echo "<script>alert('select time between 08:30:00 and 16:45:00 and get attended to. Try again')</script>";

			}
			else{

				if(mysqli_query($conn,$create_session)){


					echo "<script>alert('Booked appointment successful')</script>";
					echo "<script>window.open('index.php','_self')</script>";

				}else{

					die('Error to connect <br>'.mysqli_error($conn));
				}


		}
	}

	else
		if($count=1){



			while($row=mysqli_fetch_array($run_search_date)){

				$fcnsl_nm = $row['counsellor'];
				$fdt = $row['date'];
				$ftm = $row['st_time'];
				$fen_tm=$row['en_time'];

				

				?>
	
						
				<tr>
				<td><?php echo $fdt;?></td>
				<td><?php echo $fcnsl_nm; ?></td>
				<td><?php echo $ftm;?></td>
				<td><?php echo $fen_tm;?></td>
				
				</tr>
					<?php } ?>
					
				</table>
			</div>
			</form>
			<?php echo "<script>alert('Date and Time selected is an available for the selected Counselor');</script>"?>

			</div>		

	<?php			
		
		
	}else
	
		if($count>1){


			?>
			
			<?php echo "<script>alert('Conflicting Appointments');</script>"?>

			<?php
		
	}

	else{

		echo "Uknown Error";

	}

}


?>

	</body>
</html>

<?php } ?>
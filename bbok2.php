<?php
session_start();

if(!isset($_SESSION['student'])){
	
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
					
					//connect to database from an external file
					require_once('include/dbconnect.php');
					
				
					$cnslr_no = $_POST['counsellor'];	
					$date = date($_POST['date']);
					$time = date($_POST['settime']);
					$cnslr_office = $_POST['office'];
					
					$ftimenew= date('H:i:s',(strtotime($time)+ 60*45));
					
					//the stopage time
					$stop_time =date('17:30:00');
			
					//starting time
					$begin_work = date('08:30:00');
					
					//get the end of working hours per day
					$passed_working_time= ($time= date('H:i:s',(strtotime($time)+ 60*45)));
				
					//get the exact time the user requested
					$time =date('H:i:s',(strtotime($time)- 60*45));
					
					//function to connect to database
					
					
					
					//connect to database and fetch values 
					
				$search_from_db = "select  cnsl_nm,dt,tm,en_tm,ofc from sessions where dt =='".$date."' AND  tm BETWEEN '".$time."' AND  '".$ftimenew."'";
				//$search_from_db ="select * from sessions";
				
				$search = mysqli_query($conn, $search_from_db);
				
					//if nothing is found in the sessions table
					
					if(!$search ){
						
						if(($cnslr_no=='null') or empty($date) or ($cnslr_office=='null')){
						
						echo "<script> alert('invalid input')</script>";
						exit();
					}
						// if a student books an appointment after or before working hours then woooo echo an error
					else 
						if(($passed_working_time>$stop_time) or ($time<$begin_work )){
						
						echo "<script>alert('select time between 08:30:00 and 16:45:00 snd get attended to. Try again')</script>";
						exit();
					}
						else{
							
							
								//sql query to insert into appointments table
							$insert_query1 = "insert into appoitment_details(counsellor_no,date,time,office)
							
							values('$cnslr_no','$date','$time','$cnslr_office')";
							
							//insert some information to session table to see successful appointments
							$create_session1 = "insert into sessions(cnsl_nm,dt,tm,en_tm,ofc)value
							('$cnslr_no','$date','$time','$ftimenew','$cnslr_office')";
						
							//if the query is successful
							if(mysqli_query($conn,$insert_query1)){
								
								//if connection is successful
							if(mysqli_query($conn,$create_session1)){
								
								//echo "<script>alert('second check')</script>";
								
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
				
				while($row1 = mysqli_fetch_array($search)){
					
					
					$cnsl = $row1['cnsl_nm'];
					$dt  = $row1['dt'];
					$tm = $row1['tm'];
					$en_tm = $row1['en_tm'];
					$office = $row1['ofc'];
					
					
					//ensure that only available counselor is booked in that date and time is booked
					
					//if either field is empty echo an error
					if(($cnslr_no=='null') or empty($date) or ($cnslr_office=='null')){
						
						echo "<script> alert('invalid input')</script>";
						exit();
					}
						// if a student books an appointment after or before working hours then woooo echo an error
					else 
						if(($passed_working_time>$stop_time) or ($time<$begin_work )){
						
						echo "<script>alert('select time between 08:30:00 and 16:45:00 snd get attended to. Try again')</script>";
						exit();
					}

					
					//if a student books an appointment during another person time then woooo another error 
						else
							if(($date==$dt) and  ((((($time>=$tm) and ($time<=$en_tm))  or (($ftimenew<=$en_tm) and ($ftimenew>=$tm))) or

								($cnslr_no == $cnsl)))){
						
								
								echo "<script>alert('Time selected for the counsellor is unavailable on that date')</script>";
								echo "<script>window.open('book.php','_self')</script>";
							}
							
							// if all the conditions are true then proceed to book appointment
							
							else{
								//sql query to insert into appointments table
							$insert_query = "insert into appoitment_details(counsellor_no,date,time,office)
							
							values('$cnslr_no','$date','$time','$cnslr_office')";
							
							//insert some information session table to see successful appointments
							$create_session = "insert into sessions(cnsl_nm,dt,tm,en_tm,ofc)value
							('$cnslr_no','$date','$time','$ftimenew','$cnslr_office')";
							
							
								echo $cnsl;
								echo $dt;
								echo $tm;
						
							//if the query is successful
							if(mysqli_query($conn,$insert_query)){
								
								
								//if connection is successful
							if(mysqli_query($conn,$create_session)){
								
								//echo "<script>alert('second check')</script>";
								
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
					//close database connection
					mysqli_close($conn);
				}//close the while loop to read from sessions table
				
					}
					
				}?>
			<div id="checkbox"><h2>Appointment details</h2>

			<?php 
			
			//now this shows the student that his appointment was booked
			
			
			//connect to database from a different file
			require_once('include/dbconnect.php');
			
			
			//get the details from the database
				//select query
			
				$select_query ="select * from appoitment_details order by 1 DESC LIMIT 0, 1";
				
				//run query
				$run= mysqli_query($conn,$select_query);
				
				//fetch data
			while($row=mysqli_fetch_array($run)){
				
				//store fetched data into some variables
					//these are local variables
					$fcnslr_no = $row['counsellor_no'];
					$fdate =$row['date'];
					$ftime= $row['time'];
					$fcnslr_office = $row['office'];
			
			//increment time by 45min to get time the apointment will end.
				$ftimenew= date('H:i:s',(strtotime($ftime)+ 60*45));
		
					echo 'Hello '.$_SESSION['student'].'?<br> You have booked an appoitment to see '.$fcnslr_no.' in counselling '.$fcnslr_office.
						' as from '.$ftime.' to '.$ftimenew.' on '.$fdate.'<br>Goodluck and keep time '.$_SESSION['student'];

				//close the database connection.
				mysqli_close($conn);
			}
			
			
		?>
			
	</body>
</html>
<?php }?>
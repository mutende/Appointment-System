
<?php

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
	
	//get the end of working hours per day
	$passed_working_time= ($time= date('H:i:s',(strtotime($time)+ 60*45)));

	//get the exact time the user requested
	$time =date('H:i:s',(strtotime($time)- 60*45));
	
	//connect to database
	
	require_once('include/dbconnect.php');

	//query to insert into appointmentment datbase
		$insert_query = "insert into appoitment_details(counsellor_no,date,time,en_time,office)
			
			values('$cnslr_no','$date','$time','$ftimenew','$cnslr_office')";

	
	$search_if_exist = "select  counsellor_no, date, time, office from appoitment_details where date='".$date."' AND (time BETWEEN '".$time."' AND '".$ftimenew."')";
	
	//query to serach from database
	$execute_query = mysqli_query($conn, $search_if_exist);


		if(!$search_if_exist){

				if(($cnslr_no=='null') or empty($date) or ($cnslr_office=='null')){
		
					echo "<script> alert('invalid input')</script>";
					exit();

				}//close the null authentication if stateme

				else 
					if(($passed_working_time>$stop_time) or ($time<$begin_work )){
					
					//notification error
					echo "<script>alert('select time between 08:30:00 and 16:45:00 to get attended to.')</script>";
					exit();
							
						}//close the passed time authentication if statement
					

						else
						{

							if(mysqli_query($conn,$insert_query)){

										// notify student that the appointment is successful
									echo "<script>alert('Booked appointment successful')</script>";
									echo "<script>window.open('book.php','_self')</script>";
				

							}//close the if that verifies data was inserted successfully

							else{

								die('Error in Inserting data into appoitments_details table. '.mysqli_error($conn));
							}

						}//close the last else that inserts data into the database



		}//close the if is serching the database

		else{

				 while($row=mysqli_fetch_array($execute_query)){

						//fetch data in the databswe now
					$cnsl = $row[' counsellor_no'];
					$dt  = $row['date'];
					$tm = $row['time'];
					$en_tm = $row['en_time'];
					$office = $row['office'];


					//authenticate data if some data was found

					if(($cnslr_no=='null') or empty($date) or ($cnslr_office=='null')){
		
					echo "<script> alert('invalid input')</script>";
					exit();

				}//close the null authentication if stateme

				else 
					if(($passed_working_time>$stop_time) or ($time<$begin_work )){
					
					//notification error
					echo "<script>alert('select time between 08:30:00 and 16:45:00 to get attended to.')</script>";
					exit();
							
						}//close the passed time authentication if statement
					

						else 
							if(($date==$dt) and((($time>=$tm) or ($time<=$en_tm)) and (($ftimenew<=$en_tm) and ($ftimenew>$tm)) and ($cnslr_no==$cnsl))){

								//echo an error

								echo "<script>alert('Time selected for the counsellor is unavailable on that date')</script>";
								exit();

							}else

							{

								if(mysqli_query($conn,$insert_query)){

										// notify student that the appointment is successful
									echo "<script>alert('Booked appointment successful')</script>";
									echo "<script>window.open('book.php','_self')</script>";
				

							}//close the if that verifies data was inserted successfully

							else{

								die('Error in Inserting data into appoitments_details table. '.mysqli_error($conn));
							}//close the die error


							}//close the else that allows users to enter data into the systtem in correct time
		
	}//close the while loop

		}//close the else statement with the while loop inside
   
	
	mysqli_close($conn);
	
}

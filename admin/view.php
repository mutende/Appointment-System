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
<title>view appointments</title>
<link href="style.css" rel="stylesheet" type="text/css" media="all">
</head>	

	<?php include("../include/head.php"); ?>
	<?php include("adminnavbar.php");?>
	<table width ="1200" border="5" align="center">
	<tr>
		<td colspan="10" align="center"><h1> View Appointments of students</h1></td>
	</tr>
	<tr>
		<th>Counsellor Seen</th>
		<th> Date of Appointment</th>
		<th>Time of Appointment</th>
		<th>Office used</th>
		<th>Delete</th>
	</tr> 
		<?php 
				
			//get the details from the database
				require_once('../include/dbconnect.php');

				$select_info ="select * from appoitment_details";
				$run=mysqli_query($conn,$select_info);
				
			while($row=mysqli_fetch_array($run)){
					
					$appointment_id=$row['appointment_id'];
					$fcnslr_no = $row['counsellor_no'];
					$fdate = $row['date'];
					$time = $row['time'];
					$fcnslr_office = $row['office'];
			
			?>
		<tr>
			<td><?php echo $fcnslr_no;?></td>
			<td><?php echo $fdate ; ?></td>
			<td><?php echo $time ;?></td>
			<td><?php echo $fcnslr_office?></td>
			<td><a href="delete.php?del=<?php echo $appointment_id ;?>"> Delete</a></td>
		</tr><?php }?>
	</table>
</body>
</html>
<?php } ?>
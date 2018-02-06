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
<title>unavailable counsellors</title>
<link href="style.css" rel="stylesheet" type="text/css" media="all">
</head>	

	<?php include("../include/head.php"); ?>
	<?php include("adminnavbar.php");?>
	<table width ="1200" border="5" align="center">
	<tr>
		<td colspan="10" align="center"><h1>Counsellors who are not available</h1></td>
	</tr>
	<tr>
		<th> Id </th>
		<th>Counsellor No</th>
		<th> Date </th>
		<th>Time </th>
		<th>Available date</th>
		<th>Available time</th>
		<th> Reason </th>
	</tr> 
		<?php 
				
			//get the details from the database
				require_once('../include/dbconnect.php');

				$select_info ="select * from admin_schedule";
				$run=mysqli_query($conn,$select_info);
				
			while($row=mysqli_fetch_array($run)){
					
					$id =$row['schedule_id'];
					$counsellor_no=$row['cnsl_nm'];
					$date = $row['date'];
					$time = $row['time'];
					$avl_date = $row['avlbl_day'];
					$avl_tm = $row['avlbl_tm'];
					$rsn = $row['reason'];
			
			?>
		<tr>
			<td><?php echo $id;?></td>
			<td><?php echo $counsellor_no ; ?></td>
			<td><?php echo $date ;?></td>
			<td><?php echo $time;?></td>
			<td><?php echo $avl_date;?></td>
			<td><?php echo $avl_tm;?></td>
			<td><?php echo $rsn;?></td>
			
		</tr><?php }?>
	</table>
</body>
</html>
<?php } ?>
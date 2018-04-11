<?php
session_start();

if(!isset($_SESSION['users'])){
	
	header("location: login.php");
	
}
else{

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>view appointments</title>
	<link rel="stylesheet" href="../css/styleview.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/styleview.css">
</head>
<body>
	<?php include('../include/adminhead.php');?>
	<?php include('../include/counsellornavbar.php');?>

	<div id="searchdiv"> 

		<form action="view.php" method="get">

			<label for="">From</label>
			<input type="date" name="from" id="">
			
			<label for="">To</label>
			<input type="date" name="to" id="">

			<input type="submit" name="view" value="View">

		</form>

	</div>

		<div id="tablergn">
			<table class="table table-striped table-bordered table-condensed">

			<tr>
				<th>No</th>
				<th>Date</th>
				<th>Student</th>
				<th>Counsellor</th>
				<th>Start Time</th>
				<th>End Time</th>
			</tr>

			<?php 

				if(isset($_GET['view'])){

					$date_from =$_GET['from'];
					$date_to = $_GET['to'];

					require_once('../include/dbconnect.php');

					$search_query="select * from sessions where date BETWEEN '$date_from' AND '$date_to'";

						$run_search =mysqli_query($conn,$search_query);

						$count =1;
						while($row=mysqli_fetch_array($run_search)){

							$date = $row['date'];
							$student = $row['studentReg'];
							$counsellor = $row['counsellor'];
							$start = $row['st_time'];
							$end = $row ['en_time'];

							
					?>

								<tr>
									<td><?php echo $count;
									 $count ++;?></td>
									<td><?php echo $date;?></td>
									<td><?php echo $student;?></td>
									<td><?php echo $counsellor;?></td>
									<td><?php echo $start;?></td>
									<td><?php echo $end;?></td>

								</tr>
					<?php
						}

						mysqli_close($conn);
				}
			
			?>
			
				
			</table>
		</div>

		<div id="printbtn">
			<input type="submit" name ="print" value="Print">

		</div>
	
</body>
</html>

<?php }?>
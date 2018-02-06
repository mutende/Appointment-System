<?php
	
	
	if(isset($_GET['del'])){

		require_once('../include/dbconnect.php');
	
		
		$appointment_del =$_GET['del'];
		//7\$session_del = $_GET[];
		
		$delete_query ="delete from appoitment_details where appointment_id = '$appointment_del' ";

			//$delete_session = "";
		
			if(mysqli_query($conn,$delete_query)){
				
				echo "<script>alert('delete successful')</script>";
				echo "<script>window.open('view.php','_self')</script>";
			}
	}
	?>
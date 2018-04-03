<?php
session_start();

if(!isset($_SESSION['users'])){
	
	header("location: login.php");
	
}
else{

?>
<!DOCTYPE HTML>
<html>
<head>
<title>set schedule</title>
<link href="../css/styleset_schedule.css" rel="stylesheet" type="text/css" media="all"/>
<link rel="stylesheet" href="../css/styleview.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
</head>	
<body>
<div id="cotainerdiv">
	<?php include("../include/adminhead.php"); ?>
	<?php include("../include/counsellornavbar.php");?>
	
	<h2>date and times that you will not be availabe for this week</h2>
	<div id="align">
		<form action="#" method="post">

			<div id="cnsl">
			<label>Counselor</label><br>
			<select name="counsellor">
				<option value="null">--NONE--</option>
				<option value="Counsellor 1">Counsellor 1</option>
				<option value="Counsellor 2">Counsellor 2</option>
				<option value="Counsellor 3">Counsellor 3</option>
				<option value="Counsellor 4">Counsellor 4</option>
				<option value="Counsellor 5">Counsellor 5</option>
				<option value="Counsellor 6">Counsellor 6</option>
				<option value="Counsellor 7">Counsellor 7</option>
				<option value="Counsellor 8">Counsellor 8</option>
			</select><br>
		</div>

		<div id="email">

		<label for="">Email</label><br>
		<input type="email" name="mail" id=""><br>
		</div>
		<label>Date</label><br/>
		
		<input type="date" name="date" placeholder="YYYY-MM-DD"><br/>
		
			<label>Time </label><br/>
			<input type="time" name="settime"><br/>

		<label>Duration</label><br/>

		<labale>Time</labale>
		<select name="hduration">
			<option value="-01">HH</option>
			<option value="00">00</option>
			<option value="01">01</option>
			<option value="02">02</option>
			<option value="03">03</option>
			<option value="04">04</option>
			<option value="05">05</option>
			<option value="06">06</option>
			<option value="07">07</option>
			<option value="08">08</option>
			</select>

			<select name="minduration">
			<option value="-01">MM</option>
			<option value="00">00</option><option value="01">01</option>
			<option value="02">02</option><option value="03">03</option>
			<option value="04">04</option><option value="05">05</option>
			<option value="06">06</option><option value="07">07</option>
			<option value="08">08</option><option value="09">09</option>
			<option value="10">10</option><option value="11">11</option>
			<option value="12">12</option><option value="13">13</option>
			<option value="14">14</option><option value="15">15</option>
			<option value="16">16</option><option value="17">17</option>
			<option value="18">18</option><option value="19">19</option>
			<option value="20">20</option><option value="21">21</option>
			<option value="22">22</option><option value="23">23</option>
			<option value="24">24</option><option value="25">25</option>
			<option value="26">26</option><option value="27">27</option>
			<option value="28">28</option><option value="29">29</option>
			<option value="30">30</option><option value="31">31</option>
			<option value="32">32</option><option value="33">33</option>
			<option value="34">34</option><option value="35">35</option>
			<option value="36">36</option><option value="37">37</option>
			<option value="38">38</option><option value="39">39</option>
			<option value="40">40</option><option value="41">41</option>
			<option value="42">42</option><option value="43">43</option>
			<option value="44">44</option><option value="45">45</option>
			<option value="46">46</option><option value="47">47</option>
			<option value="48">48</option><option value="49">49</option>
			<option value="50">50</option><option value="52">51</option>
			<option value="52">52</option><option value="53">53</option>
			<option value="54">54</option><option value="55">55</option>
			<option value="56">56</option><option value="57">57</option>
			<option value="58">58</option><option value="59">59</option>
			</select>

			<label>Day</label>
			<select name="daysoff">
			<option value="00">00</option><option value="01">01</option>
			<option value="02">02</option><option value="03">03</option>
			<option value="04">04</option><option value="05">05</option>
			<option value="06">06</option><option value="07">07</option>
			<option value="08">08</option><option value="09">09</option>
			<option value="10">10</option><option value="11">11</option>
			<option value="12">12</option><option value="13">13</option>
			<option value="14">14</option><option value="15">15</option>
			<option value="16">16</option><option value="17">17</option>
			<option value="18">18</option><option value="19">19</option>
			<option value="20">20</option><option value="21">21</option>
			<option value="22">22</option><option value="23">23</option>
			<option value="24">24</option><option value="25">25</option>
			<option value="26">26</option><option value="27">27</option>
			<option value="28">28</option><option value="29">29</option>
			<option value="30">30</option><option value="31">31</option>
				

			</select>
			<label>Months</label>
			<select name="monthsoff">
			<option value="00">00</option><option value="01">01</option>
			<option value="02">02</option><option value="03">03</option>
			<option value="04">04</option><option value="05">05</option>
			<option value="06">06</option><option value="07">07</option>
			<option value="08">08</option><option value="09">09</option>
			<option value="10">10</option><option value="11">11</option>
			<option value="12">12</option>

				</select>
			<br>
			
			<label>Reason of Unavailability</label><br/>
			<input type="text" name="specify" placeholder="meeting/conference/leave"><br>
			<input type="submit" name="set" value="SET"/>
			</form>
			<?php 
			
				if(isset($_POST['set'])){
					
					$date = date($_POST['date']);
					$email = $_POST['mail'];
					$counsellor= $_POST['counsellor'];
					$time = date($_POST['settime']);
					$daysoff = $_POST['daysoff'];
					$monthsoff =$_POST['monthsoff'];
					$duration_h= $_POST['hduration'];
					$duration_min=$_POST['minduration'];
					$reason = $_POST['specify'];

					//add the period of dates being away
					//add days
					$date1= date('Y-m-d',(strtotime('+'.$daysoff.'days',strtotime($date))));

					//add months incase it is a leave
					$date2= date('Y-m-d',(strtotime('+'.$monthsoff.'months',strtotime($date1))));
					
					$availabe_date=$date2;

					//add time of being away
					$available_time = date('H:i:s',(strtotime($time)+ 60*((60*$duration_h)+$duration_min)));

					
					if(empty($date)or empty($reason) or empty($counsellor)){
						echo "<script> alert('invalid input')</script>";
						exit();
					}
					else{
						
						
						require_once('../include/dbconnect.php');
						
						$insert_query= "insert into counsellor_schedule(cnsl_nm,email,date,time,hr_drxn,min_drxn,days,mnths,avlbl_dt,avlbl_tm,rsn)values
						('$counsellor','$email','$date','$time','$duration_h','$duration_min','$daysoff','$monthsoff','$availabe_date ','$available_time','$reason')";
						
						if(mysqli_query($conn,$insert_query)){


							
							echo "<script>alert('schedule set')</script>";
							echo "<script>window.open('index.php','_self')</script>";
						}else{
							
							die('Errror '.mysqli_error($conn));
							exit();


						}
					}

					mysqli_close($conn);
				}
			?>
			</div>
			</div>
	
</body>
</html>
<?php } ?>
<?php

    session_start();
    if(!isset($_SESSION['user'])){

        header('location: login.php');

    }else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/styleapprove.css">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="../js/bootstrap.bundle.js"></script>
    <title>approve schedule</title>
</head>
<body>

<?php include("../include/adminhead.php"); ?>
<?php include("../include/adminnavbar.php"); ?>

    
        <form action="approve.php" method="post">

                <div id="rangeset">

                    <label for="">FROM</label>
                    <input type="date" name="from" id="" required>

                    <label for="">TO</label>
                    <input type="date" name="to" id="" required>

                    <input type="submit" name="get" value="GET">
                
                </div>
        <div id="table" class="table-responsive">
            <table class="table table-striped table-bordered table-condensed">
                <tr>
                    <th>No</th>
                    <th>Counsellor</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Reason</th> 
                    <th>Confirm</th>              
                </tr>
                    <?php

                    if(isset($_POST['get'])){

                    $from = $_POST['from'];

                    $to =$_POST['to'];

                    require_once('../include/dbconnect.php');

                    $get_schedules="select * from counsellor_schedule where date BETWEEN '$from' AND '$to'";
                    
                    $run=mysqli_query($conn,$get_schedules);

                    $count=1;

                    while($row=mysqli_fetch_array($run)){

                        $counsellor = $row['cnsl_nm'];
                        $email = $row['email'];
                        $date = $row['date'];
                        $time = $row['time'];
                        $available_date = $row['avlbl_dt'];
                        $available_time =$row['avlbl_tm'];
                        $reason = $row['rsn'];

                        ?>
                        <tr>
                            <td><?php echo $count; $count++;?></td>
                            <td><?php echo $counsellor; ?></td>
                            <td><?php echo $email;?></td>
                            <td><?php echo $date;?></td>
                            <td><?php echo $available_date;?></td>
                            <td><?php echo $available_time;?></td>
                            <td><?php echo $reason;?></td>
                            <td><input type="checkbox" name="checked" id=""></td>
                        </tr>
                        <?php
                    }
                    
                }
                    ?>
            </table>

        </div>
        
        </form>
       
    
    
</body>
</html>

   <?php }?>
<?php

    session_start();

    $student= $_SESSION['regNo'];

    if(!isset($student)){

        header('location:login.php');

    }else{


    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>booked time and date</title>
    <link rel="stylesheet" href="css/stylesessions.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/datepicker.css">
    <script type="text/javascript" src="jquery/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="js/bootstrap-datepicker.js"></script>   
    <script type="text/javascript" src="js/bootstrap.bundle.js"></script>
</head>
<body>
    <?php include("include/head.php");?>
    <?php include("include/navbar.php");?>

        <div id="maindiv">

            <form action="sessions.php" method="GET">

                <div id="searchdiv">

                <label for="">Date</label>
                    <input type="date" name="date" id="" placeholder="dd-mm-yyyy" required>
                    <?php include('include/datepicker.php');?>
                    <input type="submit" name="search" value="Search">

                </div>
            </form>

            <div id="tableregion">
                <table class="table table-striped table-bordered table-condensed">

                    <tr>
                        <th>No</th>
                        <th>DATE</th>
                        <th>COUNSELLOR</th>
                        <th>START TIME</th>
                        <th>END TIME</th>
                    </tr>
        
        <?php 

            if(isset($_GET['search'])){

                $search_id = $_GET['date'];

                require_once('include/dbconnect.php');
                $search_query = "select * from sessions where date = '$search_id'";

                $run_query= mysqli_query($conn,$search_query);

                $count = 1;
                while($row = mysqli_fetch_array($run_query)){

                    $date = $row['date'];
                    $counsellor = $row['counsellor'];
                    $start_time = $row['st_time'];
                    $end_time = $row['en_time'];

                    ?>
                    <tr>
                    <td><?php echo $count;?></td>
                    <td><?php echo $date;?></td>
                    <td><?php echo $counsellor;?></td>
                    <td><?php echo $start_time;?></td>
                    <td><?php echo $end_time;?></td>
                    
                    </tr>
                    <?php


            $count++;
                }

            }
        
        
        
        
        ?>

                </table>
            </div>
        </div>
    
</body>
</html>
<?php } ?>
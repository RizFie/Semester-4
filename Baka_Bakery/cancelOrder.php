<!DOCTYPE html>
<?php
    include("bakadbconn.php");
    session_start();

    if($_SESSION['privilege'] != "customer"){/*make sure no unauthorized user access this page*/
        die("<script>alert('Unauthorized User')
            ;window.location.href='login.php';</script>"); 
    }
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        //get value from get
        $ord_id = $_GET['ord_id'];
    
?>
    <style>
        <?php include('cancelOrder.css'); ?>
    </style>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
</head>
<body>
<div class="container">
<div class="wrapper">
    <!--deletion-->
    <h1>Are your sure to delete?</h1><br>
    <?php
        echo "<td><a href='cancelProcess.php?o_id=".$ord_id."'>Yes</a></td>"
    ?>
    <br>
    <a class="no" href='custOrder.php' name="option" value="No">No</a>
    </div>
        <div class="a">
            
        </div>
    </div>
</body>
<?php
    }
    else{
        header('Location: custOrder.php');
    }
    mysqli_close($dbconn);
?>
</html>
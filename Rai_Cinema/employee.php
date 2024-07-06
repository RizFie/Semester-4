<!DOCTYPE html>
<?php
    session_start();
    include('dbconn.php');

    //check if user is employee
    if ($_SESSION['privilege'] != "EMPLOYEE") {
        die("<script>alert('UNAUTHORIZED USER'); window.location.href='registerLogin.php';</script>");
        exit();
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee's Page</title>
    <link rel="stylesheet" href="employee.css">
</head>
<header>
        <div class="title">
            <h2>Rai Cinema</h2>
            <h2 class="staffTitle">Staff</h2>
        </div>
        <h1>CINEMA MANAGEMENT SYSTEM</h1>
    </header>
<body>
    <div class="flex-container">
        <a href="viewCustomer.php">
            <div class="cust-container">
                <div class="cust-item-container">
                    <i id="custAccIcon" class="fa-solid fa-user fa-9x"></i>
                    <h4>CUSTOMERS ACCOUNT DETAILS</h4>
                </div>
            </div>
        </a>
        
        <a href="viewBooking.php">
            <div class="booking-container">
                <i class="fa-solid fa-ticket fa-9x"></i>
                <h4>UPDATE CUSTOMERS BOOKING</h4>
            </div>
        </a>
    </div>
</body>
<script src="https://kit.fontawesome.com/e921146c68.js" crossorigin="anonymous"></script>
<?php
    mysqli_close($dbconn);
?>
</html>
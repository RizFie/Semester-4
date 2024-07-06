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
    <title>Booking Details</title>
    <style>
        <?php include('viewbooking.css'); ?>
    </style>
</head>
<body>
    <div class = "header">
        <h1>Bookings' Details</h1>
    </div>
    <?php
        $sql = "SELECT * FROM bookedseat;";
        $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
        $numRow = mysqli_num_rows($query);

        if($numRow == 0){
            //show that there is no record
    ?>
            <h1 class = "noRecord">No Record of Bookings</h1>
    <?php
        }
        else{
            while($row = mysqli_fetch_assoc($query)){
    ?>
            <div class="row">
                <div class="card">
                    <h4><?= $row['bookingID'] ?></h4>
                    <br>
                    <table>
                        <tr>
                            <td class = "firstColumn">Seat ID</td>
                            <td>:</td>
                            <td><?= $row['idSeat'] ?></td>
                        </tr>
                        <tr>
                            <td class = "firstColumn">Movie ID</td>
                            <td>:</td>
                            <td><?= $row['idMovie'] ?></td>
                        </tr>
                        <tr>
                            <td class = "firstColumn">Customer Username</td>
                            <td>:</td>
                            <td><?= $row['cust_uname'] ?></td>
                        </tr>
                        <tr>
                            <td class = "firstColumn">Time</td>
                            <td>:</td>
                            <td><?= $row['reserveTime'] ?></td>
                        </tr>
                        <tr>
                            <td class = "firstColumn">Seat Number</td>
                            <td>:</td>
                            <td><?= $row['seatNum'] ?></td>
                        </tr>
                        <tr>
                            <td class = "firstColumn">Payment ID</td>
                            <td>:</td>
                            <td><?= $row['idpayment'] ?></td>
                        </tr>
                    </table>
                </div>
            </div>
    <?php
            }
        }
    ?>
</body>
<?php
    mysqli_close($dbconn);
?>
</html>
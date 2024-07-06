<?php
session_start();
include('dbconn.php');

if (!isset($_SESSION['username'])) {
    header('Location: registerLogin.php');
    exit();
}

if (isset($_SESSION['seatNum']) && isset($_SESSION['movieID']) && isset($_SESSION['reserveTime']) && isset($_SESSION['username']) && isset($_SESSION['paymentID'])) {
    $seatNums = explode(", ", $_SESSION['seatNum']);
    $movieID = $_SESSION['movieID'];
    $reserveTime = $_SESSION['reserveTime'];
    $username = $_SESSION['username'];
    $paymentID = $_SESSION['paymentID'];

    // Guna foreach loop sebab seatNum maybe banyak
    foreach ($seatNums as $seatNum) {
        
        $sql_seat = "SELECT idSeat FROM seat WHERE seatNum='$seatNum' AND idMovie='$movieID' AND reserveTime='$reserveTime'";
        $result_seat = mysqli_query($dbconn, $sql_seat);
        
        if (mysqli_num_rows($result_seat) > 0) {
            $row_seat = mysqli_fetch_assoc($result_seat);
            $idSeat = $row_seat['idSeat'];

            // masukkan booking
            $sql_booked = "INSERT INTO bookedseat (idSeat, idMovie, cust_uname, reserveTime, seatNum, idpayment) 
                           VALUES ('$idSeat', '$movieID', '$username', '$reserveTime', '$seatNum', '$paymentID')";
            if (!mysqli_query($dbconn, $sql_booked)) {
                echo "Error: " . $sql_booked . "<br>" . mysqli_error($dbconn);
            }
        } else {
            echo "Error: Seat '$seatNum' not found.<br>";
        }
    }
    
    echo "<script>alert('Your movie is succesfully booked :)'); window.location.href='main.php';</script>";
    exit();
} else {
    echo "Error: Booking details are not set in the session.";
}

mysqli_close($dbconn);
?>

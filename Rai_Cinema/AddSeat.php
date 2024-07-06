<?php
    include("dbconn.php");
    
    // Fetching data from the form
    $movie_id = $_POST['idmovie'];
    $movie_time = $_POST['reserveTime'];
    $hall = $_POST['hallNum'];

    // Insert seats
    $seatInserts = [
        "INSERT INTO seat (idSeat, reserveTime, seatNum, hallNum, idMovie) VALUES ('' , '$movie_time', 'A01', '$hall', '$movie_id')",
        "INSERT INTO seat (idSeat, reserveTime, seatNum, hallNum, idMovie) VALUES ('' , '$movie_time', 'A02', '$hall', '$movie_id')",
        "INSERT INTO seat (idSeat, reserveTime, seatNum, hallNum, idMovie) VALUES ('' , '$movie_time', 'A03', '$hall', '$movie_id')",
        "INSERT INTO seat (idSeat, reserveTime, seatNum, hallNum, idMovie) VALUES ('' , '$movie_time', 'A04', '$hall', '$movie_id')",
        "INSERT INTO seat (idSeat, reserveTime, seatNum, hallNum, idMovie) VALUES ('' , '$movie_time', 'B01', '$hall', '$movie_id')",
        "INSERT INTO seat (idSeat, reserveTime, seatNum, hallNum, idMovie) VALUES ('' , '$movie_time', 'B02', '$hall', '$movie_id')",
        "INSERT INTO seat (idSeat, reserveTime, seatNum, hallNum, idMovie) VALUES ('' , '$movie_time', 'B03', '$hall', '$movie_id')",
        "INSERT INTO seat (idSeat, reserveTime, seatNum, hallNum, idMovie) VALUES ('' , '$movie_time', 'B04', '$hall', '$movie_id')",
        "INSERT INTO seat (idSeat, reserveTime, seatNum, hallNum, idMovie) VALUES ('' , '$movie_time', 'C01', '$hall', '$movie_id')",
        "INSERT INTO seat (idSeat, reserveTime, seatNum, hallNum, idMovie) VALUES ('' , '$movie_time', 'C02', '$hall', '$movie_id')",
        "INSERT INTO seat (idSeat, reserveTime, seatNum, hallNum, idMovie) VALUES ('' , '$movie_time', 'C03', '$hall', '$movie_id')",
        "INSERT INTO seat (idSeat, reserveTime, seatNum, hallNum, idMovie) VALUES ('' , '$movie_time', 'C04', '$hall', '$movie_id')"
    ];

    $allInsertsSuccessful = true;
    foreach ($seatInserts as $insertQuery) {
        if (!mysqli_query($dbconn, $insertQuery)) {
            $allInsertsSuccessful = false;
            break;
        }
    }

    if ($allInsertsSuccessful) {
        echo "<script>alert('Seats added successfully!'); window.location.href='showTime.php';</script>";
    } else {
        echo "Error adding seats: " . mysqli_error($dbconn);
    }

    // Close the database connection
    mysqli_close($dbconn);
?>

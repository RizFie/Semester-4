<?php
    include("dbconn.php");
    
    // Fetching data from the form
    $movie_id = $_POST['idmovie'];
    $movie_name = $_POST['movie_name'];
    $movie_genre = $_POST['movie_genre'];
    $movie_age = $_POST['movie_age'];
    $movie_image = $_POST['movie_image'];
    $movie_desc = $_POST['movie_desc'];
    $movie_license_fee = $_POST['movie_licenseFee'];
    $movie_rating = $_POST['movie_rating'];
    $movie_language = $_POST['movie_language'];
    $movie_time = $_POST['reserveTime'];
    $hall = $_POST['hallNum'];

    // SQL query to insert data into the database
    $sqlInsertMovie = "INSERT INTO movie (idmovie, movie_name, movie_genre, movie_age, movie_image, movie_desc, movie_licenseFee, movie_rating, movie_language) 
                       VALUES ('$movie_id', '$movie_name', '$movie_genre', '$movie_age', '$movie_image', '$movie_desc', '$movie_license_fee', '$movie_rating', '$movie_language')";
    
    // Executing the movie insert query
    if (mysqli_query($dbconn, $sqlInsertMovie)) {
        // Insert seats if the movie insert was successful
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
            echo "<script>alert('New movie and seats created successfully :>'); window.location.href='adminAddMovie.php';</script>";
        } else {
            echo "Error adding seats: " . mysqli_error($dbconn);
        }
    } else {
        echo "Error: " . $sqlInsertMovie . "<br>" . mysqli_error($dbconn);
    }

    // Close the database connection
    mysqli_close($dbconn);
?>



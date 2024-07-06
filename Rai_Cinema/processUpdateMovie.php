<?php
// Include the database connection file
include("dbconn.php");

// If the update button is clicked
if (isset($_POST['update'])) {
    // Capture values from the HTML form
    $movie_id = $_POST['movieid'];
    $movie_name = $_POST['moviename'];
    $movie_genre = $_POST['moviegenre'];
    $movie_age = $_POST['movieage'];
    $movie_image = $_POST['movieimage'];
    $movie_desc = $_POST['moviedesc'];
    $movie_license_fee = $_POST['movielicensefee'];
    $movie_rating = $_POST['movierating'];
    $movie_language = $_POST['movielanguage'];

    // Apply SQL statement to verify the specified info first
    $sqlSel = "SELECT * FROM movie WHERE idmovie = '$movie_id'";
    $querySel = mysqli_query($dbconn, $sqlSel) or die("Error: " . mysqli_error($dbconn));
    $rowSel = mysqli_num_rows($querySel);

    if ($rowSel == 0) {
        echo "<script>alert('RECORD DOES NOT EXIST'); window.location.href='admin.php';</script>";
    } else {
        // Execute SQL UPDATE command
        $sqlUpdate = "UPDATE movie SET 
                        movie_name = '$movie_name', 
                        movie_genre = '$movie_genre', 
                        movie_age = '$movie_age', 
                        movie_image = '$movie_image', 
                        movie_desc = '$movie_desc', 
                        movie_licenseFee = '$movie_license_fee', 
                        movie_rating = '$movie_rating', 
                        movie_language = '$movie_language' 
                      WHERE idmovie = '$movie_id'";
        echo "<br>";
        mysqli_query($dbconn, $sqlUpdate) or die("Error: " . mysqli_error($dbconn));
        
        // Display a message
        echo "<script>alert('MOVIE HAS BEEN UPDATED'); window.location.href='admin.php';</script>";
    }
}




?>
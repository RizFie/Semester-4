<?php
include ('dbconn.php');
session_start();

// Check if user is admin
if ($_SESSION['privilege'] != "EMPLOYEE") {
    die("<script>alert('UNAUTHORIZED USER'); window.location.href='registerLogin.php';</script>");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Info</title>
    <link rel="stylesheet" href="custViewMovieInfo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>
<header>
    <div class="navbar">
        <div class="logo"><a href="dashboard.php">Rai Cinemas</a></div>
        <div class="toggle_btn">
            <i class="fa-solid fa-bars"></i>
        </div>
    </div> 
    <div class="dropdown_menu">
                <li><a href="dashboard.php" style="color: black;">Mainpage</a></li>
                <li><a href="adminAddMovie.php" style="color: black;">Add Movie</a></li>
                <li><a href="showTime.php" style="color: black;">Showtime</a></li>
                <li><a href="viewCustomer.php" style="color: black;">Customer List</a></li>
                <li><a href="empList.php" style="color: black;">Employee List</a></li>
                <li><a href="adminBookedList.php" style="color: black;">Booking List</a></li>
                <li><a href="EditEmp.php" style="color: black;">Edit Account</a></li>
                <li><a href="logout.php" class="action_btn">Logout</a></li>
    </div>     
</header>
<div class="container">
    <form method="post" class="genre-filter-form">
        <h2>Filter by Genre</h2>
        <label><input type="checkbox" name="genres[]" value="Family/Comedy"> Family/Comedy</label>
        <label><input type="checkbox" name="genres[]" value="Action/Sci-fi"> Action/Sci-fi</label>
        <label><input type="checkbox" name="genres[]" value="Action/Thriller"> Action/Thriller</label>
        <button type="submit" class="filter-btn">Filter</button>
    </form>
    <div class="movie-list">
        <?php
        // Retrieve selected genres from the form
        $selected_genres = isset($_POST['genres']) ? $_POST['genres'] : [];

        // Construct the SQL query based on selected genres
        // Inside the movie list fetching section, add this part to fetch distinct showtimes

        $sql = "SELECT * FROM movie";
        if (!empty($selected_genres)) {
            $genre_placeholders = implode(',', array_fill(0, count($selected_genres), '?'));
            $sql .= " WHERE movie_genre IN ($genre_placeholders)";
        }

        // Prepare the SQL statement
        $stmt = $dbconn->prepare($sql);

        // Bind the selected genres to the SQL statement
        if (!empty($selected_genres)) {
            $stmt->bind_param(str_repeat('s', count($selected_genres)), ...$selected_genres);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $row_count = $result->num_rows;

        if ($row_count == 0) {
            echo "<p>No records found.</p>";
        } else {
            echo "<table border='1'>";
            echo "<tr>";
            echo "<th>Movie Name</th>";
            echo "<th>Movie Image</th>";
            echo "<th>Movie Showtime</th>";
            echo "<th>Action</th>";
            echo "</tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["movie_name"]."</td>";
                echo "<td><img src='".$row["movie_image"]."' alt='Movie Image' class='movie-img' /></td>";

                // Fetch distinct showtimes for the current movie
                $showtime_sql = "SELECT DISTINCT reserveTime FROM seat WHERE idMovie = ?";
                $showtime_stmt = $dbconn->prepare($showtime_sql);
                $showtime_stmt->bind_param('s', $row["idmovie"]);
                $showtime_stmt->execute();
                $showtime_result = $showtime_stmt->get_result();

                echo "<td>";
                while ($showtime_row = $showtime_result->fetch_assoc()) {
                    echo $showtime_row["reserveTime"] . "<br>";
                }
                echo "</td>";

                // Action column
                // Inside the movie listing loop
                echo "<td><a class='action' href='addShowtime.php?id=".$row["idmovie"]."'>Add</a> <a class='action' href='deleteShowtime.php?id=".$row["idmovie"]."'>Delete</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        }

        ?>
    </div>
</div>
<script>
    const toggleBtn = document.querySelector('.toggle_btn');
    const toggleBtnIcon = document.querySelector('.toggle_btn i');
    const dropDownMenu = document.querySelector('.dropdown_menu');

    toggleBtn.onclick = function () {
        dropDownMenu.classList.toggle('open')
        const isOpen = dropDownMenu.classList.contains('open')

        toggleBtnIcon.className = isOpen ? 'fa-solid fa-xmark' : 'fa-solid fa-bars'
    }
</script>
</body>
<?php
$dbconn->close();
?>
</html>

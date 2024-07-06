<?php
include ('dbconn.php');
session_start();
//check if user is admin
if ($_SESSION['privilege'] != "CUSTOMER") {
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
            <div class="logo"><a href="main.php">Rai Cinemas</a></div>
            <div class="toggle_btn">
                <i class="fa-solid fa-bars"></i>
            </div>
         </div> 
         <div class="dropdown_menu">
            <?php echo"<li><a href='EditCust.php?a_no=".$username."' >Edit Account</a></li>"; ?>
            <li><a href="Contact.php" style="color: black;">About</a></li>
            <li><a href="custViewMovieInfo.php" style="color: black;">Movies</a></li>
            <li><a href="custViewBooking.php" style="color: black;">View Booking</a></li>
            <?php
                        if(isset($_SESSION['username'])){
                            echo '<li><a href="logout.php" class="action_btn">Logout (' . $_SESSION['username'] . ')</a></li>';
                        }
             ?>
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
                echo "<th>Movie Genre</th>";
                echo "<th>Movie Age</th>";
                echo "<th>Movie Image</th>";
                echo "<th>Movie Description</th>";
                echo "<th>Rating</th>";
                echo "<th>Language</th>";
                echo "</tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["movie_name"]."</td>";
                    echo "<td>".$row["movie_genre"]."</td>";
                    echo "<td>".$row["movie_age"]."</td>";
                    echo "<td><img src='".$row["movie_image"]."' alt='Movie Image' class='movie-img' /></td>";
                    echo "<td>".$row["movie_desc"]."</td>";
                    echo "<td>".$row["movie_rating"]."</td>";
                    echo "<td>".$row["movie_language"]."</td>";
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
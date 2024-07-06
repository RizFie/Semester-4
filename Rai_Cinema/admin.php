<?php
include ('dbconn.php');
session_start();
//check if user is admin
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
    <title>Admin Page</title>
    <link rel="stylesheet" href="staffStyle.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
     crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        h2.role {color: #fdfdfd;}
        .movie-img {
            width: 100px;
            height: auto;
        }
    </style>
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
            <ul>
                <li><a href="dashboard.php" style="color: black;">Mainpage</a></li>
                <li><a href="adminAddMovie.php" style="color: black;">Add Movie</a></li>
                <li><a href="showTime.php" style="color: black;">Showtime</a></li>
                <li><a href="viewCustomer.php" style="color: black;">Customer List</a></li>
                <li><a href="empList.php" style="color: black;">Employee List</a></li>
                <li><a href="adminBookedList.php" style="color: black;">Booking List</a></li>
                <li><a href="registerEmp.php" style="color: black;">Add Employee</a></li>
                <li><a href="EditEmp.php" style="color: black;">Edit Account</a></li>
                <li><a href="logout.php" class="action_btn">Logout</a></li>
            </ul>
         </div>
        <h1>CINEMA MANAGEMENT SYSTEM</h1>
        <h2 class="role">ADMIN</h2>
    </header>
    
    <section>
        <h2>List of Movies</h2>
        <?php  
            include("dbconn.php");
            
            // Check if action=delete and a_no (movie id) proceed or tak
            if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['a_no'])) {
                $movie_id = $_GET['a_no'];
                
                // Delete movie dari database
                // $sqlDelete = "DELETE FROM movie WHERE idmovie = '" . $movie_id . "'";
                // mysqli_query($dbconn, $sqlDelete) or die("Error: " . mysqli_error($dbconn));
                $sqlDeleteSeat = "DELETE FROM bookedseat WHERE idmovie = '" . $movie_id . "'";
                mysqli_query($dbconn, $sqlDeleteSeat) or die("Error: " . mysqli_error($dbconn));

                $sqlDeleteSeat = "DELETE FROM seat WHERE idmovie = '" . $movie_id . "'";
                mysqli_query($dbconn, $sqlDeleteSeat) or die("Error: " . mysqli_error($dbconn));

                // Then delete from movie table
                $sqlDeleteMovie = "DELETE FROM movie WHERE idMovie = '" . $movie_id . "'";
                mysqli_query($dbconn, $sqlDeleteMovie) or die("Error: " . mysqli_error($dbconn));
                // Redirect untuk refresh page lepas delete
                header("Location: admin.php");
                exit();
            }
            
            // display movie list
            $sql = "SELECT * FROM movie";
            $query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));
            $row_count = mysqli_num_rows($query);
            
            if($row_count == 0) {
                echo "<p>No records found.</p>";
            } else {
                echo "<table border='1'>";
                echo "<tr>";
                echo "<th>Movie ID</th>";
                echo "<th>Movie Name</th>";
                echo "<th>Movie Genre</th>";
                echo "<th>Movie Age</th>";
                echo "<th>Movie Image</th>";
                echo "<th>Movie Description</th>";
                echo "<th>License Fee</th>";
                echo "<th>Rating</th>";
                echo "<th>Language</th>";
                echo "<th>Actions</th>";
                echo "</tr>";
                
                while($row = mysqli_fetch_array($query)) {
                    echo "<tr>";
                    echo "<td>".$row["idmovie"]."</td>";
                    echo "<td>".$row["movie_name"]."</td>";
                    echo "<td>".$row["movie_genre"]."</td>";
                    echo "<td>".$row["movie_age"]."</td>";
                    echo "<td><img src='".$row["movie_image"]."' alt='Movie Image' class='movie-img' /></td>";
                    echo "<td>".$row["movie_desc"]."</td>";
                    echo "<td>".$row["movie_licenseFee"]."</td>";
                    echo "<td>".$row["movie_rating"]."</td>";
                    echo "<td>".$row["movie_language"]."</td>";
                    echo "<td>
                            <a class='alter'  href='EditMovie.php?a_no=".$row["idmovie"]."'>Edit</a> |
                            <a class='alter' href='admin.php?action=delete&a_no=".$row["idmovie"]."' onclick='return confirmDelete()'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
                
                echo "</table>";
            }
        ?>    
    </section>

    <script>
        const toggleBtn = document.querySelector('.toggle_btn');
        const dropDownMenu = document.querySelector('.dropdown_menu');

        toggleBtn.onclick = function () {
            dropDownMenu.classList.toggle('open');
            toggleBtn.innerHTML = dropDownMenu.classList.contains('open') ? '<i class="fa-solid fa-xmark"></i>' : '<i class="fa-solid fa-bars"></i>';
        }

        //Confirmation Popup tuk delete
        function confirmDelete() {
            return confirm("Are you sure you want to delete this movie?");
        }
    </script>
</body>
</html>

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
    <style>h2.role {color: #fdfdfd;}

       
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
                <li><a href="dashboard.php" style="color: black;">Mainpage</a></li>
                <li><a href="showTime.php" style="color: black;">Showtime</a></li>
                <li><a href="viewCustomer.php" style="color: black;">Customer List</a></li>
                <li><a href="empList.php" style="color: black;">Employee List</a></li>
                <li><a href="adminBookedList.php" style="color: black;">Booking List</a></li>
                <li><a href="EditEmp.php" style="color: black;">Edit Account</a></li>
                <li><a href="logout.php" class="action_btn">Logout</a></li>
         </div>
        <h1>CINEMA MANAGEMENT SYSTEM</h1>
        <h2 class="role">ADMIN</h2>
    </header>
    

<section class="secAddMovie">
        <h2>Add Movie</h2>
        <form action="AddMovieProcess.php" method="post">
            <label>Movie ID</label>
            <input type="text" name="idmovie" required>

            <label>Movie Name</label>
            <input type="text" name="movie_name" required>

            <label>Movie Genre</label>
            <input type="text" name="movie_genre" required>

            <label>Movie Age</label>
            <input type="text" name="movie_age" required>

            <label>Movie Image URL</label>
            <input type="text" name="movie_image" required>

            <label>Movie Description</label>
            <textarea name="movie_desc" rows="4" required></textarea>

            <label>License Fee</label>
            <input type="number" name="movie_licenseFee">

            <label>Rating</label>
            <input type="text" name="movie_rating">

            <label>Language</label>
            <input type="text" name="movie_language" required>

            <label>Date:Time First Showing</label>
            <input type="text" name="reserveTime" placeholder = "2024-05-17 11:00:00" required>

            <label>Hall Number</label>
            <input type="text" name="hallNum" required>

            <button type="submit">Add Movie</button>
        </form>
    </section>

    
    <script>
        const toggleBtn = document.querySelector('.toggle_btn');
        const toggleBtnIcon = document.querySelector('.toggle_btn i');
        const dropDownMenu = document.querySelector('.dropdown_menu');

        toggleBtn.onclick = function () {
            dropDownMenu.classList.toggle('open')
            const isOpen = dropDownMenu.classList.conatins('open')

            toggleBtn.classList = isOpen
                ? 'fa-solid fa-xmark'
                : 'fa-solid fa-bars'
        }
    </script>
</body>
</html>

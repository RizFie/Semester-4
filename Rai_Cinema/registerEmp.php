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
<script>
        function checkEmptyFields()
        {   
            let format = /[!@#$%^&*(),.?":{}|<>]/g;
            let username = document.getElementById("userName").value;
            let fname = document.getElementById("firstName").value;
            let lname = document.getElementById("lastName").value;
            let password = document.getElementById("password").value;
        
            if (!isNaN(fname)) {
                alert("First name should be alphabetic!");
                return false;
            } else if (!isNaN(lname)) {
                alert("Last name should be alphabetic!");
                return false;
            } else if (password.length < 8) {
                alert("Password should be at least 8 characters!");
                return false;
            } else if (!password.match(format)) {
                alert("Password must contain at least one special character!");
                return false;
            } else {
                return true;
            }
        }
    </script>
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
                <li><a href="adminAddMovie.php" style="color: black;">Add Movie</a></li>
                <li><a href="showTime.php" style="color: black;">Showtime</a></li>
                <li><a href="viewCustomer.php" style="color: black;">Customer List</a></li>
                <li><a href="empList.php" style="color: black;">Employee List</a></li>
                <li><a href="adminBookedList.php" style="color: black;">Booking List</a></li>
                <li><a href="registerEmp.php" style="color: black;">Add Employee</a></li>
                <li><a href="EditEmp.php" style="color: black;">Edit Account</a></li>
                <li><a href="logout.php" class="action_btn">Logout</a></li>
         </div>
        <h1>CINEMA MANAGEMENT SYSTEM</h1>
        <h2 class="role">EMPLOYEE</h2>
    </header>
    

<section class="secAddMovie">
        <h2>Add Employee</h2>
        <form action="AddEmp.php" method="post">
            <label for = "userName"> Employee Username:</label>
            <input type="text" id="userName" name="userName"  required>

            <label for = "firstName">Employee First Name:</label>
            <input type="text" id="firstName" name="firstName"  required>

            <label for = "lastName">Employee Last Name:</label>
            <input type="text" id="lastName" name="lastName" required>

            <label for = "email"> Email:</label>
            <input type="text" id="email" name="email" required>

            <label for="password"> Password:</label>
            <input type="password" id="password" name="password" required>  
            <label class="instructions">Must be at least 8 characters and contain at least one special characters.</label>

            <button type="submit" name="Submit" value="Submit" onClick="return checkEmptyFields()">Hire!</button>
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
<?php
session_start();
include("dbconn.php");

if ($_SESSION['privilege'] != "EMPLOYEE") {
    die("<script>alert('UNAUTHORIZED USER'); window.location.href='registerLogin.php';</script>");
    exit();
}
$username = $_SESSION['username'];

// SQL to retrieve customer data
$sql = "SELECT * FROM employee WHERE emp_uname= '$username'";

// Execute SQL query
$query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));

// Check if any record found
$row = mysqli_num_rows($query);

if ($row == 0) {
    echo "No record found";
} else {
    // Fetch customer data
    $r = mysqli_fetch_assoc($query);
    $username = $r['emp_uname'];
    $fname = $r['emp_fname'];
    $lname = $r['emp_lname'];
    $email = $r['emp_email'];
    $pass = $r['emp_pass'];
}
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
            } else if (age < 18) {
                alert("You must be at least 18 years old to create an admin account!");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Rai Cinemas</title>
    <style>
            <?php include "navbar.css" ?>
    </style>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url(https://i.ibb.co/cFK2V6g/backG.png);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            overflow: hidden; /* Prevents scrollbar from appearing during animation */
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 50%;
            animation: slideIn 1s ease-out; /* Animation applied here */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            font-size: large;
        }
        th {
            background-color: #f4f4f4;
        }
        input[type=text], input[type=number] {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .buttons {
            text-align: center;
            margin-top: 20px;
        }
        input[type=submit] {
            width: 45%;
            padding: 10px;
            margin: 10px 2%;
            font-size: 1em;
            color: white;
            background-color: gray;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #b2beb5;
            color: black;
        }

        /* CSS Animation */
        @keyframes slideIn {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>
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
                <!-- <li><a href="logout.php" class="action_btn">Logout</a></li> -->
            <?php
                if(isset($_SESSION['username'])){
                    echo '<li><a href="logout.php" class="action_btn">Logout (' . $_SESSION['username'] . ')</a></li>';
                }
             ?>
         </div>
</header>
<body>
<div class="container">
    <form action="processUpDelEmp.php" method="post">
        <table>
            <tr>
                <th colspan="2">Employee Details</th>
            </tr>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" value="<?php echo $username; ?>" readonly></td>
            </tr>
            <tr>
                <td>First Name</td>
                <td><input type="text" name="fname" value="<?php echo $fname; ?>"></td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td><input type="text" name="lname" value="<?php echo $lname; ?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $email; ?>"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="text" name="pass" value="<?php echo $pass; ?>"></td>
            </tr>
        </table>
        <div class="buttons">
            <input type="submit" name="update" value="Update" onClick="return checkEmptyFields()">
            <input type="submit" name="delete" value="Delete">
        </div>
    </form>
</div>
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


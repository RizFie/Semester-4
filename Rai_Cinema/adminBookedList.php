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
    <style>h2.role {color: #fdfdfd;}</style>
    
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
        <h1>CINEMA MANAGEMENT SYSTEM</h1>
        <h2 class="role">ADMIN</h2>
    </header>

    <section>
        <h2>List of Booked Ticket</h2>
        <?php  
            include("dbconn.php");
            $sql = "SELECT * FROM bookedseat";
            $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
            $row = mysqli_num_rows($query);
            if ($row == 0) {
                echo "No record found";
            } else {
                echo "<table border='1'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Booking ID</th>";
                echo "<th>Seat ID</th>";
                echo "<th>Movie ID</th>";
                echo "<th>Customer Username</th>";
                echo "<th>Reserve Time</th>";
                echo "<th>Seat Number</th>";
                echo "<th>Payment ID</th>";

                // echo "<th>Actions</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_array($query)) {
                    echo "<tr>";
                    echo "<td>".$row["bookingID"]."</td>";
                    echo "<td>".$row["idSeat"]."</td>";
                    echo "<td>".$row["idMovie"]."</td>";
                    echo "<td>".$row["cust_uname"]."</td>";
                    echo "<td>".$row["reserveTime"]."</td>";
                    echo "<td>".$row["seatNum"]."</td>";
                    echo "<td>".$row["idpayment"]."</td>";

                    // echo "<td>
                    //         <a href='EditCustomer.php?cust_uname=".$row["cust_uname"]."'>Edit</a> |
                    //         <a href='DeleteCustomer.php?cust_uname=".$row["cust_uname"]."'>Delete</a>
                    //       </td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }   
        ?>    
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

<!DOCTYPE html>
<?php
    session_start();
    include('dbconn.php');

    //check if user is employee
    if ($_SESSION['privilege'] != "EMPLOYEE") {
        die("<script>alert('UNAUTHORIZED USER'); window.location.href='registerLogin.php';</script>");
        exit();
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>
    <style>
        <?php include('viewCustomer.css'); ?>
    </style>
    <link rel="stylesheet" href="navbar.css">
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
    <div class = "header">
        <h1>Customers' Details</h1>
    </div>

    <!-- <div class="row">
        <div class="card">
            <h4>What is a Frontend Develoment?</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam porro similique aliquid debitis ipsam soluta dolorum ipsa! Voluptate, suscipit iure.</p>
        </div>
    </div> -->
    
    <?php
        $sql = "SELECT * FROM customer;";
        $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
        $numRow = mysqli_num_rows($query);

        if($numRow == 0){
    ?>
            <h1 class = "noRecord">No Record of Bookings</h1>
    <?php
        }

        while($row = mysqli_fetch_assoc($query)){
    ?>
    <div class="row">
        <div class="card">
            <h4><?= $row['cust_uname'] ?></h4>
            <br>
            <table>
                <tr>
                    <td class = "firstColumn">First name</td>
                    <td>:</td>
                    <td><?= $row['cust_fname'] ?></td>
                </tr>
                <tr>
                    <td class = "firstColumn">Last name</td>
                    <td>:</td>
                    <td><?= $row['cust_lname'] ?></td>
                </tr>
                <tr>
                    <td class = "firstColumn">Age</td>
                    <td>:</td>
                    <td><?= $row['cust_age'] ?></td>
                </tr>
                <tr>
                    <td class = "firstColumn">Email</td>
                    <td>:</td>
                    <td><?= $row['cust_email'] ?></td>
                </tr>
            </table>
        </div>
    </div>
    <?php
        }
    ?>
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
<?php
    mysqli_close($dbconn);
?>
</html>
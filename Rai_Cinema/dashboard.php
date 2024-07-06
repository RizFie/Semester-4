<?php
include ('dbconn.php');
session_start();

// Check if user is admin
if ($_SESSION['privilege'] != "EMPLOYEE") {
    die("<script>alert('UNAUTHORIZED USER'); window.location.href='registerLogin.php';</script>");
    exit();
}

$username = $_SESSION['username'];

// Fetch total customers
$queryTotalCustomers = "SELECT COUNT(*) AS total_customers FROM customer";
$resultTotalCustomers = mysqli_query($dbconn, $queryTotalCustomers);
$rowTotalCustomers = mysqli_fetch_assoc($resultTotalCustomers);
$totalCustomers = $rowTotalCustomers['total_customers'];

// Fetch total movies
$queryTotalMovies = "SELECT COUNT(*) AS total_movies FROM movie";
$resultTotalMovies = mysqli_query($dbconn, $queryTotalMovies);
$rowTotalMovies = mysqli_fetch_assoc($resultTotalMovies);
$totalMovies = $rowTotalMovies['total_movies'];

// Fetch total sales (example query, adjust according to your database schema)
$queryTotalSales = "SELECT SUM(total_payment) AS total_sales FROM payment";
$resultTotalSales = mysqli_query($dbconn, $queryTotalSales);
$rowTotalSales = mysqli_fetch_assoc($resultTotalSales);
$totalSales = $rowTotalSales['total_sales'];

$queryTotalSeat = "SELECT COUNT(*) AS total_seat FROM bookedseat";
$resultTotalSeat = mysqli_query($dbconn, $queryTotalSeat);
$rowTotalSeat = mysqli_fetch_assoc($resultTotalSeat);
$totalSeat = $rowTotalSeat['total_seat'];

$queryTotalEmp = "SELECT COUNT(*) AS total_emp FROM employee";
$resultTotalEmp = mysqli_query($dbconn, $queryTotalEmp);
$rowTotalEmp = mysqli_fetch_assoc($resultTotalEmp);
$totalEmp = $rowTotalEmp['total_emp'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">    
    <link rel="stylesheet" href="navbar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
            <ul>
                <li><a href="adminAddMovie.php" style="color: black;">Add Movie</a></li>
                <li><a href="showTime.php" style="color: black;">Showtime</a></li>
                <li><a href="viewCustomer.php" style="color: black;">Customer List</a></li>
                <li><a href="empList.php" style="color: black;">Employee List</a></li>
                <li><a href="adminBookedList.php" style="color: black;">Booking List</a></li>
                <li><a href="EditEmp.php" style="color: black;">Edit Account</a></li>
                <li><a href="logout.php" class="action_btn">Logout</a></li>
            </ul>
        </div>
        <h1>CINEMA MANAGEMENT SYSTEM</h1>
    </header>
    <!--Analytics statistic -->
    <div class="home-content">
        <div class="overview-boxes">
            <div class="box">
                <div class="right-side">
                    <div class="box-topic">Total Movies</div>
                    <div class="number"><?php echo $totalMovies; ?></div>
                    <div class="indicator">
                        <i class="bx bx-up-arrow-alt"></i>
                    </div>
                </div>
                <i class='bx bxs-camera-movie bx-lg'></i>
            </div>
            <div class="box">
                <div class="right-side">
                    <div class="box-topic">Total Sales</div>
                    <div class="number"><?php echo $totalSales; ?></div>
                    <div class="indicator">
                        <i class="bx bx-up-arrow-alt"></i>
                    </div>
                </div>
                <i class='bx bx-money bx-lg'></i>
            </div>
            <div class="box">
                <div class="right-side">
                    <div class="box-topic">Total Customers</div>
                    <div class="number"><?php echo $totalCustomers; ?></div>
                    <div class="indicator">
                        <i class="bx bx-up-arrow-alt"></i>  
                    </div>
                </div>
                <i class='bx bx-child bx-lg'></i>
            </div>
        </div>
    </div>
    <div class="home-content">
        <div class="overview-boxes">
            <div class="box">
                <div class="right-side">
                    <div class="box-topic">Total Seat Booked</div>
                    <div class="number"><?php echo $totalSeat; ?></div>
                    <div class="indicator">
                        <i class="bx bx-up-arrow-alt"></i>
                    </div>
                </div>
                <i class='bx bx-handicap bx-lg'></i>
            </div>
            <div class="box">
                <div class="right-side">
                    <div class="box-topic">Total Employee</div>
                    <div class="number"><?php echo $totalEmp; ?></div>
                    <div class="indicator">
                        <i class="bx bx-up-arrow-alt"></i>
                    </div>
                </div>
                <i class='bx bx-body bx-lg'></i>
            </div>
    </div>
    <section class="service">
        <div class="flex-container">
            <a href="admin.php">
                <div class="movie-container">
                    <i class="fa-solid fa-film fa-6x"></i>
                    <h3>MOVIE</h3>
                </div>
            </a>
            <a href="adminBookedList.php">
                <div class="booking-container">
                    <i class="fa-solid fa-ticket fa-6x"></i>
                    <h3>BOOKING</h3>
                </div>
            </a>
            <a href="viewCustomer.php">
                <div class="cust-container">
                    <i class="fa-solid fa-person fa-6x"></i>
                    <h3>CUSTOMER LIST</h3>
                </div>
            </a>
            <a href="empList.php">
                <div class="emp-container">
                    <i class="fa-solid fa-user fa-6x"></i></i>
                    <h3>EMPLOYEE</h3>
                </div>
            </a>
            <a href="showTime.php">
                <div class="show-container">
                    <i class="fa-solid fa-business-time fa-6x"></i>
                    <h3>SHOWTIME</h3>
                </div>
            </a>
        </div>
    </section>

    <?php mysqli_close($dbconn); ?>
    <script src="https://kit.fontawesome.com/e921146c68.js" crossorigin="anonymous"></script>
    <script>
        const toggleBtn = document.querySelector('.toggle_btn');
        const dropDownMenu = document.querySelector('.dropdown_menu');

        toggleBtn.onclick = function () {
            dropDownMenu.classList.toggle('open');
            toggleBtn.innerHTML = dropDownMenu.classList.contains('open') ? '<i class="fa-solid fa-xmark"></i>' : '<i class="fa-solid fa-bars"></i>';
        }

        // Confirmation Popup for delete
        function confirmDelete() {
            return confirm("Are you sure you want to delete this movie?");
        }
    </script>
</body>
</html>

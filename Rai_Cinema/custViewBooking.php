<?php
include ('dbconn.php');
session_start();
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema System</title>
    <link rel="stylesheet" href="CinemaCSS.css">
    <link rel="stylesheet" href="promoCSS.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <style>
        .secShoeList {
            margin-top: 100px; /* Adjust to avoid overlapping with the fixed navbar */
            display: flex;
            justify-content: center;
        }
        .shoeListContainer {
            background-color: #ffffff; /* White background color for the container */
            padding: 20px;
            border-radius: 10px; /* Slightly rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for better separation */
            max-width: 1200px;
            width: 90%;
        }
        .shoe-image {
            width: 100px;
            height: auto;
        }
        .order {
            text-align: center;
            margin: 20px auto;
            width: 80%;
        }
        .order-container {
            /* Grayish background color */
            border-radius: 10px; /* Slight curve for the corners */
            padding: 20px;
            margin-bottom: 20px;
        }
        table {
            margin: 0 auto;
            width: 100%;
            border-collapse: collapse;
            font-size: x-large;
        }
        th, td {
            padding: 10px;
            border: 1px solid #000;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
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
        <?php echo "<li><a href='EditCust.php?a_no=".$username."' >Edit Account</a></li>"; ?>
        <li><a href="Contact.php" style="color: black;">About</a></li>
        <li><a href="#movies" style="color: black;">Movies</a></li>
        <?php
            if(isset($_SESSION['username'])){
                echo '<li><a href="logout.php" class="action_btn">Logout (' . $_SESSION['username'] . ')</a></li>';
            }
        ?>
    </div>
</header>
<section class="secShoeList" >
    <div class="shoeListContainer" >
        <?php
        include("dbconn.php");
        $sql = "SELECT bs.bookingID, m.movie_name, bs.reserveTime, GROUP_CONCAT(bs.seatNum ORDER BY bs.seatNum) AS seatNums, p.total_payment
                FROM bookedseat bs
                JOIN movie m ON bs.idMovie = m.idMovie
                JOIN payment p ON bs.idpayment = p.idpayment
                WHERE bs.cust_uname = '$username'
                GROUP BY bs.bookingID, m.movie_name, bs.reserveTime, p.total_payment";
        $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
        
        if (mysqli_num_rows($query) == 0) {
            echo "No record found";
        } else {
            echo "<font size='30'>Booked Movie by <b>$username</b></font>";
            echo "<div class='order-container'>";
            echo "<div class='order'>";
            echo "<table border='1'>";
            echo "<tr>";
            echo "<th>Booking ID</th>";
            echo "<th>Movie Name</th>";
            echo "<th>Reserve Time</th>";
            echo "<th>Seat Numbers</th>";
            echo "<th>Ticket Price</th>";
            echo "</tr>";

            while($fetch = mysqli_fetch_assoc($query)) {
                echo "<tr>";
                echo "<td>" . $fetch['bookingID'] . "</td>";
                echo "<td>" . $fetch['movie_name'] . "</td>";
                echo "<td>" . $fetch['reserveTime'] . "</td>";
                echo "<td>" . $fetch['seatNums'] . "</td>";
                echo "<td> 15.00 </td>";
                echo "</tr>";
            }
            
            echo "</table>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
</section>

<script>
    const toggleBtn = document.querySelector('.toggle_btn');
    const toggleBtnIcon = document.querySelector('.toggle_btn i');
    const dropDownMenu = document.querySelector('.dropdown_menu');

    toggleBtn.onclick = function () {
        dropDownMenu.classList.toggle('open')
        const isOpen = dropDownMenu.classList.contains('open')

        toggleBtn.classList = isOpen
            ? 'fa-solid fa-xmark'
            : 'fa-solid fa-bars'
    }
</script>
<?php
} else {
    session_destroy();
    header("Location: registerLogin.php");
    exit();
}
mysqli_close($dbconn);
?>
</body>
</html>

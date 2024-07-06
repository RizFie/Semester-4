<?php
session_start();
include('dbconn.php');
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];}

// Validate input
if (isset($_POST['movieID']) && isset($_POST['selectDateTime' ]) && isset($_POST['hallNum' ]) && isset($_POST['idSeat' ])) {
    $movieID = mysqli_real_escape_string($dbconn, $_POST['movieID']);
    $reserveTime = mysqli_real_escape_string($dbconn, $_POST['selectDateTime']);
    $hallNum = mysqli_real_escape_string($dbconn, $_POST['hallNum']);
    $idSeat = mysqli_real_escape_string($dbconn, $_POST['idSeat']);
    
    $_SESSION['movieID'] = $movieID;
    $_SESSION['reserveTime'] = $reserveTime;
    $_SESSION['hallNum'] = $hallNum;
    $_SESSION['idSeat'] = $idSeat;
} else if (isset($_GET['movieID']) && isset($_GET['reserveTime']) && isset($_GET['hallNum']) && isset($_GET['idSeat'])) {
    $movieID = mysqli_real_escape_string($dbconn, $_GET['movieID']);
    $reserveTime = mysqli_real_escape_string($dbconn, $_GET['reserveTime']);
    $hallNum = mysqli_real_escape_string($dbconn, $_GET['hallNum']);
    $idSeat = mysqli_real_escape_string($dbconn, $_GET['idSeat']);
    
    $_SESSION['movieID'] = $movieID;
    $_SESSION['reserveTime'] = $reserveTime;
    $_SESSION['hallNum'] = $hallNum;
    $_SESSION['idSeat'] = $idSeat;
}else {
    die("Movie ID or Reserve Time not set");
}

// Fetch movie name based on movieID
$sql_movie = "SELECT movie_name FROM movie WHERE idmovie='$movieID'";
$result_movie = mysqli_query($dbconn, $sql_movie);

if (mysqli_num_rows($result_movie) > 0) {
    $row_movie = mysqli_fetch_assoc($result_movie);
    $movieName = $row_movie['movie_name'];
} else {
    die("Movie not found");
}

//kinda hardcoded but nvm
$seatLayout = [
    'A' => ['A01', 'A02', 'A03', 'A04'],
    'B' => ['B01', 'B02', 'B03', 'B04'],
    'C' => ['C01', 'C02', 'C03', 'C04']
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Selection</title>
    <link rel="stylesheet" href="seatALPHA.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
     crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>
<div class="logo">
    <a href="main.php">Rai Cinemas</a>
</div>
    <section class="seatAlpha">
        <h1>Please choose your seat for <?php echo htmlspecialchars($movieName); ?></h1>
        <div class="seat-container">
            <p>You may choose your seat based on the layout:</p>
            <form id="form1" method="post" action="payment.php">
                <div class="screen">
                    <p>Screen</p>
                </div>
                
                <label for="seats">Select your seat:</label>
                <table border="1">
                    <?php foreach ($seatLayout as $row => $seats): ?>
                        <tr>
                            <td><?php echo $row; ?></td>
                            <?php foreach ($seats as $seat): ?>
                                <?php
                                // Check if seat is booked
                                $sql_check_seat = "SELECT * FROM bookedseat WHERE seatNum='$seat' AND idMovie='$movieID' AND reserveTime='$reserveTime'";
                                $result_check_seat = mysqli_query($dbconn, $sql_check_seat);
                                $isBooked = mysqli_num_rows($result_check_seat) > 0;
                                $disabledAttr = $isBooked ? 'disabled' : '';
                                ?>
                                <td>
                                    <input type="checkbox" name="seatNum[]" value="<?php echo $seat; ?>" <?php echo $disabledAttr; ?>>
                                    <?php echo $seat; 
                                    ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <div class="button-container">
                    <div class="btn-back">
                        <a href="dateTime.php?movieID=<?php echo $movieID; ?>"><button type="button">Back</button></a>
                    </div>
                    <div class="buttonSubmit">
                        <button form="form1" type="submit">Proceed to Payment</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>

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
<?php
mysqli_close($dbconn);
?>
</html>
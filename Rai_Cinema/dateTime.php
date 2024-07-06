<?php
session_start();
include ('dbconn.php');
if (isset($_POST['movieID'])) {
    $movieID = $_POST['movieID'];
} elseif (isset($_GET['movieID'])) {
    $movieID = $_GET['movieID'];
}else {
    die("No movie selected");
}
// if(isset($_SESSION['username'])) {
//     $username = $_SESSION['username'];}
//check if user is customer
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
    <title>Date & Time Selection</title>
    <link rel="stylesheet" href="dateTime.css">
</head>
<body> 
<div class="logo">
    <a href="main.php">Rai Cinemas</a>
</div>  
    <?php $sql_movie = "SELECT * from movie WHERE idmovie='$movieID';";
          $result = mysqli_query($dbconn, $sql_movie);
          if (mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
            $movieName = $row['movie_name'];
    }}?>
    <div class="head"><h1><?php echo "$movieName" ?> Date & time</h1></div>
    <label for="date-select">Please choose the available date and time: </label>
    <div class="container">
        <form id="formDAT" method="post" action="seatALPHA.php">
            <select id="date-select" name="selectDateTime">
                <?php $sql = "SELECT DISTINCT reserveTime from seat WHERE idMovie='$movieID';";
                $result = mysqli_query($dbconn, $sql);
                if (mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                    $reserveTime = $row['reserveTime'];
                    echo "<option value='$reserveTime'>$reserveTime</option>";
            }
            }
            
            ?>
            </select>
            <?php 
                $sqlHall = "SELECT DISTINCT hallNum from seat WHERE idMovie='$movieID';";
                $resultHall = mysqli_query($dbconn, $sqlHall);
                $fetch = mysqli_fetch_assoc($resultHall);
                $hallNum = $fetch['hallNum'];

                $sqlIDseat = "SELECT *  from seat WHERE idMovie='$movieID';";
                $resultIDSeat = mysqli_query($dbconn, $sqlIDseat);
                $fetchIDSeat = mysqli_fetch_assoc($resultIDSeat);
                $idSeat = $fetchIDSeat['idSeat'];
            ?>
            <input type="hidden" name="idSeat" value="<?php echo $idSeat; ?>">
            <input type="hidden" name="movieID" value="<?php echo $movieID; ?>">
            <input type="hidden" name="hallNum" value="<?php echo $hallNum; ?>">
        </form>
        <p>Once you have selected the date and time, please click the proceed button.</p>
        <div class="button-container">
            <div class="btn-back">
                <a href="main.php"><button type="button">Back</button></a>
            </div>
            <div class="btn-submit">
                <button form="formDAT" type="submit">Proceed</button>
            </div>
        </div>
    </div>
</body>
<?php
    mysqli_close($dbconn);
?>
</html>



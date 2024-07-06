<?php
    session_start();
    include ('dbconn.php');
    $movieID = $_SESSION['movieID'];
    $reserveTime = $_SESSION['reserveTime'];
    $hallNum = $_SESSION['hallNum'];
    $username =  $_SESSION['username'];
    $idSeat =  $_SESSION['idSeat'];

    if(!empty($_POST['seatNum'])) {
        $seatNum = $_POST['seatNum'];
        $seatNums = implode(", ", $seatNum);
        $_SESSION['seatNum'] = $seatNums; 
        $seatCount = count($seatNum);     
        }

        // INSERT PAYMENT DETAILS
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['paymentType']) && isset($_POST['bank_name']) && isset($_POST['totalPayment']) ) {
            // Get the payment details from the form
            $paymentType = $_POST['paymentType'];
            $bankName = $_POST['bank_name'];
            $totalPrice = $_POST['totalPayment'];
    
            // Insert payment details into database
            $sqlPayment = "INSERT INTO payment (payment_type, total_payment, bank_name) VALUES ('$paymentType', '$totalPrice', '$bankName')";
            if (mysqli_query($dbconn, $sqlPayment)) {
                //masukkan dalam session jap paymentID ni, nak guna xoxo
                $paymentID = mysqli_insert_id($dbconn);
                $_SESSION['paymentID'] = $paymentID;
                // Redirect ke insert_booking.php kejap sebab nak data dia ;)
                header("Location: insert_booking.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($dbconn);
            }


            // ERROR KAT SINI 
            //insert bookedseat detail in db
            // $sqlBooked = "INSERT INTO bookedseat (idSeat, idMovie, cust_uname, reserveTime, seatNum) VALUES ('$idSeat','$movieID', '$username', '$reserveTime', '$seatNum')";

            // if (mysqli_query($dbconn, $sqlBooked)) {
            //     // Redirect to main page after successful insertion
            //     header("Location: main.php");
            //     exit();
            // } else {
            //     echo "Error: " . $sql . "<br>" . mysqli_error($dbconn);
            // }
        }
    // Retrieve movie details from the database
    $sql_movie = "SELECT * from movie WHERE idmovie='$movieID'";
    $result_movie = mysqli_query($dbconn, $sql_movie);
    $movieName = ""; // Initialize $movieName variable
    if (mysqli_num_rows($result_movie) > 0){
        $row = mysqli_fetch_assoc($result_movie);
        $movieName = $row['movie_name'];
    }

    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="paymentCSS.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"/>
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
            <?php echo"<li><a href='EditCust.php?a_no=".$username."' >Edit Account</a></li>"; ?>
            <li><a href="Contact.php" style="color: black;">About</a></li>
            <li><a href="custViewMovieInfo.php" style="color: black;">Movies</a></li>
            <li><a href="custViewBooking.php" style="color: black;">View Booking</a></li>
            <?php
                        if(isset($_SESSION['username'])){
                            echo '<li><a href="logout.php" class="action_btn">Logout (' . $_SESSION['username'] . ')</a></li>';
                        }
             ?>
         </div>
    </div>
</header>

<div class="payment">
  <div class="itemList">
    <div class="group">
        <h4>Checkout
            <span class="price" style="color:black">
                <i class="fa fa-shopping-cart"></i>
                <b>Price</b>
            </span>
        </h4>
        <!-- PHP or dynamic content display here -->
        <p><a href="#" style="color: black;">Movie Name</a> <span class="price"><?php echo"$movieName"?></span></p>
        <p><a href="#" style="color:black">Seat</a> <span class="price"><?php echo"$seatNums"?></span></p>
        <p><a href="#" style="color:black">Hall Number</a> <span class="price"><?php echo"$hallNum"?></span></p>
        <p><a href="#" style="color:black">Quantity</a> <span class="price"><?php echo"$seatCount"?></span></p>
        <p><a href="#" style="color:black">Date/Time</a> <span class="price"><?php echo"$reserveTime"?></span></p>
        <hr>
        <?php $totalPrice = 15*$seatCount; ?>
        <p>Total <span class="price" style="color:black"><b><?php echo "RM$totalPrice";?></b></span></p>
    </div>
    </div>
    <div class="billAddress_payment">
        <div class="group">
            <form id="formDetails" action="" method="POST">
                <div class="row">
                    <div class="containerBillPayment">
                        <h3>Billing Address</h3>
                        <label for="fullname">Full Name</label>
                        <input type="text" id="fullname" name="fullname" placeholder="Asjad Bin Amran" required>
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" value="<?php echo $username; ?>" readonly>
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" placeholder="Enter your address" required>
                        <!-- store total payment -->
                        <input type="hidden" name="totalPayment" value="<?php echo $totalPrice; ?>">
                    </div>
                    <div class="containerBillPayment">
                        <h3>Payment</h3>
                        <label for="paymentType">Payment Type:</label>
                        <div class="radio-group">
                            <label><input type="radio" name="paymentType" value="Credit Card"> Credit Card</label>
                            <label><input type="radio" name="paymentType" value="Debit Card"> Debit Card</label>
                        </div>
                        <label for="bank_name">Bank:</label>
                        <select name="bank_name" id="bank_name" required>
                            <option value="MayBank">MayBank</option>
                            <option value="CIMB Bank">CIMB Bank</option>
                            <option value="Bank Islam">Bank Islam</option>
                            <option value="Bank Muamalat">Bank Muamalat</option>
                            <option value="BSN">BSN</option>
                            <option value="GX Bank">GX Bank</option>
                            <option value="Hong Leong Bank">Hong Leong Bank</option>
                            <option value="HSBC">HSBC</option>
                            <option value="AmBank">AmBank</option>
                            <option value="Al-Rajhi">Al-Rajhi</option>
                            <option value="Citibank">Citibank</option>
                            <option value="Affin">Affin</option>
                            <option value="Alliance Bank">Alliance Bank</option>
                        </select><br>
                    </div>
                </div><!-- row -->
                <label>
                    <input type="checkbox" checked="checked" name="terms" required> Please ensure that you have read the terms and conditions.
                </label>
                
                <button for="formDetails" type="submit" class="btn">Continue to checkout</button>
            </form>
            <a href="seatALPHA.php?movieID=<?php echo $movieID; ?>&reserveTime=<?php echo $reserveTime; ?>&hallNum=<?php echo $hallNum; ?>&idSeat=<?php echo $idSeat; ?>"><button type="button" class="btn">Back</button></a>
        </div>
    </div>
</div>

<script>
    const toggleBtn = document.querySelector('.toggle_btn');
    const dropDownMenu = document.querySelector('.dropdown_menu');

    toggleBtn.onclick = function () {
        dropDownMenu.classList.toggle('open');
        const isOpen = dropDownMenu.classList.contains('open');

        toggleBtn.innerHTML = isOpen ? '<i class="fa-solid fa-xmark"></i>' : '<i class="fa-solid fa-bars"></i>';
    }
</script>

</body>
<?php
    mysqli_close($dbconn);
?>
</html>

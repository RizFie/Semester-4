<?php
include ('dbconn.php');
session_start();
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
    <script>
        let counter = 1;
        setInterval(function(){
        document.getElementById('radio' + counter).checked = true;
        counter++;
        if( counter > 5)
        {
        counter = 1;
        }
        }, 4000);

        function setMovieName(movieName) {
        localStorage.setItem('movieName', movieName);
        }
        </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema System</title>
    <link rel="stylesheet" href="CinemaCSS.css">
    <link rel="stylesheet" href="promoCSS.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
     crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
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
</header>
<body>
    <div class="slider">
        <div class="slides">
         <!--radio starts-->
         <input type="radio" name="radio-btn" id="radio1">
         <input type="radio" name="radio-btn" id="radio2">
         <input type="radio" name="radio-btn" id="radio3">
         <input type="radio" name="radio-btn" id="radio4">
         <input type="radio" name="radio-btn" id="radio5">
        <!--radio button ends-->

        <div class="slide first">
            <img src="https://i.ibb.co/TWk1QWD/panda.png" alt="panda">
        </div>
        <div class="slide">
            <img src="https://i.ibb.co/jfWksyD/apes.webp" alt="apes">
        </div>
        <div class="slide">
            <img src="https://i.ibb.co/BnyvZ4T/If.jpg" alt="if">
        </div>
        <div class="slide">
            <img src="https://i.ibb.co/5nH36nS/Garfield.jpg" alt="Garfield">
        </div>
        <div class="slide">
            <img src="https://i.ibb.co/hZVGYCF/sheriff.png" alt="sheriff">
        </div>
        <div class="button">
            <a onclick="nextimg(-1)" class="prev">&#10094;</a>
            <a onclick="nextimg(1)" class="prev">&#10095;</a>
        </div>
        <div class="navigation-auto">
            <div class="auto-btn1"></div>
            <div class="auto-btn2"></div>
            <div class="auto-btn3"></div>
            <div class="auto-btn4"></div>
            <div class="auto-btn5"></div>
        </div>
        <!--slides end-->
        </div>
        <div class="navigation-manual">
            <label for="radio1" class="manual-btn"></label>
            <label for="radio2" class="manual-btn"></label>
            <label for="radio3" class="manual-btn"></label>
            <label for="radio4" class="manual-btn"></label>
            <label for="radio5" class="manual-btn"></label>
        </div>
    </div>
    <section class="movies" id="movies">
        <h1 class="trending">Trending</h1>
        <div class="movies-container">
        <?php
			    $sql = "SELECT * FROM movie;";
                $result = mysqli_query($dbconn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $movieID = $row['idmovie'];
                        $movieName = $row['movie_name'];
                        $moviePic = $row['movie_image'];
    
                        echo "<div class='movie-box'>
                                <div class='movie-box-img'>
                                    <form action='dateTime.php' method='POST'>
                                        <input type='hidden' name='movieID' value='$movieID'>
                                        <input type='image' src='$moviePic'>
                                    </form>
                                </div>
                            </div>";}}
        ?>
        </div>
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
<?php
    mysqli_close($dbconn);
?>
</html>
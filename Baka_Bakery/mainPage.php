<?php
    include ('bakadbconn.php');
    session_start();
?>
<script>
function confirmation() {
    let text;
    if (confirm("Are you sure that you want to leave :( ?") == true) {
        window.location.href='logoutC.php';
    } else {
    }
}
</script>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Baka Bakery</title>
        <!--<link rel="stylesheet" href="irdp2CSS.css">-->
        <style>
            <?php include('irdp2CSS.css'); ?> 
        </style>
    </head>
    <body>
    <header>
        <div class="container">
            <div class="left-section">
                <img src="pics/logobaka.jpg" alt="Logo" class="logo">
                <h1 class=custfont id=tagline > "One smell hold thousand memories"</h1>
            </div>
            <nav>
                <a href="custOrder.php">Your Order</a>
                <?php 
                    if(isset($_SESSION['cust_id'])){
                        echo "<a onClick = 'confirmation()'>Logout</a>";
                    }
                    else{
                        echo "<a href='login.php'>Login</a>";
                    }
                ?> 
            </nav>
        </div>
    </header>
        <main class="maincontainer">
            <section id="featured-products">
                <div class="feaprod">
                <h2 class= mainsec>Featured Products</h2>
                </div>
                <div class="product-wrapper">
                    <div class="product-grid" id="product-grid">

                        <?php 
                            $sql = "SELECT * FROM food;";
                            $result = mysqli_query($dbconn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    $food_name = $row['food_name'];
                                    $food_desc = $row['food_desc'];
                                    $food_price = $row['food_price'];
                                    $food_picture = $row['picture'];
                                    $food_id = $row['food_id'];

                                    echo "<a href='product1.php?f_id=$food_id' class='product'>
                                             <div class='product-content'>
                                                <img src='$food_picture' alt='$food_name'>
                                                <h3 >$food_name</h3>
                                                <p>RM $food_price</p>
                                             </div>
                                          </a>";
                }
            }
        ?>
    </div>
</div>

                </div>
            </section>
            <section id="Categories">
                <h2 class=mainsec>Browse by Categories</h2>
                <div class="category-grid">
                    <div class="category">
                        <a href="#ice-cream" class="scroll-link">
                        <img src="https://i.ibb.co/CBfJsgp/ice-cream.jpg" alt="ice-cream" border="0">
                        <h3>Ice creams</h3>
                        </a>
                    </div>
                    <div class="category" class="scroll-link">
                        <a href="#cake">
                        <img src="https://i.ibb.co/FnHfyFs/cake.jpg" alt="cake" border="0">
                        <h3>Cakes</h3>
                        </a>
                    </div>
                    <div class="category" class="scroll-link">
                        <a href="#cookie">
                        <img src="https://i.ibb.co/PrFFwjQ/cookie.jpg" alt="cookie" border="0">
                        <h3>Cookies</h3>
                        </a>
                    </div>
                </div>
            </section>
            <section class="ice-cream">
                <h2 class=customfont id="ice-cream">Ice Creams</h2>
                <div class="iceCream-container" >
                    <?php
                        $sql_ice = "SELECT * FROM food WHERE food_type='dessert';";
                        $result = mysqli_query($dbconn,$sql_ice);

                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                $food_name = $row['food_name'];
                                $food_desc = $row['food_desc'];
                                $food_price = $row['food_price'];
                                $food_picture = $row['picture'];

                                echo "<a href=product1.php?f_id=".$row['food_id']." class= 'producti'>
                                <div class='product'>
                                    <img src='$food_picture' alt='$food_name'>
                                    <h3>$food_name</h3>
                                    <p>RM $food_price</p>
                                </div>
				                </a>";
				                
                            }
                        }

                    ?>
                </div>
            </section>
            <section class="cake">
                <h2 class=customfont id="cake">Cakes</h2>
                <div class="cake-container" >
                    <?php
                        $sql_cake = "SELECT * FROM food WHERE food_type='cake';";
                        $result = mysqli_query($dbconn,$sql_cake);

                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                $food_name = $row['food_name'];
                                $food_desc = $row['food_desc'];
                                $food_price = $row['food_price'];
                                $food_picture = $row['picture'];

                                echo "<a href=product1.php?f_id=".$row['food_id']." class= 'producti'>
                                <div class='product'>
                                    <img src='$food_picture' alt='$food_name'>
                                    <h3>$food_name</h3>
                                    <p>RM $food_price</p>
                                </div>
				                </a>";
                            }
                        }

                    ?>
                </div>
            </section>
            <section class="cookie">
                <h2 class=customfont id="cookie">Cookies</h2>
                <div class="cookie-container" >
                    <?php
                        $sql_cookie = "SELECT * FROM food WHERE food_type='cookies';";
                        $result = mysqli_query($dbconn,$sql_cookie);

                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                $food_name = $row['food_name'];
                                $food_desc = $row['food_desc'];
                                $food_price = $row['food_price'];
                                $food_picture = $row['picture'];

                                echo "<a href=product1.php?f_id=".$row['food_id']." class= 'productk'>
                                <div class='product'>
                                    <img src='$food_picture' alt='$food_name'>
                                    <h3>$food_name</h3>
                                    <p>RM $food_price</p>
                                </div>
				                </a>";
                            }
                        }

                    ?>
                </div>
            </section>
        </main>
        <footer>
            <div class="footer-container">
                <p>&copy; 2024 Baka Bakery. All rights reserved.</p>
            </div>
        </footer>

        <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
        </script>
    </body>
    <?php mysqli_close($dbconn); ?>
</html> 

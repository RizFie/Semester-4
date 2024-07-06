<!DOCTYPE html>
<?php
    include("bakadbconn.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="stylesheet" href="singupCSS.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="container">
        <div class="wrapper">
            <h1>Sign Up</h1>
            <form method="post" action="signupProcess.php">
                <div class="input-box">
                    <input type="text" placeholder="name" name="name" required><i class='bx bx-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Password" name="password" required><i class='bx bx-lock-alt'></i>
                </div>
                <div class="input-box">
                    <input type="email" placeholder="Email" name="email" required><i class='bx bx-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Adress" name="adress" required><i class='bx bx-id-card'></i>
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Phone Number" name="phone" required><i class='bx bx-phone'></i>
                </div>
                <div class="btn"><button type="submit">Sign Up</button></div>
            </form>
            <div class="register">
                <p>Already have an account? <a href="login.php"><b>Login here</b></a></p>
            </div>
        </div>
    </div>
</body>
<?php
    mysqli_close($dbconn);
?>
</html>
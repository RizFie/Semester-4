<!DOCTYPE html>
<?php
    session_start();
    include("bakadbconn.php");
?>
<html lang="en">
    
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="loginCSS.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="container">
        <div class="wrapper">
            <h1>Login</h1>
            <form method="post" action="loginProcess.php">
                <div class="types">
                    <label><input type="radio" name="privilege" value="employee">Employee</label>
                    <label><input type="radio" name="privilege" value="customer" checked>Customer</label>
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Username" name="username" required><i class='bx bx-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Password" name="password" required><i class='bx bx-lock-alt'></i>
                </div>
                
                <div class="btn"><button type="submit">login</button></div>
            </form>
            <div class="register">
                <p>Dont have an account yet? <a href="signup.php"><b>Register an account</b></a></p>
            </div>
        </div>
    </div>

</body>
<?php
    mysqli_close($dbconn);
?>
</html>
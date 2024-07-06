<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        function checkEmptyFields()
        {   
            let format = /[!@#$%^&*(),.?":{}|<>]/g;
            let username = document.getElementById("userName").value;
            let fname = document.getElementById("firstName").value;
            let lname = document.getElementById("lastName").value;
            let password = document.getElementById("password").value;
        
            if (!isNaN(fname)) {
                alert("First name should be alphabetic!");
                return false;
            } else if (!isNaN(lname)) {
                alert("Last name should be alphabetic!");
                return false;
            } else if (password.length < 8) {
                alert("Password should be at least 8 characters!");
                return false;
            } else if (age < 13) {
                alert("You must be at least 13 years old to create an account!");
                return false;
            } else if (!password.match(format)) {
                alert("Password must contain at least one special character!");
                return false;
            } else {
                return true;
            }
        }
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Rai Cinemas</title>
    <style>
            <?php include "registerLogin.css" ?>
    </style>
</head>
<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">
        
        <div class="signup">
            <form id="form" name="form" method="post" action="register1.php"> 
                <label for="chk" aria-hidden="true">Register</label>
                <div class="text">
                <label for = "userName"> Username:</label>
                <input type="text" id="userName" name="userName" placeholder="user101" required>
                <label for = "firstName"> First Name:</label>
                <input type="text" id="firstName" name="firstName" placeholder="Abu" required>
                <label for = "lastName"> Last Name:</label>
                <input type="text" id="lastName" name="lastName" placeholder="Bakar" required>
                <label for = "age"> Age:</label>
                <input type="number" id="age" name="age" placeholder="20" required>
                <label for = "email"> Email:</label>
                <input type="text" id="email" name="email" placeholder="abubakar@gmail.com" required>
                <label for="password"> Password:</label>
                <input type="password" id="password" name="password" required>  
                <label class="instructions">Must be at least 8 characters and contain at least one special characters.</label>
                </div>
                <div class="wrap">
                    <button type="submit" name="Submit" value="Submit" onClick="return checkEmptyFields()">Register</button>
                </div>
            </form>
        </div>
        
        <div class="login">
            <form name="formLogin " method="post" action="login0.php">
                <label for="chk" aria-hidden="true">Login</label>
                <div class="text">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="dragonslayer9000" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                </div>
                <div class="wrap">
                    <button type="submit" name="Submit">Log In</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

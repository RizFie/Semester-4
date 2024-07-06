<!DOCTYPE html>
<?php
    include("bakadbconn.php");
    session_start();

    if($_SESSION['privilege'] != "admin"){/*make sure no unauthorized user access this page*/
        die("<script>alert('Unauthorized User')
            ;window.location.href='login.php';</script>"); 
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
            <?php include('addEmployeeCSS.css'); ?> 
    </style>
</head>
<body>
    <header>
        <h1>Admin - Add Employee</h1>
    </header>
    <form action="addEmployeeProcess.php" method="post">
        <table>
            <tr>
                <td>emp_name</td>
                <td>:</td>
                <td><input type="text" name="e_name" required></td>
            </tr>
            <tr>
                <td>emp_email</td>
                <td>:</td>
                <td><input type="text" name="e_email" required></td>
            </tr>
            <tr>
                <td>emp_password</td>
                <td>:</td>
                <td><input type="password" name="e_password" required></td>
            </tr>
            <tr>
                <td>emp_phone</td>
                <td>:</td>
                <td><input type="text" name="e_phone" required></td>
            </tr>
        </table>
        <button type="submit" value="submit">submit</button>
    </form>
    <div class="cancelbut">
    <a href='admin.php'>cancel</a><br>
    </div>
</body>
<?php
    mysqli_close($dbconn);
?>
</html>
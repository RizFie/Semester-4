<!DOCTYPE html>
<?php
    session_start();
    include("bakadbconn.php");

    if($_SESSION['privilege'] != "customer"){/*make sure no unauthorized user access this page*/
        die("<script>alert('You have not login yet. Lets do that now!!')
            ;window.location.href='login.php';</script>");
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer Detail</title>
</head>
<body>
    <div class="wrapper">
        <h1><!--Customer name--></h1>
        <div class="container">
            <div class="wrapper">
                <!--Also isi form action ni-->
                <form action="updateCustomerProcess.php" method="post">
                    <table>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><input type="text" name="c_name" required></td>
                        </tr>
                        <tr>
                            <td>email</td>
                            <td>:</td>
                            <td><input type="text" name="c_email" required></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td><input type="text" name="c_address" required></td>
                        </tr>
                        <tr>
                            <td>Phone number</td>
                            <td>:</td>
                            <td><input type="text" name="c_phone" required></td>
                        </tr>
                    </table>
                    <div class="btn"><button type="submit" value="submit">update</button></div>
                </form>
            </div>
            <div class="a">
                <!--letak href dia tuk back nanti -->
                <a href=''>cancel</a><br>
            </div>
        </div>
    </div>
</body>
<?php
    mysqli_close($dbconn);
?>
</html>
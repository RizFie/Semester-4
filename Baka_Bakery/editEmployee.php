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
    <title>Edit Employee</title>
    <style>
            <?php include('editEmployeeCSS.css'); ?> 
    </style>
</head>
<body>
    <header>
    <h1>Update Employee</h1>
    </header>
    <form action="upDelEmployee.php" method="post">
        <?php
            $emp_id = $_REQUEST['e_id'];
            $sql = "SELECT * FROM employee WHERE emp_id = '$emp_id';";
            $query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));
            $row = mysqli_num_rows($query);
        
            if($row == 0){
                echo "No record found";
            }
            else{
                $r = mysqli_fetch_assoc($query);
                $emp_name = $r['emp_name'];
                $emp_email = $r['emp_email'];
                $emp_password = $r['emp_password'];
                $emp_phone = $r['emp_phone']; 
            }

            $_SESSION['e_id'] = $emp_id;
        ?>
        <table>
        <tr>
                <td>emp_id</td>
                <td>:</td>
                <td><?php echo $emp_id; ?></td>
            </tr>
            <tr>
                <td>emp_name</td>
                <td>:</td>
                <td><input type="text" name="e_name" value="<?php echo $emp_name; ?>"></td>
            </tr>
            <tr>
                <td>emp_email</td>
                <td>:</td>
                <td><input type="text" name="e_email" value="<?php echo $emp_email; ?>"></td>
            </tr>
            <tr>
                <td>emp_phone</td>
                <td>:</td>
                <td><input type="text" name="e_phone" value="<?php echo $emp_phone; ?>"></td>
            </tr>
        </table>
        <input type="submit" name = "update" value = "Update">
        <input type="submit" name = "delete" value = "Delete">
    </form>
    <div class= cancelbut>
    <a href='admin.php'>cancel</a><br>
    </div>
</body>
<?php
    mysqli_close($dbconn);
?>
</html>
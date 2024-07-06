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
    <title>List of Employee</title>
    <link rel="stylesheet" href="viewEmployeeCSS.css">
</head>
<body>
    <table border="1">
        <tr>
            <th>Employee ID</th>
            <th>Employee name</th>
            <th>Employee email</th>
            <th>Employee phone</th>
            <th>Option</th>
        </tr>
        <?php
            $sql = "select * from employee;";
            $query = mysqli_query($dbconn, $sql) or die ("Error :". mysqli_error($dbconn));
            $r = mysqli_num_rows($query);

            while($row = mysqli_fetch_array($query)){
                echo "<tr>";
                echo "<td>". $row['emp_id'] ."</td>";
                echo "<td>". $row['emp_name'] ."</td>";
                echo "<td>". $row['emp_email'] ."</td>";
                echo "<td>". $row['emp_phone'] ."</td>";
                echo "<td><a href='editEmployee.php?e_id=".$row["emp_id"]."'>Edit</a></td>";
                echo "<tr>";
            }
        ?>
    </table>
    <a href='addEmployee.php'>add new employee</a><br>
        <a href='admin.php'>cancel</a><br>
</body>
<?php
    mysqli_close($dbconn);
?>
</html>
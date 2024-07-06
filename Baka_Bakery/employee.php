<!DOCTYPE html>
<?php
	
    include("bakadbconn.php");
    session_start();
    
    if($_SESSION['privilege'] != "employee"){/*make sure no unauthorized user access this page*/
        die("<script>alert('Unauthorized User')
            ;window.location.href='login.php';</script>"); 
    }
    $employee = $_SESSION['emp_id']
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Page</title>
    <!-- <link rel="stylesheet" href="employeeCSS.css"> -->
    <style>
        <?php include('employeeCSS.css');
         include('logout.css');?>
    </style>
</head>
<body>
    <h1>Welcome, this is the Employee Page<br><button class="btnLogOut" onClick='confirmation()'>Log Out</button></h1>
    <div class="order-stat">
        <h2>Order Status</h2>
        <div class="status">
            <ul>
                <li>Pending</li>
                <li>Complete</li>
                <li>Cancelled</li>
            </ul>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="pending-stat">
            <h3>Pending</h3>
            <table border="1">
                <tr>
                    <td>Order ID</td>
                    <td>Customer ID</td>
                    <td>Food ID</td>
                    <td>Quantity</td>
                    <td>Employee ID</td>
                    <td>Status</td>
                    <!--Untuk update, refer sini: https://docs.google.com/presentation/d/1HNhDIzOMOvb3IPY9SVcXha6MLLyjXydp/edit?usp=sharing&ouid=115591133717528043506&rtpof=true&sd=true-->
                    <th>Update</th>
                    <?php
                    $sql = "select * from food_order where ord_status = 'Pending' and emp_id = '$employee' ;";
                    $query = mysqli_query($dbconn, $sql) or die ("Error :". mysqli_error($dbconn));
                    $r = mysqli_num_rows($query);

                    while($row = mysqli_fetch_array($query)){
                        echo "<tr>";
                        echo "<td>". $row['ord_id'] ."</td>";
                        echo "<td>". $row['cust_id'] ."</td>";
                        echo "<td>". $row['food_id'] ."</td>";
                        echo "<td>". $row['qty'] ."</td>";
                        echo "<td>". $row['emp_id'] ."</td>";
                        echo "<td>". $row['ord_status'] ."</td>";
                        echo"<td><a href='editStatus.php?o_code=".$row["ord_id"]."'>Edit</a></td>";
                        echo "<tr>";
                    }
                    ?>
                </tr>
            </table>
        </div>
        <div class="complete-stat">
            <h3>Complete</h3>
            <table border="1">
                <tr>
                    <td>Order ID</td>
                    <td>Customer ID</td>
                    <td>Food ID</td>
                    <td>Quantity</td>
                    <td>Employee ID</td>
                    <td>Status</td>
                    <th>Update</th>
                    <?php
                    $sql = "select * from food_order where ord_status = 'Complete' and emp_id = '$employee';";
                    $query = mysqli_query($dbconn, $sql) or die ("Error :". mysqli_error($dbconn));
                    $r = mysqli_num_rows($query);

                    while($row = mysqli_fetch_array($query)){
                        echo "<tr>";
                        echo "<td>". $row['ord_id'] ."</td>";
                        echo "<td>". $row['cust_id'] ."</td>";
                        echo "<td>". $row['food_id'] ."</td>";
                        echo "<td>". $row['qty'] ."</td>";
                        echo "<td>". $row['emp_id'] ."</td>";
                        echo "<td>". $row['ord_status'] ."</td>";
                        echo"<td><a href='editStatus.php?o_code=".$row["ord_id"]."'>Edit</a></td>";
                        echo "<tr>";
                    }
                    ?>
                </tr>
            </table>
        </div>
        <div class="complete-stat">
            <h3>Cancelled</h3>
            <table border="1">
                <tr>
                    <td>Order ID</td>
                    <td>Customer ID</td>
                    <td>Food ID</td>
                    <td>Quantity</td>
                    <td>Employee ID</td>
                    <td>Status</td>
                    <th>Update</th>
                    <?php
                    $sql = "select * from food_order where ord_status = 'Cancelled' and emp_id = '$employee';";
                    $query = mysqli_query($dbconn, $sql) or die ("Error :". mysqli_error($dbconn));
                    $r = mysqli_num_rows($query);

                    while($row = mysqli_fetch_array($query)){
                        echo "<tr>";
                        echo "<td>". $row['ord_id'] ."</td>";
                        echo "<td>". $row['cust_id'] ."</td>";
                        echo "<td>". $row['food_id'] ."</td>";
                        echo "<td>". $row['qty'] ."</td>";
                        echo "<td>". $row['emp_id'] ."</td>";
                        echo "<td>". $row['ord_status'] ."</td>";
                        echo"<td><a href='editStatus.php?o_code=".$row['ord_id']."' >Edit</a></td>";
                        echo "<tr>";
                    }
                    ?>
                </tr>
            </table>
        </div>
    </div>
    <!---<h2>Food details</h2> ++++++++++++++++++++++++ FOOD DETAILS ++++++++++++++++++++++++++++ 
    
	<div>
        <h2>Update order status</h2>
        <div>
            <form action="updateOrderProcess.php" method="post">
            <table class="order">
                <tr>
                    <td>
                        Order ID
                    </td>
                    <td>:</td>
                    <td>
                        <input type="text" name="ord_id" id="o_id" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        Order Status
                    </td>
                    <td>:</td>
                    <td>
                        <input type="text" name="ord_status" id="o_stat" required>
                    </td>
                </tr>
            </table>
            <button type="submit" value="orders">Update</button>
            </form>
        </div>
    </div>
	-->
</body>
<?php
    mysqli_close($dbconn);
?>
</html>
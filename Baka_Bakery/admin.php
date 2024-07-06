<!DOCTYPE html>
<?php
    include("bakadbconn.php");
    session_start();
    
    if($_SESSION['privilege'] != "admin"){/*make sure no unauthorized user access this page*/
        die("<script>alert('Unauthorized User')
            ;window.location.href='login.php';</script>"); 
    }
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
    <title>Admin Page</title>
    <!--<link rel="stylesheet" href="adminCSS.css">-->
    <style>
            <?php include('adminCSS.css');
            include('logout.css'); ?> 
        </style>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
</head>
<body>
    <h1>Welcome, this is the Admin Page</h1>
    <a class="btnLogOut" onClick = 'confirmation()'>Logout</a>
    <h2>Food details</h2> <!-- ++++++++++++++++++++++++ FOOD DETAILS ++++++++++++++++++++++++++++ -->
    <div class="food-container">
        <form action="food.php" method="post">
            <table border="1" class="food">
                <tr>
                    <th>Food ID</th>
                    <th>Food name</th>
                    <th>Food description</th>
                    <th>Food price</th>
                    <th>Food type</th>
                    <th>Picture link</th>
                </tr>
                <?php
                    $sql = "select * from food;";
                    $query = mysqli_query($dbconn, $sql) or die ("Error :". mysqli_error($dbconn));
                    $r = mysqli_num_rows($query);

                    while($row = mysqli_fetch_array($query)){
                        echo "<tr>";
                        echo "<td>". $row['food_id'] ."</td>";
                        echo "<td>". $row['food_name'] ."</td>";
                        echo "<td>". $row['food_desc'] ."</td>";
                        echo "<td>". $row['food_price'] ."</td>";
                        echo "<td>". $row['food_type'] ."</td>";
                        echo "<td>". $row['picture'] ."</td>";
                        echo "<tr>";
                    }
                ?>

            </table>
            <?php
                if($r == 0){
                    echo "No record";
                } 
            ?>
            <div class="btn">
                <button type="submit" value="foods">Update Food</button>
            </div>
        </form>
    </div>
    <!-- ################################################# UPDATE ORDER STATUS #######################################################
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
    --->
    <h2>Employee details</h2> <!-- ++++++++++++++++++++++++ EMPLOYEE DETAILS ++++++++++++++++++++++++++++ -->
    <div class="details-container">
        <form action="viewEmployee.php" method="post">
            <table border="1"><!--Hariz deleted class="food" for table-->
                <tr>
                    <th>Employee ID</th>
                    <th>Employee name</th>
                    <th>Employee email</th>
                    <th>Employee phone</th>
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
                        echo "<tr>";
                    }
                ?>

            </table>
            <?php
                if($r == 0){
                    echo "No record";
                } 
            ?>
            <div class="btn">
                <button type="submit" value="employee">Update Employee</button>
            </div>
        </form>
    </div>
    <div class="calc-container">
        <div class="calc-wrapper">
            <h2>Total Sales</h2> <!-- ++++++++++++++++++++++++ TOTAL SALES ++++++++++++++++++++++++++++ -->
            <table class="sales" border="1">
                <tr>
                    <th>Payment ID</th>
                    <th>Order ID</th>

                    <th>Sale<br>(qty x price)</th>
                </tr>
                <?php
                    $sql = "select r.pay_id, o.ord_id, (f.food_price * o.qty) as sales  from food_order o
                                join receipt r on r.ord_id = o.ord_id
                                join food f on f.food_id = o.food_id;";
                    $query = mysqli_query($dbconn, $sql) or die ("Error :". mysqli_error($dbconn));
                    $r = mysqli_num_rows($query);

                    while($row = mysqli_fetch_array($query)){
                        echo "<tr>";
                        echo "<td>". $row['pay_id'] ."</td>";
                        echo "<td>". $row['ord_id'] ."</td>";
                        echo "<td>". $row['sales'] ."</td>";
                        echo "<tr>";
                    }
                ?>
                <!--Most bottom row-->
                <tr>
                    <td colspan="2">Total</td>
                    <?php
                        $sql = "select sum(f.food_price * o.qty) as sales  from food_order o
                                    join receipt r on r.ord_id = o.ord_id
                                    join food f on f.food_id = o.food_id;";
                        $query = mysqli_query($dbconn, $sql) or die ("Error :". mysqli_error($dbconn));

                        $row = mysqli_fetch_array($query);
                        echo "<td>". $row['sales'] ."</td>";
                    ?>
                </tr>
            </table>
        </div>
    </div>
    <div>
        <div class="ViewOrder">
            <h2>Order Details</h2> <!-- ++++++++++++++++++++++++ ORDER DETAIL ++++++++++++++++++++++++++++ -->
            <!--Tarik data dri table food_order-->
            <!--refer sini: https://docs.google.com/presentation/d/1oG7xQLYF5JqRdEuNAhqxMcvNx7-KkHMZ/edit?usp=drive_link&ouid=115591133717528043506&rtpof=true&sd=true-->
            <table class="details" border="1">
                <tr>
                    <th>Order ID</th>
                    <th>Customer ID</th>
                    <th>Customer Name</th>
                    <th>Food ID</th>
                    <th>Food Name</th>
                    <th>Quantity</th>
                    <th>Order Status</th>
                    <th>Employee ID</th>
                </tr>
                <?php
                    $sql = "select o.ord_id, c.cust_id, c.cust_name, f.food_id, f.food_name, o.qty, o.ord_status, coalesce(o.emp_id, 'Unassigned') as emp_id from food_order o
                                join food f on o.food_id = f.food_id
                                join customer c on o.cust_id = c.cust_id;";
                    $query = mysqli_query($dbconn, $sql) or die ("Error :". mysqli_error($dbconn));
                    $r = mysqli_num_rows($query);

                    while($row = mysqli_fetch_array($query)){
                        echo "<tr>";
                        echo "<td>". $row['ord_id'] ."</td>";
                        echo "<td>". $row['cust_id'] ."</td>";
                        echo "<td>". $row['cust_name'] ."</td>";
                        echo "<td>". $row['food_id'] ."</td>";
                        echo "<td>". $row['food_name'] ."</td>";
                        echo "<td>". $row['qty'] ."</td>";
                        echo "<td>". $row['ord_status'] ."</td>";
                        echo "<td>". $row['emp_id'] ."</td>";
                        echo "<tr>";
                    }
                ?>
            </table>
            <?php
                if($r == 0){
                    echo "No record";
                }
            ?>
        </div>
        <div>
        <h2>Assign an Employee to an Order</h2> <!-- ######################## ASSIGN AN EMPLOYEE TO AN ORDER-->
        <div class="emp-container">
        <table class="details" border="1">
                <tr>
                    <th>Order ID</th>
                    <th>Customer ID</th>
                    <th>Food ID</th>
                    <th>Quantity</th>
                    <th>Order Status</th>
                    <th>Employee ID</th>
                </tr>
                <?php
                    $sql = "select * from food_order where emp_id is null;";
                    $query = mysqli_query($dbconn, $sql) or die ("Error :". mysqli_error($dbconn));
                    $r = mysqli_num_rows($query);

                    while($row = mysqli_fetch_array($query)){
                        echo "<tr>";
                        echo "<td>". $row['ord_id'] ."</td>";
                        echo "<td>". $row['cust_id'] ."</td>";
                        echo "<td>". $row['food_id'] ."</td>";
                        echo "<td>". $row['qty'] ."</td>";
                        echo "<td>". $row['ord_status'] ."</td>";
                        echo "<td>Unassigned</td>";
                        echo "<tr>";
                    }
                ?>
            </table>
            <form action="assignEmployee.php" method="post">
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
                        Employee ID
                    </td>
                    <td>:</td>
                    <td>
                        <input type="text" name="emp_id" id="o_stat" required>
                    </td>
                </tr>
            </table>
            <button type="submit" value="assign">Update</button>
            </form>
        </div>
    </div>
    </div>
</body>
<?php
    mysqli_close($dbconn);
?>
</html>
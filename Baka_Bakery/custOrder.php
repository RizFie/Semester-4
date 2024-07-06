<!DOCTYPE html>
<?php
    include("bakadbconn.php");
    session_start();
    
    if($_SESSION['privilege'] != "customer"){/*make sure no unauthorized user access this page*/
        die("<script>alert('Unauthorized User')
            ;window.location.href='login.php';</script>"); 
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Page</title>
    <link rel="stylesheet" href="custOrderCSS.css">
</head>
<body>
    <div class="header">
        <h1><?php echo "Hi ". $_SESSION['cust_name']."" ?></h1>
        <h2>This is your order</h2>
    </div>
    
    <!--Dptkan order details based on cust id-->
    <div class="wrapper">
        <table border="1">
            <tr>
                <th>Food Picture</th>
                <th>Order ID</th>
                <th>Food ID</th>
                <th>Quantity</th>
                <th>Order Status</th>
                <th>Option</th>
                    <?php
                    $sql = "SELECT food_order.*, food.picture 
                    FROM food_order 
                    JOIN food ON food_order.food_id = food.food_id 
                    WHERE food_order.cust_id = '".$_SESSION['cust_id']."' ";
                    $query = mysqli_query($dbconn, $sql) or die ("Error :". mysqli_error($dbconn));
                    $r = mysqli_num_rows($query);
                    while($row = mysqli_fetch_array($query)){
                        echo "<tr>";
                        echo "<td align='center'><img src='" . $row['picture'] . "' alt='Food Picture' /></td>";
                        echo "<td>". $row['ord_id'] ."</td>";
                        echo "<td>". $row['food_id'] ."</td>";
                        echo "<td>". $row['qty'] ."</td>";
                        echo "<td>". $row['ord_status'] ."</td>";
                        if($row['ord_status'] == 'Pending'||$row['ord_status'] == 'pending'){
                            echo "<td><a href='cancelOrder.php?ord_id=".$row['ord_id']."'>Cancel</a></td>";
                        }
                        else{
                            echo "<td>-</td>";
                        }
                        echo "<tr>";
                    }
                    ?>
                    
            </tr>
            
        </table>
        
        
    </div align-items: center>
    
    <div class="prev"><a href='mainPage.php'>Back</a></div>
</body>
<?php 
    mysqli_close($dbconn);
?>
</html>
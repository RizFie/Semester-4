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
    <!-- <link rel="stylesheet" href="foodCSS.css"> -->
    <style>
        <?php include('foodCSS.css'); ?>
    </style>
</head>
<body>
    <header>
        <div class="header">
            <h1>Product Details</h1>
        </div>
    </header>
    <div class="wrapper">
        <table border="1">
            <tr>
                <th>Food ID</th>
                <th>Food name</th>
                <th>Food description</th>
                <th>Food price</th>
                <th>Food type</th>
                <th>Picture link</th>
                <th>Option</th>
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
                    echo "<td><a href='editFood.php?f_id=".$row["food_id"]."'>Edit</a></td>";
                    echo "<tr>";
                }
            ?>
        </table>
    </div>
    <div class="addfud">
        <a href='addFood.php'><button>add new food</button></a><br>
    </div>
    <div class="back">
        <a href='admin.php'><button>cancel</button></a><br>
    </div>  
</body>
<?php
    mysqli_close($dbconn);
?>
</html>
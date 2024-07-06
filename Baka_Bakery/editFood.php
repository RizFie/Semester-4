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
    <title>Edit Food</title>
    <!-- <link rel="stylesheet" href="editFoodCSS.css"> -->
    <style>
        <?php include('editFoodCSS.css') ?>
    </style>
</head>
<body>
    <h1>Update Food</h1>
    <form action="upDelFood.php" method="post">
        <?php
            $food_id = $_REQUEST['f_id'];
            $sql = "SELECT * FROM food WHERE food_id= '$food_id';";
            $query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));
            $row = mysqli_num_rows($query);
        
            if($row == 0){
                echo "No record found";
            }
            else{
                $r = mysqli_fetch_assoc($query);
                $food_name = $r['food_name'];
                $food_desc = $r['food_desc'];
                $food_price = $r['food_price'];
                $food_type = $r['food_type'];
                $picture = $r['picture'];
            }

            $_SESSION['f_id'] = $food_id;
        ?>
        <table>
            <tr>
                <td>food_id</td>
                <td>:</td>
                <td><?php echo $food_id; ?></td>
            </tr>
            <tr>
                <td>food_name</td>
                <td>:</td>
                <td><input type="text" name="f_name" value="<?php echo $food_name; ?>"></td>
            </tr>
            <tr>
                <td>food_desc</td>
                <td>:</td>
                <td><input type="text" name="f_desc" value="<?php echo $food_desc; ?>"></td>
            </tr>
            <tr>
                <td>food_price</td>
                <td>:</td>
                <td><input type="text" name="f_price" value="<?php echo $food_price; ?>"></td>
            </tr>
            <tr>
                <td>food_type</td>
                <td>:</td>
                <td><input type="text" name="f_type" value="<?php echo $food_type; ?>"></td>
            </tr>
            <tr>
                <td>picture</td>
                <td>:</td>
                <td><input type="text" name="pic" value="<?php echo $picture; ?>"></td>
            </tr>
        </table>
        <input type="submit" name = "update" value = "Update">
        <input type="submit" name = "delete" value = "Delete">
    </form>
    <a href='admin.php'>cancel</a><br>
</body>
<?php
    mysqli_close($dbconn);
?>
</html>
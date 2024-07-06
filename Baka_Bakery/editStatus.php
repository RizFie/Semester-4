<!DOCTYPE html>
<?php
    include("bakadbconn.php");
    session_start();
    
    if($_SESSION['privilege'] != "employee"){/*make sure no unauthorized user access this page*/
        die("<script>alert('Unauthorized User')
            ;window.location.href='login.php';</script>"); 
    }
    
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status Page</title>
    <!-- <link rel="stylesheet" href="editStatusCSS.css"> -->
    <style>
        <?php include('editStatusCSS.css'); ?>
    </style>
</head>
<body>
<h2>Status detail</h2> <!-- ++++++++++++++++++++++++ FOOD DETAILS ++++++++++++++++++++++++++++ -->
    <div class="container">
        <div>
            <form action="updateOrderProcess.php" method="post">
            <?php
                $ord_code = $_REQUEST['o_code'];
                $sql = "SELECT * from food_order where ord_id = '$ord_code';";
                $query = mysqli_query($dbconn, $sql) or die ("Error :". mysqli_error($dbconn));
                $row = mysqli_fetch_assoc($query);
            
                if($row == 0){
                    echo "No record found";
                }
                
                $_SESSION['o_code'] = $ord_code;
            ?>
            <table border="1" class="order">
                <tr>
                    <td>
                        Order ID
                    </td>
                    <td>:</td>
                    <td><?php echo $ord_code; ?></td>
                </tr>
                <tr>
                    <td>
                        Order Status
                    </td>
                    <td>:</td>
                    <td>
                        <!--<input type="text" name="ord_status"  id="o_stat" required>-->
						<label><input type="radio" name="ord_status" id="o_stat" value="Pending" checked    >Pending</label>
						<label><input type="radio" name="ord_status" id="o_stat" value="Complete">Complete</label>
						<label><input type="radio" name="ord_status" id="o_stat" value="Cancelled">Cancelled</label>

						
                    </td>
                </tr>
            </table>
            <button class="btn" type="submit" value="orders">Update</button>
            </form>
        </div>
    </div>
    <div class="cancel"><a href='employee.php'>cancel</a><br></div>
</body>
</html>
<?php
    include("bakadbconn.php");
    session_start();
?>

<?php
    
    if($_SESSION['privilege'] != "customer"){/*make sure no unauthorized user access this page*/
        die("<script>alert('Unauthorized User')
            ;window.location.href='login.php';</script>"); 
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $ord_id = $_GET['o_id'];
        $sql = "Update food_order set ord_status = 'Cancelled' where ord_id = '$ord_id'";
        $query = mysqli_query($dbconn, $sql) or die ("Error :". mysqli_error($dbconn));

        $sql = "delete from receipt where ord_id = '$ord_id'";
        $query = mysqli_query($dbconn, $sql) or die ("Error :". mysqli_error($dbconn));
        die("<script>alert('Order Canceled!')
            ;window.location.href='custOrder.php';</script>");
    }
    else{
        die("<script>alert('Order Canceled!')
         ;window.location.href='custOrder.php';</script>");
    }
?>
<?php
    mysqli_close($dbconn);
?>
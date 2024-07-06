<?php
    include("bakadbconn.php");
    session_start();
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $ord_id = $_SESSION['o_code'];
        $ord_status = $_POST['ord_status'];

        $sql = "update food_order
                set ord_status = '". $ord_status ."'
                where ord_id = '". $ord_id ."';";
        mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));
        mysqli_close($dbconn);

        die("<script>alert('Update successfully')
        ;window.location.href='employee.php';</script>");
    }
    else{
        header("Location: employee.php");
    }

    mysqli_close($dbconn);
?>
<?php
    include("bakadbconn.php");
    session_start();

    if($_SESSION['privilege'] != "admin"){/*make sure no unauthorized user access this page*/
        die("<script>alert('Unauthorized User')
            ;window.location.href='login.php';</script>"); 
    }
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $ord_id = htmlspecialchars($_POST['ord_id']);
        $emp_id = htmlspecialchars($_POST['emp_id']);
        /*Check the existing employee id and order id*/
        $sql = "Select * from food_order where ord_id = '$ord_id'";
        $query = mysqli_query($dbconn, $sql) or die ("Error :". mysqli_error($dbconn));
        $row = mysqli_num_rows($query);
        if($ord_id == 0){
            die("<script>alert('Order doesn't not exist')
            ;window.location.href='admin.php';</script>");
        }
        $sql = "Select * from employee where emp_id = '$emp_id'";
        $query = mysqli_query($dbconn, $sql) or die ("Error :". mysqli_error($dbconn));
        $row = mysqli_num_rows($query);
        if($emp_id == 0){
            die("<script>alert('Employee doesn't not exist')
            ;window.location.href='admin.php';</script>");
        }
        /*assign the employee to order*/
        $sql = "update food_order set emp_id = '$emp_id' where ord_id = '$ord_id';";
        $query = mysqli_query($dbconn, $sql) or die ("Error :". mysqli_error($dbconn));
        die("<script>alert('Employee is succesfully assigned')
            ;window.location.href='admin.php';</script>");
    }else{
        header("Location: admin.php");
    }
    mysqli_close($dbconn);
?>
<?php
    session_start();
    include("bakadbconn.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        /*capture data from post and sesstion */
        $cust_id = $_SESSION['cust_id'];
        $cust_name = $_POST['c_name'];
        $cust_email = $_POST['c_email'];
        $cust_address = $_POST['c_address'];
        $cust_phone = $_POST['c_phone'];

        //check id email is empty
        if(empty($cust_email)){
            die("<script>alert('The email field is empty!!')
            ;window.location.href='updateCustDetail.php';</script>");
        }

        //check if email already exist in database
        $sql = "select * from customer where cust_email = '$cust_email';";
        $query = mysqli_query($dbconn, $sql) or die ("Error :". mysqli_error($dbconn));
        $row = mysqli_num_rows($query);
        $r = mysqli_fetch_assoc($query);

        //check if email already exist in database and if the email was change
        if($row != 0 && $cust_email != $r['cust_email']){
            die("<script>alert('This email already existed')
            ;window.location.href='updateCustDetail.php';</script>");
        }

        //update data
        $sql = "update customer set cust_name = '$cust_name', cust_email = '$cust_email', cust_address = '$cust_address', cust_phone = '$cust_phone'
                where cust_id = '$cust_id';";
        $query = mysqli_query($dbconn, $sql) or die ("Error :". mysqli_error($dbconn));
    }
    else{
        header("Location: updateCustDetail.php");
    }
    mysqli_close($dbconn);
?>
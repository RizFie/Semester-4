<?php 
    session_start();
    include("bakadbconn.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $ord_id = htmlspecialchars($_POST['ord_id']);
        $bank_id = htmlspecialchars($_POST['bank_id']);
        $rep_date = (string)date("y-m-d");
        $pay_id = "";

        do{/*generate pay_id */
            $id = (string)rand(1,99999);
        
            while(strlen($id) < 5){
                $id = "0".$id;
            }
            $id = "P".$id;
            
            $sql = "select * from receipt where pay_id = '$id'";
            $query = mysqli_query($dbconn, $sql) or die("Error :". mysqli_error($dbconn));
            $row = mysqli_num_rows($query);

            $pay_id = ($row == 0 ? $id : "");
        }while($row != 0);

        $sql = "insert into receipt (pay_id, ord_id, bank_id, rep_date) values
                ('$pay_id', '$ord_id','$bank_id', '$rep_date')";
        mysqli_query($dbconn, $sql) or die("Error :". mysqli_error($dbconn));
        die("<script>alert('Payment has been made!!')
            ;window.location.href='mainPage.php';</script>");
    }
    else{
        header("Location: mainPage.php");
    }

    mysqli_close($dbconn);
?>
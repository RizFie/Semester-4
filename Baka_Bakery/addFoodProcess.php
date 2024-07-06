<?php
    include("bakadbconn.php");
    session_start();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        /*capture value from post */
        $food_id = htmlspecialchars($_POST['f_id']);
        $food_name = htmlspecialchars($_POST['f_name']);
        $food_desc = htmlspecialchars($_POST['f_desc']);
        $food_price = htmlspecialchars($_POST['f_price']);
        $food_type = htmlspecialchars($_POST['f_type']);
        $picture = htmlspecialchars($_POST['pic']);

        /*check if food_id is null. if yes, go back to addFood.php */
        if(empty($food_id)){
            die("<script>alert('Primary key is NULL')
            ;window.location.href='addFood.php';</script>");
        }

        $sql = "select * from food where food_id = '$food_id';";
        $query = mysqli_query($dbconn, $sql) or die("Error :". mysqli_error($dbconn));
        $row = mysqli_num_rows($query);

        if($row != 0){
            die("<script>alert('Primary key already exist')
            ;window.location.href='addFood.php';</script>");
        }

        $sql = "select * from food where food_name = '$food_name';";
        $query = mysqli_query($dbconn, $sql) or die("Error :". mysqli_error($dbconn));
        $row = mysqli_num_rows($query);

        if($row != 0){
            die("<script>alert('Food name already exist')
            ;window.location.href='addFood.php';</script>");
        }


        $sql = "insert into food values ('$food_id', '$food_name','$food_desc', '$food_price', '$picture', '$food_type')";
        mysqli_query($dbconn, $sql) or die("Error :". mysqli_error($dbconn));
        die("<script>alert('Data inserted successfully')
            ;window.location.href='admin.php';</script>");
    }
    else{
        header("Location: admin.php");
    }
    mysqli_close($dbconn);

?>
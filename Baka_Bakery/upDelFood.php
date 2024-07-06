<?php
    include("bakadbconn.php");
    session_start();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['update'])){
            $food_id = $_SESSION['f_id'];
            $food_name = htmlspecialchars($_POST['f_name']);
            $food_desc = htmlspecialchars($_POST['f_desc']);
            $food_price = htmlspecialchars($_POST['f_price']);
            $food_type = htmlspecialchars($_POST['f_type']);
            $picture = htmlspecialchars($_POST['pic']);

            $sql = "update food set food_name = '$food_name', food_desc = '$food_desc',
                    food_price = '$food_price', food_type = '$food_type', picture = '$picture'
                    where food_id = '$food_id'";
            $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
            die("<script>alert('Update successfully')
            ;window.location.href='admin.php';</script>");
        }
        elseif(isset($_POST['delete'])){
            $food_id = $_SESSION['f_id'];

            $sql = "delete from food where food_id = '$food_id'";
            $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
            die("<script>alert('Delete successfully')
            ;window.location.href='admin.php';</script>");
        }
        else{
            die("<script>alert('No changes has been made')
            ;window.location.href='admin.php';</script>");
        }
    }
    else{
        header("location: admin.php");
    }
    mysqli_close($dbconn);

?>
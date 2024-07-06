<?php
    include("bakadbconn.php");
    session_start();

    if($_SESSION['privilege'] != "admin"){/*make sure no unauthorized user access this page*/
        die("<script>alert('Unauthorized User')
            ;window.location.href='login.php';</script>"); 
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['update'])){
            $emp_id = $_SESSION['e_id'];
            $emp_name = htmlspecialchars($_POST['e_name']);
            $emp_email = htmlspecialchars($_POST['e_email']);
            $emp_phone = htmlspecialchars($_POST['e_phone']);

            if(!filter_var($emp_email, FILTER_VALIDATE_EMAIL)){
                die("<script>alert('Invalid email')
                    ;window.location.href='admin.php';</script>");
            }

            $sql = "select * from employee where emp_email = '$emp_email'";
            $query = mysqli_query($dbconn, $sql) or die("Error :". mysqli_error($dbconn));
            $row = mysqli_num_rows($query);
            $r = mysqli_fetch_assoc($query);

            //check if the email already exist if the admin change the email
            if($row != 0 && $emp_email != $r['emp_email']){
                die("<script>alert('This email already existed')
                ;window.location.href='editEmployee.php';</script>");
            }

            //update employee
            $sql = "update employee set emp_name = '$emp_name', emp_email = '$emp_email',
                    emp_phone = '$emp_phone'
                    where emp_id = '$emp_id';";
            $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
            die("<script>alert('Update successfully')
            ;window.location.href='admin.php';</script>");
        }
        elseif(isset($_POST['delete'])){
            $emp_id = $_SESSION['e_id'];

            $sql = "delete from employee where emp_id = '$emp_id'";
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
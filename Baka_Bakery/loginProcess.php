<?php
    session_start();
    include("bakadbconn.php");
    
    /*check if user submit form */
    if($_SERVER['REQUEST_METHOD'] == "POST"){
         /*capture var from post */
        $email = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        /*check if email is empty, if yes, return to login */
        if(empty($email)){
            exit();
            header('Location: login.php');
        }

        if($_POST['privilege'] == "customer"){
            /*searching user*/
            $sql = "select * from customer where cust_email = '". $email ."';";
            $query = mysqli_query($dbconn, $sql) or die ("Error :". mysqli_error($dbconn));
            $row = mysqli_fetch_assoc($query);

            if(password_verify($password, $row['cust_password'])){
                $_SESSION['privilege'] = "customer";
                $_SESSION['cust_id'] = $row['cust_id'];
                $_SESSION['cust_name'] = $row['cust_name'];
                header('Location: mainPage.php');
            }
            else{
                die("<script>alert('Invalid email or password.')
                ;window.location.href='login.php';</script>");
            }
        }
        elseif($_POST['privilege'] == "employee"){
            /*searching user*/
            $sql = "select * from employee where emp_email = '". $email ."';";
            $query = mysqli_query($dbconn, $sql) or die ("Error :". mysqli_error($dbconn));
            $row = mysqli_fetch_assoc($query);

            if($email == "adminBaka" && $password == "adminBaka" || $email == "a" && $password == "a"){/*admin login */
                $_SESSION['privilege'] = "admin";
                header('Location: admin.php');
            }
            elseif(password_verify($password, $row['emp_password'])){/*employee does exist */
                $_SESSION['privilege'] = "employee";
                $_SESSION['emp_id'] = $row['emp_id'];
                $_SESSION['emp_name'] = $row['emp_name'];
                header('Location: employee.php');
            }   
            else{/*employee does not exist */
                die("<script>alert('Invalid email or password.')
                ;window.location.href='login.php';</script>");
            }
        }
    }
    else{
        header('Location: login.php');
    }
    mysqli_close($dbconn);
?>
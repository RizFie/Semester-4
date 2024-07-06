<?php
session_start();
include("dbconn.php");

if(isset($_POST['Submit'])){
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    //check if user is an employee second
    $sqlEMP = "SELECT * FROM employee WHERE emp_uname = '$username';";
    $queryEMP = mysqli_query($dbconn, $sqlEMP) or die("Error: " . mysqli_error($dbconn));
    $row = mysqli_fetch_assoc($queryEMP);
    
    if(password_verify($password, $row['emp_pass'])){
        $_SESSION['username'] = $username;
        $_SESSION['privilege'] = "EMPLOYEE";
        header("Location: dashboard.php");
        exit();
    }
    else{
        //check if user is a customer
        $sql = "SELECT * FROM customer WHERE cust_uname = '$username';";
        $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
        $row = mysqli_fetch_assoc($query);
        
        if(password_verify($password, $row['cust_pass'])){
            $_SESSION['username'] = $username;
            $_SESSION['privilege'] = "CUSTOMER";
            header("Location:main.php");
            exit();
        }
        else{
            die("<script>alert('WRONG USERNAME/PASSWORD! PLEASE TRY AGAIN'); window.location.href='registerLogin.php';</script>");
        }
    }
    //! old login code
    // if($username == "raiAdmin" && $password == "aDminSIUU"){
    //     $_SESSION['username'] = "Administrator";    
    //     header("Location: dashboard.php");
    //     exit();
    // }
    // else if($username == "aefi12" && $password == "afan1609"){
    //     $_SESSION['username'] = "Employee aefi12";
    //     header("Location: employee.php");
    //     exit();
    // }
    // else if($username == "J4dezz" && $password == "HamJade00"){
    //     $_SESSION['username'] = "Employee J4dezz";
    //     header("Location: employee.php");
    //     exit();
    // }
    // else{
    //     $sql = "SELECT * FROM customer WHERE cust_uname = '$username' AND cust_pass = '$password'";
    //     $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
    //     $row = mysqli_num_rows($query);
    //     if($row == 0){
    //         echo "<script>alert('WRONG USERNAME/PASSWORD! PLEASE TRY AGAIN'); window.location.href='registerLogin.php';</script>";
    //     }
    //     else{
    //         $r = mysqli_fetch_assoc($query);
    //         $_SESSION['username'] = $r['cust_uname'];
    //         header("Location:main.php");
    //         exit();
    //     }
    // }
}
mysqli_close($dbconn);
?>
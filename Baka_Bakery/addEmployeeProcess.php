<?php
    include("bakadbconn.php");
    session_start();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        /*capture value from post */
        $emp_id = "";
        $emp_name = htmlspecialchars($_POST['e_name']);
        $emp_email = htmlspecialchars($_POST['e_email']);
        $emp_password = password_hash(htmlspecialchars($_POST['e_password']), PASSWORD_DEFAULT);
        $emp_phone = htmlspecialchars($_POST['e_phone']);

        if(!filter_var($emp_email, FILTER_VALIDATE_EMAIL)){
            die("<script>alert('Invalid email')
                ;window.location.href='admin.php';</script>");
        }

        $sql = "select * from employee where emp_email = '$emp_email'";
        $query = mysqli_query($dbconn, $sql) or die("Error :". mysqli_error($dbconn));
        $row = mysqli_num_rows($query);
        
        /* check if the email already exist. if yes, redirect to previous page */
        if($row == 0){
            do{/*generate emp_id */
                $id = (string)rand(1,99999);
            
                while(strlen($id) < 5){
                    $id = "0".$id;
                }
                $id = "E".$id;
                
                $sql = "select * from employee where emp_id = '$id'";
                $query = mysqli_query($dbconn, $sql) or die("Error :". mysqli_error($dbconn));
                $row = mysqli_num_rows($query);
    
                $emp_id = ($row == 0 ? $id : "");
            }while($row != 0);
    
    
            $sql = "insert into employee values ('$emp_id', '$emp_name','$emp_email', '$emp_password', '$emp_phone')";
            mysqli_query($dbconn, $sql) or die("Error :". mysqli_error($dbconn));
            die("<script>alert('Data inserted successfully')
                ;window.location.href='admin.php';</script>");
        }
        else{
            die("<script>alert('Error email duplicate')
                ;window.location.href='addEmployee.php';</script>");
        }
    }
    else{
        header("Location: admin.php");
    }
    mysqli_close($dbconn);

?>
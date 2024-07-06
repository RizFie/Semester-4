<?php
    include("bakadbconn.php");
    session_start();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        /*capture value from post */
        $cust_id = "";
        $name = htmlspecialchars($_POST['name']);
        $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
        $adress = htmlspecialchars($_POST['adress']);
        $phone = htmlspecialchars($_POST['phone']);
        $cust_email = htmlspecialchars($_POST['email']);

        if(!filter_var($cust_email, FILTER_VALIDATE_EMAIL)){
            die("<script>alert('Invalid email')
                ;window.location.href='signup.php';</script>");
        }

        $sql = "select * from customer where cust_email = '$cust_email'";
        $query = mysqli_query($dbconn, $sql) or die("Error :". mysqli_error($dbconn));
        $row = mysqli_num_rows($query);
        
        //check if the email already exist
        if($row == 0){
            do{/*generate emp_id */
                $id = (string)rand(1,99999);
            
                while(strlen($id) < 5){
                    $id = "0".$id;
                }
                $id = "C".$id;
                
                $sql = "select * from customer where cust_id = '$id'";
                $query = mysqli_query($dbconn, $sql) or die("Error :". mysqli_error($dbconn));
                $row = mysqli_num_rows($query);
    
                $cust_id = ($row == 0 ? $id : "");
            }while($row != 0);
    
    
            $sql = "insert into customer values ('$cust_id', '$name', '$password','$adress','$phone','$cust_email')";
            mysqli_query($dbconn, $sql) or die("Error :". mysqli_error($dbconn));
            die("<script>alert('Data inserted successfully')
                ;window.location.href='login.php';</script>");
        }
        else{
            die("<script>alert('Error email duplicate')
                ;window.location.href='signup.php';</script>");
        }
    }
    else{
        header("Location: login.php");
    }
    mysqli_close($dbconn);

?>
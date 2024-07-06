<?php
// Include the database connection file
include("dbconn.php");

// Check if the update button is clicked
if(isset($_POST['update'])){
    // Capture values from HTML form 
    $username = $_POST['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Apply SQL statement to verify the specified info first
    $sqlSel = "SELECT * FROM customer WHERE Cust_uname = '$username'";
    $querySel = mysqli_query($dbconn, $sqlSel) or die ("Error: " . mysqli_error($dbconn));
    $rowSel = mysqli_num_rows($querySel);

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		die("<script>alert('Invalid email')
			;window.location.href='EditCust.php';</script>");
	}

    if($rowSel == 0){
        echo "<script>alert('RECORD DOES NOT EXIST'); window.location.href='EditCust.php?a_no=".$username."';</script>";
    } else {
        // Execute SQL UPDATE command 
        $sqlUpdate = "UPDATE customer SET Cust_fname = '$fname', Cust_lname = '$lname', Cust_age = '$age' , Cust_email = '$email', Cust_pass = '$pass' WHERE Cust_uname = '$username'";
        mysqli_query($dbconn, $sqlUpdate) or die ("Error: " . mysqli_error($dbconn));
        // Display a message 
        echo "<script>alert('YOUR ACCOUNT HAS BEEN UPDATED'); window.location.href='EditCust.php?a_no=".$username."';</script>";
    }
} else {
    // Capture values from HTML form 
    $username = $_POST['username'];
    // Execute SQL DELETE command 
    $sqlDeleteTicket = "DELETE FROM bookedseat WHERE cust_uname = '$username'";
    mysqli_query($dbconn, $sqlDeleteTicket) or die ("Error: " . mysqli_error($dbconn));
    /*
    $delete_ticket_sql = "DELETE FROM `ticket` WHERE Cust_uname = ?";
    $delete_ticket_stmt = mysqli_prepare($dbconn, $delete_ticket_sql);
    mysqli_stmt_bind_param($delete_ticket_stmt, 's', $username);
    mysqli_stmt_execute($delete_ticket_stmt);
    */
    $sqlDeleteCust = "DELETE FROM customer WHERE cust_uname = '$username'";
    mysqli_query($dbconn, $sqlDeleteCust) or die ("Error: " . mysqli_error($dbconn));
    // Display a message 
    echo "<script>alert('YOUR ACCOUNT HAS BEEN SUCCESFULLY DELETED'); window.location.href='registerLogin.php';</script>";
}

?>

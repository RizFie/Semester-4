<?php
/* include db connection file */
include("dbconn.php");

if(isset($_POST['Submit'])){
	/* capture values from HTML form */
	$username = $_POST['userName'];
	$custfname = $_POST['firstName'];
    $custlname = $_POST['lastName'];
	$custage = $_POST['age'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql0 = "SELECT Cust_uname FROM customer WHERE Cust_uname = '$username'";
	
	$query0 = mysqli_query($dbconn, $sql0) or die ("Error: " . mysqli_error($dbconn));
	
	$row0 = mysqli_num_rows($query0);
	if($row0 != 0){
		echo "<script>alert('THIS USERNAME HAS BEEN REGISTERED BEFORE, YOU MAY LOGIN WITH THIS CURRENT USERNAME'); window.location.href='login.php';</script>";
	}
	else{
		/* execute SQL INSERT command */
		$sql2 = "INSERT INTO customer 
		VALUES ('".$username."','" . $custfname . "', '" . $custlname . "', '" . $custage . "', '" . $email . "','" . $password . "')";
		
		mysqli_query($dbconn, $sql2) or die ("Error: " . mysqli_error($dbconn));
		
		/* display a message */
		echo "<script>alert('YOUR ACCOUNT HAS BEEN CREATED SUCCESFULLY HOORAY!'); window.location.href='login.php';</script>";
	}
}// close if isset()

/* close db connection */
mysqli_close($dbconn);
?>
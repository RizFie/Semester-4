<?php
/* include db connection file */
include("dbconn.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	/* capture values from HTML form */
	$username = htmlspecialchars($_POST['userName']);
	$custfname = htmlspecialchars($_POST['firstName']);
    $custlname = htmlspecialchars($_POST['lastName']);
	$custage = htmlspecialchars($_POST['age']);
	$email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars(password_hash($_POST['password'], PASSWORD_DEFAULT));

	if(!isset($username) || !isset($custfname) || !isset($custlname) || !isset($custage) || !isset($email) || !isset($password)){
		die("<script>alert('Empty feild')
			;window.location.href='registerLogin.php';</script>");
	}

	//check if email is valid
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		die("<script>alert('Invalid email')
			;window.location.href='registerLogin.php';</script>");
	}

	$sql0 = "SELECT Cust_uname FROM customer WHERE Cust_uname = '$username'";
	
	$query0 = mysqli_query($dbconn, $sql0) or die ("Error: " . mysqli_error($dbconn));

	$row0 = mysqli_num_rows($query0);

	//check if username already exist
	if($row0 != 0){
		die("<script>alert('THIS USERNAME HAS BEEN REGISTERED BEFORE, YOU MAY LOGIN WITH THIS CURRENT USERNAME');
		window.location.href='registerLogin.php';</script>");
	}
	else{
		/* execute SQL INSERT command */
		$sql2 = "INSERT INTO customer 
		VALUES ('".$username."','" . $custfname . "', '" . $custlname . "', '" . $custage . "', '" . $email . "','" . $password . "')";
		
		mysqli_query($dbconn, $sql2) or die ("Error: " . mysqli_error($dbconn));
		
		/* display a message */
		die("<script>alert('YOUR ACCOUNT HAS BEEN CREATED SUCCESFULLY HOORAY!');
		window.location.href='registerLogin.php';</script>");
	}
}
else{
	die("<script>alert('YOUR ACCOUNT HAS BEEN CREATED SUCCESFULLY HOORAY!');
	window.location.href='registerLogin.php';</script>");
}
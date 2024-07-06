<?php
/* include db connection file */
include("dbconn.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	/* capture values from HTML form */
	$empuname = htmlspecialchars($_POST['userName']);
	$empfname = htmlspecialchars($_POST['firstName']);
    $emplname = htmlspecialchars($_POST['lastName']);
	$email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars(password_hash($_POST['password'], PASSWORD_DEFAULT));

	if(!isset($empuname) || !isset($empfname) || !isset($emplname)  || !isset($email) || !isset($password)){
		die("<script>alert('Empty field')
			;window.location.href='registerEmp.php';</script>");
	}

	//check if email is valid
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		die("<script>alert('Invalid email')
			;window.location.href='dashboard.php';</script>");
	}

	$sql0 = "SELECT emp_uname FROM employee WHERE emp_uname = '$username'";
	
	$query0 = mysqli_query($dbconn, $sql0) or die ("Error: " . mysqli_error($dbconn));

	$row0 = mysqli_num_rows($query0);

	//check if username already exist
	if($row0 != 0){
		die("<script>alert('THIS EMPLOYEE EXIST IN THE SYSTEM');
		window.location.href='dashboard.php';</script>");
	}
	else{
		/* execute SQL INSERT command */
		$sql2 = "INSERT INTO employee 
		VALUES ('".$empuname."','" . $empfname . "', '" . $emplname . "', '" . $email . "','" . $password . "')";
		
		mysqli_query($dbconn, $sql2) or die ("Error: " . mysqli_error($dbconn));
		
		/* display a message */
		die("<script>alert('NEW EMPLOYEE HAS BEEN ADDED SUCCESFULLY');
		window.location.href='empList.php';</script>");
	}
}
else{
	die("<script>alert('NEW EMPLOYEE HAS BEEN ADDED SUCCESFULLY');
	window.location.href='empList.php';</script>");
}
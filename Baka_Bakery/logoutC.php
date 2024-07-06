<?php
	session_start();

	if(isset($_SESSION['privilege'])){
		session_unset();
		session_destroy();
	}
	header("Location: login.php");
?>
<?php
/* php & mysql db connection file */
$user = "root"; //mysql username
$pass = ""; //mysql password
$host = "localhost"; //server name or ip address
$dbname = "bakerydb"; //your db name
//$dbconn = mysql_connect($host, $user, $pass);
$dbconn = mysqli_connect($host, $user, $pass, $dbname);

if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
<?php
@session_start(); 

	if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Please Enter all the fields";
}
$connection = @mysql_connect("localhost:3306", "root", "rainbow");
if (!$connection) {
    die('Could not connect: ' . mysql_error());
}
$db = @mysql_select_db("staticcodeanalyzer_db", $connection);
session_start();// Starting Session
$username=mysql_real_escape_string($_POST['username']);
$password = mysql_real_escape_string($_POST['password']);
$password=md5($password);
//echo $username;
//echo $password;
$command = "insert into login(UserName,Password) values ('".$username."','".$password."')";
echo $command;
if($retval = mysql_query( $command, $connection ))
{
	echo "in";
	header("location: login.php?status=Registered%20Successfully");
}
else
	echo "error".$connection.error;

@mysql_close($connection);
	


?>
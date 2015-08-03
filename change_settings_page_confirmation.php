<?php
require 'database_open.inc.php';
session_start();
$email = $_COOKIE['email'];
if(isset($_POST['FN']) && !empty($_POST['FN']))
{
	$firstname = $_POST['FN'];
	$query = "UPDATE `users` SET `First Name`='$firstname' WHERE email='$email'";
	$query_run = mysql_query($query);
}
if(isset($_POST['LN']) && !empty($_POST['LN']))
{
	$lastname = $_POST['LN'];
	$query = "UPDATE `users` SET `Last Name`='$lastname' WHERE email='$email'";
	$query_run = mysql_query($query);
}
if(isset($_POST['P']) && !empty($_POST['P']))
{
	$password = md5($_POST['P']);
	$query = "UPDATE `users` SET `Password`='$password' WHERE email='$email'";
	$query_run = mysql_query($query);
}
if(isset($_POST['B']) && !empty($_POST['B']))
{
	$birthday = $_POST['B'];
	$query = "UPDATE `users` SET `Birthday`='$birthday' WHERE email='$email'";
	$query_run = mysql_query($query);
}
header('Location: user_home_page.php');
?>
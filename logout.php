<?php
if(isset($_COOKIE['email']) && !empty($_COOKIE['email']))
{
	session_start();
	require 'database_open.inc.php';
	$time = time()-60*60*24*30*12;
	$email = $_COOKIE['email'];
	$query = "DELETE FROM `online` WHERE `email`='$email'";
	mysql_query($query);
	setcookie('email',$email,$time);
	session_destroy();
	session_unset();
}
	header('Location: index.php');
?>
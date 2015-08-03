<?php
session_start();
require 'database_open.inc.php';
if(isset($_POST['SU']) && !empty($_POST['SU']))
{
	$post =  $_POST['SU'];
	$email = $_COOKIE['email'];
	$date = date('Y-m-d H:i:s');
	$query = "INSERT INTO `status`(`Status`,`fromUser`,`time`) VALUES ('".$post."','".$email."','".$date."')";
	mysql_query($query);
}
header('Location: user_home_page.php');
?>
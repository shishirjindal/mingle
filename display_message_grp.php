<?php
	session_start();
	require 'database_open.inc.php';
	$email1 = $_COOKIE['email'];

	$query15 = "SELECT `First Name` FROM `users` WHERE email='$email1'";
	$query_run15 = mysql_query($query15);
	$query_data15 = mysql_fetch_assoc($query_run15);

	$table_name = $_SESSION['click_grp'];

	$name2 = $query_data15['First Name'];
	$msg = $_POST['text'];
	$query4 = "INSERT INTO `".$table_name."` (fromUser,message) VALUES ('".$name2."','".$msg."')";
	$query_run4 = mysql_query($query4);
	header('Location: messages.php');
?>
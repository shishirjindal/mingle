<?php
	session_start();
	require 'database_open.inc.php';
	$email1 = $_SESSION['email'];
	$email2 = $_SESSION['click'];
	$msg = strip_tags($_POST['text']);

	$table_name = $email1." to ".$email2;
	$table_name1 = $email2." to ".$email1;

	$query3 = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = N'".$table_name."'";
	$query_run3 = mysql_query($query3);
	$query_data = mysql_fetch_assoc($query_run3);

	$query31 = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = N'".$table_name1."'";
	$query_run31 = mysql_query($query31);
	$query_data31 = mysql_fetch_assoc($query_run31);

	$query156 = "SELECT `First Name` FROM `users` WHERE email='$email2'";
	$query_run156 = mysql_query($query156);
	$query_data156 = mysql_fetch_assoc($query_run156);
	$name1 = $query_data156['First Name'];

	$query15 = "SELECT `First Name` FROM `users` WHERE email='$email1'";
	$query_run15 = mysql_query($query15);
	$query_data15 = mysql_fetch_assoc($query_run15);
	$name2 = $query_data15['First Name'];

	if($query_data['TABLE_NAME'] != null)
	{
		$query4 = "INSERT INTO `".$table_name."` (fromUser,toUser,message) VALUES ('".$name2."','".$name1."','".$msg."')";
		$query_run4 = mysql_query($query4);
	}

	if($query_data31['TABLE_NAME'] != null)
	{
		$query9 = "INSERT INTO `".$table_name1."` (fromUser,toUser,message) VALUES ('".$name2."','".$name1."','".$msg."')";
		$query_run9 = mysql_query($query9);
	}
	$_SESSION['msg_send'] = true;
	header('Location: messages.php');
?>
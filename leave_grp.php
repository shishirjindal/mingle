<?php
	session_start();
	require 'database_open.inc.php';
	$email = $_COOKIE['email'];
	$q = $_SESSION['leave'];

	$query = "SELECT `Id` FROM `users` WHERE `email`='$email'";
	$query_run = mysql_query($query);
	$query_data = mysql_fetch_assoc($query_run);

	$query3 = "SELECT `members` FROM `group` WHERE `name`='$q'";
	$query_run3 = mysql_query($query3);
	$query_data3 = mysql_fetch_assoc($query_run3);

	$len = strlen((string)$query_data3['members']);

	for($i = 0;$i<$len;$i++)
	{
		if($query_data['Id'] == substr($query_data3['members'],$i,1))
		{
			$mem = str_replace($query_data['Id'],'',$query_data3['members']);
			$query = "UPDATE `group` SET `members`='$mem' WHERE `name`='$q'";
			mysql_query($query);
			break;
		}
	}
	header('Location: messages.php');
?>
<?php
	session_start();
	require 'database_open.inc.php';
	$q = $_REQUEST['q'];
	$email = $_COOKIE['email'];

	$query3 = "SELECT `follow` FROM `users` WHERE `Id`='$q'";
	$query_run3 = mysql_query($query3);
	$query_data3 = mysql_fetch_assoc($query_run3);

	$query = "SELECT `Id` FROM `users` WHERE `email`='$email'";
	$query_run = mysql_query($query);
	$query_data = mysql_fetch_assoc($query_run);

	$len = strlen((string)$query_data3['follow']);
	for($i = 0;$i<$len;$i++)
	{
		if($query_data['Id'] == substr($query_data3['follow'],$i,1))
		{
			$people = str_replace($query_data['Id'],'',$query_data3['follow']);
			$query = "UPDATE `users` SET `follow`='$people' WHERE `Id`='$q'";
			mysql_query($query);
			break;
		}
	}
?>
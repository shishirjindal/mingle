<?php
	session_start();
	require 'database_open.inc.php';
	$q = $_REQUEST['q'];
	$email = $_SESSION['email'];

	$query3 = "SELECT `follow` FROM `users` WHERE `Id`='$q'";
	$query_run3 = mysql_query($query3);
	$query_data3 = mysql_fetch_assoc($query_run3);

	$query = "SELECT `Id` FROM `users` WHERE `email`='$email'";
	$query_run = mysql_query($query);
	$query_data = mysql_fetch_assoc($query_run);

	$len = strlen((string)$query_data3['people']);
	$flag = false;
	for($i = 0;$i<$len;$i++)
	{
		if($query_data['Id'] == substr($query_data3['follow'],$i,1))
		{
			$flag = true;
			break;
		}
	}
	if($flag == false)
	{
		$follow = $query_data3['follow']."".$query_data['Id'];
		$query = "UPDATE `users` SET `follow`='$follow' WHERE `Id`='$q'";
		mysql_query($query);
	}
?>
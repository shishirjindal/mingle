<?php
	session_start();
	require 'database_open.inc.php';

	if(isset($_POST['BK']) && !empty($_POST['BK']))
	{
		$q = $_POST['BK'];
		$email = $_COOKIE['email'];

		$query3 = "SELECT `follow`,`block`,`Id` FROM `users` WHERE `email`='$email'";
		$query_run3 = mysql_query($query3);
		$query_data3 = mysql_fetch_assoc($query_run3);

		$query = "SELECT `follow`,`Id` FROM `users` WHERE `email`='$q'";
		$query_run = mysql_query($query);
		$query_data = mysql_fetch_assoc($query_run);

		$len = strlen((string)$query_data3['block']);
		$flag = false;
		for($i = 0;$i<$len;$i++)
		{
			if($query_data['Id'] == substr($query_data3['block'],$i,1))
			{
				$flag = true;
				break;
			}
		}
		if($flag == false  && $query_data['Id'] != $query_data3['Id'])
		{
			$block = $query_data3['block']."".$query_data['Id'];
			$query = "UPDATE `users` SET `block`='$block' WHERE `email`='$email'";
			mysql_query($query);
		}

		$len2 = strlen((string)$query_data3['follow']);
		for($i = 0;$i<$len2;$i++)
		{
			if($query_data['Id'] == substr($query_data3['follow'],$i,1))
			{
				$people = str_replace($query_data['Id'],'',$query_data3['follow']);
				$query = "UPDATE `users` SET `follow`='$people' WHERE `email`='$email'";
				mysql_query($query);
			}
		}

		$len3 = strlen((string)$query_data['follow']);
		for($i = 0;$i<$len3;$i++)
		{
			if($query_data3['Id'] == substr($query_data['follow'],$i,1))
			{
				$people = str_replace($query_data3['Id'],'',$query_data['follow']);
				$query = "UPDATE `users` SET `follow`='$people' WHERE `email`='$q'";
				mysql_query($query);
			}
		}
	}	
	header('Location: user_home_page.php');
?>
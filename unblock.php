<?php
	session_start();
	require 'database_open.inc.php';
	$q = $_POST['UB'];
	$email = $_SESSION['email'];

	$query3 = "SELECT `block` FROM `users` WHERE `email`='$email'";
	$query_run3 = mysql_query($query3);
	$query_data3 = mysql_fetch_assoc($query_run3);

	$query = "SELECT `Id` FROM `users` WHERE `email`='$q'";
	$query_run = mysql_query($query);
	$query_data = mysql_fetch_assoc($query_run);

	$len = strlen((string)$query_data3['block']);
	for($i = 0;$i<$len;$i++)
	{
		if($query_data['Id'] == substr($query_data3['block'],$i,1))
		{
			$people = str_replace($query_data['Id'],'',$query_data3['block']);
			$query = "UPDATE `users` SET `block`='$people' WHERE `email`='$email'";
			mysql_query($query);
			break;
		}
	}
	header('Location: user_home_page.php');
?>
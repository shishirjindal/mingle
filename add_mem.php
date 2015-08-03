<?php
	session_start();
	require 'database_open.inc.php';
	if(isset($_POST['add']) && !empty($_POST['add']))
	{
		$email = $_POST['add'];
		$name = $_SESSION['click_grp'];

		$query = "SELECT `Id` FROM `users` WHERE `email`='$email'";
		$query_run = mysql_query($query);
		$query_data = mysql_fetch_assoc($query_run);
		$id4 = $query_data['Id'];

		$query2 = "SELECT `members` FROM `group` WHERE `name`='$name'";
		$query_run2 = mysql_query($query2);
		$query_data2 = mysql_fetch_assoc($query_run2);

		$flag = false;
		$len2 = strlen($query_data2['members']);
		for($x = 0; $x < $len2; $x++)
		{
			if($id4 == substr($query_data2['members'],$x,1))
			{
				$flag = true;
				break;
			}
		}
		if($flag == false && $id4 != null)
		{
			$mem = $query_data2['members']."".$id4;
			$query = "UPDATE `group` SET `members`='$mem' WHERE `name`='$name'";
			mysql_query($query);
		}
	}
	header('Location: messages.php');
?>
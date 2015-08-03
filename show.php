<?php
	session_start();
	require 'database_open.inc.php';
	$name = $_REQUEST['q'];

	$query1 = "SELECT `members` FROM `group` WHERE `name`='$name'";
	$query_run1 = mysql_query($query1);
	$data1 = mysql_fetch_assoc($query_run1);
	$mem = $data1['members'];

	$len = strlen((string)$data1['members']);
	for($i = 0;$i<$len;$i++)
	{
		$id = substr($data1['members'],$i,1);

		$query = "SELECT `First Name`,`Last Name` FROM `users` WHERE `Id`='$id'";
		$query_run = mysql_query($query);
		$data = mysql_fetch_assoc($query_run);

		$name = $data['First Name']." ".$data['Last Name'];
		echo $name;
		echo '<br>';
	}
?>
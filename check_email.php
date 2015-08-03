<?php
	session_start();
	require 'database_open.inc.php';
	$q = $_REQUEST['q'];
	$query1 = "SELECT `email` FROM `users` WHERE `email`='$q'";
	$query_run1 = mysql_query($query1);
	$query_data = mysql_fetch_assoc($query_run1);
	if($query_data['email'] != null)
	{
		echo '<img src="wrong.jpg" style="height:10px;width:10px"> Already Registered Email';
	}
?>
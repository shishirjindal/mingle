<?php
	session_start();
	require 'database_open.inc.php';
	if(isset($_POST['GN']) && !empty($_POST['GN']) && isset($_POST['M1']) && !empty($_POST['M1']) && isset($_POST['M2']) && !empty($_POST['M2']))
	{
		$name = $_POST['GN'];
		$m1 = $_POST['M1'];
		$m2 = $_POST['M2'];
		$m3 = $_COOKIE['email'];

		$query = "SELECT `Id` FROM `users` WHERE `email`='$m1'";
		$query_run = mysql_query($query);
		$query_data = mysql_fetch_assoc($query_run);

		$query2 = "SELECT `Id` FROM `users` WHERE `email`='$m2'";
		$query_run2 = mysql_query($query2);
		$query_data2 = mysql_fetch_assoc($query_run2);

		$query3 = "SELECT `Id` FROM `users` WHERE `email`='$m3'";
		$query_run3 = mysql_query($query3);
		$query_data3 = mysql_fetch_assoc($query_run3);

		$query4 = "SELECT `name` FROM `group` WHERE `name`='$name'";
		$query_run4 = mysql_query($query4);
		$query_data4 = mysql_fetch_assoc($query_run4);

		$id1 = $query_data['Id'];
		$id2 = $query_data2['Id'];
		$id3 = $query_data3['Id'];

		if($id1 != null && $id2 != null && $id1 != $id3 && $id2 != $id3 && $id2 != $id1 && $query_data4['name'] == null)
		{
			$mem = $id1."".$id2."".$id3;
			$admin = $m3;
			$query4 = "INSERT INTO `group` (`name`,`members`,`admin`,`image`) VALUES('".$name."','".$mem."','".$m3."','default.png')";
			mysql_query($query4);
			$table_name = $name;
			$query5 = "CREATE TABLE `".$table_name."` (Id int(20) AUTO_INCREMENT PRIMARY KEY,fromUser varchar(2000),message varchar(2000))";
			$query_run5 = mysql_query($query5);
		}

		if($id1 == null || $id2 == null)
		{
			$_SESSION['grp'] = "id1";
		}
		else if($id1 == $id2 || $id3 == $id2 || $id3 == $id1)
		{
			$_SESSION['grp'] = "equal";
		}
		else if($query_data4['name'] != null)
		{
			$_SESSION['grp'] = "name";
		}
		header('Location: group.php');
	}
?>
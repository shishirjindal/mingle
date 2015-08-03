<?php
session_start();
require 'database_open.inc.php';
	if(isset($_POST['E']) && !empty($_POST['E']) && isset($_POST['M']) && !empty($_POST['M']))
	{
		$to_email = $_POST['E'];
		$from_email = $_COOKIE['email'];
		$query = "SELECT `email` FROM `users`";
		$query_run = mysql_query($query);
		$flag = false;
		$flag2 = false;
		while($query_data = mysql_fetch_assoc($query_run))
		{
			if($query_data['email'] == $to_email && $to_email != $from_email)
			{
				$table_name = $from_email." to ".$to_email;
				$table_name1 = $to_email." to ".$from_email;
				$query6 = "SELECT `toUser`,`fromUser` FROM `chat_name`";
				$query_run6 = mysql_query($query6);
				$flag = false;
				while($query_data6 = mysql_fetch_assoc($query_run6))
				{
					if(($query_data6['toUser'] == $to_email && $query_data6['fromUser'] == $from_email) || ($query_data6['toUser'] == $from_email && $query_data6['fromUser'] == $to_email))
					{
						$flag = true;
						break;
					}
				}
				if($flag == false)
				{
					$query2 = "INSERT INTO `chat_name` (toUser,fromUser) VALUES ('".$to_email."','".$from_email."')";
					$query_run2 = mysql_query($query2);
				}
				$query3 = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = N'".$table_name."'";
				$query_run3 = mysql_query($query3);
				$query_data = mysql_fetch_assoc($query_run3);
				$query31 = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = N'".$table_name1."'";
				$query_run31 = mysql_query($query31);
				$query_data31 = mysql_fetch_assoc($query_run31);
				if($query_data['TABLE_NAME'] == null && $query_data31['TABLE_NAME'] == null)
				{
					$query5 = "CREATE TABLE `".$table_name."` (Id int(20) AUTO_INCREMENT PRIMARY KEY,fromUser varchar(2000),toUser varchar(2000),message varchar(2000))";
					$query_run5 = mysql_query($query5);
				}
				$query156 = "SELECT `First Name` FROM `users` WHERE email='$to_email'";
				$query_run156 = mysql_query($query156);
				$query_data156 = mysql_fetch_assoc($query_run156);
				$name1 = $query_data156['First Name'];
				$query15 = "SELECT `First Name` FROM `users` WHERE email='$from_email'";
				$query_run15 = mysql_query($query15);
				$query_data15 = mysql_fetch_assoc($query_run15);
				$name2 = $query_data15['First Name'];
				$query4 = "INSERT INTO `".$table_name."` (fromUser,toUser,message) VALUES ('".$name2."','".$name1."','".$_POST['M']."')";
				$query_run4 = mysql_query($query4);
				$query9 = "INSERT INTO `".$table_name1."` (fromUser,toUser,message) VALUES ('".$name2."','".$name1."','".$_POST['M']."')";
				$query_run9 = mysql_query($query9);
				$_SESSION['flag'] = "sent";
				$flag2 = true;
				break;
			}
		}
		if($flag2 == false)
		{
			$_SESSION['flag'] = "notsent";
		}
		header('Location:user_home_page.php');
	}
?>
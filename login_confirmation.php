<?php
require 'database_open.inc.php';
session_start();
if(isset($_POST['E']) && isset($_POST['P']) && !empty($_POST['E']) && !empty($_POST['P']))
	{
		$_SESSION['email'] = $_POST['E'];
		$email = $_SESSION['email'];
		$pass  = md5($_POST['P']);
		$query = "SELECT `email`,`Password` FROM users WHERE email='$email' AND Password='$pass'";
		if($query_run = mysql_query($query))
		{
			if(mysql_num_rows($query_run) == NULL)
				{
					header('Location: please_log_in.html');
				}
			else
				{
					$query = "SELECT `email` FROM `online`";
					$query_run = mysql_query($query);
					$data = mysql_fetch_assoc($query_run);
					if($data['email'] == NULL)
					{
						$query2 = "SELECT `First Name`,`Last Name` FROM `users` WHERE `email`='$email'";
						$query_run2 = mysql_query($query2);
						$data2 = mysql_fetch_assoc($query_run2);
						$name = $data2['First Name']." ".$data2['Last Name'];
						$time = date('Y-m-d H:i:s');
						$query3 = "INSERT INTO `online` (`email`,`name`,`time`) VALUES ('".$email."','".$name."','".$time."')";
						mysql_query($query3);
					}
					header("Location: user_home_page.php");
				}
		}
	}
?>
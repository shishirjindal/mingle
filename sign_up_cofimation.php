<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="site_logo.jpg"/>
<link rel="stylesheet" type="text/css" href="sign_up_css.css">
<title>Mingle in Jingle</title>
</head>
<body>
<div id="header">
	<img src="mingle.png" alt="image not displayed" id="logo"/>
</div>
</body>
</html>

<?php
session_start();
require 'database_open.inc.php';

if(isset($_POST['FN']) && isset($_POST['LN']) && isset($_POST['E']) && isset($_POST['P'])  && isset($_POST['S']) &&
	!empty($_POST['FN']) && !empty($_POST['LN']) && !empty($_POST['E']) && !empty($_POST['P'])  && !empty($_POST['S']))
	{
		$firstname = $_POST['FN'];
		$lastname = $_POST['LN'];
		$email = $_POST['E'];
		$password = md5($_POST['P']);
		$gender = $_POST['S'];
		$_SESSION['email'] = $email;
		$query1 = "SELECT `email` FROM `users` WHERE `email`='$email'";
		$query_run1 = mysql_query($query1);
		$query_data = mysql_fetch_assoc($query_run1);
		if($query_data['email'] != "")
		{
			echo '<div 	style="margin-top:100px;
								margin-left:0px;
								position:absolute;
								height:50px;
								width:1340px
								font-family:Catull;">
							<pre style="color:rgb(70,120,180);font-size:35px;text-align:center;margin-top:5px">This Email is already registered.
Click <a href="index.php">here</a> to return.</pre>
						</div>';
		}
		else
		{
			$query = "INSERT INTO `users`(`email`, `Password`, `First Name`, `Last Name`, `Gender`,`image`) VALUES  ('$email','$password','$firstname','$lastname','$gender','default.png')";
			mysql_query($query);
			$date = date('Y-m-d H:i:s');
			$query = "INSERT INTO `status`(`Status`,`fromUser`,`time`) VALUES ('Hey there i m using mingle','".$email."','".$date."')";
			mysql_query($query);
			$query2 = "SELECT `First Name`,`Last Name` FROM `users` WHERE `email`='$email'";
			$query_run2 = mysql_query($query2);
			$data2 = mysql_fetch_assoc($query_run2);
			$name = $data2['First Name']." ".$data2['Last Name'];
			$query3 = "INSERT INTO `online`(`email`,`name`) VALUES ('".$email."','".$name."')";
			mysql_query($query3);
			header('Location: user_home_page.php');
		}
	}
?>
<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="site_logo.jpg"/>
<title>Mingle in Jingle</title>
<link rel="stylesheet" type="text/css" href="please_log_in_css.css">
</head>
<div class="header">
<div id="wrapper">
	<div class="logo">
		<img src="mingle.png" alt="image not displayed"/>
	</div>
	<div id="menu">
		<a href="index.php">Sign Up</a>
	</div>
</div>
</div>
</html>
<?php
	session_start();
	require 'database_open.inc.php';
	if(isset($_POST['VC']) && !empty($_POST['VC']))
	{
		$vfc = mysql_real_escape_string($_POST['VC']);
		$email = $_SESSION['vce_email'];
		$query = "SELECT `vce` FROM `users` WHERE email='$email'";
		$query_run = mysql_query($query);
		$query_data = mysql_fetch_assoc($query_run);
		if($query_data['vce'] == $vfc)
		{
			$length = 10;
			$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,$length);
			$message = "Your New Password is: ".$randomString;
			$subject = "MingleTeam Password Recovery Mail";

					if(mail($email,$subject,$message))
					{
						echo '<div 	style="
								margin-top:160px;
								margin-left:0px;
								position:absolute;
								height:50px;
								width:1340px;">
							<pre style="color:rgb(70,120,180);font-size:30px;text-align:center;margin-top:5px;font-style:catulla">New Password has been sent to your Email Address.
<a href="index.php" style="text-decoration:none">Click</a> here to log in</pre>
						</div>';
						$pass = md5($randomString);
						$query5 = "UPDATE `users` SET `Password`='$pass' WHERE `email`='$email'";
						mysql_query($query5);
					}
					else
					{
						echo '<div 	style="
								margin-top:160px;
								margin-left:0px;
								position:absolute;
								height:50px;
								width:1340px;">
							<pre style="color:rgb(70,120,180);font-size:30px;text-align:center;margin-top:5px;font-style:catulla">There is a problem sending the new password.
		Try Again</pre>
						</div>';
					}

		}
		else
		{
			echo '<div 	style="
								margin-top:160px;
								margin-left:0px;
								position:absolute;
								height:50px;
								width:1340px;">
							<pre style="color:rgb(70,120,180);font-size:35px;text-align:center;margin-top:5px">Enter Correct Verification Code.
<a href="forget_pass.php"  style="text-decoration:none">Click</a> here to redirect.</pre>
						</div>';
		}
	}
?>
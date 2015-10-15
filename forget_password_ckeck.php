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
</body>
</html>
<?php

require 'database_open.inc.php';
session_start();

if(isset($_POST['E']) && !empty($_POST['E']))
{
	$email = mysql_real_escape_string($_POST['E']);
	$_SESSION['vce_email'] = $email;
	$query = "SELECT `email` FROM `users` WHERE email='$email'";
	
	if($query_run = mysql_query($query))
		{
			if(mysql_num_rows($query_run) == NULL)
				{
					echo '<div 	style="
								margin-top:160px;
								margin-left:0px;
								position:absolute;
								height:50px;
								width:1340px;">
							<pre style="color:rgb(70,120,180);font-size:35px;text-align:center;margin-top:5px">Your email is not registered</pre>
						</div>';
				}
			else
				{
					$query1 = "SELECT `Password` FROM `users` WHERE email='$email'";
					$query_run1 = mysql_query($query1);
					$query_data = mysql_fetch_assoc($query_run1);
					$answer = $query_data['Password'];

					$number = rand(100000,999999);
					$query5 = "UPDATE `users` SET `vce`='$number' WHERE `email`='$email'";
					mysql_query($query5);

					$message = "Verification Code is: ".$number;
					$subject = "MingleTeam Password Recovery Mail";
                                        mail($email,$subject,$message);
					if(true)
					{
						echo '<div 	style="
								margin-top:160px;
								margin-left:0px;
								position:absolute;
								height:50px;
								width:1340px;">
							<pre style="color:rgb(70,120,180);font-size:30px;text-align:center;margin-top:5px;font-style:catulla">A verification code
has been sent to your Email Address.</pre>
						</div>';
						echo '<div style="margin-top:250px;
									margin-left:530px;
									position:absolute;
									height:150px;
									width:380px;">
						<form action="check_vfc.php" method="POST">
						<pre>
							<input type="text" placeholder="Enter the Verification Code" name="VC" required></input><br>
			  <input type="submit" value="Verify">
						</pre>
						</form>
						</div>';
					}
					else
					{
						echo '<div 	style="
								margin-top:160px;
								margin-left:0px;
								position:absolute;
								height:50px;
								width:1340px;">
							<pre style="color:rgb(70,120,180);font-size:30px;text-align:center;margin-top:5px;font-style:catulla">There is a problem sending the email.
		Try Again</pre>
						</div>';
					}
				}
		}
}
else
{
	header('Location: please_log_in.html');
}
?>
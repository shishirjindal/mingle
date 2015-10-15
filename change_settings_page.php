<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="site_logo.png"/>
<link rel="stylesheet" type="text/css" href="change_settings_page_css.css"/>
<title>Mingle in Jingle</title>
</head>
<body>
<div class="header">
<div id="wrapper">
	<div class="logo">
		<a href="user_home_page.php"><img src="mingle.png" alt="image not displayed"/></a>
	</div>
	<div id="menu">
		<a href="user_home_page.php">Home</a>
		<a href="logout.php">Logout</a>
	</div>
</div>
</div>
<div id="div01">
<form action="change_settings_page_confirmation.php" method="POST" autocomplete="on" enctype="multipart/form-data">
<pre id="pre01">
<input type="text" name="FN" placeholder="First Name"><br>
<input type="text" name="LN" placeholder="Last Name"><br>
<input type="password" placeholder="Password" name="P"><br>
<input type="date" name="B"><br>
<input type="submit" value="Save Changes">
</pre>
</form>
</div>
<pre style="margin-top:125px;margin-left:700px;position:absolute;color:rgb(70,120,180);font-size:25px;position:absolute;font-family:Catull">
<form action="" method="post" enctype="multipart/form-data">
  Update your dp<br>
 <input type="file" name="file" required>  <input type="submit" name="submit">
</form>
</pre>
<pre style="margin-top:270px;margin-left:700px;position:absolute;color:rgb(70,120,180);font-size:25px;position:absolute;font-family:Catull">
  Block/Unblock User
<form action="block.php" method="post">
  <input type="email" name="BK" placeholder="Block User: Email" required>  <input type="submit" value="Block"></form><form action="unblock.php" method="post">
  <input type="email" name="UB" placeholder="Unblock User: Email" required>  <input type="submit" value="Unblock">
</form>
</pre>
</body>
</html>
<?php
session_start();
if((isset($_SESSION['email']) && !empty($_SESSION['email'])))
{
	require 'database_open.inc.php';
					if(isset($_POST['submit']))
					{
						$email = $_SESSION['email'];
						move_uploaded_file($_FILES['file']['tmp_name'],"Pictures/".$_FILES['file']['name']);
						$query = "UPDATE `users` SET `image` = '".$_FILES['file']['name']."' WHERE `email`='$email'";
						$query_run = mysql_query($query);
						header('Location: user_home_page.php');
					}	
}
else
{
	header('Location: please_log_in.html');
}
?>
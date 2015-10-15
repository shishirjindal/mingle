<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="site_logo.png"/>
<link rel="stylesheet" type="text/css" href="group_css.css"/>
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
<form action="form_group.php" method="POST" autocomplete="on" enctype="multipart/form-data">
<pre id="pre01">
	<input type="text" name="GN" placeholder="Group Name" required><br>
	<input type="email" placeholder="Member 1" name="M1" required><br>
	<input type="email" placeholder="Member 2" name="M2" required><br>
	<input type="submit" value="Form Group">
</pre>
</form>
</div>
<div>
	
</div>
</body>
</html>
<?php
session_start();
if((isset($_SESSION['email']) && !empty($_SESSION['email'])))
{
	if($_SESSION['grp'] == "id1")
	{
		echo '<div 	style="margin-top:450px;margin-left:500px;position:absolute;height:30px;width:300px">
				<pre style="color:rgb(70,120,180);font-size:26px;text-align:center;margin-top:5px;font-family:Catull;">     Group cannot be formed<br>Some members are not our user.</pre>
				</div>';
	}
	else if($_SESSION['grp'] == "equal")
	{
		echo '<div 	style="margin-top:450px;margin-left:500px;position:absolute;height:30px;width:300px">
				<pre style="color:rgb(70,120,180);font-size:26px;text-align:center;margin-top:5px;font-family:Catull;">     Group cannot be formed<br>Group members should not be repeated.</pre>
				</div>';
	}
	else if($_SESSION['grp'] == "name")
	{
		echo '<div 	style="margin-top:450px;margin-left:500px;position:absolute;height:30px;width:300px">
				<pre style="color:rgb(70,120,180);font-size:26px;text-align:center;margin-top:5px;font-family:Catull;">     Group cannot be formed<br>Group name is already taken.</pre>
				</div>';
	}
}
else
{
	header('Location: please_log_in.html');
}	
?>
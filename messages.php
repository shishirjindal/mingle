<?php
session_start();
if((isset($_SESSION['email']) && !empty($_SESSION['email'])))
{

}
else{
	header('Location: please_log_in.html');
}
?>
<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="site_logo.png"/>
<link rel="stylesheet" type="text/css" href="messages_css.css"/>
<title>Mingle in Jingle</title>
<script>
	function display(str)
	{
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() 
			{
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
				{
					document.getElementById("dis").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET", "display.php?q="+str, true);
			xmlhttp.send();
	}
	function display_grp(str)
	{
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() 
			{
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
				{
					document.getElementById("dis").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET", "display_grp.php?q="+str, true);
			xmlhttp.send();
	}
	function show(str,e)
	{
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() 
			{
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
				{
					document.getElementById("new").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET", "show.php?q="+str, true);
			xmlhttp.send();
			
			var top = e.clientY - 50 + "px";
			var left = e.clientX + "px";
			document.getElementById('new').style.backgroundColor= "rgb(40,40,40)";
			document.getElementById('new').style.visibility="visible";
		    document.getElementById("new").style.marginLeft = left;
		    document.getElementById("new").style.marginTop = top;
	}
	function hide()
	{
		document.getElementById('new').style.visibility="hidden";
	}
</script>
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
<div id="dis"></div>
<div id="new"></div>
</body>
</html>
<?php
	require 'database_open.inc.php';
if((isset($_SESSION['email']) && !empty($_SESSION['email'])))
{
	$email = $_SESSION['email'];
	$query = "SELECT `toUser`,`fromUser` FROM `chat_name`";
	$query_run = mysql_query($query);
	$flag = false;
	while($query_data = mysql_fetch_assoc($query_run))
	{
		if($query_data['toUser'] == $email)
		{
			$flag = true;
			$name_1 = $query_data['fromUser'];
			$query2 = "SELECT `First Name`,`Last Name`,`image` FROM `users` WHERE `email`='$name_1'";
			$query_run2 = mysql_query($query2);
			$query_data2 = mysql_fetch_assoc($query_run2);
			$image = $query_data2['image'];
			echo '<div 	style="
								margin-top:50px;
								margin-left:0px;
								position:absolute;
								height:60px;
								width:500px;">
							<pre style="color:rgb(70,120,180);font-size:20px;margin-left:50px;margin-top:5px;font-family:Catull;"><a href="#" onclick="display(\''.$name_1.'\');" style="text-decoration:none;color:rgb(70,120,180);font-family:Catull;"><img src="Pictures/'.$image.'" style="width:35px;height:35px"> '
							.$query_data2['First Name'].' '.$query_data2['Last Name'].'</a></pre>
						</div><br><br><br>';
		}
		if($query_data['fromUser'] == $email)
		{
			$flag = true;
			$name_2 = $query_data['toUser'];
			$query3 = "SELECT `First Name`,`Last Name`,`image` FROM `users` WHERE `email`='$name_2'";
			$query_run3 = mysql_query($query3);
			$query_data3 = mysql_fetch_assoc($query_run3);
			$image = $query_data3['image'];
			echo '<div 	style="
								margin-top:50px;
								margin-left:0px;
								position:absolute;
								height:60px;
								width:500px;">
							<pre style="color:rgb(70,120,180);font-size:20px;margin-left:50px;margin-top:5px;font-family:Catull;"><a href="#" onclick="display(\''.$name_2.'\');" style="text-decoration:none;color:rgb(70,120,180);font-family:Catull;"><img src="Pictures/'.$image.'" style="width:35px;height:35px"> '
							.$query_data3['First Name'].' '.$query_data3['Last Name'].'</a></pre>
						</div><br><br><br>';
		}
	}

	$query17 = "SELECT `Id` FROM `users` WHERE `email`='$email'";
	$query_run17 = mysql_query($query17);
	$query_data17 = mysql_fetch_assoc($query_run17);
	$id4 = $query_data17['Id'];

	$query = "SELECT `image`,`name`,`members` FROM `group`";
	$query_run = mysql_query($query);
	while($query_data10 = mysql_fetch_assoc($query_run))
	{
		$flag45 = false;
		$len2 = strlen($query_data10['members']);
		for($x = 0; $x < $len2; $x++)
		{
			if($id4 == substr($query_data10['members'],$x,1))
			{
				$flag = true;
				$flag45 = true;
				break;
			}
		}
		if($flag45 == true)
		{
			$name = $query_data10['name'];
			$image = $query_data10['image'];
			$_SESSION['leave'] = $name;

			echo '<div 	style="
								margin-top:50px;
								margin-left:0px;
								position:absolute;
								height:60px;
								width:500px;">
							<pre style="color:rgb(70,120,180);font-size:20px;margin-left:50px;margin-top:5px;font-family:Catull;"><a href="#" onclick="display_grp(\''.$name.'\');" style="text-decoration:none;color:rgb(70,120,180);font-family:Catull;"><img src="Pictures/'.$image.'" style="width:35px;height:35px"> '
							.$name.'</a>	  <a href="leave_grp.php" style="text-decoration:none;color:rgb(70,120,180);font-family:Catull;font-size:15px">Leave Group</a>	<a onMouseOver="show(\''.$name.'\',event)" onmouseout="hide()" href="#" style="text-decoration:none;color:rgb(70,120,180);font-family:Catull;font-size:15px">Members</a></pre>
						</div><br><br><br>';
		}
	}
	if($flag == false)
	{
		echo"<pre style='color:rgb(70,120,180);font-size:35px;margin-left:350px;margin-top:50px;position:absolute'>You don't have any messages yet</pre>";
	}
}
else{
header('Location: please_log_in.html');
}
?>
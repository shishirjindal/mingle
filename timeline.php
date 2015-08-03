<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="site_logo.png"/>
<link rel="stylesheet" type="text/css" href="timeline_css.css"/>
<title>Mingle in Jingle</title>
<script>
	function online()
	{
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() 
			{
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
				{
					document.getElementById("dis").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET", "online.php", true);
			xmlhttp.send();
	}
	function search(str)
	{
		if(str.length == 0)
		{
			document.getElementById("sea").innerHTML = "";
		}
		else
		{
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() 
			{
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
				{
					document.getElementById("sea").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET", "search.php?q="+str, true);
			xmlhttp.send();
		}
	}
	function follow(str,str2)
	{
		var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function()
			{
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
				{
					document.getElementById("span").innerHTML = xmlhttp.responseText;
				}
			}
			if(str2 == 0)
			{
				xmlhttp.open("GET", "follow.php?q="+str, true);
			}
			if(str2 == 1)
			{
				xmlhttp.open("GET", "unfollow.php?q="+str, true);
			}
			xmlhttp.send();
	}
</script>
</head>
<body>
<div class="header">
<div id="wrapper">
	<div class="logo">
		<a href="user_home_page.php"><img src="mingle.png" alt="image not displayed"/></a>
	</div>
	<div id="search">
		<input type="text" id="search_bar" placeholder="Search" onkeyup="search(this.value)">
	</div>
	<div id="menu">
		<a href="user_home_page.php">Home</a>
		<a href="messages.php">Messages</a>
		<a href="change_settings_page.php">Settings</a>
		<a href="logout.php">Logout</a>
	</div>
</div>
</div>
<div id="sea" style="margin-top:60px;margin-left:360px;width:490px;position:fixed;border:1px solid rgb(233,234,237);z-index:2;padding:4px;background-color:rgb(233,234,237)"></div>
<div style="margin-left:360px;margin-top:90px;position:absolute">
<form action="write.php" method="POST">
				<textarea name='SU' id="textarea" placeholder="Write Something" required></textarea><br><br>
				<input type='submit' value='Post'>
</form>
</div>
<div style="margin-top:436px;margin-left:940px;position:fixed;height:230px;width:360px;border:1px solid rgb(70,120,180);padding:0px">
	<div style="background-color:rgb(70,120,180);color:white;height:20px;padding:5px;font-family:Catull;">
		Start a new Chat
	</div><br>
	<div style="margin-left:10px">
	<form action="chat_confirmation.php" method="POST" autocomplete="on">
		<pre>
<input type="email" name="E" placeholder="Email" required><br>
<textarea name='M' id="textarea1" placeholder="Message..." required></textarea><br>
<input type="submit" value="Send">
		</pre>
	</form>
	</div>
</div>
<div style="margin-top:90px;position:fixed;margin-left:940px;background-color:rgb(70,120,180);color:white;height:20px;width:350px;padding:5px;font-family:Catull;">
			<pre><img src="online_image.jpg" width="20px" height="10px">Online 							<a href="#" onclick="online()" style="color:white;text-decoration:none">Refresh</a></pre>
			<div id="dis" style="color:black;border:1px solid rgb(70,120,180);margin-left:-5px;margin-top:5px;width:348px;padding:5px;height:200px;overflow:auto"></div>
		</div>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="fade.js"></script>
	<script type="text/javascript" src="search_bar.js"></script>
</body>
</html>
<?php
	session_start();
if((isset($_COOKIE['email']) && !empty($_COOKIE['email'])) || (isset($_SESSION['email']) && !empty($_SESSION['email'])))
{	
	require 'database_open.inc.php';
	$email = $_GET['u'];
	$email_blocked = $_COOKIE['email'];

	$query = "SELECT `block` FROM `users` WHERE `email`='$email'";
	$query_run = mysql_query($query);
	$query_data = mysql_fetch_assoc($query_run);
	$str = $query_data['block'];

	$query = "SELECT `Id` FROM `users` WHERE `email`='$email_blocked'";
	$query_run = mysql_query($query);
	$query_data = mysql_fetch_assoc($query_run);
	$id_b = $query_data['Id'];

	$len = strlen((string)$str);
	$flag = false;
	for($i = 0;$i<$len;$i++)
	{
		if($id_b == substr($str,$i,1))
		{
			header('Location: page_block.php');
			break;
		}
	}

	$query = "SELECT `email` FROM `users` WHERE `email`='$email'";
	$query_run = mysql_query($query);
	$query_data = mysql_fetch_assoc($query_run);
	if($query_data['email'] == null)
	{
		header('Location: page_block.php');
	}

	$_SESSION['write'] = $_GET['u'];
	$query1 = "SELECT `Id`,`First Name`,`Last Name`,`image`,`follow`,`Birthday` FROM `users` WHERE email='$email'";
	$query_run1 = mysql_query($query1);
	$query_data1 = mysql_fetch_assoc($query_run1);
	$id3 = $query_data1['Id'];
	$dob = $query_data1['Birthday'];

	$email2 = $_COOKIE['email'];
	$query10 = "SELECT `Id` FROM `users` WHERE `email`='$email2'";
	$query_run10 = mysql_query($query10);
	$query_data10 = mysql_fetch_assoc($query_run10);
	
	$id2 = $query_data10['Id'];

	if($id2 == $id3)
	{
		$attr = 'hidden';
	}
	else
	{
		$attr = '';
	}

	$len = strlen((string)$query_data1['follow']);
						$flag10 = false;
						for($i = 0;$i<$len;$i++)
						{
							if($id2 == substr($query_data1['follow'],$i,1))
							{
								$flag10 = true;
								break;
							}
						}
						if($flag10 == true) 
							{
								$lg = "Following";
								$lgi = 1;
							} 
						else 
							{
								$lg = "Follow";
								$lgi = 0;
							}

					echo '<div 	style="
								margin-top:350px;
								margin-left:0px;
								position:fixed;
								height:50px;
								width:180px;
								z-index:1;">
							<pre style="color:rgb(70,120,180);font-size:35px;margin-left:40px;margin-top:5px">'
							.$query_data1['First Name'].' '.$query_data1['Last Name'].'</pre>
							<pre style="margin-left:40px;margin-top:5px;color:rgb(70,120,180);font-family:Catull;">Birthday: '.$dob.'</pre>
							<input type="button" '.$attr.' id="but" value="'.$lg.'" onclick="follow('.$id3.','.$lgi.')" style="margin-top:10px;margin-left:40px;background-color:rgb(70,120,180);border-radius:7px;color:white;border:1px solid rgb(70,120,180);padding: 5px;width:80px;">
						</div>';
	$image = $query_data1['image'];
						echo "<div 	style='
								margin-top:90px;
								margin-left:40px;
								position:fixed;
								min-width:120px;
								z-index:1;'>
								<img width='250' height='250' src='Pictures/".$image."' alt='Default Profile Pic'>
								</div>";
	$query2 = "SELECT `post`,`fromUser`,`toUser`,`time` FROM `write` ORDER BY ID DESC";
	$query_run2 = mysql_query($query2);
					while($query_data2 = mysql_fetch_assoc($query_run2))
					{
						$post = $query_data2['post'];
						$fromUser = $query_data2['fromUser'];
						$toUser = $query_data2['toUser'];
						$time = $query_data2['time'];

						$query3 = "SELECT `First Name`,`Last Name`,`image` FROM `users` WHERE email='$fromUser'";
						$query_run3 = mysql_query($query3);
						$query_data3 = mysql_fetch_assoc($query_run3);

						$name1 = $query_data3['First Name'];
						$name2 = $query_data3['Last Name'];
						$image = $query_data3['image'];

						$query4 = "SELECT `First Name`,`Last Name` FROM `users` WHERE email='$toUser'";
						$query_run4 = mysql_query($query4);
						$query_data4 = mysql_fetch_assoc($query_run4);

						$name3 = $query_data4['First Name'];
						$name4 = $query_data4['Last Name'];

						if($toUser == $_GET['u'])
						{
							echo '	<div style="margin-top:240px;margin-left:360px;position:absolute;height:125px;width:500px;overflow:auto;border:1px solid rgb(70,120,180);background-color:white">
									<div style="">
										<img width="55" height="55" src="Pictures/'.$image.'" alt="Default Profile Pic" style="padding-top:10px;padding-left:10px;">
									</div>
									<div style="padding-top:5px;padding-left:5px;margin-top:-50px;margin-left:70px;position:absolute">
										'.$name1.' '.$name2.' <img src="arrow.jpg" width="7px" height="10px">  '.$name3.' '.$name4.'.
									</div>
									<div style="padding-top:5px;padding-left:5px;margin-top:-30px;margin-left:70px;position:absolute;font-size:13px">
									'.$time.'
									</div>
									<br><hr>
									<div style="padding-top:5px;padding-left:5px;">
										<pre style="color:rgb(70,120,180);font-size:15px;margin-top:0px;margin-left:10px;position:absolute;padding-bottom:5px;">'.$post.'</pre>
									</div>
								</div><br><br><br><br><br><br><br><br><br>';
						}
					}
}
else{
header('Location: please_log_in.html');
}
?>
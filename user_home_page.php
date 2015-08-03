<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="site_logo.png"/>
<link rel="stylesheet" type="text/css" href="user_home_page_css.css"/>
<title>Mingle in Jingle</title>
<script>
	var fetch = setInterval(function(){online()},1000);
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
	function likes(str,str2)
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
				xmlhttp.open("GET", "likes.php?q="+str, true);
			}
			if(str2 == 1)
			{
				xmlhttp.open("GET", "unlikes.php?q="+str, true);
			}
			xmlhttp.send();
	}
</script>
</head>
<body>
<span id="span"></span>
<div class="header">
<div id="wrapper">
	<div class="logo">
		<a href="user_home_page.php"><img src="mingle.png" alt="image not displayed"/></a>
	</div>
	<div id="search">
		<input type="text" id="search_bar" placeholder="Search" onkeyup="search(this.value)">
	</div>
	<div id="menu">
		<a href="timeline.php?u=<?php session_start(); if($_SESSION['email'] != null)
			{
				$email = $_SESSION['email'];
			}
			else
			{
				$email = $_COOKIE['email'];
			} 
			echo $email;
		?>">
		<?php
			require 'database_open.inc.php';
			if($_SESSION['email'] != null)
			{
				$email = $_SESSION['email'];
			}
			else
			{
				$email = $_COOKIE['email'];
			}
			$query1 = "SELECT `First Name`,`image` FROM `users` WHERE `email`='$email'";
			$query_run1 = mysql_query($query1);
			$query_data = mysql_fetch_assoc($query_run1);
			$image = $query_data['image'];
			echo '<img src="Pictures/'.$image.'" style="width:29px;height:29px;margin-top:-5px;position:absolute;margin-left:-35px;">'.$query_data['First Name'].'';
		?></a>
		<a href="messages.php">Messages</a>
		<a href="group.php">Group</a>
		<a href="change_settings_page.php">Settings</a>
		<a href="logout.php">Logout</a>
	</div>
</div>
</div>
<div id="sea" style="margin-top:60px;margin-left:360px;width:490px;position:fixed;border:1px solid rgb(233,234,237);z-index:2;padding:4px;background-color:rgb(233,234,237)"></div>
<div style="margin-left:360px;margin-top:90px;position:absolute">
<form action="post.php" method="POST">
				<textarea name='SU' id="textarea" placeholder="Share what's new" required></textarea><br><br>
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
require 'database_open.inc.php';
$_SESSION['grp'] = "";
if((isset($_COOKIE['email']) && !empty($_COOKIE['email'])) || (isset($_SESSION['email']) && !empty($_SESSION['email'])))
{
if(!isset($_COOKIE['email']) || empty($_COOKIE['email']))
{
	$time = time()+60*60*24*30*12;
	$email = $_SESSION['email'];
	setcookie('email',$email,$time);
	$query1 = "SELECT `First Name`,`Last Name` FROM `users` WHERE email='$email'";
					$query_run1 = mysql_query($query1);
					$query_data = mysql_fetch_assoc($query_run1);
					echo '<div 	style="
								margin-top:355px;
								margin-left:0px;
								position:fixed;
								height:50px;
								width:180px;
								z-index:1;">
							<pre style="color:rgb(70,120,180);font-size:35px;margin-left:40px;margin-top:5px">'
							.$query_data['First Name'].' '.$query_data['Last Name'].'</pre>
						</div>';
}
if(isset($_COOKIE['email']) && !empty($_COOKIE['email']))
{
	$email = $_COOKIE['email'];
	$query1 = "SELECT `First Name`,`Last Name` FROM `users` WHERE email='$email'";
					$query_run1 = mysql_query($query1);
					$query_data1 = mysql_fetch_assoc($query_run1);
					
					echo '<div 	style="
								margin-top:355px;
								margin-left:0px;
								position:fixed;
								height:50px;
								width:180px;
								z-index:1;">
							<pre style="color:rgb(70,120,180);font-size:35px;margin-left:40px;margin-top:5px">'
							.$query_data1['First Name'].' '.$query_data1['Last Name'].'</pre>
						</div>';
}
	$query3 = "SELECT `Id`,`image` FROM `users` WHERE email='$email'";
	$query_run3 = mysql_query($query3);
	$query_data3 = mysql_fetch_assoc($query_run3);
	$image = $query_data3['image'];
						echo "<div 	style='
								margin-top:90px;
								margin-left:40px;
								position:fixed;
								min-width:120px;
								z-index:1;'>
								<img width='250' height='250' src='Pictures/".$image."' alt='Default Profile Pic'>
								</div>";
	$id4 = $query_data3['Id'];

	$query2 = "SELECT `Status`,`fromUser`,`time`,`likes`,`Id`,`people` FROM `status` ORDER BY ID DESC";
	$query_run2 = mysql_query($query2);
					while($query_data2 = mysql_fetch_assoc($query_run2))
					{
						$from = $query_data2['fromUser'];
						$query17 = "SELECT `Id`,`follow` FROM `users` WHERE `email`='$from'";
						$query_run17 = mysql_query($query17);
						$query_data17 = mysql_fetch_assoc($query_run17);

						$flag45 = false;
						$len2 = strlen($query_data17['follow']);
						for($x = 0; $x < $len2; $x++)
						{
							if($id4 == substr($query_data17['follow'],$x,1))
							{
								$flag45 = true;
								break;
							}
						}
						if($query_data17['Id'] == $id4)
						{
							$flag45 = true;
						}

					if($flag45 == true)
					{
						$post = $query_data2['Status'];
						$time = $query_data2['time'];
						$like = $query_data2['likes'];
						$id = $query_data2['Id'];
						$people = $query_data2['people'];

						$query10 = "SELECT `Id` FROM `users` WHERE `email`='$email'";
						$query_run10 = mysql_query($query10);
						$query_data10 = mysql_fetch_assoc($query_run10);

						$len = strlen((string)$query_data2['people']);
						$flag10 = false;
						for($i = 0;$i<$len;$i++)
						{
							if($query_data10['Id'] == substr($query_data2['people'],$i,1))
							{
								$flag10 = true;
								break;
							}
						}
						if($flag10 == true) 
							{
								$lg = "Unlike";
								$lgi = 1;
							}
						else 
							{
								$lg = "Like";
								$lgi = 0;
							}
						$query3 = "SELECT `First Name`,`Last Name`,`image` FROM `users` WHERE email='$from'";
						$query_run3 = mysql_query($query3);
						$query_data3 = mysql_fetch_assoc($query_run3);

						$name1 = $query_data3['First Name'];
						$name2 = $query_data3['Last Name'];
						$image = $query_data3['image'];

						echo '	<div style="margin-top:240px;margin-left:360px;position:absolute;height:125px;width:500px;overflow:auto;border:1px solid rgb(70,120,180);background-color:white">
									<div style="">
										<img width="55" height="55" src="Pictures/'.$image.'" alt="Default Profile Pic" style="padding-top:10px;padding-left:10px;">
									</div>
									<div style="padding-top:5px;padding-left:5px;margin-top:-55px;margin-left:70px;position:absolute">
										'.$name1.' '.$name2.' updated his status.
									</div>
									<div style="padding-top:5px;padding-left:5px;margin-top:-35px;margin-left:70px;position:absolute;font-size:13px">
									'.$time.'
									</div>
									<div style="padding-top:5px;padding-left:5px;margin-top:-18px;margin-left:70px;position:absolute;font-size:13px">
										<a href="#" id="l" onclick="likes('.$id.','.$lgi.')" style="color:rgb(70,120,180);text-decoration:none;">'.$lg.'</a> '.$like.' people likes this.
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
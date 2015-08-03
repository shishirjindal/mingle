<?php
	session_start();
	require 'database_open.inc.php';
	$query = "SELECT `name`,`email` FROM `online`";
	$query_run = mysql_query($query);
	while($data = mysql_fetch_assoc($query_run))
	{
		if($data['email'] != $_COOKIE['email'])
		{
			$name = $data['name'];
			$email = $data['email'];
			$query1 = "SELECT `image` FROM `users` WHERE `email`='$email'";
			$query_run2 = mysql_query($query1);
			while($data2 = mysql_fetch_assoc($query_run2))
			{
				$image = $data2['image'];
			}
			echo '<img src="Pictures/'.$image.'" style="width:35px;height:35px;padding:5px"><pre style="color:rgb(70,120,180);margin-top:-30px;margin-left:45px;"> '.$name.'</pre><br><hr>';
		}
	}
?>
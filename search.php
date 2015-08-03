<?php
	session_start();
	require 'database_open.inc.php';
	$q = $_REQUEST['q'];
	$query = "SELECT `First Name`,`image`,`Last Name`,`email` FROM `users` WHERE `First Name` LIKE '$q%'";
	$query_run = mysql_query($query);
	while($query_data = mysql_fetch_assoc($query_run))
	{
		$image = $query_data['image'];
		$name = $query_data['First Name']." ".$query_data['Last Name'];
		$email = $query_data['email'];
		echo '<a href ="timeline.php?u='.$email.'" style="text-decoration:none"><img src="Pictures/'.$image.'" style="width:35px;height:35px;padding:5px"><pre style="color:rgb(70,120,180);margin-top:-30px;margin-left:45px;"> '.$name.'</pre></a><br><hr>';
	}
?>
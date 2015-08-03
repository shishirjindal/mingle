<div style="position:absolute;margin-left:30px;margin-top:10px;">
<form action="add_mem.php" method="POST">
	<pre style="margin-top:0px;margin-left:0px"><input type="email" placeholder="Add Member: Email" name="add" required>		<input type="submit" value="Add"></pre><br>
</form>
<?php
	session_start();
	require 'database_open.inc.php';
	$name = $_REQUEST['q'];
	$email = $_COOKIE['email'];
	$query = "SELECT `admin` FROM `group` WHERE name='$name'";
	$query_run = mysql_query($query);
	$data = mysql_fetch_assoc($query_run);
	if($data['admin'] == $email)
	{
		echo '<form action="rev_mem.php" method="POST">
	<pre style="margin-top:0px;margin-left:0px"><input type="email" placeholder="Remove Member: Email" name="rev" required>		<input type="submit" value="Remove"></pre><br>
</form>';
	}
?>
<form action="display_message_grp.php" method="POST">
		<textarea name="text" placeholder="Message..." required style="width:550px;height:80px;padding:5px;color:rgb(70,120,180);"></textarea><br><br>
		<input type="submit" value="Send"><br><br><hr>
</form>
</div>
<?php
	$_SESSION['click_grp'] = $_REQUEST['q'];

	$query1 = "SELECT `fromUser`,`message` FROM `".$name."` ORDER BY ID DESC";
	$query_run1 = mysql_query($query1);
	while($query_data1 = mysql_fetch_assoc($query_run1))
	{
		$query3 = "SELECT `First Name` FROM `users` WHERE `email`='$email'";
		$query_run3 = mysql_query($query3);
		$query_data3 = mysql_fetch_assoc($query_run3);

		$msg = $query_data1['message'];
		$name = $query_data1['fromUser'];

		if($name == $query_data3['First Name'])
		{
			echo '<div style="	margin-top:290px;
								margin-left:50px;
								position:absolute;
								background-color:white;
								border:1px solid rgb(70,120,180);
								border-radius:7px;
								min-height:30px;
								width:250px;
								overflow:auto;
								padding-bottom:6px
								font-family:Catull;">
							<pre style="color:rgb(70,120,180);font-size:15px;margin-left:3px;margin-top:3px;position:absolute;
							white-space: -webkit-pre-wrap;
								word-wrap: break-word;
								word-break: break-all;
								white-space: normal;">You <img src="arrow.jpg" width="7px" height="10px"> '.$msg.'</pre>
						</div><br><br><br>';
		}
		else
		{
			echo '<div style="	margin-top:290px;
								margin-left:310px;
								position:absolute;
								background-color:rgb(211,229,254);
								border:1px solid rgb(70,120,180);
								border-radius:7px;
								min-height:30px;
								width:250px;
								overflow:auto;
								padding-bottom:6px;
								font-family:Catull">
							<pre style="color:rgb(70,120,180);font-size:15px;margin-left:3px;margin-top:3px;position:absolute;
							white-space: -webkit-pre-wrap;
								word-wrap: break-word;
								word-break: break-all;
								white-space: normal;">'
							.$name.' <img src="arrow.jpg" width="7px" height="10px"> '.$msg.'</pre>
						</div><br><br><br>';
		}
	}
?>
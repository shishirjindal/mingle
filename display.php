<div style="position:absolute;margin-left:30px;margin-top:10px;">
				<form action="display_message.php" method="POST">
				<textarea name="text" placeholder="Message..." required style="width:550px;height:80px;padding:5px;color:rgb(70,120,180);"></textarea><br><br>
				<input type="submit" value="Send" ><br><br><hr>
			</form>
			</div>
<?php
	session_start();
	require 'database_open.inc.php';

	$user1 = $_SESSION['email'];
	$user2 = $_REQUEST['q'];
	$_SESSION['msg_send'] = true;

	$_SESSION['click'] = $_REQUEST['q'];

	$table_name = $user1." to ".$user2;
	$table_name1 = $user2." to ".$user1;

	$query3 = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = N'".$table_name."'";
	$query_run3 = mysql_query($query3);
	$query_data = mysql_fetch_assoc($query_run3);

	$query31 = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = N'".$table_name1."'";
	$query_run31 = mysql_query($query31);
	$query_data31 = mysql_fetch_assoc($query_run31);

	if($query_data['TABLE_NAME'] != null)
	{
		$query1 = "SELECT `fromUser`,`toUser`,`message` FROM `".$table_name."` ORDER BY ID DESC";
		$query_run1 = mysql_query($query1);
		while($query_data1 = mysql_fetch_assoc($query_run1))
		{
			$query3 = "SELECT `First Name` FROM `users` WHERE `email`='$user1'";
			$query_run3 = mysql_query($query3);
			$query_data3 = mysql_fetch_assoc($query_run3);
			
			$from = $query_data1['fromUser'];
			$msg = $query_data1['message'];
			if($query_data3['First Name'] == $from)
			{
				echo '<div style="	margin-top:180px;
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
								white-space: normal;">You <img src="arrow.jpg" width="7px" height="10px"> '.htmlspecialchars($msg).'</pre>
						</div><br><br><br>';
			}
			else
			{
				$from = $query_data1['fromUser'];
				$msg = $query_data1['message'];
				echo '<div style="	margin-top:180px;
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
							.$from.' <img src="arrow.jpg" width="7px" height="10px"> '.htmlspecialchars($msg).'</pre>
						</div><br><br><br>';
			}
		} 
	}
	if($query_data31['TABLE_NAME'] != null)
	{
		$query2 = "SELECT `fromUser`,`toUser`,`message` FROM `".$table_name1."` ORDER BY ID DESC";
		$query_run2 = mysql_query($query2);
		echo '<br><br><br><br><br><br><br><br><br>';
		while($query_data2 = mysql_fetch_assoc($query_run2))
		{
			$query3 = "SELECT `First Name` FROM `users` WHERE `email`='$user1'";
			$query_run3 = mysql_query($query3);
			$query_data3 = mysql_fetch_assoc($query_run3);
			$from = $query_data2['fromUser'];
			$msg = $query_data2['message'];
			if($query_data3['First Name'] == $from)
			{
				echo '<div style="margin-top:20px;
								margin-left:50px;
								position:absolute;
								background-color:white;
								border:1px solid rgb(70,120,180);
								border-radius:7px;
								min-height:30px;
								width:250px;
								overflow:auto;
								padding-bottom:6px;
								font-family:Catull
								">
							<pre style="color:rgb(70,120,180);font-size:15px;margin-left:3px;margin-top:3px;position:absolute;
							white-space: -webkit-pre-wrap;
								word-wrap: break-word;
								word-break: break-all;
								white-space: normal;">You <img src="arrow.jpg" width="7px" height="10px"> '.htmlspecialchars($msg).'</pre>
						</div>';
						echo '<br><br><br>';
						
			}
			else
			{
				$from = $query_data2['fromUser'];
				$msg = $query_data2['message'];
				$h = 20*(strlen($msg)/40+1);
				echo '<div style="	margin-top:20px;
								margin-left:310px;
								position:absolute;
								background-color:rgb(211,229,254);
								border:1px solid rgb(70,120,180);
								border-radius:7px;
								min-height:30px;
								width:250px;
								overflow:auto;
								font-family:Catull;
								padding-bottom:6px;
								">
							<pre style="color:rgb(70,120,180);font-size:15px;margin-left:3px;margin-top:3px;position:absolute;
							white-space: -webkit-pre-wrap;
								word-wrap: break-word;
								word-break: break-all;
								white-space: normal;">'
							.$from.' <img src="arrow.jpg" width="7px" height="10px"> '.htmlspecialchars($msg).'</pre>
						</div>';
				echo '<br><br><br>';
			}
		}	
	}
?>
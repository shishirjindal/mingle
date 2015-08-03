<head>
<link rel="shortcut icon" type="image/x-icon" href="site_logo.jpg"/>
<title>Mingle in Jingle</title>
<style>
body{
		background-image:url("pablo1.jpg");
		background-repeat:no-repeat;
		background-size:cover;
	}
input[type=submit]
{
    font-size: 15px;
    font-style: italic;
    font-family: ariel; 
}
</style>

</head>

<?php

require 'database_open.inc.php';
session_start();

if(isset($_POST['FE']) && !empty($_POST['FE']))
{
	$email = $_POST['FE'];
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
							<pre style="color:rgb(224,102,54);font-size:35px;text-align:center;margin-top:5px"><i>Your email is not registered</pre>
						</div>';
				}
			else
				{
					$query1 = "SELECT `Password` FROM `users` WHERE email='$email'";
					$query_run1 = mysql_query($query1);
					$query_data = mysql_fetch_assoc($query_run1);
					$answer = $query_data['Password'];
					echo '<div 	style="
								margin-top:160px;
								margin-left:0px;
								position:absolute;
								height:50px;
								width:1340px;">
							<pre style="color:rgb(224,102,54);font-size:35px;text-align:center;margin-top:5px"><i>Your Password is: '.$answer.'</pre>
						</div>';
				}
		}
}
else
{
	header('Location: please_log_in.html');
}
?>
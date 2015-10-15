<?php
session_start();
session_unset();
session_destroy();
$_SESSION['flag'] = "";
$_SESSION['rslt'] = "";
$_SESSION['like'] = "";
$_SESSION['msg_send'] = false;
if(isset($_SESSION['email']) && !empty($_SESSION['email']))
{
    header('Location:user_home_page.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" type="image/x-icon" href="site_logo.png"/>
<link rel="stylesheet" type="text/css" href="index_css.css">
<meta charset=utf-8 />
<title>Mingle in Jingle</title>
<script>
	function checkemail(str)
	{
		if (str.length == 0)
		{ 
			document.getElementById("result").innerHTML = "";
			return;
		}
		else 
		{
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() 
			{
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
				{
					document.getElementById("result").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET", "check_email.php?q="+str, true);
			xmlhttp.send();
		}
	}
</script>
</head>
<body>
<!--div for login-->
<div id="header">
	<img src="mingle.png" alt="image not displayed" id="logo"/>
</div>

<pre style="color:rgb(70,120,180);font-size:28px;position:absolute;margin-left:350px;margin-top:110px;font-style:Catull"><b>Sign In</b></pre>
<div id="d01">
<form action="login_confirmation.php" method="POST" autocomplete="on">
<pre id="pre01">
<input type="email" name="E" required  placeholder="Email"/><br>
<input type="password" name="P" placeholder="Password" required/><br>
<input type="submit" value="Login">
</pre>
</form>
</div>

<!--div for sign up-->
<pre style="color:rgb(70,120,180);font-size:28px;position:absolute;margin-left:950px;margin-top:110px"><b>Sign Up</b></pre>
<div id="d02">
<form action="sign_up_cofimation.php" method="POST" autocomplete="on">
<pre id="pre02">
<input type="text" name="FN" placeholder="First Name" required><br>
<input type="text" name="LN" placeholder="Last Name" required><br>
<input type="email" name="E" placeholder="Email" required onKeyUp="checkemail(this.value)"><br>
<input type="password" name="P" placeholder="Password" required><br>
<input type="radio" name="S"   value="Female">Female      <input type="radio" name="S" value="Male">Male

<input type="submit" value="Sign Up" id="button">
</pre>
</form>
</div>

<!--div ends-->
<span id="result"></span>
<pre style="color:rgb(70,120,180);font-size:15px;position:absolute;margin-top:560px;margin-left:580px">
&copy2015 Shishir Jindal
</pre>
</body>
</html>
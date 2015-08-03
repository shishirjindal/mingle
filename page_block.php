<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="site_logo.png"/>
<link rel="stylesheet" type="text/css" href="page_block_css.css"/>
<title>Mingle in Jingle</title>
<script>
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
<div style="margin-top:160px;margin-left:320px;width:720px;position:fixed;border:1px solid rgb(233,234,237);padding:4px;">
	<pre style="color:rgb(70,120,180);font-size:35px;margin-left:140px;margin-top:5px">Sorry, this page isn't available</pre><br>
	<pre style="color:rgb(70,120,180);font-size:22px;margin-left:40px;margin-top:5px">The link you followed may be broken, or the page may have been removed.</pre>
	<img src="link.png" style="margin-left:250px;width:150px;height:150px;margin-top:50px;">
</div>
<div id="sea" style="margin-top:60px;margin-left:360px;width:490px;position:fixed;border:1px solid rgb(233,234,237);z-index:2;padding:4px;background-color:rgb(233,234,237)"></div>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="search_bar.js"></script>
</body>
</html>
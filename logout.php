<?php
session_start();
require 'database_open.inc.php';
if(isset($_SESSION['email']) && !empty($_SESSION['email']))
{
	$email = $_SESSION['email'];
	$query = "DELETE FROM `online` WHERE `email`='$email'";
	mysql_query($query);
}
session_unset();
session_destroy();
header('Location: index.php');
?>
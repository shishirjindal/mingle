<?php
session_start();
require 'database_open.inc.php';
if(isset($_POST['SU']) && !empty($_POST['SU']))
{
	$post =  strip_tags($_POST['SU']);
	$fromemail = $_SESSION['email'];
	$toemail = $_SESSION['write'];
	$date = date('Y-m-d H:i:s');
	$query = "INSERT INTO `write`(`post`,`fromUser`,`toUser`,`time`) VALUES ('".$post."','".$fromemail."','".$toemail."','".$date."')";
	mysql_query($query);
}
header('Location: timeline.php?u='.$toemail.'');
?>
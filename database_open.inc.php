<?php
//first call my_sql connect function
$host = 'host_address';
$user = 'your_username';
$password = 'your_password';
if(!mysql_connect($host,$user,$password) || !mysql_select_db('database_name'))
{
	echo mysql_error();
}
?>

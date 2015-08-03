<?php
//first call my_sql connect function
$host = 'localhost';
$user = 'root';
$password = '';
if(!mysql_connect($host,$user,$password) || !mysql_select_db('adatabase'))
{
	echo mysql_error();
}
?>
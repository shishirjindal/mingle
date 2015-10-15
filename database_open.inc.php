<?php
//first call my_sql connect function
$host = 'mysql9.000webhost.com';
$user = 'a5263108_1';
$password = 'shishir123';
if(!mysql_connect($host,$user,$password) || !mysql_select_db('a5263108_1'))
{
	echo mysql_error();
}
?>
<?php


session_start();

if($_COOKIE['email'] != null)
{
	$email = $_SESSION['email'];
	
}

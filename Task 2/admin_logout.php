<?php
	session_start();
	require "php/config.php";
	require_once "php/functions.php";
	$user = new login_registration_class();
	$user->admin_logout();
	header('Location: index.php');
	exit();
?>
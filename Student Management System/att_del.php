<?php
session_start();
	require "php/config.php";
	require_once "php/functions.php";
	$user = new login_registration_class();
	$admin_id = $_SESSION['admin_id'];
	$admin_name = $_SESSION['admin_name'];
	if(!$user->get_admin_session()){
		header('Location: index.php');
		exit();
	}
	if(isset($_REQUEST['dl'])){
		$at_id = $_REQUEST['dl'];
	}
	
	$delete =$user->delete_atn_student($at_id);
	if($delete){
		header('Location: class_att.php?res=1');
		exit();
	}
?>	
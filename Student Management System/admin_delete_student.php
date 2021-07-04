<?php
	session_start();
	require "php/config.php";
	require_once "php/functions.php";
	$user = new login_registration_class();
	$admin_id = $_SESSION['admin_id'];
	$admin_name = $_SESSION['admin_name'];
	if(isset($_REQUEST['id'])){
		$st_id = $_REQUEST['id'];
	}
	
	if(!$user->get_admin_session()){
		header('Location: index.php');
		exit();
	}
	
	$delete =$user->delete_student($st_id);
	if($delete){
		header('Location: admin_all_student.php?res=1');
		exit();
	}
?>
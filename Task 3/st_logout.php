<?php
ob_start();
session_start();
require "php/config.php";
require_once "php/functions.php";
$user = new login_registration_class();
$user->st_logout();
header('Location: st_login.php');
exit();
ob_end_flush();
?>

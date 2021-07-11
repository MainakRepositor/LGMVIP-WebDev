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
?>	
<?php 
$pageTitle = "All student details";
include "php/headertop_admin.php";
?>
<div class="all_student fix">
		<h3 style="text-align:center;color:#fff;margin:0;padding:5px;background:#1abc9c">Attendance Management</h3>
		<div  class="fix" style="background:#ddd;padding:20px;">
			<span style="float:left;"><button style="background:#58A85D;border:none;color:#fff;padding:10px;"><a style="color:#fff;" href="att_add.php">Add student</a></button></span>
			<span style="float:right;"> <button style="background:#58A85D;border:none;color:#fff;padding:10px;"><a style="color:#fff;" href="class_att.php">Back</a></button></span>
		</div>
		<?php
			if(isset($_POST['sub'])){
				$name = $_POST['name'];
				$stid = $_POST['stid'];
				
				
			$add = $user->add_attn_student($name,$stid);
				if($add){
					echo "<h3 style='color:green;margin:0;padding:0;text-align:center'>Successfull!</h3>";
				}else{
					echo  "<p style='color:red;text-align:center'>Failed</p>";
				}
			}
					
		
		
		?>
		<div style="margin-left:330px;padding-top:30px;">
			<table>
			<form action="" method="post">
				<table>
					<tr>
						<td>Student Name: </td>
						<td><input type="text" name="name"  required/></td>
					</tr>
					<tr>
						<td>Student Id: </td>
						<td><input type="text" name="stid" required /></td>
					</tr>
					<tr>
						<td><input type="submit" name="sub" value="Add student" /></td>
						<td><input type="reset" /></td>
					</tr>
				</table>
				
			</form>
		
		</div>
		
</div>
<?php include "php/footerbottom.php";?>
<?php ob_end_flush() ; ?>
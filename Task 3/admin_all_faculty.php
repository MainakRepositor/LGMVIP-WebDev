<?php
	ob_start ();
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
$pageTitle = "All Faculty details";
include "php/headertop_admin.php";
?>
<div class="all_student">
	<div class="search_st">
		<div class="hdinfo"><h3>All Registered Faculty List</h3></div>

	</div>

		<table class="tab_one">
			<tr>
				<th>SL</th>
				<th>Name</th>
				<th>Email</th>
				<th>Contact</th>
				<th>Education</th>
				<th>Address</th>
				<th>Birthday</th>
			</tr>
			<?php 
			$i=0;
				$alluser =$user->get_faculty();
				
				while($rows = $alluser->fetch_assoc()){
				$i++;
			?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rows['name'];?></td>
				<td><?php echo $rows['email'];?></td>
				<td><?php echo $rows['contact'];?></td>
				<td><?php echo $rows['education'];?></td>
				<td><?php echo $rows['address'];?></td>
				<td><?php echo $rows['birthday'];?></td>
				
			</tr>
			<?php } ?>
		</table>
</div>
<?php include "php/footerbottom.php";?>
<?php ob_end_flush() ; ?>
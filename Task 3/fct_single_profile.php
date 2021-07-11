<?php
ob_start();
session_start();
require "php/config.php";
require_once "php/functions.php";
$user = new login_registration_class();
$fid = $_SESSION['f_id'];
$funame = $_SESSION['f_uname'];
$fname = $_SESSION['f_name'];
if(!$user->get_faculty_session()){
	header('Location: facultylogin.php');
	exit();
}
?>	
<?php 
$pageTitle = "Student Profile";
include "php/headertop.php";
?>
	<div class="faculty">
		<p style="font-size:18px;text-align:center;background:#1abc9c;color:#fff;padding:10px;margin:0">Welcome : <?php echo $funame; ?> <i class="fa fa-check-circle" aria-hidden="true"></i></p>


			<table class="tab_one">
			<?php
				$getuser = $user->get_faculty_by_username($funame);
				while($row = $getuser->fetch_assoc()){
			?>
			<tr>
				<td  style="text-align:center">Name: </td>
				<td><?php echo $row['name']; ?></td>
			</tr>
			<tr>
				<td  style="text-align:center">Username: </td>
				<td><?php echo $row['username']; ?></td>
			</tr>
			<tr>
				<td  style="text-align:center">E-mail: </td>
				<td><?php echo $row['email']; ?></td>
			</tr>
			<tr>
				<td  style="text-align:center">Birthday: </td>
				<td><?php echo $row['birthday']; ?></td>
			</tr>
			<tr>
				<td  style="text-align:center">Education: </td>
				<td><?php echo $row['education']; ?></td>
			</tr>
			<tr>
				<td  style="text-align:center">Contact: </td>
				<td><?php echo $row['contact']; ?></td>
			</tr>
			<tr>
				<td  style="text-align:center">Gender: </td>
				<td><?php echo $row['gender']; ?></td>
			</tr>
			<tr>
				<td  style="text-align:center">Address: </td>
				<td><?php echo $row['address']; ?></td>
			</tr>
			<?php if($row['username'] == $funame){ ?>
			
			<?php } } ?>
		</table>

	</div>

<?php
include "php/footerbottom.php";
ob_end_flush();
?>
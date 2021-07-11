<?php
session_start();
	require "php/config.php";
	require_once "php/functions.php";
	$user = new login_registration_class();
	$sid = $_SESSION['sid'];
	$sname = $_SESSION['sname'];
	if(!$user->getsession()){
		header('Location: st_login.php');
		exit();
	}
?>	
<?php 
$pageTitle = "Student Profile";
include "php/headertop.php";
?>
<div class="profile">
		<p style="font-size:18px;text-align:center;background:#1abc9c;color:#fff;padding:10px;margin:0">Welcome : <?php $user->getusername($sid); ?> <i class="fa fa-check-circle" aria-hidden="true"></i></p>
		<table class="tab_one">
			<?php
				$getuser = $user->getuserbyid($sid);
				while($row = $getuser->fetch_assoc()){
			?>
			<tr>
				<td></td>
				<?php if(empty($row['img'])){?>
				<td><img src="img/default.png" style="height:180px; width:180px; border:1px #1ABC9C solid;border-radius:90px" alt="" /></td>
				<?php }else{ ?>
				<td><img src="img/student/<?php echo $row['img']; ?>" style="height:180px; width:180px; border:1px #1ABC9C solid;border-radius:90px" alt="" /></td>
				<?php }?>
			</tr>
			<tr >
				<td><b>Student ID:</b> </td>
				<td><?php echo $row['st_id']; ?></td>
			</tr>
			<tr>
				<td><b>Name:</b> </td>
				<td><?php echo $row['name']; ?></td>
			</tr>
			<tr>
				<td><b>E-mail:</b> </td>
				<td><?php echo $row['email']; ?></td>
			</tr>
			<tr>
				<td><b>Birthday:</b> </td>
				<td><?php echo $row['bday']; ?></td>
			</tr>
			<tr>
				<td><b>Program:</b> </td>
				<td><?php echo $row['program']; ?></td>
			</tr>
			<tr>
				<td><b>Contact:</b> </td>
				<td><?php echo $row['contact']; ?></td>
			</tr>
			<tr>
				<td><b>Gender:</b> </td>
				<td><?php echo $row['gender']; ?></td>
			</tr>
			<tr>
				<td><b>Address:</b> </td>
				<td><?php echo $row['address']; ?></td>
			</tr>
			<?php if($row['st_id'] == $sid){ ?>
			<tr>
				<td><b>Update Profile:</b> </td>
				<td><a href="st_update.php?id=<?php echo $row['st_id'];?>"><button class="editbtn">Edit Profile</button></a></td>
			</tr>
			<?php } } ?>
		</table>

</div>

<?php include "php/footerbottom.php";?>
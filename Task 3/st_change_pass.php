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
$pageTitle = "Change Password";
include "php/headertop.php";
?>
<div class="profile">
			<h3 style="font-size:18px;text-align:center;background:#1abc9c;color:#fff;padding:10px;margin:0">Update Your Profile</h3>							
				<?php
					if($_SERVER['REQUEST_METHOD'] == "POST"){
						$oldpass  = $_POST['oldpass'];
						$newpass  = $_POST['newpass'];
						$confirmpass  = $_POST['confirmpass'];
						if(empty($newpass) or empty($oldpass) or empty($confirmpass)){
							echo "<p style='color:red;text-align:center'>Field must not be empty.</p>";
						}elseif($newpass != $confirmpass){
							echo "<p style='color:red;text-align:center'>Password not matched.</p>";
						}else{
							$oldpass = md5($oldpass);
							$newpass = md5($newpass);
							$user->updatePassword($sid, $newpass, $oldpass);
						}
					}
				?>
			
			<div class="changepass fix">
				<form action="" method="post">
						<?php
						$result = $user->getuserbyid($sid);
						while($row = $result->fetch_assoc()){
						?>
					<table class="tab_one" >
						<tr>
							<td style="width:125px;"></td>
							<td width="26%">Old Password:</td>
							<td><input type="text" name="oldpass" placeholder="old password" /></td>
						</tr>
						<tr>
							<td style="width:125px;"></td>
							<td>New Password:</td>
							<td><input type="text" name="newpass" placeholder="New password" /></td>
						</tr>
						<tr>
							<td style="width:125px;"></td>
							<td>Confirm Password:</td>
							<td><input type="text" name="confirmpass" placeholder="Confirm password" /></td>
						</tr>
				
						<tr>
						<td style="width:125px;"></td>
						<td></td>
						<td colspan="2">
							<input style="background:#3498db;color:#fff;width:168px;border-radius:5px;" type="submit" name="Update" value="Update">
							</td>						
						</tr>
					</table>
						<?php } ?>
				</form>
			</div>
			<div class="back fix">
				<p style="text-align:center"><a href="st_profile.php"><button class="editbtn">Back to your Profile</button></a></p>
			</div>
</div>


<?php include "php/footerbottom.php";?>
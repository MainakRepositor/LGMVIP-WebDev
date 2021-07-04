<?php
	session_start();
	require "php/config.php";
	require_once "php/functions.php";
	$user = new login_registration_class();
	$sid = $_SESSION['sid'];
	$sname = $_SESSION['sname'];
/*
	if(isset($_REQUEST['id'])){
		$id = $_REQUEST['id'];
	}else{
		header('Location: index.php');
		exit();
	}
*/	
	if(!$user->getsession()){
		header('Location: st_login.php');
		exit();
	}
	
?>

<?php 
$pageTitle = "Update Profile";
include "php/headertop.php";
?>
 <script>
    function PreviewImage(upname, prv_id) {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementsByName(upname)[0].files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById(prv_id).src = oFREvent.target.result;
        };
    };
  
</script>

<div class="profile">
			<h3 style="font-size:18px;text-align:center;background:#1abc9c;color:#fff;padding:10px;margin:0">Update Your Profile</h3>							
				<?php
						$qry=$user->getuserbyid($sid);
						$pic=$qry->fetch_assoc();
						$piclocation=$pic['img'];
				
					if($_SERVER['REQUEST_METHOD'] == "POST"){
						//code for img
						function guid() {
								 if (function_exists('com_create_guid')) {
											return com_create_guid();
										} else {
											mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.
											$charid = strtoupper(md5(uniqid(rand(), true)));
											$hyphen = chr(45); // "-"
											$uuid = chr(123)// "{"
													. substr($charid, 0, 8) . $hyphen
													. substr($charid, 8, 4) . $hyphen
													. substr($charid, 12, 4) . $hyphen
													. substr($charid, 16, 4) . $hyphen
													. substr($charid, 20, 12)
													. chr(125); // "}"
											return $uuid;
										}
							  }
					
								
								if($_FILES["personal_image"]["name"])
								{
									  $path_parts = pathinfo($_FILES["personal_image"]["name"]);
												  $ext = $path_parts['extension'];
												  $fileName = trim(guid(), '{}') . '.' . $ext;
								}
								else{
									$fileName = $piclocation;
								}

							move_uploaded_file($_FILES['personal_image']['tmp_name'], "img/student/$fileName");

													
						//end img 
						$st_name = $_POST['st_name'];
						$st_email = $_POST['st_email'];
						$st_dept = $_POST['st_dept'];
						$st_contact  = $_POST['st_contact'];
						$st_gender  = $_POST['st_gender'];
						$st_add  = $_POST['st_add'];
						if(empty($st_name) or empty($st_email) or empty($st_contact) or empty($st_dept) or empty($st_gender) or empty($st_add)){
							echo "<p style='color:red;text-align:center'>Field must not be empty.</p>";
						}else{
							$update = $user->updateprofile($sid,$st_name,$st_email,$st_dept,$st_gender,$st_contact,$st_add,$fileName);
							if($update){
								echo "<h4 style='color:green;text-align:center'>Information Updated successfully</h4>";
							}else{
								echo "<h4 style='color:red;text-align:center;text-align:center'>Failed to update</h4>";
							}
						}
					}
				?>
			
			<div class="st_update fix">
				<form action="" method="post" enctype="multipart/form-data">
						<?php
						$result = $user->getuserbyid($sid);
						while($row = $result->fetch_assoc()){
						?>
					<table class="tab_one" >
						<tr>
							<td style="width:250px;"></td>
							<td>Photo</td>
							<td>
							<img id="logo_preview" src="img/student/<?php echo $row['img']?>" style="height:150px; width:150px; border:1px green solid;"><br><br> 
							<input type="file" name="personal_image" id="spic" onchange="PreviewImage('personal_image', 'logo_preview')" />
							</td>
						</tr>
						<tr>
							<td style="width:125px;"></td>
							<td>Name:</td>
							<td><input type="text" name="st_name" value="<?php echo $row['name'];?>"></td>
						</tr>
						<tr>
							<td style="width:125px;"></td>
							<td>E-mail:</td>
							<td><input type="email" name="st_email" value="<?php echo $row['email']; ?>"></td>
						</tr>
						<tr>
							<td style="width:125px;"></td>
							<td>Program:</td>
							<td><input type="text" name="st_dept" value="<?php echo $row['program']; ?>"></td>
						</tr>
						<tr>
							<td style="width:125px;"></td>
							<td>Contact:</td>
							<td><input type="text" name="st_contact" value="<?php echo $row['contact']; ?>"></td>
						</tr>
						<tr>
							<td style="width:125px;"></td>
							<td>Gender:</td>
							<td><input type="text" name="st_gender" value="<?php echo $row['gender']; ?>"></td>
						</tr>
						<tr>
							<td style="width:125px;"></td>
							<td>Address:</td>
							<td><input type="text" name="st_add" value="<?php echo $row['address']; ?>"></td>
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
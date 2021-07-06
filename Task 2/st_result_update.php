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
	if(isset($_REQUEST['ar'])){
		$stid = $_REQUEST['ar'];
		$name = $_REQUEST['vn'];
		$semester = $_REQUEST['seme'];
	}
?>	
<?php 
$pageTitle = "update Student Result";
include "php/headertop_admin.php";
?>
<div class="all_student fix">
		<div>
		<p style="text-align:center;color:#fff;background:purple;margin:0;padding:8px;"><?php echo "Name: ".$name."<br>ID: ".$stid."<br>Semester: " . $semester; ?></p>
		</div>
			<?php
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$subject = $_POST['umark'];
				$res = $user->update_result($stid,$subject,$semester);
				//var_dump($res);
				if($res){
					echo "<h3 style='color:green;margin:0;padding:0;text-align:center'>Marks successfully updated!</h3>";
				}else{
					echo  "<p style='color:red;text-align:center'>Failed to update data</p>";
				}
			}
		
	
		?>

		
		<form action="" method="post">
		<table class="tab_one" style="text-align:center;">
			<tr>
				<th style="text-align:center;">Subject</th>
				<th style="text-align:center;">Marks</th>
				
			</tr>
			<?php 
			$i=0;
			
				$get_result = $user->show_marks($stid,$semester);
				
				while($rows = $get_result->fetch_assoc()){
				$i++;
		?>
			<tr>
				<td><?php echo $rows['sub'];?></td>
				<td><input type="text" name="umark[<?php echo $rows['sub'];?>]" value="<?php echo $rows['marks'];?>"/></td>
				
			</tr>
			<?php } ?>
			<tr><td colspan="2"><input type="submit" value="Update Result" /></td></tr>
		</table>
	</form>
		<div class="back fix">
				<p style="text-align:center"><a href="view_result.php?vr=<?php echo $stid?>&vn=<?php echo $name?>"><button class="editbtn">go to result page</button></a></p>
			</div>
</div>
<?php include "php/footerbottom.php";?>
<?php ob_end_flush() ; ?>
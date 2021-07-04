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
$pageTitle = "Admin";
include "php/headertop_admin.php";
?>
<div class="admin_profile">
	
	<div class="section">
			<h3>Student</h3>
			<ul>
				<li><a href="admin_all_student.php">View All Student</a></li>
				<li><a href="st_result.php">Student Result</a></li>
				<li><a href="class_att.php">Attendance</a></li>
				<li><a href="student_list_pdf.php"><button>Download Student List</button></a></li>
			</ul>
	</div>
	<div class="section">
			<h3>Faculty</h3>
			<ul>
				<li><a href="admin_all_faculty.php">Faculty Details</a></li>
				<li><a href="#">Information</a></li>
				<li><a href="#">Search Faculty</a></li>
				<li><a href="faculty_list.php"><button>Download Faculty List</button></a></li>
			</ul>
	</div>
	
	</div> 

</div>

<?php include "php/footerbottom.php";?>
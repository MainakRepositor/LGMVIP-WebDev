<?php
class login_registration_class{
	public function __construct(){
		$db = new databaseConnection();
	}
	
	//All function for Student
	
	//function for student registration
	public function st_registration($st_id,$st_name,$st_pass,$st_email,$bday,$st_dept,$st_contact,$st_gender,$st_add){
		global $conn;
		$query = $conn->query("select st_id from st_info where st_id='$st_id' or email ='$st_email' ");

		$num = $query->num_rows;
		$in_sql = "INSERT INTO st_info (st_id,name,password,email,bday,program,contact,gender,address) VALUES ('$st_id','$st_name','$st_pass','$st_email','$bday','$st_dept','$st_contact','$st_gender','$st_add') ";
		if($num == 0){
			$conn->query($in_sql);
			return true;
		}else{
			return false;
		}
	}
	
	//function for student login
	public function st_userlogin($st_id, $st_pass){
		global $conn;
		$sql = "SELECT st_id,name FROM st_info WHERE st_id='$st_id' and password='$st_pass'";
		$result = $conn->query($sql);
		$userdata = $result->fetch_assoc();
		$count = $result->num_rows;
		if($count == 1){
			session_start();
			$_SESSION['st_login'] = true; 
			$_SESSION['sid'] = $userdata['st_id']; 
			$_SESSION['sname'] = $userdata['name']; 
			//$_SESSION['login_msg'] = "Login Success"; 
			return true;
		}else{
			return false;
		}
		
	}
	
	//function for get student Name 
	public function getusername($sid){
		global $conn;
		$query = $conn->query("select name from st_info where st_id='$sid'");
		$result = $query->fetch_assoc();
		echo $result['name'];
	}
	// Get all info of a specific student by Student ID
	public function getuserbyid($st_id){
		global $conn;
		$query = $conn->query("select * from st_info where st_id='$st_id'");
		return $query;
	}
	//Update Student Profile
	public function updateprofile($sid,$st_name,$st_email,$st_dept,$st_gender,$st_contact,$st_add,$file){
		global $conn;
		$query = $conn->query("update st_info set name='$st_name',email='$st_email',program='$st_dept',gender='$st_gender',contact='$st_contact', address='$st_add',img='$file' where st_id='$sid'");
		return true;
	}
	
	//Change Student Password
	public function updatePassword($sid, $newpass, $oldpass){
		global $conn;
		$query = $conn->query("select st_id from st_info where st_id='$sid' and password='$oldpass' ");
		$count = $query->num_rows;
		if($count == 0){
			return print("<p style='color:red;text-align:center'>old password not exist.</p>");
		}else{
			$update = $conn->query("update st_info set password='$newpass' where st_id='$sid' ");
			return print("<p style='color:green;text-align:center'>Password changed successfully.</p>");
		}
	}
	//Session Unset for Student info //Log out option
	public function st_logout(){
		$_SESSION['st_login'] = false;
		unset($_SESSION['sid']); 
		unset($_SESSION['sname']);
		unset($_SESSION['st_login']);
		
		//session_destroy();
	}
	public function getsession(){
		return @$_SESSION['st_login'];
	}

	public function fct_registration($name,$uname, $pass,$email, $bday,$gender,$edu,$contact,$address){
		global $conn;
		$fct = $conn->query("select id from faculty where username='$uname' ");
		$count = $fct->num_rows;
		if($count == 0){
			$sql = "insert into faculty(name,username,password,email,birthday,gender,education,contact,address) values('$name','$uname','$pass','$email','$bday','$gender','$edu','$contact','$address')";
			$result = $conn->query($sql);
			return true;
		}else{
			return false;
		}
	}
	//get faculty 
	public function get_faculty_by_username($uname){
		global $conn;
		$sql = "select * from faculty where username='$uname'";
		$result = $conn->query($sql);
		return $result;
	}
	public function get_faculty(){
		global $conn;
		$sql = "select * from faculty order by id ASC";
		$result = $conn->query($sql);
		return $result;
	}
	//login for faculty 
	public function fct_login($uname, $pass){
		global $conn;
		$sql = "select id,username,name from faculty where username='$uname' and password='$pass' ";
		$result = $conn->query($sql);
		$count = $result->num_rows;
		$fctinfo = $result->fetch_assoc();
		if($count == 1){
			session_start();
			$_SESSION['fct_login'] = true;
			$_SESSION['f_id'] = $fctinfo['id'];
			$_SESSION['f_uname'] = $fctinfo['username'];
			$_SESSION['f_name'] = $fctinfo['name'];
			return true;
		}else{
			return false;
		}
	}
	public function faculty_logout(){
		$_SESSION['fct_login'] = false;
		unset($_SESSION['f_id']);
		unset($_SESSION['f_uname']);
		unset($_SESSION['f_name']);
		unset($_SESSION['fct_login']);
	}
	public function get_faculty_session(){
		return @$_SESSION['fct_login'];
	}
	

	
	//for getting All student infomation 
	public function get_all_student(){
		global $conn;
		$sql = "select * from st_info order by st_id ASC";
		$query = $conn->query($sql);
		return $query;
	}
	//search student
	//Search Query
	public function search($query){
		global $conn;
		$result = $conn->query("SELECT * FROM st_info WHERE (st_id LIKE '%".$query."%'
							OR name LIKE '%".$query."%'
								OR contact LIKE '%".$query."%'
									OR email LIKE '%".$query."%') order by st_id");
		return $result;
	}
	
	//Admin log in function 
	public function admin_userlogin($username, $password){
		global $conn;
		$sql  = "select id,username from admin where username='$username' and password='$password'";
		$result = $conn->query($sql);
		$admin_info = $result->fetch_assoc();
		$count = $result->num_rows;
		if($count == 1){
			session_start();
			$_SESSION['admin_login'] = true;
			$_SESSION['admin_id'] = $admin_info['id'];
			$_SESSION['admin_name'] = $admin_info['username'];
			return true;
		}else{
			return false;
		}
		
	}
	public function get_admin_session(){
		return @$_SESSION['admin_login'];
	}
	//admin logout 
	public function admin_logout(){
		$_SESSION['admin_login'] = false;
		unset($_SESSION['admin_id']);
		unset($_SESSION['admin_name']);
		unset($_SESSION['admin_login']);
	}
	//delete student
	public function delete_student($st_id){
		global $conn;
		$sql = "delete from st_info where st_id='$st_id' ";
		$result = $conn->query($sql);
		if($result){
			return true;
		}else{
			return false;
		}
	}
	//attendance system
	
	public function attn_student(){
		global $conn;
		$sql = "select * from at_student";
		$result = $conn->query($sql);
		return $result;
	}
	public function add_attn_student($name,$stid){
		global $conn;
		$sql = "insert into at_student(name,st_id) values('$name','$stid')";
		$result = $conn->query($sql);
		
		$sql2 = "insert into attn(st_id) values('$stid')";
		$result = $conn->query($sql2);
		return $result;
	}
	public function insertattn($cur_date,$atten = array()){
		global $conn;
		$sql = "select distinct at_date from attn";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){
			$db_date = $row['at_date'];
			if($cur_date == $db_date){
				return false;
			}
		}
		foreach($atten as $key =>$attn_value ){
			if($attn_value == "present"){
				$sql = "insert into attn(st_id,atten,at_date) values('$key','present','$cur_date')";
				$att_res = $conn->query($sql);
			}elseif($attn_value == "absent"){
				$sql = "insert into attn(st_id,atten,at_date) values('$key','absent','$cur_date')";
				$att_res = $conn->query($sql);
			}
		}
		if($att_res){
			return true;
		}else{
			return false;
		}
		
	}
	public function delete_atn_student($at_id){
		global $conn;
		$res = $conn->query("delete from at_student where id = '$at_id' ");
		return $res;
	}
	public function get_attn_date(){
		global $conn;
		$res = $conn->query("select distinct at_date from attn ");
		return $res;
		
	}
	public function attn_all_student($date){
		global $conn;
		$res = $conn->query("select at_student.name, attn.*
			from at_student
			inner join attn
			on at_student.st_id = attn.st_id
			where at_date = '$date' ");
		return $res;
	}
	public function update_attn($date,$atten){
		global $conn;
		foreach($atten as $key =>$attn_value ){
			if($attn_value == "present"){
				$sql = "update attn set atten='present' where st_id='$key' and at_date='$date' ";
				$att_res = $conn->query($sql);
			}elseif($attn_value == "absent"){
				$sql = "update attn set atten='absent' where st_id='$key' and at_date='$date' ";
				$att_res = $conn->query($sql);
			}
		}
		if($att_res){
			return true;
		}else{
			return false;
		}
	}
	//grading system
	public function add_marks($stid,$subject,$semester,$marks){
		global $conn;
		$qry = "select * from result where st_id='$stid' and sub='$subject' and semester='$semester' ";
		$query = $conn->query($qry);
		$count = $query->num_rows;
		if($count>0){
			return false;
		}else{
		$sql = "insert into result(st_id,marks,sub,semester) values('$stid','$marks','$subject','$semester')";
		$result = $conn->query($sql);
		return $result;
		}
	}
	//show marks
	public function show_marks($stid,$semester){
		global $conn;
		$result = $conn->query("select * from result where st_id='$stid' and semester='$semester' ");
		$count = $result->num_rows;
		if($count>0){
			return $result;
		}else{
			return false;
		}
		
	}
	//update student result
	public function update_result($stid,$subject = array(),$semester){
		global $conn;
		foreach($subject as $key =>$mark ){
			$sql = "update result set marks='$mark' where st_id='$stid' and semester='$semester' and sub='$key' ";
				$result = $conn->query($sql);	
		}
		if($result){
			return true;
		}else{
			return false;
		}
	}
	public function view_cgpa($stid){
		global $conn;
		$sql = "select * from result where st_id='$stid'";
		$result = $conn->query($sql);
		return $result;
	}
	
	
	
	
};



?>
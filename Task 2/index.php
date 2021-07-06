<?php
ob_start ();
session_start();
require "php/config.php";
require_once "php/functions.php";
$user = new login_registration_class();
if($user->get_admin_session()){
	header('Location: admin.php');
	exit();
}
?>

<?php
	$pageTitle = "Admin Login";
?>
<?php include "header.php"; ?>

	<div class="loginform fix">
		<div class="msg "><h3><i class="fa fa-user" aria-hidden="true"></i>  Admin login</h3></div>
		<div class="access">
			<?php
					if($_SERVER['REQUEST_METHOD'] == "POST"){
						$username	  = $_POST['username'];
						$password = $_POST['password'];

						if(empty($username) or empty($password)){
							echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";
						}else{
							$password = md5($password);
							$login = $user->admin_userlogin($username, $password);
							if($login){
								header('Location: admin.php');
							}else{
								echo "<p style='color:red;text-align:center'>Incorrect username or password</p>";
							}
						}
					}
				?>
			<form action="" method="post">
				<input type="text" name="username" placeholder="Username" />
				<input type="password" name="password" placeholder="Password" />
				<input type="submit" value="Login" />
			</form>
		</div>
	</div>
					
<?php include "footer.php"; ?>		
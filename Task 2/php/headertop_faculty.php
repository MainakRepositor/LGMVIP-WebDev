
<!Doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo $pageTitle; ?></title>
        <meta name="description" content="Student Management system">
		<meta name="author" content="Mainak Chaudhuri">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="fonts/stylesheet.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <header class="container header_area" >
			<div id="sticker">
				<div class="head">
					<a href="#               "><div class="logo fix">
						<img src="img/logo.png" alt="" />
					</div></a>
					<div class="uniname fix">
					<h2>Student Management System</h2>
					</div>
				</div>
				<div class="menu ">
					<div class="dateshow fix"><p><?php echo "Date : ".date("d M Y"); ?></p></div>
					<ul>
						<?php if($user->getsession()){ ?>
						<li><a href="st_logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
						<li><a href="st_change_pass.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Change Password</a></li>
						<li><a href="st_result.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Result</a></li>
						<li><a href="st_profile.php"><i class="fa fa-user" aria-hidden="true"></i>
						<?php echo $sid; ?>
						</a></li>
						
						<?php } ?>
					</ul>

				</div>
			</div>
		</header>
		<div class="info container fix">

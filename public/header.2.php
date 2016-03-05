<?php require_once("../includes/session.php"); ?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Mobshop</title>
		<meta name="description" content="Mobshop" />
		<meta name="keywords" content="on scroll, animate, header, transition, css3, 3d, effect, inspiration" />
		<meta name="author" content="Mobshop" />
		<link rel="stylesheet" type="text/css" href="css/login_signup.css">

		<link rel="stylesheet" type="text/css" href="css/normalize_header.css" />
		<link rel="stylesheet" type="text/css" href="css/component_header.css" />

		<!--<script src="js/modernizr.custom.js"></script> -->
	</head>
	<?php $os = array("android", "windows", "blackberry"); ?>
	<?php 
		if(isset($_GET['os']))
		{
			$thisPage =$_GET['os'];
		}
		else
		{
			$thisPage = "login-register";
		
		}
		 ?>
	<?php 

		if(isset($_P))

	?>
	<body style="overflow-y:visible;" >
		<div class="container_header">
			<!-- the header that will be animated by adding the respective state class to it -->
			<header id="ha-header" class="ha-header ha-header-large">
				<div class="ha-header-perspective" style="bottom:235px">
					<div class="ha-header-front" style="border-bottom: 6px solid #123456;">
						<a href="index.php"><h1><span>MOBSHOP</span></h1></a>
						<nav>
							<?php if($thisPage=="android")
							{
								echo "<a id = \"selected\" href = 'product.php?os=".$os[0] ."'>ANDROID</a>"; 
							}
							else
							{
								echo "<a href = 'product.php?os=".$os[0] ."'>ANDROID</a>"; 
							}
							?>
							<?php if($thisPage=="windows")
							{
								echo "<a id = \"selected\" href = 'product.php?os=".$os[1] ."'>WINDOWS</a>"; 
							}
							else
							{
								echo "<a href = 'product.php?os=".$os[1] ."'>WINDOWS</a>"; 
							}
							?>
							<?php if($thisPage=="blackberry")
							{
								echo "<a id = \"selected\" href = 'product.php?os=".$os[2] ."'>BLACKBERRY</a>"; 
							}
							else
							{
								echo "<a href = 'product.php?os=".$os[2] ."'>BLACKBERRY</a>"; 
							}
							?>
							

							<?php 
							 if(isset($_SESSION['state']))
							 {
							 	if($_SESSION['username'] == "admin")
							 	{
							 		echo "<a id=\"admin\" href = '../admin/brand.php'>ADMIN CONTROLS</a>";
							 	}
							 	echo "<span class=\"usermenu\" href=\"#\" style=\"font-size: large;\">HI, ". strtoupper($_SESSION['username']) . " &#9662
									  <ul class=\"dropdown\">
									  <li><a href=\"logout.php\">Logout</a></li>
									  </ul></span>";
							 }
							 else
							 {
								echo "<input type=\"button\" id=\"login\" class=\"login-button-header\" value=\"LOGIN\" name=\"login\">
								     <input type=\"button\" class=\"login-button-header\" value=\"SIGN UP\" id=\"signup\">";
							}?>
						</nav>
						<script type="text/javascript">
    						document.getElementById("login").onclick = function () {
        						location.href = "login_new.php";
    						};
    						document.getElementById("signup").onclick = function () {
        						location.href = "signup_new.php";
    						};
						</script>
					</div>
				</div>
			</header>
			</div>
			<div class="content">
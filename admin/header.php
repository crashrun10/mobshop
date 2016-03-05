<?php require_once("../includes/session.php") ?>
<?php 
if($_SESSION['state']!=='admin_loggedin')
	{
		redirect_to("../public/index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../public/css/admin.css" />
</head>
<body>
	<div id="wrapper">
		<div id="header">
		<h1>MOBSHOP - ADMIN CONTROL PANEL</h1>
		<div id="link">
		<a href = "../public/index.php">Go back to website</a>
		</div>
		</div>
		<div id = "navigation">
			<ul id="nav">
				<li><a href = "brand.php">Brand</a></li>
				<li><a href="product.php">Product</a></li>
				<li><a href="db_brand.php">DB - Brand</a></li>
				<li><a href="db_product.php">DB - Product</a></li>
			</ul>
		</div>
		<div id="content">
	

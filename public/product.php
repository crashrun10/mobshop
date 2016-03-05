<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php $thisPage = $_GET['os']; ?>
<link rel="stylesheet" type="text/css" href="css/1.css">
<link rel="stylesheet" type="text/css" href="css/2.css">
<link rel="stylesheet" type="text/css" href="css/3.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/prettyPhoto.css" rel="stylesheet">
<link href="css/price-range.css" rel="stylesheet">
<link href="css/animate.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">

<?php include_once("header (2).php"); ?>
<?php

	$os = $_GET['os'];
	if(isset($_GET['bid']))
	{
		$bid = $_GET['bid'];
		$products_query  = "SELECT * ";
		$products_query .= "FROM products ";
		$products_query .= "WHERE brand_id = '{$bid}' ";
		$products_query .= "AND os = '{$os}'";
		$products_result = mysqli_query($connection, $products_query);
	}
	else
	{
		$products_query  = "SELECT * ";
		$products_query .= "FROM products ";
		$products_query .= "WHERE os = '{$os}'";
		$products_result = mysqli_query($connection, $products_query);
	}
	
	
?>
 <style>
    	.dynamic_cart_button{
    		width: 3px;
    height: 3px;
    text-decoration: none;
    color: #000;
    font-style: normal;
    border: 2px solid #fff;
    border-radius: 50px;
    background-color: #fff;
    	}
    </style>
<br /><br />
<?php if(isset($_SESSION['state']))
{
	echo "<a href=\"cart.php\" class=\"btn btn-default add-to-cart\" style=\"bottom: 120px;
   		  position: relative;left: 1100;width: 90px;\">
	      Cart &nbsp<b class=\"dynamic_cart_button\">";
	      if(isset($_SESSION['products']))
	      {
	      	echo count($_SESSION['products']); 
	      }
	      else
	      {
	      	echo "0";
	      }
		 echo "</b></a>"; } ?>
<div class="container">
			<div class="row" style="position: relative; bottom: 100px;">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
								<?php 
									$brand_query  = "SELECT * ";
									$brand_query .= "FROM brands ";
									$brand_query .= "WHERE os1='{$os}' ";
									$brand_query .= "OR os2='{$os}' ";
									$brands_result = mysqli_query($connection, $brand_query);
									while($brand = mysqli_fetch_assoc($brands_result))
									{
											
											echo "<li><a href=\"product.php?os=" . $os . "&bid=" . $brand['brand_id'] . "\">". $brand['brand_name'] . "</a></li>";
										
									} ?>
									
								</ul>
							</div>
						</div><!--/brands_products-->
						
						
					
					</div>
				</div>
				
						 
						<div class="col-sm-9 padding-right">
						<div class="features_items"><!--features_items-->
							<h2 class="title text-center">Features Items</h2>
				<?php
					
					while($products = mysqli_fetch_assoc($products_result))
					{
						echo 	"<div class=\"col-sm-4\">
								<div class=\"product-image-wrapper\">
									<div class=\"single-products\">
											<div class=\"productinfo text-center\">
												<a href=\"product_detail.php?os=" . $os ."&pid=" . $products['product_id'] .
												"\"><img src=\"images/product/" . $products['product_img'] . "\" alt=\"\" style=\"width:125px; height:250px;\" /></a>
												<h2>Rs." . $products['price'] . "</h2>
												<p style=\"font-weight:bold;\">" . $products['model'] . "</p>
												<form method=\"POST\" action=\"add_to_cart_processing.php\">
												<input type=\"hidden\" name=\"os\" value=\"".$_GET['os'] . "\">";
												if(isset($_SESSION['products']))
												{
													if(in_array($products['product_id'], $_SESSION['products']))
													{echo "<button type=\"button\" class=\"btn btn-fefault cart\" 
														  style=\"color: #fff;background-color: #33A52C;\"
													 	  value=\"".$products['product_id']."\">
														  <i class=\"fa fa-shopping-cart\"></i> IN CART
														  </button>";}
														  else{
												     echo "<button type=\"submit\" name=\"add_to_cart\" class=\"btn btn-fefault cart\" value=\"".$products['product_id']."\">
															<i class=\"fa fa-shopping-cart\"></i>Add to cart
															</button>";
												}
												}
												else
												{
												     echo "<button type=\"submit\" name=\"add_to_cart\" class=\"btn btn-fefault cart\" value=\"".$products['product_id']."\">
														   <i class=\"fa fa-shopping-cart\"></i>Add to cart
														   </button>";
												}
											
									echo "</form>
											</div>
										
									</div>
								</div>
							</div>";


					}
					?>
				</div>		
					
			</div>
			</div>
			</div>
<?php include_once("footer.php"); ?>

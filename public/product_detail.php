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

<?php 

	$pid = $_GET['pid'];
	$query  = "SELECT * ";
	$query .= "FROM products ";
	$query .= "WHERE product_id = '{$pid}'";
	$result = mysqli_query($connection, $query);
	$product = mysqli_fetch_assoc($result);

	$brand_name_query  = "SELECT * ";
	$brand_name_query .= "FROM brands ";
	$brand_name_query .= "WHERE brand_id = '{$product['brand_id']}'";
	$brand_name_query_result = mysqli_query($connection, $brand_name_query);
	$brand = mysqli_fetch_assoc($brand_name_query_result);

?>
<?php if(isset($_SESSION['state']))
{
	echo "<a href=\"cart.php\" class=\"btn btn-default add-to-cart\" style=\"bottom: 115px;
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
<section style="    position: relative; bottom: 100px;">
		<div class="container">
			<div class="row">
			
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="images/product/<?php echo $product['product_img']; ?>" alt="" width="329px" height="380px" />
							</div>
							
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<h2><?php echo $product['model']; ?></h2>
								<span>
									<span>Rs. <?php echo $product['price']; ?></span>
									<br />
									<form method="POST" action="add_to_cart_processing.php">
									<?php echo "<input type=\"hidden\" name=\"pid\" value=\"".$_GET['pid'] . "\">"; ?>
									<?php echo "<input type=\"hidden\" name=\"os_d\" value=\"".$_GET['os'] . "\">"; ?>
									<?php echo "<input type=\"hidden\" name=\"os\" value=\"".$_GET['os'] . "\">"; ?>
									<?php if(isset($_SESSION['products']))
												{
													if(in_array($product['product_id'], $_SESSION['products']))
													{echo "<button type=\"button\" class=\"btn btn-fefault cart\" 
														  style=\"color: #fff;background-color: #33A52C;\"
													 	  value=\"".$product['product_id']."\">
														  <i class=\"fa fa-shopping-cart\"></i> IN CART
														  </button>";}
														  else{
												     echo "<button type=\"submit\" name=\"add_to_cart\" class=\"btn btn-fefault cart\" 
												     value=\"".$product['product_id']."\">
															<i class=\"fa fa-shopping-cart\"></i>Add to cart
															</button>";
												}
												}
												else
												{
												     echo "<button type=\"submit\" name=\"asdf\" class=\"btn btn-fefault cart\"
												      value=\"".$product['product_id']."\">
														   <i class=\"fa fa-shopping-cart\"></i>Add to cart
														   </button>";
												} ?>
									<!--<button type="submit" class="btn btn-fefault cart" value="Add To Cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>--></form> 
								</span>
								<p><b>Brand:</b> <?php echo $brand['brand_name']; ?> </p>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					
				
					
				</div>
			</div>
		</div>
	</section>
	


<div class="productSpecs specSection" style="position: relative;bottom: 80px;">
			<h3 class="sectionTitle">
                    Specifications of <?php echo $product['model']; ?>
            </h3>
						<table cellspacing="0" class="specTable">
							<tr>
								<th class="groupHead" colspan="2">GENERAL FEATURES</th>
							</tr>
								<tr>
										<td class="specsKey">Brand</td>
									<td class="specsValue">
                                                <?php echo $brand['brand_name']; ?>
									</td>
								</tr>
								<tr>
										<td class="specsKey">Model Name</td>
									<td class="specsValue">
                                                <?php echo $product['model']; ?>
									</td>
								</tr>
								<tr>
										<td class="specsKey">Touch Screen</td>
									<td class="specsValue">
                                                <?php echo $product['touchscreen']; ?>
									</td>
								</tr>
						</table>
						<table cellspacing="0" class="specTable">
							<tr>
								<th class="groupHead" colspan="2">Camera</th>
							</tr>
								<tr>
										<td class="specsKey">Rear Camera</td>
									<td class="specsValue">
                                                <?php echo $product['rear_cam']; ?>
									</td>
								</tr>
								<tr>
										<td class="specsKey">Front Facing Camera</td>
									<td class="specsValue">
                                                <?php echo $product['front_cam']; ?>
									</td>
								</tr>
						</table>
						<table cellspacing="0" class="specTable">
							<tr>
								<th class="groupHead" colspan="2">Display</th>
							</tr>
								<tr>
										<td class="specsKey">Resolution</td>
									<td class="specsValue">
                                                <?php echo $product['resolution']; ?>
									</td>
								</tr>
								<tr>
										<td class="specsKey">Type</td>
									<td class="specsValue">
                                               <?php echo $product['screen_type']; ?>
									</td>
								</tr>
								<tr>
										<td class="specsKey">Size</td>
									<td class="specsValue">
                                                <?php echo $product['screen_size']; ?>
									</td>
								</tr>
						</table>
						<table cellspacing="0" class="specTable">
							<tr>
								<th class="groupHead" colspan="2">Dimensions</th>
							</tr>
								<tr>
										<td class="specsKey">Weight</td>
									<td class="specsValue">
                                                <?php echo $product['weight']; ?>
									</td>
								</tr>
						</table>
						<table cellspacing="0" class="specTable">
							<tr>
								<th class="groupHead" colspan="2">Warranty</th>
							</tr>
								<tr>
										<td class="specsKey">Warranty Summary</td>
									<td class="specsValue">
                                                <?php echo $product['warranty']; ?>
									</td>
								</tr>
						</table>
						<table cellspacing="0" class="specTable">
							<tr>
								<th class="groupHead" colspan="2">Battery</th>
							</tr>
								<tr>
										<td class="specsKey">Type</td>
									<td class="specsValue">
                                                <?php echo $product['battery']; ?>
									</td>
								</tr>
						</table>
						<table cellspacing="0" class="specTable">
							<tr>
								<th class="groupHead" colspan="2">Memory and Storage</th>
							</tr>
								<tr>
										<td class="specsKey">Memory</td>
									<td class="specsValue">
                                                <?php echo $product['ram']; ?> 
									</td>
								</tr>
								<tr>
										<td class="specsKey">Internal</td>
									<td class="specsValue">
                                               <?php echo $product['internal_memory']; ?>
									</td>
								</tr>
						</table>
						<table cellspacing="0" class="specTable">
							<tr>
								<th class="groupHead" colspan="2">Platform</th>
							</tr>
								<tr>
										<td class="specsKey">OS</td>
									<td class="specsValue">
                                                <?php echo $product['os']; ?>
									</td>
								</tr>
								<tr>
										<td class="specsKey">OS Version</td>
									<td class="specsValue">
                                                <?php echo $product['os_version']; ?>
									</td>
								</tr>
								<tr>
										<td class="specsKey">Processor</td>
									<td class="specsValue">
                                                <?php echo $product['processor']; ?>
									</td>
								</tr>
						</table>
						<table cellspacing="0" class="specTable">
							<tr>
								<th class="groupHead" colspan="2">Other</th>
							</tr>
								<tr>
										<td class="specsKey">Inbox Contents</td>
									<td class="specsValue">
                                                <?php echo $product['inbox']; ?>
									</td>
								</tr>
								<tr>
										<td class="specsKey">other Features</td>
									<td class="specsValue">
                                                <?php echo $product['other_features']; ?>
									</td>
								</tr>
						</table>
		</div>
<?php include_once("footer.php"); ?>
		</body>
</html>
<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
</head><!--/head-->
<?php include_once("header (2).php"); ?>
<?php 

	if(isset($_SESSION['state']))
	{
		{
			$user_id = $_SESSION['user_id'];
			$query  = "SELECT * ";
			$query .= "FROM cart ";
			$query .= "WHERE user_id = '{$user_id}'";
			$result = mysqli_query($connection, $query);
			if($result)
			{
				$total = 0;
				echo "<section id=\"cart_items\">
					<div class=\"container\">
						
						<div class=\"table-responsive cart_info\">
							<table class=\"table table-condensed\">
								<thead>
									<tr class=\"cart_menu\">
										<td class=\"image\">Item</td>
										<td class=\"description\"></td>
										<td class=\"price\">Price</td>
										<td class=\"total\">Total</td>
										<td></td>
									</tr>
								</thead>
								<tbody>";
				while($cart = mysqli_fetch_assoc($result))
				{	
					//$pid = $_GET['pid'];
					$product_query  = "SELECT * ";
					$product_query .= "FROM products ";
					$product_query .= "WHERE product_id = '{$cart['p_id']}'";
					$product_result = mysqli_query($connection, $product_query);
					$product = mysqli_fetch_assoc($product_result);			
					echo "<tr>
						<td class=\"cart_product\">
							<img src=\"images/product/" . $product['product_img'] . "\" style=\"width:60; height:90px;\" alt=\"\">
						</td>
						<td class=\"cart_description\">
							<h4><a href=\"product_detail.php?os=" . $product['os'] . "&pid=" . $product['product_id'] ."\" >"
							. $product['model'] . "</a></h4>
						</td>
						<td class=\"cart_price\">
							<p>RS." . $product['price'] . "</p>
						</td>
						<td class=\"cart_delete\">
						<form method=\"POST\" action=\"delete_from_cart.php\">
							<button type=\"submit\" name=\"remove\" value=\"" . $product['product_id'] . 
							"\"class=\"cart_quantity_delete\" style=\"background-color:red; border-color:red;\">
							<i class=\"fa fa-times\" style=\"color: #fff;background-color: red;border-color: red;\"></i>
							</button></form>
						</td>
					</tr>";
					$total= $total + $product['price'];
									
				}	

				echo 				"</tbody>
							</table>
						</div>
					</div>
				</section> <!--/#cart_items-->

				<section id=\"do_action\">
					<div class=\"container\">
						<div class=\"heading\">
							
						</div>
						
							<div class=\"col-sm-6\">
								<div class=\"total_area\">
									<ul>
										<li>Cart Sub Total <span>Rs." . $total . "</span></li>
										<li>Shipping Cost <span>Free</span></li>
										<li>Total <span>Rs." . $total ."</span></li>
									</ul>
										
										<a class=\"btn btn-default check_out\" href=\"\">Check Out</a>
								</div>
							</div>
						</div>
					</div>
				</section><!--/#do_action-->

				
				
			</div>";
			 include_once("footer.php");

			    
			echo "</body>
				</html>";
			}
			else
			{

			}
		}
	}
	else
	{
		redirect_to("login_new.php");
	}

?>

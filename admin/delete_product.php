<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/connection.php") ?>
<?php require_once("../includes/functions.php") ?>
<?php include_once("/header.php"); ?>

<?php
if($_SESSION['state']!=='admin_loggedin')
{
	redirect_to("../public/index.php");
}
if(isset($_GET['pid']))
{
	$id = $_GET['pid'];
	$query  = "DELETE ";
	$query .= "FROM products ";
	$query .= "WHERE product_id = '{$id}'";
	$result = mysqli_query($connection, $query);
	if($result)
	{
		redirect_to("db_product.php");
	}
}
?>

</div>
</body>
</html>
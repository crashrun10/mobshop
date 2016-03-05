<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/connection.php") ?>
<?php require_once("../includes/functions.php") ?>
<?php include_once("/header.php"); ?>

<?php
if($_SESSION['state']!=='admin_loggedin')
	{
		redirect_to("../public/index.php");
	}
if(isset($_GET['bid']))
{
	$id = $_GET['bid'];
	$query  = "DELETE ";
	$query .= "FROM brands ";
	$query .= "WHERE brand_id = '{$id}'";
	$result = mysqli_query($connection, $query);

	if($result)
	{
		redirect_to("db_brand.php");
	}
	else
	{
		echo "Cannot delete this brand because products exist in database under this brand";
	}
}

?>

</div>
</body>
</html>
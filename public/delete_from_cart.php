<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php 

	$user_id = $_SESSION['user_id'];
	$pid = $_POST['remove'];
	$query  = "DELETE FROM cart ";
	$query .= "WHERE user_id = '{$user_id}' ";
	$query .= "AND p_id = '{$pid}'";
	$result = mysqli_query($connection, $query);
	$key = array_search($pid, $_SESSION['products']) ;
		unset($_SESSION['products'][$key]);
	if($result)
	{
		redirect_to("cart.php");
	}

?>
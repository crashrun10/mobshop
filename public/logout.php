<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/connection.php") ?>
<?php require_once("../includes/functions.php"); ?>
<?php 
	//session_start();
	//$_SESSION = array();
	$query  = "DELETE ";
	$query .= "FROM cart ";
	$query .= "WHERE user_id= '{$_SESSION['user_id']}'";
	$result = mysqli_query($connection, $query);
	session_destroy();
	redirect_to("index.php");

?>
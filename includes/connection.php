<?php 

	define("DB_SERVER", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "asdf");
	define("DB_NAME", "mobshop");

	//Creating a DB connection
	$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

	//Test if connection successfull
	if(mysqli_connect_errno())
	{
		die("Database Connection Failed ".
			mysqli_connect_error().
				" (". mysqli_connect_errno() . ")"
			);
	}
 ?>
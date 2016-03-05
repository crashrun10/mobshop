<?php

	$errors = array();

	function fieldname_as_text($fieldname)
	{
		$fieldname = str_replace("_", " ", $fieldname);
		$fieldname = ucfirst($fieldname);
		return $fieldname;
	}

	// * presence
	// use trim() so empty spaces don't cpouunt
	// use  === to avoid false positive
	// empty would consider "0" to be empty
	function has_presence($value)
	{
		return isset($value) && $value !== "";
	}	

	function validate_presences($required_fields)
	{
		global $errors;
		foreach ($required_fields as $field)
		{
			$value = trim($_POST[$field]);
            if(!has_presence($value))
            {
            	$errors[$field] = fieldname_as_text($field) . " can't be blank!";
            	$errors_signup[$field] = fieldname_as_text($field) . " can't be blank!";
            }
		}	
	}

	// * string length
	//min length
	function has_min_length($value, $min)
	{
		return strlen($value) >= $min;
	}

	function validate_min_length($fields_with_min_lengths)
	{
		global $errors;
		// Expects an assoc. array
		foreach($fields_with_min_lengths as $field => $min)
		{
			$value = trim($_POST[$field]);
			if(!has_min_length($value, $min))
			{
				$errors[$field] = fieldname_as_text($field) . " is too short";
			}
		}
	}

	// Email validate
	function validate_email($email)
	{
		global $errors;
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$errors[$email] = "Enter valid email id";
			$errors_signup[$email] = "Enter valid email id";
		}
	}

	// Check whether account with email already exists
	function email_exists($email, $con)
	{
		global $errors_signup;
		$query  = "SELECT id ";
		$query .= "FROM users ";
		$query .= "WHERE email_id='$email'";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result) == 1)
		{
			$errors_signup[$_POST["email"]] = "Account with this Email Id already exists.";
		}
	}


	function mobile_no_exists($mob_no, $con)
	{
		global $errors_signup;
		$result = mysqli_query($con, "SELECT id FROM users WHERE mob_no='$mob_no'");
		if(mysqli_num_rows($result) == 1)
		{
			$errors_signup[$_POST["mob_no"]] = "Account with this mobile no. already exists.";
		}
	}

	function brand_exists($brand, $con)
	{
		global $errors;
		$query  = "SELECT brand_id ";
		$query .= "FROM brands ";
		$query .= "WHERE brand_name='$brand'";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result) == 1)
		{
			$errors[$_POST["brand"]] = "This brand alredy exists in the Database.";
		}
	}

	function model_exists($model, $con)
	{
		global $errors;
		$query  = "SELECT product_id ";
		$query .= "FROM products ";
		$query .= "WHERE model='$model'";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result) == 1)
		{
			$errors[$_POST["model"]] = "This model alredy exists in the Database.";
		}
	}
?>
<?php

	function redirect_to($new_location)
	{
		header("Location: " . $new_location);
		exit;
	}

	function mysql_prep($string)
	{
		global $connection;

		$escaped_string = mysqli_real_escape_string($connection, $string);
		return $escaped_string;
	}

	function form_errors($errors = array())
	{
		$output = "";
		if(!empty($errors))
		{
			$output .= "<div class=\"error\">";
			$output .= "<ul>";
			foreach ($errors as $key => $error) 
			{
				$output .= "<li style = \"color:red;\">";
					$output .= htmlentities($error);
					$output .= "</li>";
			}
			$output .= "</ul>";
			$output .= "</div>";
		}
		return $output;
	}

	function confirm_query($result_set)
	{
		if(!$result_set)
		{
			die("Database query failed.");
		}
	}

	function find_user_by_email($email)
	{
		global $connection;

		$safe_email = mysql_prep($email);

		$query  = "SELECT * ";
		$query .= "FROM users ";
		$query .= "WHERE email_id = '{$safe_email}'";
		$query .= "LIMIT 1";

		$user_set = mysqli_query($connection, $query);

		confirm_query($user_set);

		if($user = mysqli_fetch_assoc($user_set))
		{
			return $user;
		}
		else
		{
			return null;
		}
	}

	function password_check($password, $retrieved_password)
	{
		
		if(md5($password) === $retrieved_password)
		{
			return true;
		}
		else
		{
			return false;
		}
	}	

	function attempt_login($email, $password)
	{
		global $connection;
		$user = find_user_by_email($email);
		if($user)
		{
			// found user, now check password
			if(password_check($password, $user["password"]))
			{
				// password matches
				return $user;
			}
			else
			{
				// password doesn't match
				return false;
			}
		}
		else
		{
			// user not found
			return false;
		}
	}

	function auto_increment_value($connection, $table_name)
	{
			$query  = "SELECT `AUTO_INCREMENT` ";
			$query .= "FROM INFORMATION_SCHEMA.TABLES ";
			$query .= "WHERE TABLE_SCHEMA = 'mobshop' ";
			$query .= "AND TABLE_NAME = '{$table_name}'";
			$result = mysqli_query($connection, $query);
			$value = mysqli_fetch_assoc($result);
			return $value['AUTO_INCREMENT'];
	}
	
	function select_all_from_table($connection, $table_name, $id)
	{
		$query  = "SELECT * ";
		$query .= "FROM '{$table_name}' ";
		$query .= "WHERE product_id='{$id}'";
		$result = mysqli_query($connection, $query);
		$values = mysqli_fetch_assoc($result);
		return $values;
	}
	
	function update_product_field($connection, $field_name, $value, $pid)
	{
		$query  = "UPDATE products ";
		$query .= "SET $field_name = '{$value}' ";
		$query .= "WHERE product_id = '{$pid}'";
		$result = mysqli_query($connection, $query);
		if(!$result)
		{
			redirect_to("../includes/public/index.php");
		}
	}

	function update_brand_field($connection, $field_name, $value, $bid)
	{
		$query  = "UPDATE brands ";
		$query .= "SET $field_name = '{$value}' ";
		$query .= "WHERE brand_id = '{$bid}'";
		$result = mysqli_query($connection, $query);
		if(!$result)
		{
			redirect_to("../includes/public/index.php");
		}
	}

	function add_to_cart($connection, $user_id, $pid)
	{
		// check given product id is numeric or not
		if(is_numeric($pid))
		{
			// escape real strings
			$safe_pid = mysql_prep($pid);
			// check if product with $pid exists
			$product_exist_query  = "SELECT * ";
			$product_exist_query .= "FROM products ";
			$product_exist_query .= "WHERE product_id = '{$safe_pid}'";
			$result = mysqli_query($connection, $product_exist_query);
			// if product exist add user_id, pid, product price in cart table
			if($result)
			{
				$product  = mysqli_fetch_assoc($result);
				$add_to_cart_query  = "INSERT INTO cart (";
				$add_to_cart_query .= "user_id, p_id, price";
				$add_to_cart_query .= ") VALUES (";
				$add_to_cart_query .= "'{$user_id}', '{$safe_pid}', '{$product['price']}'";
				$add_to_cart_query .= ")";
				$result_add_to_cart = mysqli_query($connection, $add_to_cart_query);
				if($result_add_to_cart)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		}
	}

?>
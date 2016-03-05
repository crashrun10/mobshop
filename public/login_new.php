<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_function.php"); ?>
<?php include_once("header (2).php"); ?>
<link rel="stylesheet" type="text/css" href="css/login_signup.css">

<?php 

if(isset($_SESSION['state']))
	{
		redirect_to("index.php");
	}
	if(isset($_POST["submit"]))
	{

		//Validation

		$required_fields = array('email', 'password');
		validate_presences($required_fields);

		if(empty($errors))
		{

			$email = $_POST["email"];
			$password = $_POST["password"];

			$found_user = attempt_login($email, $password);

			if($found_user)
			{
				// Success
				// Mark user as logged in
				if($found_user['email_id']=="admin@mobshop.com")
				{
					$_SESSION['state'] = "admin_loggedin";
					$_SESSION['user_id'] = $found_user["id"];
					//$_SESSION['username'] = $found_user["f_name"];
					$_SESSION['username'] = "admin";
					$_SESSION['products'] = array();
					redirect_to("product.php?os=android"); 
				}
				else
				{
					$_SESSION['state'] = "user_loggedin";
					$_SESSION['user_id'] = $found_user["id"];
					$_SESSION['username'] = $found_user["f_name"];
					redirect_to("product.php?os=android"); 
				}
			}
			else
			{
				$errors['login'] = "Incorrect Email/Password!";
			}
		}

	}


?>

			<form class="login" style="height:350px; top:330px;" method="POST" action="login_new.php">
			    <h1>Log In</h1>
			    <fieldset id="inputs">
			        <input id="username" type="email" name="email" placeholder="Email Id" autofocus required>   
			        <input id="password" type="password" name="password" placeholder="Password" required>
			    </fieldset>
			    <?php echo form_errors($errors); ?>
			    <fieldset id="actions">
			        <input type="submit" id="submit" name="submit" value="Log In">
			        <a href="">Forgot your password?</a><a href="">Register</a>
			    </fieldset>
			</form>
</div>
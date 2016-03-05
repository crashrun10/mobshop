<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_function.php") ?>
<?php include_once("header (2).php"); ?>
<link rel="stylesheet" type="text/css" href="css/login_signup.css">
<?php

    if(isset($_POST['submit']))
    {
        //Check if user is already logged in
        if(isset($_SESSION['state']))
        {
            redirect_to("index.php");
        }
        //Process the form

        //Validations
        $required_fields = array("fname","lname","email","password","confirm_password","mob_no");
        validate_presences($required_fields);

        // Check  if account with email already exists
        $email_check = mysql_prep($_POST["email"]);
        email_exists($email_check, $connection);

        // Check if account with mobile no exists
        $mob_check = mysql_prep($_POST["mob_no"]);
        mobile_no_exists($mob_check, $connection);

        //validating mobile no.
       $mob = mysql_prep($_POST['mob_no']);
        if((strlen($mob)!==10) || !ctype_digit($mob))
        {
            $errors_signup[$_POST["mob_no"]] = "Invalid Mobile No.";
        }

        //$fields_with_min_length = array("password" => 8 );
        //validate_min_length($fields_with_min_length);

        validate_email($_POST["email"]);

        // validation for password == confirm_password
        $pd = $_POST["password"];
        $c_pd = $_POST["confirm_password"];
        if($pd !== $c_pd)
        {
            $errors_signup[$_POST["password"]] = "Password doesn't match.";
        }

        if(empty($errors_signup))
        {
            // Perform Create

            $fname = mysql_prep($_POST["fname"]);
            $lname = mysql_prep($_POST["lname"]);
            $email = mysql_prep($_POST["email"]);
            $password = md5($_POST["password"]);

            $query  = "INSERT INTO users (";
            $query .= " f_name, l_name, email_id, mob_no, password";
            $query .= ") VALUES (";
            $query .= " '{$fname}', '{$lname}', '{$email}', '{$mob}', '{$password}'";
            $query .= ")";
            $result = mysqli_query($connection, $query);

            if($result)
            {
                // Success
                $user = find_user_by_email($email);
                $_SESSION['state'] = "user_loggedin";
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = strtoupper($user['f_name']);
                redirect_to("product.php?os=android"); 
            }
            else
            {
                // Failure
                echo "User creation failed.";
            }

        }
    }

?>
<form class="login" style="height: 620px;top: 300px;" method="POST" action="signup_new.php">
    <h1>Sign Up</h1>
    <fieldset id="inputs">
        <input id="username" type="text" name="fname" placeholder="First Name" autofocus required>
        <input id="username" type="text" name="lname" placeholder="Last Name" autofocus required> 
        <input id="username" type="email" name="email" placeholder="Email Id" autofocus required>
        <input id="username" type="tel" pattern="\d{10}" name="mob_no" placeholder="Mobile No (10 digits)" autofocus required> 
        <input id="password" type="password" name="password" placeholder="Password" required>
        <input id="password" type="password" name="confirm_password" placeholder="Re-enter Password" required>
    </fieldset>
        <?php
            if(isset($errors_signup))
            {
                echo form_errors($errors_signup);
             }       
        ?>
    <fieldset id="actions">
        <input type="submit" id="submit" name="submit" value="Sign Up">
    </fieldset>
</form>
</div>
</body>
</html>

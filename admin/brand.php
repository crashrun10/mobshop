<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_function.php") ?>
<?php include_once("/header.php") ?>

<?php
	if($_SESSION['state']!=='admin_loggedin')
	{
		redirect_to("../public/index.php");
	}
	$msg = "";
	if(isset($_POST['submit']))
	{

		//Process the form
		//Validations
		$required_fields = array("brand");
		validate_presences($required_fields);

		if(empty($_FILES['img']['name']))
		{
			$errors["img"] = "Image must be uploaded!";
		}

		// Check whether brand exists in DB
		brand_exists($_POST['brand'], $connection);

		if(empty($errors))
		{
			// Perform create

			$brand_name = mysql_prep($_POST['brand']);
			$os1 = mysql_prep($_POST['os1']);
			$os2 = mysql_prep($_POST['os2']);
			$image = $_FILES['img']['name'];
			$tmp_image = $_FILES['img']['tmp_name'];
			$image_ext = explode(".", $image);
			$image_extension = $image_ext[1];

		/*	$count_query  = "SELECT count(*) ";
			$count_query .= "as total ";
			$count_query .= "FROM brands";
			$count_query_result = mysqli_query($connection, $count_query);
			$count_value = mysqli_fetch_assoc($count_query_result);

			$id = ($count_value['total'] + 1);*/

			/*$id_query  = "SELECT `AUTO_INCREMENT` ";
			//$id_query .= "as previd";
			$id_query .= "FROM INFORMATION_SCHEMA.TABLES ";
			$id_query .= "WHERE TABLE_SCHEMA = 'mobshop' ";
			$id_query .= "AND TABLE_NAME = 'brands'";
			$id_query_result = mysqli_query($connection, $id_query);
			$prev_id = mysqli_fetch_assoc($id_query_result);
			$id = $prev_id['AUTO_INCREMENT'];*/

			$id = auto_increment_value($connection, "brands");

			if($image_extension == "PNG" || $image_extension == "png" || $image_extension == "JPG" || $image_extension == "jpg" || $image_extension == "JPEG" || $image_extension == "jpeg")
			{
				$brand_logo = $id . "." .$image_extension;
				$query  = "INSERT into brands (";
				$query .= "brand_name, brand_logo, os1, os2";
				$query .= ") VALUES (";
				$query .= " '{$brand_name}', '{$brand_logo}', '{$os1}', '{$os2}'";
				$query .= ")";
				if(mysqli_query($connection, $query))
				{	

					if(move_uploaded_file($tmp_image, "../public/images/brand_logo/$brand_logo"))
					{
						$msg = $brand_name . " added successfully to the Database!";
					}
					else
					{
						$msg = "Brand added successfully.\"<br />\"Image not uploaded!";
					}
				}
			}
		}

	}	


?>
			<?php echo form_errors($errors); ?>
			<form method="POST" action="brand.php" enctype="multipart/form-data">
				<input type="text" name="brand" placeholder="Enter new brand">
				<br /><br />
				Operating System(1): 
				<select name="os1">
					<option value="android">Android</option>
					<option value="windows">Windows</option>
					<option value="blackberry">Blackberry</option>
				</select>
				<br /><br />
				Operating System(2): 
				<select name="os2">
					<option value="none">None</option>
					<option value="android">Android</option>
					<option value="windows">Windows</option>
					<option value="blackberry">Blackberry</option>
				</select>
				<br /><br />
				Image :
				<input type="file" name="img" id="imageupload">
				<br /><br />
				<input type="submit" name="submit">
				<br /><br />
			</form>
			<?php echo $msg ?>
		</div>
</body>
</html>
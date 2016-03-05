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
		$required_fields = array("brand","model","price",);
		validate_presences($required_fields);
		if(empty($_FILES['img']['name']))
		{
			$errors["img"] = "Image must be uploaded!";
		}

		// Check whetheer model exists in the DB
		model_exists($_POST["model"], $connection);

		if(empty($errors))
		{
			// Create Product
			$brand = mysql_prep($_POST["brand"]);
			$model = mysql_prep($_POST["model"]);
			$os    = mysql_prep($_POST["os"]);
			$os_version = mysql_prep($_POST["os_version"]);
			$price = mysql_prep($_POST["price"]);
			$processor = mysql_prep($_POST["processor"]);
			$weight = mysql_prep($_POST["weight"]);
			$battery = mysql_prep($_POST["battery"]);
			$warranty = mysql_prep($_POST["warranty"]);
			$inbox = mysql_prep($_POST["inbox"]);
			$touchscreen = mysql_prep($_POST["touchscreen"]);
			$front_camera = mysql_prep($_POST["front_camera"]);
			$rear_camera = mysql_prep($_POST["rear_camera"]);
			$resolution = mysql_prep($_POST["resolution"]);
			$type = mysql_prep($_POST["type"]);
			$size = mysql_prep($_POST["size"]);
			$ram = mysql_prep($_POST["ram"]);
			$internal_memory = mysql_prep($_POST["internal_memory"]);
			$other_features = mysql_prep($_POST["other_features"]);

			// Inserting image to database
			$image = $_FILES['img']['name'];
			$tmp_image = $_FILES['img']['tmp_name'];
			$image_ext = explode(".", $image);
			$image_extension = $image_ext[1];

			// Retrieving the current auto_increment value for naming the image
			$id = auto_increment_value($connection, "products");

			if($image_extension == "PNG" || $image_extension == "png" || $image_extension == "JPG" || $image_extension == "jpeg" || $image_extension == "jpg" || $image_extension == "JPEG" )
			{

				$product_image = $_POST['brand'] . "_" . $id . "." . $image_extension;
				$query  = "INSERT into products (";
				$query .= "brand_id, model, product_img, os, os_version, price, processor, weight, battery, warranty, inbox, touchscreen, front_cam, rear_cam, resolution, screen_type, screen_size, ram, internal_memory, other_features ";
				$query .= ") VALUES (";
				$query .= "'{$brand}','{$model}','{$product_image}','{$os}', '{$os_version}', '{$price}', '{$processor}', '{$weight}', '{$battery}', '{$warranty}', '{$inbox}', '{$touchscreen}', '{$front_camera}', '{$rear_camera}', '{$resolution}', '{$type}', '{$size}', '{$ram}', '{$internal_memory}', '{$other_features}' ";
				$query .= ")";
				if(mysqli_query($connection, $query))
				{
					if(move_uploaded_file($tmp_image, "../public/images/product/$product_image"))
					{
						$msg = $model . " added successfully to the DataBase";
					}
				}

			}
		}
	}
?>
			<?php echo form_errors($errors); ?>
			<form method="POST" action="product.php" enctype="multipart/form-data">
				Brand :
				<select name="brand">
					<?php

						$query  = "SELECT * ";
						$query .= "FROM brands";
						$result = mysqli_query($connection, $query);
						while($row = mysqli_fetch_array($result))
						{
							$brand_id = $row["brand_id"];
							echo "<option value = \"{$brand_id}\">" . $row["brand_name"] . "</option>";
						}
					?>
				</select>
				<br /><br />
				<input type="text" name="model" placeholder="Enter Model Name">
				<br /><br />
				Image :
				<input type="file" name="img" id="imageupload">
				<br /><br />
				Operating System : 
				<select name="os">
					<option value="android">Android</option>
					<option value="windows">Windows</option>
					<option value="blackberry">Blackberry</option>
				</select>
				<br /><br />
				<input type="text" name="os_version" placeholder="Enter OS Version">
				<br /><br />
				<input type="text" name="price" placeholder="Enter Price">
				<br /><br />
				<input type="text" name="processor" placeholder="Enter Processor Details">
				<br /><br />
				<input type="text" name="weight" placeholder="Enter Weight of mobile">
				<br /><br />
				<input type="text" name="battery" placeholder="Enter Battery Details">
				<br /><br />
				<input type="text" name="warranty" placeholder="Enter Warranty Details">
				<br /><br />
				<input type="text" name="inbox" placeholder="Enter Inbox Items">
				<br /><br />
				Touchscreen :
				<input type="radio" name="touchscreen" value="yes" checked="checked">Yes &nbsp&nbsp&nbsp
				<input type="radio" name="touchscreen" value="no">No
				<br /><br />
				Camera :
				<br /><br />
				<input type="text" name="front_camera" placeholder="Enter Front Camera Details">
				<br /><br />
				<input type="text" name="rear_camera" placeholder="Enter Rear Camera Details">
				<br /><br />
				Display :
				<br /><br />
				<input type="text" name="resolution" placeholder="Enter Screen Resolution">
				<br /><br />
				<input type="text" name="type" placeholder="Enter Screen Type">
				<br /><br />
				<input type="text" name="size" placeholder="Enter Screen Size">
				<br /><br />
				Memory & Storage :
				<br /><br />
				<input type="text" name="ram" placeholder="Enter RAM">
				<br /><br />
				<input type="text" name="internal_memory" placeholder="Enter Internal Memory">
				<br /><br />
				Other Features :
				<br /><br />
				<textarea name="other_features" cols="20" rows="5"></textarea>
				<br /><br />
				<input type="submit" name="submit">

			</form>
			<?php echo $msg ?>
		</div>
	</div>
</body>
</html>
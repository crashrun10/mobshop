<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include_once("header.php"); ?>

<?php 
	if($_SESSION['state']!=='admin_loggedin')
	{
		redirect_to("../public/index.php");
	}
	// Get thee product id
	$id = $_GET['pid'];

	// Read the data for $id from products table
	$select_query  = "SELECT * ";
	$select_query .= "FROM products ";
	$select_query .= "WHERE product_id = '{$id}'";
	$select_result = mysqli_query($connection, $select_query);
	$product = mysqli_fetch_assoc($select_result);

	// Update the data
	if(isset($_POST['submit']))
	{
		if(!empty($_POST['brand']))
		{
			update_product_field($connection, "brand_id", mysql_prep($_POST['brand']), $id);
		}
		if(!empty($_POST['model']))
		{
			update_product_field($connection, "model", mysql_prep($_POST['model']), $id);
		}
		if(!empty($_POST['os']))
		{
			update_product_field($connection, "os", mysql_prep($_POST['os']), $id);
		}
		if(!empty($_POST['os_version']))
		{
			update_product_field($connection, "os_version", mysql_prep($_POST['os_version']), $id);
		}
		if(!empty($_POST['price']))
		{
			update_product_field($connection, "price", mysql_prep($_POST['price']), $id);
		}
		if(!empty($_POST['processor']))
		{
			update_product_field($connection, "processor", mysql_prep($_POST['processor']), $id);
		}
		if(!empty($_POST['weight']))
		{
			update_product_field($connection, "weight", mysql_prep($_POST['weight']), $id);
		}
		if(!empty($_POST['battery']))
		{
			update_product_field($connection, "battery", mysql_prep($_POST['battery']), $id);
		}
		if(!empty($_POST['warranty']))
		{
			update_product_field($connection, "warranty", mysql_prep($_POST['warranty']), $id);
		}
		if(!empty($_POST['inbox']))
		{
			update_product_field($connection, "inbox", mysql_prep($_POST['inbox']), $id);
		}
		if(!empty($_POST['touchscreen']))
		{
			update_product_field($connection, "touchscreen", mysql_prep($_POST['touchscreen']), $id);
		}
		if(!empty($_POST['front_camera']))
		{
			update_product_field($connection, "front_cam", mysql_prep($_POST['front_camera']), $id);
		}
		if(!empty($_POST['rear_camera']))
		{
			update_product_field($connection, "rear_cam", mysql_prep($_POST['rear_camera']), $id);
		}
		if(!empty($_POST['resolution']))
		{
			update_product_field($connection, "resolution", mysql_prep($_POST['resolution']), $id);
		}
		if(!empty($_POST['type']))
		{
			update_product_field($connection, "screen_type", mysql_prep($_POST['type']), $id);
		}
		if(!empty($_POST['size']))
		{
			update_product_field($connection, "screen_size", mysql_prep($_POST['size']), $id);
		}
		if(!empty($_POST['ram']))
		{
			update_product_field($connection, "ram", mysql_prep($_POST['ram']), $id);
		}
		if(!empty($_POST['internal_memory']))
		{
			update_product_field($connection, "internal_memory", mysql_prep($_POST['internal_memory']), $id);
		}
		if(!empty($_POST['other_features']))
		{
			update_product_field($connection, "other_features", mysql_prep($_POST['other_features']), $id);
		}
		if(!empty($_FILES['img']['name']))
		{
			$image = $_FILES['img']['name'];
			$tmp_image = $_FILES['img']['tmp_name'];
			$image_ext = explode(".", $image);
			$image_extension = $image_ext[1];

			if($image_extension == "PNG" || $image_extension == "png" || $image_extension == "JPG" || $image_extension == "jpg" || $image_extension == "JPEG" || $image_extension == "jpeg")
			{
				$product_img = $_POST['brand'] . "_" . $id . "." .$image_extension;
				$query  = "UPDATE products ";
				$query .= "SET product_img = '{$product_img}' ";
				$query .= "WHERE product_id = '{$id}'";
				if(mysqli_query($connection, $query))
				{	

					if(move_uploaded_file($tmp_image, "../public/images/product/$product_img"))
					{
						$msg = "done";
					}
					else
					{
						redirect_to("index.php");
					}
				}
			}
		}
		redirect_to("edit_product.php?pid=" . $id);
	}

?>

		<form method="POST" action="" enctype="multipart/form-data">
			Brand : <strong><?php 
			$query  = "SELECT brand_name ";
			$query .= "FROM brands ";
			$query .= "WHERE brand_id = '{$product['brand_id']}'";
			$result = mysqli_query($connection, $query);
			$brand_name = mysqli_fetch_assoc($result);
			echo $brand_name['brand_name']; 

			?></strong>
			<br />
			New value for Brand :
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
			<br />
			<p style="color:red;">*Select correct value, even if you don't want to change brand</p>
			<br />
			Model :<strong> <?php echo $product['model']; ?></strong>
			<br />
			<input type="text" name="model" placeholder="Enter new value for model">
			<br /><br />
			<img src="../public/images/product/<?php echo $product['product_img']; ?>" width="250px" height="250px" >
			<br />
			<input type="file" name="img" id="imageupload">
			<br />
			<br />
			Operating System :<strong> <?php echo $product['os']; ?></strong>
			<br />
			Select new Value for Operating System : 
					<select name="os">
						<option value="android">Android</option>
						<option value="windows">Windows</option>
						<option value="blackberry">Blackberry</option>
					</select>
			<p style="color:red;">*Select correct value, even if you don't want to change OS</p>
			<br /><br />
			OS version :<strong> <?php echo $product['os_version']; ?></strong>
			<br />
			<input type="text" name="os_version" placeholder="Enter new value for os version here">
			<br /><br />
			Price : <strong><?php echo $product['price']; ?></strong>
			<br />
			<input type="text" name="price" placeholder="Enter new price here">
			<br /><br />
			Processor Details :<strong> <?php echo $product['processor']; ?></strong>
			<br />
			<input type="text" name="processor" placeholder="Enter new value for processor here">
			<br /><br />
			Weight :<strong> <?php echo $product['weight']; ?></strong>
			<br />
			<input type="text" name="weight" placeholder="Enter new value weight here">
			<br /><br />
			Battery Details :<strong> <?php echo $product['battery']; ?></strong>
			<br />
			<input type="text" name="battery" placeholder="Enter new battery details here">
			<br /><br />
			Warranty Details :<strong> <?php echo $product['warranty']; ?></strong>
			<br />
			<input type="text" name="warranty" placeholder="Enter new warranty details here">
			<br /><br />
			Inbox items :<strong> <?php echo $product['inbox']; ?></strong>
			<br />
			<input type="text" name="inbox" placeholder="Enter new inbox items here">
			<br /><br />
			Touchscreen :<strong> <?php echo $product['touchscreen']; ?></strong>
			<br />
			New Touchscreen Value :
					<input type="radio" name="touchscreen" value="yes" checked="checked">Yes &nbsp&nbsp&nbsp
					<input type="radio" name="touchscreen" value="no">No
			<br />
			<p style="color:red;">*Select correct value, even if you don't want to the value</p>
			<br /><br />
			Front Camera :<strong> <?php echo $product['front_cam']; ?></strong>
			<br />
			<input type="text" name="front_camera" placeholder="Enter new Front Camera details here">
			<br /><br />
			Rear Camera :<strong> <?php echo $product['rear_cam']; ?></strong>
			<br />
			<input type="text" name="rear_camera" placeholder="Enter new Rear Camera details here">
			<br /><br />
			Screen Resolution :<strong> <?php echo $product['resolution']; ?></strong>
			<br />
			<input type="text" name="resolution" placeholder="Enter new Screen Resolution here">
			<br /><br />
			Screen Type :<strong> <?php echo $product['screen_type']; ?></strong>
			<br />
			<input type="text" name="type" placeholder="Enter new Screen Type here">
			<br /><br />
			Screen Size :<strong> <?php echo $product['screen_size']; ?></strong>
			<br />
			<input type="text" name="size" placeholder="Enter new Screen Size here">
			<br /><br />
			RAM :<strong> <?php echo $product['ram']; ?></strong>
			<br />
			<input type="text" name="ram" placeholder="Enter new RAM value here">
			<br /><br />
			Internal Memory :<strong> <?php echo $product['internal_memory']; ?></strong>
			<br />
			<input type="text" name="internal_memory" placeholder="Enter new Internal Memory value here">
			<br /><br />
			Other Features :<strong> <?php echo $product['other_features']; ?></strong>
			<br />
			Enter new Other Features value here :<br />
			<textarea name="other_features" cols="20" rows="5"></textarea>
			<br /><br />
			<input type="submit" name="submit">
		</form>
	</div>
</body>
</html>

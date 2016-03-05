<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include_once("header.php"); ?>
<?php 
	if($_SESSION['state']!=='admin_loggedin')
	{
		redirect_to("../public/index.php");
	}
	$id = $_GET['bid'];
	if(isset($_POST['submit']))
	{	
		/*$os1 = mysql_prep($_POST['os1']);
		$os2 = mysql_prep($_POST['os2']);
		if(!empty($_POST['brand']))
		{
			$brand_name = mysql_prep($_POST['brand']);
			$update_brand_name_query  = "UPDATE brands ";
			$update_brand_name_query .= "SET brand_name = '{$brand_name}', ";
			$update_brand_name_query .= "WHERE brand_id = '{$id}'";
			
			$result = mysqli_query($connection, $update_brand_name_query);
		}*/
		if(!empty($_POST['brand']))
		{
			update_brand_field($connection, "brand_name", mysql_prep($_POST['brand']), $id);
		}
		if(!empty($_POST['os1']))
		{
			update_brand_field($connection, "os1", mysql_prep($_POST['os1']), $id);
		}
		if(!empty($_POST['os2']))
		{
			update_brand_field($connection, "os2", mysql_prep($_POST['os2']), $id);
		}
		//Upload Image
		if(!empty($_FILES['img']['name']))
		{
			$image = $_FILES['img']['name'];
			$tmp_image = $_FILES['img']['tmp_name'];
			$image_ext = explode(".", $image);
			$image_extension = $image_ext[1];

			if($image_extension == "PNG" || $image_extension == "png" || $image_extension == "JPG" || $image_extension == "jpg" || $image_extension == "JPEG" || $image_extension == "jpeg")
			{
				$brand_logo = $id . "." .$image_extension;
				$query  = "UPDATE brands ";
				$query .= "SET brand_logo = '{$brand_logo}'";
				$query .= "WHERE brand_id = '{$id}'";
				
				if(mysqli_query($connection, $query))
				{	

					if(move_uploaded_file($tmp_image, "../public/images/brand_logo/$brand_logo"))
					{
						$msg = "done";
					}
				}
			}
		}	
}
	$select_query  = "SELECT * ";
	$select_query .= "FROM brands ";
	$select_query .= "WHERE brand_id = '{$id}'";
	$select_result = mysqli_query($connection, $select_query);
	$values = mysqli_fetch_assoc($select_result);

?>


	<form method="POST" action = "" enctype="multipart/form-data" >
		Brand Name :
		<br /><br />
		<input type = "text" name = "brand-old" value = "<?php echo $values['brand_name']; ?>">
		<br /><br />
		<input type = "text" name = "brand" placeholder = "Enter new value here">
		<br /><br />
		Select new Value for Operating System(1) : 
					<select name="os1">
						<option value="android">Android</option>
						<option value="windows">Windows</option>
						<option value="blackberry">Blackberry</option>
					</select>
			<p style="color:red;">*Select correct value, even if you don't want to change OS</p>
			<br /><br />
			Select new Value for Operating System(2) : 
					<select name="os2">
						<option value="none">None</option>
						<option value="android">Android</option>
						<option value="windows">Windows</option>
						<option value="blackberry">Blackberry</option>
					</select>
			<p style="color:red;">*Select correct value, even if you don't want to change OS</p>
			<br /><br />
		<img src="../public/images/brand_logo/<?php echo $values['brand_logo'] ?>" width="250px" height="250px">
		<br /><br />
		<input type = "file" name = "img" id="imageupload">
		<br /><br />
		<input type = "submit" name = "submit">

	</form>
</div>
</body>
</html>
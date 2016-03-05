<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/connection.php"); ?>
<?php include_once("/header.php") ?>

<?php 
	if($_SESSION['state']!=='admin_loggedin')
	{
		redirect_to("../public/index.php");
	}
	$query  = "SELECT * ";
	$query .= "FROM products";
	$result = mysqli_query($connection, $query);
	echo "<table>
		  	<tr>
		  		<td> <strong> Brand </strong> </td>
		  		<td> <strong> Model </strong> </td>
		  		<td></td>
		  		<td></td>
		  	</tr>
		  ";
	while($row = mysqli_fetch_array($result))
	{
		$brand_name_query = mysqli_query($connection,"SELECT brand_name FROM brands WHERE brand_id='{$row['brand_id']}'");
		$brand_name_query_result = mysqli_fetch_array($brand_name_query);
		$brand_name = $brand_name_query_result['brand_name'];		
		echo "<tr> <td>" . $brand_name . "</td>";
		echo "<td>" . $row['model'] . "</td>";
		echo "<td> <a href='edit_product.php?pid=" . $row['product_id'] . "'> Edit </a> </td>";
		echo "<td> <a href='delete_product.php?pid=" . $row['product_id'] . "'> Delete </a> </td> </tr>";
	}
?>
</table>
</div>
</body>
</html>

							
<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/connection.php"); ?>
<?php include_once("/header.php") ?>

<?php 
	if($_SESSION['state']!=='admin_loggedin')
	{
		redirect_to("../public/index.php");
	}
	$query  = "SELECT * ";
	$query .= "FROM brands";
	$result = mysqli_query($connection, $query);
	echo "<table>
		  	<tr>
		  		<td> <strong> Brand </strong> </td>
		  		<td> <strong> Logo </strong> </td>
		  		<td></td>
		  		<td></td>
		  	</tr>
		  ";
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr> <td>" . $row['brand_name'] . "</td>";
		echo "<td>" . $row['brand_logo'] . "</td>";
		echo "<td> <a href='edit_brand.php?bid=" . $row['brand_id'] . "'> Edit </a> </td>";
		echo "<td> <a href='delete_brand.php?bid=" . $row['brand_id'] . "'> Delete </a> </td> </tr>";
	}
?>
</table>
</div>
</body>
</html>

							
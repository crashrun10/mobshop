<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/connection.php"); ?>
<?php require_once("../includes/functions.php"); ?> 
<?php 
	
	if(isset($_POST['add_to_cart']))
	{
		//echo $_POST['os'];
		//echo $_POST['add_to_cart'];
		if(!isset($_SESSION['state']))
		{
			echo '<script language="javascript">';
            echo 'alert("Please Login inorder to do shopping!"); ';
            echo 'window.location.href ="product.php?os=' . $_POST['os'] . '"; ';
            echo '</script>';
            //redirect_to("product.php?os=" . $_POST['os']);
		}
		else
		{
			if(add_to_cart($connection, $_SESSION['user_id'], $_POST['add_to_cart']))
			{
				
				$_SESSION['products'] [] = $_POST['add_to_cart'];
				echo '<script language="javascript">';
				if(isset($_POST['os']))
				{
					echo 'window.location.href="product.php?os='.$_POST['os'] . '"; ';
				}
				else
				{
					echo 'window.location.href="product_detail.php?os='.$_POST['os_detail_page'] . '&pid=' . $_POST['pid'] . '"; ';
				}
				echo '</script>';
			}
			else
			{
				echo print_r($_SESSION);
				echo "<br />";
				echo $_POST['add_to_cart'];
			}
		}
	}
	if(isset($_POST['asdf']))
	{
		
		//redirect_to("index.php");
		echo '<script language="javascript">';
        echo 'alert("Please Login inorder to do shopping!"); ';
        echo 'window.location.href ="product_detail.php?os=' . $_POST['os_d'] . '&pid=' . $_POST['pid'] . '"; ';
        echo '</script>';
         
	}
?>
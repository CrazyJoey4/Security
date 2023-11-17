<?PHP
	//order_update.php
	
	include("connect.php");	
	session_start();
	
	if(isset($_POST['ID']))
	{	
		$ID			= $_POST['ID'];
		$NAME		= $_POST['Food_name'];
		$QUANTITY	= $_POST['Food_quantity'];
		$TABLE		= $_POST['Table_ID'];
		
		$query = "
			UPDATE `order_table` SET 
			`Food_quantity` = '$QUANTITY'
			WHERE `ID` = '$ID'
			";
		
		if(mysqli_query($connected,$query))
		{
			header("location:Order_Edit.php?id=$TABLE");
			$_SESSION['message'] = "<script>alert('Updated !');</script>";
		}
		else
		{
			$_SESSION['message'] = "<script>alert('Update failed. Try again.');</script>";
			header("location:Order.php?st=failure");
		}
	}
	else
	{
		$_SESSION['message'] = "<script>alert('Connect failed. Try again.');</script>";
		header("location:Order.php?st=failure");
	}
?>
<?PHP
	//category_update.php
	
	include("connect.php");	
	session_start();
	
	if(isset($_POST['ID']))
	{	
		$ID 	= $_POST['ID'];
		$NAME	= $_POST['Category_name'];
		$STATUS	= $_POST['Category_status'];
		
		$query = "
			UPDATE `category_table` SET 
			`Category_name` = '$NAME',
			`Category_status` = '$STATUS'
			WHERE `ID` = '$ID'
			";
		
		if(mysqli_query($connected,$query))
		{
			header("location:Category.php?st=updated");
			$_SESSION['message'] = "<script>alert('Updated !');</script>";
		}
		else
		{
			$_SESSION['message'] = "<script>alert('Update failed. Try again.');</script>";
			header("location:Category.php?st=failure");
		}
	}
	else
	{
		$_SESSION['message'] = "<script>alert('Connect failed. Try again.');</script>";
		header("location:Category.php?st=failure");
	}
?>
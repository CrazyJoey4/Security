<?PHP
	//tax_update.php
	
	include("connect.php");	
	session_start();
	
	if(isset($_POST['Tax_ID']))
	{	
		$ID 		= $_POST['Tax_ID'];
		$NAME		= $_POST['Tax_name'];
		$PERCENT	= $_POST['Tax_percent'];
		$STATUS		= $_POST['Tax_status'];
		
		$percent = $PERCENT / 100;
		
		$query = "
			UPDATE `tax_table` SET 
			`Tax_name` = '$NAME',
			`Tax_percent` = '$percent',
			`Tax_status` = '$STATUS'
			WHERE `Tax_ID` = '$ID'
			";
		
		if(mysqli_query($connected,$query))
		{
			header("location:Tax.php?st=updated");
			$_SESSION['message'] = "<script>alert('Updated !');</script>";
		}
		else
		{
			$_SESSION['message'] = "<script>alert('Update failed. Try again.');</script>";
			header("location:Tax.php?st=failure");
		}
	}
	else
	{
		$_SESSION['message'] = "<script>alert('Connect failed. Try again.');</script>";
		header("location:Tax.php?st=failure");
	}
?>
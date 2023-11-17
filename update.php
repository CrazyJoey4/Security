<?PHP
	//update.php
	
	include("connect.php");	
	session_start();
	
	$object = new Connect();
	
	if(isset($_SESSION['User_ID']))
	{		
		$ID 		= $_SESSION['User_ID'];
		$NAME		= $_POST['User_name'];
		$EMAIL		= $_POST['User_email'];
		$PASSWORD	= $_POST['User_pwd'];		
		$CONTACT	= $_POST['User_contact'];
		$BIRTHDAY	= $_POST['User_birthday'];
		$GENDER		= $_POST['User_gender'];
		
		$query = "
			UPDATE `user_table` SET 
			`User_name` = '$NAME',
			`User_email` = '$EMAIL',
			`User_pwd` = '$PASSWORD',
			`User_contact` = '$CONTACT',
			`User_birthday` = '$BIRTHDAY',
			`User_gender` = '$GENDER' 
			WHERE User_ID = '$ID'
			";
				
		if(mysqli_query($connected,$query))
		{
			header("location:Profile.php?st=success");
			$_SESSION['message'] = "<script>alert('Updated !');</script>";
		}
		else
		{
			$_SESSION['message'] = "<script>alert('Update failed. Try again.');</script>";
			header("location:Profile.php?st=failure");
		}
	}
	else
	{
		$_SESSION['message'] = "<script>alert('Connect failed. Try again.');</script>";
		header("location:Profile.php?st=failure");
	}
?>
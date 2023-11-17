<?PHP
	//staff_insert.php
	
	include('connect.php');
	session_start();
	
	$object = new Connect();
	
	if(isset($_POST["User_ID"]))
	{
		$USER_ID = $_POST['User_ID'];
		
		$query = mysqli_query($connected, "SELECT * FROM user_table WHERE User_ID = '$USER_ID'");
				
		if(mysqli_num_rows($query) == 1)
		{
			header("location:Staff.php?st=failure");
			
			$_SESSION['message'] = "<script>alert('ID already exists!Please use another ID.')</script>";
		}
		else
		{
			$USER_name		= $_POST['User_name'];
			$USER_email		= $_POST['User_email'];
			$USER_password	= $_POST['User_pwd'];
			$USER_position	= $_POST['User_position'];
			$USER_start		= $object->get_datetime();
			
			$query = "
			INSERT INTO `user_table`
			(`User_ID`, `User_name`, `User_email`, `User_pwd`, `User_position`, `User_start`) 
			VALUES ('$USER_ID', '$USER_name', '$USER_email', '$USER_password', '$USER_position', '$USER_start')";
			
			if(mysqli_query($connected,$query))
			{
				header("location:Staff.php?st=success");
				$_SESSION['message'] = "<script>alert('Registered successful. You may ask the staff to login now.');</script>";
			}
			else
			{
				$_SESSION['message'] = "<script>alert('Register failed. Try again.');</script>";
				header("location:Staff.php?st=failure");
			}			
		}
	}
	else
	{
		echo "<script>alert('Connect failed. Try again.')</script>";
		header("location:Staff.php?st=allfailure");
	}
?>
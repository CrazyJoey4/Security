<?PHP
	include('connect.php');
	session_start();
	
	$object = new Connect();
	
	if(isset($_POST["User_ID"]))
	{
		$USER_ID = $_POST['User_ID'];
		
		$query = mysqli_query($connected, "SELECT * FROM user_table WHERE User_ID = '$USER_ID'");
				
		if(mysqli_num_rows($query) == 1)
		{
			header("location:RegisterForm.php?st=failure");
			
			$_SESSION['message'] = "<script>alert('ID already exists!Please use another ID.')</script>";			
		}
		else
		{			
			$RES_name		= $_POST['res_name'];
			$RES_location	= $_POST['res_location'];
			$RES_contact	= $_POST['res_contact'];
			$RES_email		= $_POST['User_email'];
			$RES_currency	= $_POST['res_currency'];
			$RES_timezone	= $_POST['res_timezone'];
			$USER_email		= $_POST['User_email'];
			$USER_pwd		= $_POST['User_pwd'];
			$USER_position	= "Master";
			$USER_start		= $object->get_datetime();
			
			$query = "
			INSERT INTO `restaurant_master`
			(`res_name`, `res_location`, `res_contact`, `res_email`, `res_currency`, `res_timezone`) 
			VALUES ('$RES_name', '$RES_location', '$RES_contact', '$RES_email', '$RES_currency', '$RES_timezone');
			
			INSERT INTO `user_table`
			(`User_ID`, `User_email`, `User_pwd`, `User_position`, `User_start`)
			VALUES ('$USER_ID', '$USER_email', '$USER_pwd', '$USER_position', '$USER_start');
			";
			
			if(mysqli_multi_query($connected,$query))
			{
				header("location:index.php?st=success");
				$_SESSION['message'] = "<script>alert('Registered successful. You may login now.');</script>";
				$_SESSION['message'] = "Registered successful. You may login now.";
			}
			else
			{
				$_SESSION['message'] = "<script>alert('Login failed. Try again.');</script>";
				header("location:RegisterForm.php?st=failure");
			}			
		}
	}
	else
	{
		echo "<script>alert('Connect failed. Try again.')</script>";
		header("location:RegisterForm.php?st=allfailure");
	}
?>
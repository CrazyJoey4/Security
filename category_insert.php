<?PHP
	//category_insert.php
	
	include('connect.php');
	session_start();
	
	if(isset($_POST["Category_name"]))
	{
		$CATEGORY_name		= $_POST['Category_name'];
		$CATEGORY_status	= $_POST['Category_status'];
				
		$query = "
		INSERT INTO `category_table`
		(`Category_name`, `Category_status`) 
		VALUES ('$CATEGORY_name', '$CATEGORY_status')";
		
		if(mysqli_query($connected,$query))
		{
			header("location:Category.php?st=success");
			$_SESSION['message'] = "<script>alert('Added !');</script>";
		}
		else
		{
			$_SESSION['message'] = "<script>alert('Failed. Try again.');</script>";
			header("location:Category.php?st=failure");
		}			
	}
	else
	{
		echo "<script>alert('Connect failed. Try again.')</script>";
		header("location:Category.php?st=allfailure");
	}
?>
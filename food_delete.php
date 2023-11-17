<?PHP
	//food_delete.php
	
	include('connect.php');
	
	if(isset($_GET['id']))
	{
		$delete_id = $_GET['id'];
		
		$query = "DELETE FROM menu_table WHERE Food_ID = '".$delete_id."'";
		
		if(mysqli_query($connected,$query))
		{
			header("location:FoodMenu.php?st=Deleted");
		} 
		else 
		{
			$_SESSION['message'] = "<script>alert('Delete failed. Try again.');</script>";
			header("location:FoodMenu.php?st=failure");
		}
	}
?>
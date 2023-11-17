<?PHP
	//category_delete.php
	
	include('connect.php');
	
	if(isset($_GET['id']))
	{
		$delete_id = $_GET['id'];
		
		$query = "DELETE FROM category_table WHERE ID = '".$delete_id."'";
		
		if(mysqli_query($connected,$query))
		{
			header("location:Category.php?st=Deleted");
		} 
		else 
		{
			$_SESSION['message'] = "<script>alert('Delete failed. Try again.');</script>";
			header("location:Category.php?st=failure");
		}
	}
?>
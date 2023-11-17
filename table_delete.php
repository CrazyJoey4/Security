<?PHP
	//table_delete.php
	
	include('connect.php');
	
	if(isset($_GET['id']))
	{
		$delete_id = $_GET['id'];
		
		$query = "DELETE FROM table_data WHERE Table_ID = '".$delete_id."'";
		
		if(mysqli_query($connected,$query))
		{
			header("location:Table.php?st=Deleted");
		} 
		else 
		{
			$_SESSION['message'] = "<script>alert('Delete failed. Try again.');</script>";
			header("location:Table.php?st=failure");
		}
	}
?>
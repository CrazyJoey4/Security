<?PHP
	//order_delete.php
	
	include('connect.php');
	
	if(isset($_GET['id']))
	{
		$delete_id = $_GET['id'];
		
		$select = "SELECT Table_ID FROM order_table WHERE ID = '".$delete_id."'";		
		$result = mysqli_query($connected, $select);
		$row = mysqli_fetch_assoc($result);
		$TABLE = $row['Table_ID'];
		
		
		$query = "DELETE FROM order_table WHERE ID = '".$delete_id."'";
		
		if(mysqli_query($connected,$query))
		{
			header("location:Order_Edit.php?id=$TABLE");
		} 
		else 
		{
			$_SESSION['message'] = "<script>alert('Delete failed. Try again.');</script>";
			header("location:Order_Edit.php?id=$TABLE&st=failure");
		}
	}
?>
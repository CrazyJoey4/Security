<?PHP
//order_delete.php

include('connect.php');

if (isset($_GET['id'])) {
	$DELETE_id = $_GET['id'];

	$query_select = "SELECT Table_ID FROM order_table WHERE ID = ?";
	$statement_select = mysqli_prepare($connected, $query_select);
	if ($statement_select) {
		mysqli_stmt_bind_param($statement_select, "s", $DELETE_id);
		mysqli_stmt_execute($statement_select);
	
		// Bind the result variable
		mysqli_stmt_bind_result($statement_select, $tableId);
	
		// Fetch the result
		mysqli_stmt_fetch($statement_select);
	
		// Close the statement
		mysqli_stmt_close($statement_select);

		$TABLE = $tableId;
	} else {
		echo "Error in preparing the statement: " . mysqli_error($connected);
	}


	$query = "DELETE FROM order_table WHERE ID = ?";
	$statement = mysqli_prepare($connected, $query);

	// Check if the prepared statement is successfully deleted
	if ($statement) {
		mysqli_stmt_bind_param($statement, "s", $DELETE_id);

		// Execute the statement
		if (mysqli_stmt_execute($statement)) {
			// Check the number of affected rows after the delete operation
			$rowsAffected = mysqli_stmt_affected_rows($statement);

			if ($rowsAffected > 0) {
				header("location:Order_Edit.php?id=$TABLE&st=Cancelled");
			} else {
				$_SESSION['message'] = "<script>alert('Order cancel failed. Please try again.');</script>";
				header("location:Order_Edit.php?id=$TABLE&st=failure");
			}
		} else {
			// echo "Error executing the statement: " . mysqli_stmt_error($statement);
			$_SESSION['message'] = "<script>alert('Order cancel failed. Please try again.');</script>";
			header("location:Order_Edit.php?st=failure");
		}

		// Close the prepared statement
		mysqli_stmt_close($statement);
	} else {
		// echo "Error in preparing the statement: " . mysqli_error($connected);
		$_SESSION['message'] = "<script>alert('Order cancel failed. Please try again.');</script>";
		header("location:Order_Edit.php?st=failure");
	}
} else {
	$_SESSION['message'] = "<script>alert('Connection failed. Please try again.');</script>";
	header("location:Order_Edit.php?st=failure");
}
?>
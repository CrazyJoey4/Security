<?PHP
//wait_delete.php

include('connect.php');

if (isset($_POST['Wait_ID'])) {
	$DELETE_id = $_POST['Wait_ID'];
	$table = $_POST['Table_ID'];

	$query_assign = "DELETE FROM waitlist_table WHERE Wait_ID = ?";
	$statement_assign = mysqli_prepare($connected, $query_assign);

	// Check if the prepared statement is successfully deleted
	if ($statement_assign) {
		mysqli_stmt_bind_param($statement_assign, "s", $DELETE_id);

		// Execute the statement
		if (mysqli_stmt_execute($statement_assign)) {
			// Check the number of affected rows after the delete operation
			$rowsAffected = mysqli_stmt_affected_rows($statement_assign);

			if ($rowsAffected > 0) {
				header("location:Order_Edit.php?id=$table");
			} else {
				$_SESSION['message'] = "<script>alert('Assign table failed. Please try again.');</script>";
				header("location:Waitlist.php?st=failure");
			}
		} else {
			// echo "Error executing the statement: " . mysqli_stmt_error($statement);
			$_SESSION['message'] = "<script>alert('Assign table failed. Please try again.');</script>";
			header("location:Waitlist.php?st=failure");
		}

		// Close the prepared statement
		mysqli_stmt_close($statement_assign);
	} else {
		// echo "Error in preparing the statement: " . mysqli_error($connected);
		$_SESSION['message'] = "<script>alert('Assign table failed. Please try again.');</script>";
		header("location:Waitlist.php?st=failure");
	}
}

if (isset($_GET['id'])) {
	$DELETE_id = $_GET['id'];

	$query = "DELETE FROM waitlist_table WHERE Wait_ID = ?";
	$statement = mysqli_prepare($connected, $query);

	// Check if the prepared statement is successfully deleted
	if ($statement) {
		mysqli_stmt_bind_param($statement, "s", $DELETE_id);

		// Execute the statement
		if (mysqli_stmt_execute($statement)) {
			// Check the number of affected rows after the delete operation
			$rowsAffected = mysqli_stmt_affected_rows($statement);

			if ($rowsAffected > 0) {
				header("location:Waitlist.php?st=Deleted");
			} else {
				$_SESSION['message'] = "<script>alert('Waiting order delete failed. Please try again.');</script>";
				header("location:Waitlist.php?st=failure");
			}
		} else {
			// echo "Error executing the statement: " . mysqli_stmt_error($statement);
			$_SESSION['message'] = "<script>alert('Waiting order delete failed. Please try again.');</script>";
			header("location:Waitlist.php?st=failure");
		}

		// Close the prepared statement
		mysqli_stmt_close($statement);
	} else {
		// echo "Error in preparing the statement: " . mysqli_error($connected);
		$_SESSION['message'] = "<script>alert('Waiting order delete failed. Please try again.');</script>";
		header("location:Waitlist.php?st=failure");
	}
}
?>
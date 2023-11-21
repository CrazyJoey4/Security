<?PHP
//food_delete.php

include('connect.php');

if (isset($_GET['id'])) {
	$DELETE_id = $_GET['id'];

	$query = "DELETE FROM menu_table WHERE Food_ID = ?";
	$statement = mysqli_prepare($connected, $query);

	// Check if the prepared statement is successfully deleted
	if ($statement) {
		mysqli_stmt_bind_param($statement, "s", $DELETE_id);

		// Execute the statement
		if (mysqli_stmt_execute($statement)) {
			// Check the number of affected rows after the delete operation
			$rowsAffected = mysqli_stmt_affected_rows($statement);

			if ($rowsAffected > 0) {
				header("location:FoodMenu.php?st=Deleted");
			} else {
				$_SESSION['message'] = "<script>alert('Food menu delete failed. Please try again.');</script>";
				header("location:FoodMenu.php?st=failure");
			}
		} else {
			// echo "Error executing the statement: " . mysqli_stmt_error($statement);
			$_SESSION['message'] = "<script>alert('Food menu delete failed. Please try again.');</script>";
			header("location:FoodMenu.php?st=failure");
		}
	} else {
		// echo "Error in preparing the statement: " . mysqli_error($connected);
		$_SESSION['message'] = "<script>alert('Food menu delete failed. Please try again.');</script>";
		header("location:FoodMenu.php?st=failure");
	}

	// Close the prepared statement
	mysqli_stmt_close($statement);
} else {
	$_SESSION['message'] = "<script>alert('Connection failed. Please try again.');</script>";
	header("location:FoodMenu.php?st=failure");
}
?>
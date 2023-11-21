<?PHP
//category_delete.php

include('connect.php');

if (isset($_GET['id'])) {
	$DELETE_id = $_GET['id'];

	$query = "DELETE FROM category_table WHERE ID = ?";
	$statement = mysqli_prepare($connected, $query);

	if ($statement) {
		mysqli_stmt_bind_param($statement, "i", $DELETE_id);

		// Execute the statement
		if (mysqli_stmt_execute($statement)) {
			$rowsAffected = mysqli_stmt_affected_rows($statement);

			if ($rowsAffected > 0) {
				header("location:Category.php?st=Deleted");
			} else {
				$_SESSION['message'] = "<script>alert('Category delete failed. Please try again.');</script>";
				header("location:Category.php?st=failure");
			}
		} else {
			// echo "Error executing the statement: " . mysqli_stmt_error($statement);
			$_SESSION['message'] = "<script>alert('Category delete failed. Please try again.');</script>";
        	header("location: Category.php?st=failure");
		}

		mysqli_stmt_close($statement);
	} else {
		// echo "Error in preparing the statement: " . mysqli_error($connected);
		$_SESSION['message'] = "<script>alert('Category delete failed. Please try again.');</script>";
        header("location: Category.php?st=failure");
	}
} else {
	$_SESSION['message'] = "<script>alert('Connection failed. Please try again.');</script>";
	header("location:Category.php?st=failure");
}
?>
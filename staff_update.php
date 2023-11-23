<?PHP
//staff_update.php

include("connect.php");
session_start();

if (isset($_POST['User_ID'])) {
	$ID = $_POST['User_ID'];
	$POSITION = $_POST['User_position'];

	// Validate input fields to avoid empty values
	if (empty($POSITION)) {
		$_SESSION['message'] = "<script>alert('Please select a position.');</script>";
		header("location:Staff_Edit.php?id=$ID");
		exit();
	}

	$query = "UPDATE `user_table` SET 
			`User_position` = ?
			WHERE `User_ID` = ?";
	$statement = mysqli_prepare($connected, $query);

	// Check if the prepared statement is successfully updated
	if ($statement) {
		// Check the number of affected rows after the update operation
		mysqli_stmt_bind_param($statement, "ss", $POSITION, $ID);

		// Execute the statement
		if (mysqli_stmt_execute($statement)) {
			$rowsAffected = mysqli_stmt_affected_rows($statement);

			if ($rowsAffected > 0) {
				$_SESSION['message'] = "<script>alert('Staff's role updated!');</script>";
				header("location:Staff.php?st=updated");
			} else {
				$_SESSION['message'] = "<script>alert('Staff's role update failed. Please try again.');</script>";
				header("location:Staff.php?st=failure");
			}
		} else {
			// echo "Error executing the statement: " . mysqli_stmt_error($statement);
			$_SESSION['message'] = "<script>alert('Staff's role update failed. Please try again.');</script>";
			header("location:Staff.php?st=failure");
		}

		// Close the prepared statement
		mysqli_stmt_close($statement);
	} else {
		// echo "Error in preparing the statement: " . mysqli_error($connected);
		$_SESSION['message'] = "<script>alert('Staff's role update failed. Please try again.');</script>";
		header("location:Staff.php?st=failure");
	}
} else {
	$_SESSION['message'] = "<script>alert('Connection failed. Please try again.');</script>";
	header("location:Staff.php?st=failure");
}
?>
<?PHP
//table_update.php

include("connect.php");
session_start();

if (isset($_POST['Table_ID'])) {
	$ID = $_POST['Table_ID'];
	$CAPACITY = $_POST['Capacity'];
	$STATUS = $_POST['Table_status'];

	// Validate input fields to avoid empty values
	if (empty($STATUS)) {
		$_SESSION['message'] = "<script>alert('Please select a status.');</script>";
		header("location:Table_Edit.php?id=$ID");
		exit();
	}

	$query = "UPDATE `table_data` SET 
			`Capacity` = ?,
			`Table_status` = ?
			WHERE `Table_ID` = ?";
	$statement = mysqli_prepare($connected, $query);

	// Check if the prepared statement is successfully updated
	if ($statement) {
		// Check the number of affected rows after the update operation
		mysqli_stmt_bind_param($statement, "iss", $CAPACITY, $STATUS, $ID);

		// Execute the statement
		if (mysqli_stmt_execute($statement)) {
			$rowsAffected = mysqli_stmt_affected_rows($statement);

			if ($rowsAffected > 0) {
				header("location:Table.php?st=updated");
				$_SESSION['message'] = "<script>alert('Table capacity updated !');</script>";
			} else {
				$_SESSION['message'] = "<script>alert('Table capacity update failed. Please try again.');</script>";
				header("location:Table.php?st=failure");
			}
		} else {
			// echo "Error executing the statement: " . mysqli_stmt_error($statement);
			$_SESSION['message'] = "<script>alert('Table capacity update update failed. Please try again.');</script>";
			header("location:Table.php?st=failure");
		}

		// Close the prepared statement
		mysqli_stmt_close($statement);
	} else {
		// echo "Error in preparing the statement: " . mysqli_error($connected);
		$_SESSION['message'] = "<script>alert('Table capacity update failed. Please try again.');</script>";
		header("location:Table.php?st=failure");
	}
} else {
	$_SESSION['message'] = "<script>alert('Connection failed. Please try again.');</script>";
	header("location:Table.php?st=failure");
}
?>
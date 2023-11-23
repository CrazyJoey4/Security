<?PHP
//tax_update.php

include("connect.php");
session_start();

if (isset($_POST['Tax_ID'])) {
	$ID = $_POST['Tax_ID'];
	$NAME = $_POST['Tax_name'];
	$PERCENT = $_POST['Tax_percent'];
	$STATUS = $_POST['Tax_status'];

	$percent = $PERCENT / 100;

	$query = "UPDATE `tax_table` SET 
			`Tax_name` = ?,
			`Tax_percent` = ?,
			`Tax_status` = ?
			WHERE `Tax_ID` = ?";
	$statement = mysqli_prepare($connected, $query);

	// Check if the prepared statement is successfully updated
	if ($statement) {
		// Check the number of affected rows after the update operation
		mysqli_stmt_bind_param($statement, "sdss", $NAME, $percent, $STATUS, $ID);

		// Execute the statement
		if (mysqli_stmt_execute($statement)) {
			$rowsAffected = mysqli_stmt_affected_rows($statement);

			if ($rowsAffected > 0) {
				$_SESSION['message'] = "<script>alert('Tax detail updated!');</script>";
				header("location:Tax.php?st=updated");
			} else {
				$_SESSION['message'] = "<script>alert('Tax detail update failed. Please try again.');</script>";
				header("location:Tax.php?st=failure");
			}
		} else {
			// echo "Error executing the statement: " . mysqli_stmt_error($statement);
			$_SESSION['message'] = "<script>alert('Tax detail update failed. Please try again.');</script>";
			header("location:Tax.php?st=failure");
		}

		// Close the prepared statement
		mysqli_stmt_close($statement);
	} else {
		// echo "Error in preparing the statement: " . mysqli_error($connected);
		$_SESSION['message'] = "<script>alert('Tax detail update failed. Please try again.');</script>";
		header("location:Tax.php?st=failure");
	}
} else {
	$_SESSION['message'] = "<script>alert('Connection failed. Please try again.');</script>";
	header("location:Tax.php?st=failure");
}
?>
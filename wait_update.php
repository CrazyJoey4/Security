<?PHP
//wait_update.php

include("connect.php");
session_start();

if (isset($_POST['Wait_ID'])) {
	$ID = $_POST['Wait_ID'];
	$NAME = $_POST['Cus_name'];
	$PAX = $_POST['Cus_Pax'];
	$CONTACT = $_POST['Cus_contact'];

	// Validate phone number (assuming a simple format)
	if (!preg_match('/^\d{10}$/', $CONTACT)) {
		$_SESSION['message'] = "<script>alert('Invalid phone number.');</script>";
		header("location:Wait_Edit.php?id=$ID");
		exit();
	}

	$query = "UPDATE `waitlist_table` SET 
			`Cus_name` = ?,
			`Cus_Pax` = ?,
			`Cus_contact` = ?
			WHERE `Wait_ID` = ?";
	$statement = mysqli_prepare($connected, $query);

	// Check if the prepared statement is successfully updated
	if ($statement) {
		// Check the number of affected rows after the update operation
		mysqli_stmt_bind_param($statement, "siss", $NAME, $PAX, $CONTACT, $ID);

		// Execute the statement
		if (mysqli_stmt_execute($statement)) {
			$rowsAffected = mysqli_stmt_affected_rows($statement);

			if ($rowsAffected > 0) {
				$_SESSION['message'] = "<script>alert('Waitlist updated!');</script>";
				header("location:Waitlist.php?st=updated");
			} else {
				$_SESSION['message'] = "<script>alert('Waitlist update failed. Please try again.');</script>";
				header("location:Waitlist.php?st=failure");
			}
		} else {
			// echo "Error executing the statement: " . mysqli_stmt_error($statement);
			$_SESSION['message'] = "<script>alert('Waitlist update failed. Please try again.');</script>";
			header("location:Waitlist.php?st=failure");
		}

		// Close the prepared statement
		mysqli_stmt_close($statement);
	} else {
		// echo "Error in preparing the statement: " . mysqli_error($connected);
		$_SESSION['message'] = "<script>alert('Waitlist update failed. Please try again.');</script>";
		header("location:Waitlist.php?st=failure");
	}
} else {
	$_SESSION['message'] = "<script>alert('Connection failed. Please try again.');</script>";
	header("location:Waitlist.php?st=failure");
}

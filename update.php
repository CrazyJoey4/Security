<?PHP
//update.php

include("connect.php");
session_start();

$object = new Connect();

if (isset($_SESSION['User_ID'])) {
	$ID = $_SESSION['User_ID'];
	$NAME = $_POST['User_name'];
	$EMAIL = $_POST['User_email'];
	$PASSWORD = $_POST['User_pwd'];
	$CONTACT = $_POST['User_contact'];
	$BIRTHDAY = $_POST['User_birthday'];
	$GENDER = $_POST['User_gender'];

	// Validate input fields to avoid empty values
	if (empty($NAME) || empty($EMAIL) || empty($PASSWORD) || empty($CONTACT) || empty($BIRTHDAY) || empty($GENDER)) {
		$_SESSION['message'] = "<script>alert('Please fill in all fields.');</script>";
		header("location:Profile.php?st=empty");
		exit();
	}

	// Validate name (no special characters or numbers allowed)
	if (!preg_match('/^[a-zA-Z\s]+$/', $NAME)) {
		$_SESSION['message'] = "<script>alert('Invalid name. Only letters and spaces are allowed.');</script>";
		header("location:Profile.php?st=invalid_name");
		exit();
	}

	// Validate email address
	if (!filter_var($EMAIL, FILTER_VALIDATE_EMAIL)) {
		$_SESSION['message'] = "<script>alert('Invalid email address.');</script>";
		header("location:Profile.php?st=invalid_email");
		exit();
	}

	// Validate phone number (assuming a simple format)
	if (!preg_match('/^\d{10}$/', $CONTACT)) {
		$_SESSION['message'] = "<script>alert('Invalid phone number.');</script>";
		header("location:Profile.php?st=invalid_phone");
		exit();
	}

	$HASHEDPWD = password_hash($PASSWORD, PASSWORD_DEFAULT);

	$query = "UPDATE `user_table` SET 
			`User_name` = ?,
			`User_email` = ?,
			`User_pwd` = ?,
			`User_contact` = ?,
			`User_birthday` = ?
			WHERE User_ID = ?";
	$statement = mysqli_prepare($connected, $query);

	// Check if the prepared statement is successfully updated
	if ($statement) {
		// Check the number of affected rows after the update operation
		mysqli_stmt_bind_param($statement, "ssssss", $NAME, $EMAIL, $HASHEDPWD, $CONTACT, $BIRTHDAY, $ID);

		// Execute the statement
		if (mysqli_stmt_execute($statement)) {
			$rowsAffected = mysqli_stmt_affected_rows($statement);

			if ($rowsAffected > 0) {
				$_SESSION['message'] = "<script>alert('Profile updated!');</script>";
				header("location:Profile.php?st=success");
			} else {
				$_SESSION['message'] = "<script>alert('Profile update failed. Please try again.');</script>";
				header("location:Profile.php?st=failure");
			}
		} else {
			// echo "Error executing the statement: " . mysqli_stmt_error($statement);
			$_SESSION['message'] = "<script>alert('Profile update failed. Please Try again.');</script>";
			header("location:Profile.php?st=failure");
		}

		// Close the prepared statement
		mysqli_stmt_close($statement);
	} else {
		// echo "Error in preparing the statement: " . mysqli_error($connected);
		$_SESSION['message'] = "<script>alert('Profile update failed. Please try again.');</script>";
		header("location:Profile.php?st=failure");
	}
} else {
	$_SESSION['message'] = "<script>alert('Connection failed. Please try again.');</script>";
	header("location:Profile.php?st=failure");
}
?>
<?PHP
//update.php

include("connect.php");
session_start();

$object = new Connect();

if (isset($_POST['submit'])) {
	$ID = $_SESSION['User_ID'];
	$NAME = $_POST['User_name'];
	$EMAIL = $_POST['User_email'];
	$PASSWORD = $_POST['New_pwd'];
	$CONTACT = $_POST['User_contact'];
	$BIRTHDAY = $_POST['User_birthday'];
	$GENDER = $_POST['User_gender'];

	// Validate input fields to avoid empty values
	if (empty($NAME) || empty($EMAIL) || empty($CONTACT) || empty($BIRTHDAY) || empty($GENDER)) {
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

	if (!empty($PASSWORD)) {
		// Password validation
		$uppercase = preg_match('@[A-Z]@', $PASSWORD);
		$lowercase = preg_match('@[a-z]@', $PASSWORD);
		$number = preg_match('@[0-9]@', $PASSWORD);
		$specialChars = preg_match('@[^\w]@', $PASSWORD);

		if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($PASSWORD) < 8) {
			$_SESSION['message'] = "<script>alert('Invalid password. It should be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.');</script>";
			header("location:Profile.php?st=invalid_password");
			exit();
		}

		// Hash the new password
		$HASHEDPWD = password_hash($PASSWORD, PASSWORD_DEFAULT);

		$query_update = "UPDATE `user_table` SET 
								`User_name` = ?,
								`User_email` = ?,
								`User_pwd` = ?,
								`User_contact` = ?,
								`User_birthday` = ?,
								`User_gender` = ?
								WHERE User_ID = ?";
		$statement_update = mysqli_prepare($connected, $query_update);

		if ($statement_update) {
			mysqli_stmt_bind_param($statement_update, "sssssss", $NAME, $EMAIL, $HASHEDPWD, $CONTACT, $BIRTHDAY, $GENDER, $ID);

			if (mysqli_stmt_execute($statement_update)) {
				$_SESSION['message'] = "<script>alert('Profile updated!');</script>";
				header("location:Profile.php?st=success");
			} else {
				// echo "Error executing the statement: " . mysqli_stmt_error($statement_update);
				$_SESSION['message'] = "<script>alert('Profile update failed. Please try again.');</script>";
				header("location:Profile.php?st=failure");
			}

			mysqli_stmt_close($statement_update);
		} else {
			$_SESSION['message'] = "<script>alert('Profile update failed. Please try again.');</script>";
			header("location:Profile.php?st=failure1");
		}
	} else {
		$query_update = "UPDATE `user_table` SET 
						`User_name` = ?,
						`User_email` = ?,
						`User_contact` = ?,
						`User_birthday` = ?,
						`User_gender` = ?
						WHERE User_ID = ?";
		$statement_update = mysqli_prepare($connected, $query_update);

		if ($statement_update) {
			mysqli_stmt_bind_param($statement_update, "ssssss", $NAME, $EMAIL, $CONTACT, $BIRTHDAY, $GENDER, $ID);

			if (mysqli_stmt_execute($statement_update)) {
				$_SESSION['message'] = "<script>alert('Profile updated!');</script>";
				header("location:Profile.php?st=success");
			} else {
				$_SESSION['message'] = "<script>alert('Profile update failed. Please try again.');</script>";
				header("location:Profile.php?st=failure");
			}

			mysqli_stmt_close($statement_update);
		} else {
			$_SESSION['message'] = "<script>alert('Profile update failed. Please try again.');</script>";
			header("location:Profile.php?st=failure4");
		}
	}
} else {
	$_SESSION['message'] = "<script>alert('Connection failed. Please try again.');</script>";
	header("location:Profile.php?st=failure");
}

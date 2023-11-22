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

	$query = "
			UPDATE `user_table` SET 
			`User_name` = '$NAME',
			`User_email` = '$EMAIL',
			`User_pwd` = '$PASSWORD',
			`User_contact` = '$CONTACT',
			`User_birthday` = '$BIRTHDAY',
			`User_gender` = '$GENDER' 
			WHERE User_ID = '$ID'
			";

	if (mysqli_query($connected, $query)) {
		header("location:Profile.php?st=success");
		$_SESSION['message'] = "<script>alert('Updated !');</script>";
	} else {
		$_SESSION['message'] = "<script>alert('Update failed. Try again.');</script>";
		header("location:Profile.php?st=failure");
	}
} else {
	$_SESSION['message'] = "<script>alert('Connect failed. Try again.');</script>";
	header("location:Profile.php?st=failure");
}
?>
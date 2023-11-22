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

	$query = "
			UPDATE `user_table` SET 
			`User_position` = '$POSITION',
			WHERE `User_ID` = '$ID'
			";

	if (mysqli_query($connected, $query)) {
		header("location:Staff.php?st=updated");
		$_SESSION['message'] = "<script>alert('Updated !');</script>";
	} else {
		$_SESSION['message'] = "<script>alert('Update failed. Try again.');</script>";
		header("location:Staff.php?st=failure");
	}
} else {
	$_SESSION['message'] = "<script>alert('Connect failed. Try again.');</script>";
	header("location:Staff.php?st=failure");
}

?>
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

	$query = "
			UPDATE `waitlist_table` SET 
			`Cus_name` = '$NAME',
			`Cus_Pax` = '$PAX',
			`Cus_contact` = '$CONTACT'
			WHERE `Wait_ID` = '$ID'
			";

	if (mysqli_query($connected, $query)) {
		header("location:Waitlist.php?st=updated");
		$_SESSION['message'] = "<script>alert('Updated !');</script>";
	} else {
		$_SESSION['message'] = "<script>alert('Update failed. Try again.');</script>";
		header("location:Waitlist.php?st=failure");
	}
} else {
	$_SESSION['message'] = "<script>alert('Connect failed. Try again.');</script>";
	header("location:Waitlist.php?st=failure");
}
?>
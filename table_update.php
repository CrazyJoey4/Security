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

	$query = "
			UPDATE `table_data` SET 
			`Capacity` = '$CAPACITY',
			`Table_status` = '$STATUS'
			WHERE `Table_ID` = '$ID'
			";

	if (mysqli_query($connected, $query)) {
		header("location:Table.php?st=updated");
		$_SESSION['message'] = "<script>alert('Updated !');</script>";
	} else {
		$_SESSION['message'] = "<script>alert('Update failed. Try again.');</script>";
		header("location:Table.php?st=failure");
	}
} else {
	$_SESSION['message'] = "<script>alert('Connect failed. Try again.');</script>";
	header("location:Table.php?st=failure");
}
?>
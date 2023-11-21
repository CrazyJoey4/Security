<?PHP
//tax_delete.php

include('connect.php');

if (isset($_GET['id'])) {
	$delete_id = $_GET['id'];

	$query = "DELETE FROM tax_table WHERE Tax_ID = '" . $delete_id . "'";

	if (mysqli_query($connected, $query)) {
		header("location:Tax.php?st=Deleted");
	} else {
		$_SESSION['message'] = "<script>alert('Delete failed. Try again.');</script>";
		header("location:Tax.php?st=failure");
	}
}
?>
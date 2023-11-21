<?PHP
//wait_delete.php

include('connect.php');

if (isset($_POST['Wait_ID'])) {
	$delete_id = $_POST['Wait_ID'];
	$table = $_POST['Table_ID'];

	$query = "DELETE FROM waitlist_table WHERE Wait_ID = '" . $delete_id . "'";

	if (mysqli_query($connected, $query)) {
		header("location:Order_Edit.php?id=$table");
	} else {
		$_SESSION['message'] = "<script>alert('Delete failed. Try again.');</script>";
		header("location:Waitlist.php?st=failure");
	}
}

if (isset($_GET['id'])) {
	$delete_id = $_GET['id'];

	$query = "DELETE FROM waitlist_table WHERE Wait_ID = '" . $delete_id . "'";

	if (mysqli_query($connected, $query)) {
		header("location:Waitlist.php?st=Deleted");
	} else {
		$_SESSION['message'] = "<script>alert('Delete failed. Try again.');</script>";
		header("location:Waitlist.php?st=failure");
	}
}
?>
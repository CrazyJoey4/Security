<?PHP
//table_insert.php

include('connect.php');
session_start();

if (isset($_POST["Table_ID"])) {
	$TABLE_ID = $_POST['Table_ID'];
	$TABLE_capacity = $_POST['Capacity'];
	$TABLE_status = $_POST['Table_status'];


	$query = "
		INSERT INTO `table_data`
		(`Table_ID`, `Capacity`, `Table_status`) 
		VALUES ('$TABLE_ID', '$TABLE_capacity', '$TABLE_status')";

	if (mysqli_query($connected, $query)) {
		header("location:Table.php?st=success");
		$_SESSION['message'] = "<script>alert('Added !');</script>";
	} else {
		$_SESSION['message'] = "<script>alert('Failed. Try again.');</script>";
		header("location:Table.php?st=failure");
	}
} else {
	echo "<script>alert('Connect failed. Try again.')</script>";
	header("location:Table.php?st=allfailure");
}
?>
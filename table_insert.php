<?PHP
//table_insert.php

include('connect.php');
session_start();

if (isset($_POST["Table_ID"])) {
	$TABLE_ID = $_POST['Table_ID'];
	$TABLE_capacity = $_POST['Capacity'];
	$TABLE_status = $_POST['Table_status'];

	$query = "INSERT INTO `table_data`
			(`Table_ID`, `Capacity`, `Table_status`) 
			VALUES (?, ?, ?)";
	$statement = mysqli_prepare($connected, $query);

	if ($statement) {
		mysqli_stmt_bind_param($statement, "sds", $TABLE_ID, $TABLE_capacity, $TABLE_status);

		if (mysqli_stmt_execute($statement)) {
			$_SESSION['message'] = "<script>alert('New table added!');</script>";
			header("location:Table.php?st=success");
		} else {
			$_SESSION['message'] = "<script>alert('Add new table failed. Please try again.');</script>";
			header("location:Table.php?st=failure");
		}
		// Close the prepared statement
		mysqli_stmt_close($statement);
	} else {
		//echo "Error in preparing the statement: " . mysqli_error($connected);
		$_SESSION['message'] = "<script>alert('Add new table failed. Please try again.');</script>";
		header("location:Table.php?st=failure");
	}
} else {
	echo "<script>alert('Connection failed. Please try again.')</script>";
	header("location:Table.php?st=allfailure");
}
?>
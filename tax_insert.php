<?PHP
//tax_insert.php

include('connect.php');
session_start();

if (isset($_POST["Tax_name"])) {
	$TAX_name = $_POST['Tax_name'];
	$TAX_percent = $_POST['Tax_percent'];
	$TAX_status = $_POST['Tax_status'];

	$percent = $TAX_percent / 100;

	$query = "INSERT INTO `tax_table`
			(`Tax_name`, `Tax_percent`, `Tax_status`) 
			VALUES (?, ?, ?)";
	$statement = mysqli_prepare($connected, $query);

	if ($statement) {
		mysqli_stmt_bind_param($statement, "sds", $TAX_name, $percent, $TAX_status);

		if (mysqli_stmt_execute($statement)) {
			$_SESSION['message'] = "<script>alert('New tax added!');</script>";
			header("location:Tax.php?st=success");
		} else {
			$_SESSION['message'] = "<script>alert('Add new tax failed. Please try again.');</script>";
			header("location:Tax.php?st=failure");
		}

		// Close the prepared statement
		mysqli_stmt_close($statement);
	} else {
		//echo "Error in preparing the statement: " . mysqli_error($connected);
		$_SESSION['message'] = "<script>alert('Add new tax failed. Please try again.');</script>";
		header("location:Tax.php?st=failure");
	}
} else {
	echo "<script>alert('Connection failed. Please try again.')</script>";
	header("location:Tax.php?st=allfailure");
}
?>
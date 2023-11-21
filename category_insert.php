<?PHP
//category_insert.php

include('connect.php');
session_start();

if (isset($_POST["Category_name"])) {
	$CATEGORY_name = $_POST['Category_name'];
	$CATEGORY_status = $_POST['Category_status'];

	$query = "INSERT INTO `category_table`
		(`Category_name`, `Category_status`) 
		VALUES (?, ?)";
	$statement = mysqli_prepare($connected, $query);

	// Check if the prepared statement is successfully created
	if ($statement) {
		mysqli_stmt_bind_param($statement, "ss", $CATEGORY_name, $CATEGORY_status);

		// Execute the statement
		if (mysqli_stmt_execute($statement)) {
			$_SESSION['message'] = "<script>alert('Category created !');</script>";
			header("location:Category.php?st=success");
		} else {
			$_SESSION['message'] = "<script>alert('Create new category failed. Please try again.');</script>";
			header("location:Category.php?st=failure");
		}

		// Close the prepared statement
		mysqli_stmt_close($statement);
	} else {
		//echo "Error in preparing the statement: " . mysqli_error($connected);
		$_SESSION['message'] = "<script>alert('Create new category failed. Please try again.');</script>";
		header("location:Category.php?st=failure");
	}
} else {
	echo "<script>alert('Connection failed. Please try again.')</script>";
	header("location:Category.php?st=allfailure");
}
?>
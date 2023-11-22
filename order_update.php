<?PHP
//order_update.php

include("connect.php");
session_start();

if (isset($_POST['ID'])) {
	$ID = $_POST['ID'];
	$NAME = $_POST['Food_name'];
	$QUANTITY = $_POST['Food_quantity'];
	$TABLE = $_POST['Table_ID'];

	$query = "UPDATE `order_table` SET 
			`Food_quantity` = ?
			WHERE `ID` = ?";
	$statement = mysqli_prepare($connected, $query);

	// Check if the prepared statement is successfully updated
	if ($statement) {
		// Check the number of affected rows after the update operation
		mysqli_stmt_bind_param($statement, "ss", $QUANTITY, $ID);

		// Execute the statement
		if (mysqli_stmt_execute($statement)) {
			$rowsAffected = mysqli_stmt_affected_rows($statement);

			if ($rowsAffected > 0) {
				$_SESSION['message'] = "<script>alert('Order updated !');</script>";
				header("location:Order_Edit.php?id=$TABLE");
			} else {
				$_SESSION['message'] = "<script>alert('Order update failed. Please try again.');</script>";
				header("location:Order.php?st=failure");
			}
		} else {
			// echo "Error executing the statement: " . mysqli_stmt_error($statement);
			$_SESSION['message'] = "<script>alert('Order update failed. Please try again.');</script>";
			header("location:Order.php?st=failure");
		}

		// Close the prepared statement
		mysqli_stmt_close($statement);
	} else {
		// echo "Error in preparing the statement: " . mysqli_error($connected);
		$_SESSION['message'] = "<script>alert('Order update failed. Please try again.');</script>";
		header("location:Order.php?st=failure");
	}
} else {
	$_SESSION['message'] = "<script>alert('Connection failed. Please try again.');</script>";
	header("location:Order.php?st=failure");
}
?>
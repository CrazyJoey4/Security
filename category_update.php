<?PHP
//category_update.php

include("connect.php");
session_start();

if (isset($_POST['ID'])) {
	$ID = $_POST['ID'];
	$CATEGORY_name = $_POST['Category_name'];
	$CATEGORY_status = $_POST['Category_status'];

	$query = "UPDATE `category_table` SET 
			`Category_name` = ?,
			`Category_status` = ?
			WHERE `ID` = ?";
	$statement = mysqli_prepare($connected, $query);

	if ($statement) {
		mysqli_stmt_bind_param($statement, "ssi", $CATEGORY_name, $CATEGORY_status, $ID);

		// Execute the statement
		if (mysqli_stmt_execute($statement)) {
			$rowsAffected = mysqli_stmt_affected_rows($statement);

			if ($rowsAffected > 0) {
				$_SESSION['message'] = "<script>alert('Category updated!');</script>";
				header("location:Category.php?st=updated");
			} else {
				$_SESSION['message'] = "<script>alert('Category not found. Update failed. Please try again.');</script>";
				header("location:Category.php?st=failure");
			}
		} else {
			// echo "Error executing the statement: " . mysqli_stmt_error($statement);
			$_SESSION['message'] = "<script>alert('Category update failed. Please Try again.');</script>";
			header("location:Category.php?st=failure");
		}

		mysqli_stmt_close($statement);
	} else {
		// echo "Error in preparing the statement: " . mysqli_error($connected);
		$_SESSION['message'] = "<script>alert('Category update failed. Please try again.');</script>";
        header("location: Category.php?st=failure");
	}
} else {
	$_SESSION['message'] = "<script>alert('Connection failed. Please try again.');</script>";
	header("location:Category.php?st=failure");
}
?>
<?PHP
//food_update.php

include("connect.php");
session_start();

if (isset($_POST['Food_ID'])) {
	$ID = $_POST['Food_ID'];
	$FOOD_name = $_POST['Food_name'];
	$FOOD_cost = $_POST['Food_cost'];
	$FOOD_status = $_POST['Food_status'];

	$query = "UPDATE `menu_table` SET 
			`Food_name` = ?,
			`Food_cost` = ?,			
			`Food_status` = ?
			WHERE `Food_ID` = ?";
	$statement = mysqli_prepare($connected, $query);

	// Check if the prepared statement is successfully updated
	if ($statement) {
		// Check the number of affected rows after the update operation
		mysqli_stmt_bind_param($statement, "sdss", $FOOD_name, $FOOD_cost, $FOOD_status, $ID);

		// Execute the statement
		if (mysqli_stmt_execute($statement)) {
			$rowsAffected = mysqli_stmt_affected_rows($statement);

			if ($rowsAffected > 0) {
				$_SESSION['message'] = "<script>alert('Food menu updated !');</script>";
				header("location:FoodMenu.php?st=updated");
			} else {
				$_SESSION['message'] = "<script>alert('Food menu update failed. Please try again.');</script>";
				header("location:FoodMenu.php?st=failure");
			}
		} else {
			// echo "Error executing the statement: " . mysqli_stmt_error($statement);
			$_SESSION['message'] = "<script>alert('Food menu update failed. Please Try again.');</script>";
			header("location:FoodMenu.php?st=failure");
		}

		// Close the prepared statement
		mysqli_stmt_close($statement);
	} else {
		// echo "Error in preparing the statement: " . mysqli_error($connected);
		$_SESSION['message'] = "<script>alert('Food menu update failed. Please try again.');</script>";
		header("location:FoodMenu.php?st=failure");
	}
} else {
	$_SESSION['message'] = "<script>alert('Connection failed. Please try again.');</script>";
	header("location:FoodMenu.php?st=failure");
}
?>
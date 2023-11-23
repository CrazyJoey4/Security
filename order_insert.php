<?PHP
//order_insert.php

include('connect.php');
session_start();

if (isset($_POST["Table_ID"])) {
	$TABLE_id = $_POST['Table_ID'];
	$FOOD_name = $_POST['Food_name'];
	$QUANTITY = $_POST['Food_quantity'];

	$query_insert = "INSERT INTO `order_table` (`Table_ID`, `Food_name`, `Food_quantity`) VALUES (?, ?, ?)";
	$statement_insert = mysqli_prepare($connected, $query_insert);

	if ($statement_insert) {
		mysqli_stmt_bind_param($statement_insert, "ssi", $TABLE_id, $FOOD_name, $QUANTITY);

		if (mysqli_stmt_execute($statement_insert)) {
			$query_update = "UPDATE `table_data` SET `Live_status` = 'Seated' WHERE Table_ID = ?";
			$statement_update = mysqli_prepare($connected, $query_update);

			if ($statement_update) {
				mysqli_stmt_bind_param($statement_update, "s", $TABLE_id);

				if (mysqli_stmt_execute($statement_update)) {
					$_SESSION['message'] = "<script>alert('New food order added!');</script>";
					header("location:Order_Edit.php?id=" . $TABLE_id);
				} else {
					$_SESSION['message'] = "<script>alert('Update table status failed. Please try again.');</script>";
					header("location:Order_Edit.php?st=failure");
				}

				// Close the prepared statement
				mysqli_stmt_close($statement_update);
			} else {
				$_SESSION['message'] = "<script>alert('Update table status failed. Please try again.');</script>";
				header("location:Order_Edit.php?st=failure");
			}

			// Close the prepared statement
			mysqli_stmt_close($statement_insert);
		} else {
			//echo "Error in preparing the statement: " . mysqli_error($connected);
			$_SESSION['message'] = "<script>alert('Add new food order failed. Please try again.');</script>";
			header("location:Order_Edit.php?st=failure");
		}
	} else {
		//echo "Error in preparing the statement: " . mysqli_error($connected);
		$_SESSION['message'] = "<script>alert('Add new food order failed. Please try again.');</script>";
		header("location:Order_Edit.php?st=failure");
	}
} else {
	echo "<script>alert('Connection failed. Please try again.')</script>";
	header("location:Order_Edit.php?st=allfailure");
}
?>
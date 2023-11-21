<?PHP
//food_insert.php

include('connect.php');
session_start();

if (isset($_POST["Food_ID"])) {
	$FOOD_id = $_POST['Food_ID'];

	$query_check = "SELECT * FROM menu_table WHERE Food_ID = ?";
	$statement_check = mysqli_prepare($connected, $query_check);

	if ($statement_check) {
		mysqli_stmt_bind_param($statement_check, "s", $FOOD_id);
		mysqli_stmt_execute($statement_check);

		mysqli_stmt_store_result($statement_check);
		if (mysqli_stmt_num_rows($statement_check) > 0) {
			$_SESSION['message'] = "<script>alert('Food ID already exists! Please use another Food ID.')</script>";
			header("location:FoodMenu.php?st=failure");
			exit();
		}

		// Close the statement for checking
		mysqli_stmt_close($statement_check);
	}

	$FOOD_name = $_POST['Food_name'];
	$FOOD_cost = $_POST['Food_cost'];
	$CATEGORY_name = $_POST['Category_name'];
	$FOOD_status = $_POST['Food_status'];

	$query = "INSERT INTO `menu_table`
			(`Food_ID`, `Food_name`, `Food_cost`, `Category_name`, `Food_status`) 
			VALUES (?, ?, ?, ?, ?)";
	$statement = mysqli_prepare($connected, $query);

	if ($statement) {
		mysqli_stmt_bind_param($statement, "ssdss", $FOOD_id, $FOOD_name, $FOOD_cost, $CATEGORY_name, $FOOD_status);

		if (mysqli_stmt_execute($statement)) {
			$_SESSION['message'] = "<script>alert('New food menu added !');</script>";
			header("location:FoodMenu.php?st=success");
		} else {
			$_SESSION['message'] = "<script>alert('Add new food menu failed. Please try again.');</script>";
			header("location:FoodMenu.php?st=failure");
		}

		// Close the prepared statement
		mysqli_stmt_close($statement);
	} else {
		//echo "Error in preparing the statement: " . mysqli_error($connected);
		$_SESSION['message'] = "<script>alert('Add new food menu failed. Please try again.');</script>";
		header("location:FoodMenu.php?st=failure");
	}
} else {
	echo "<script>alert('Connection failed. Please try again.')</script>";
	header("location:FoodMenu.php?st=allfailure");
}
?>
<?PHP
//staff_insert.php

include('connect.php');
session_start();

$object = new Connect();

if (isset($_POST["User_ID"])) {
	$USER_id = $_POST['User_ID'];

	$query_check = "SELECT * FROM user_table WHERE User_ID = ?";
	$statement_check = mysqli_prepare($connected, $query_check);

	if ($statement_check) {
		mysqli_stmt_bind_param($statement_check, "s", $FOOD_id);
		mysqli_stmt_execute($statement_check);

		mysqli_stmt_store_result($statement_check);
		if (mysqli_stmt_num_rows($statement_check) > 0) {
			$_SESSION['message'] = "<script>alert('User ID already exists! Please use another ID.')</script>";
			header("location:Staff.php?st=failure");
			exit();
		}

		// Close the statement for checking
		mysqli_stmt_close($statement_check);
	}

	$USER_name = $_POST['User_name'];
	$USER_email = $_POST['User_email'];
	$USER_password = $_POST['User_pwd'];
	$USER_position = $_POST['User_position'];
	$USER_start = $object->get_datetime();

	$HASHED_pwd = password_hash($USER_password, PASSWORD_DEFAULT);

	$query = "INSERT INTO `user_table`
			(`User_ID`, `User_name`, `User_email`, `User_pwd`, `User_position`, `User_start`) 
			VALUES (?, ?, ?, ?, ?, ?)";

	$statement = mysqli_prepare($connected, $query);

	if ($statement) {
		mysqli_stmt_bind_param($statement, "ssssss", $USER_id, $USER_name, $USER_email, $HASHED_pwd, $USER_position, $USER_start);

		if (mysqli_stmt_execute($statement)) {
			$_SESSION['message'] = "<script>alert('Registered new staff successful. You may ask the staff to login now.');</script>";
			header("location:Staff.php?st=success");
		} else {
			$_SESSION['message'] = "<script>alert('Register new staff failed. Try again.');</script>";
			header("location:Staff.php?st=failure");
		}

		// Close the prepared statement
		mysqli_stmt_close($statement);
	} else {
		//echo "Error in preparing the statement: " . mysqli_error($connected);
		$_SESSION['message'] = "<script>alert('Register new staff failed. Please try again.');</script>";
		header("location:Staff.php?st=failure");
	}
} else {
	echo "<script>alert('Connection failed. Please try again.')</script>";
	header("location:Staff.php?st=allfailure");
}
?>
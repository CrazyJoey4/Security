<?PHP
include('connect.php');
session_start();

$object = new Connect();

if (isset($_POST["User_ID"])) {
	$USER_id = $_POST['User_ID'];

	$query_check = "SELECT * FROM user_table WHERE User_ID = ?";
    $statement_check = mysqli_prepare($connected, $query_check);

    if ($statement_check) {
        mysqli_stmt_bind_param($statement_check, "s", $USER_id);
        mysqli_stmt_execute($statement_check);

        // Get the result from the prepared statement
        $result_check = mysqli_stmt_get_result($statement_check);

        // Check if a row exists for the given User_ID
        if (mysqli_stmt_num_rows($statement_check) > 0) {
            header("location:RegisterForm.php?st=failure");
            $_SESSION['message'] = "<script>alert('ID already exists! Please use another ID.')</script>";
            exit(); // Exit to avoid executing the rest of the code
        }

        // Close the statement for checking
        mysqli_stmt_close($statement_check);
    }

    $RES_name = $_POST['res_name'];
    $RES_location = $_POST['res_location'];
    $RES_contact = $_POST['res_contact'];
    $RES_email = $_POST['User_email'];
    $RES_currency = $_POST['res_currency'];
    $RES_timezone = $_POST['res_timezone'];
    $USER_email = $_POST['User_email'];
    $USER_pwd = $_POST['User_pwd'];
    $USER_position = "Master";
    $USER_start = $object->get_datetime();

    // Use password_hash() to hash the password
    $hashed_pwd = password_hash($USER_pwd, PASSWORD_DEFAULT);

    $query = "INSERT INTO `restaurant_master` 
        	(`res_name`, `res_location`, `res_contact`, `res_email`, `res_currency`, `res_timezone`) 
        	VALUES (?, ?, ?, ?, ?, ?);

			INSERT INTO `user_table` 
			(`User_ID`, `User_email`, `User_pwd`, `User_position`, `User_start`) 
			VALUES (?, ?, ?, ?, ?);";
    $statement = mysqli_prepare($connected, $query);

    if ($statement) {
        mysqli_stmt_bind_param($statement, "ssssss", $RES_name, $RES_location, $RES_contact, $RES_email, $RES_currency, $RES_timezone);
        mysqli_stmt_execute($statement_insert);

        mysqli_stmt_bind_param($statement_insert, "sssss", $USER_id, $USER_email, $hashed_pwd, $USER_position, $USER_start);
        mysqli_stmt_execute($statement_insert);

        // Close the prepared statement
        mysqli_stmt_close($statement_insert);

		$_SESSION['message'] = "<script>alert('Account registered successful. You may login now.');</script>";
        header("location:index.php?st=success");
    } else {
        $_SESSION['message'] = "<script>alert('Account registration failed. Please try again.');</script>";
        header("location:RegisterForm.php?st=failure");
    }
} else {
	echo "<script>alert('Connection failed. Please try again.')</script>";
	header("location:RegisterForm.php?st=allfailure");
}
?>
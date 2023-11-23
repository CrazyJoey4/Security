<?PHP
//wait_insert.php

include('connect.php');
session_start();

$object = new Connect();

if (isset($_POST["Wait_ID"])) {
	$WAIT_ID = $_POST['Wait_ID'];
	$CUS_name = $_POST['Cus_name'];
	$CUS_pax = $_POST['Cus_Pax'];
	$CUS_contact = $_POST['Cus_contact'];
	$CUS_time = $object->get_datetime();

	// Validate phone number (assuming a simple format)
	if (!preg_match('/^\d{10}$/', $CUS_contact)) {
		$_SESSION['message'] = "<script>alert('Invalid phone number.');</script>";
		header("location:Waitlist.php");
		exit();
	}

	$query = "INSERT INTO `waitlist_table`
			(`Wait_ID`, `Cus_name`, `Cus_Pax`, `Cus_contact`, `Wait_time`) 
			VALUES (?, ?, ?, ?, ?)";
	$statement = mysqli_prepare($connected, $query);

	if ($statement) {
		mysqli_stmt_bind_param($statement, "ssdss", $WAIT_ID, $CUS_name, $CUS_pax, $CUS_contact, $CUS_time);

		if (mysqli_stmt_execute($statement)) {
			$_SESSION['message'] = "<script>alert('New waitlist added!');</script>";
			header("location:Waitlist.php?st=success");
		} else {
			$_SESSION['message'] = "<script>alert('Add new waitlist failed. Please try again.');</script>";
			header("location:Waitlist.php?st=failure");
		}

		// Close the prepared statement
		mysqli_stmt_close($statement);
	} else {
		//echo "Error in preparing the statement: " . mysqli_error($connected);
		$_SESSION['message'] = "<script>alert('Add new waitlist failed. Please try again.');</script>";
		header("location:Waitlist.php?st=failure");
	}
} else {
	echo "<script>alert('Connect failed. Try again.')</script>";
	header("location:Waitlist.php?st=allfailure");
}
?>
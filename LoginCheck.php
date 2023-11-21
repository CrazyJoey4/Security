<?PHP
include("connect.php");
session_start();

$object = new Connect();

if (isset($_POST["Sign"])) {
	$Id = $_POST['User_ID'];
	$password = $_POST['User_pwd'];

	$query = mysqli_query($connected, "select * from user_table where User_ID = '$Id' && User_pwd = '$password'");

	if (mysqli_num_rows($query) == 0) {
		$_SESSION['message'] = "Login failed. Try again.";
		header("location:index.php?st=WrongPassword");
	} else {
		$row = mysqli_fetch_array($query);
		$_SESSION['User_ID'] = $row['User_ID'];
		$DATETIME = $object->get_datetime();

		mysqli_query($connected, "INSERT INTO `attendance_table` (`Staff_ID`, `LoginTime`) VALUES ('$Id', '$DATETIME');");
		header("location:Dashboard.php");
	}
}
?>
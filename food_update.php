<?PHP
//food_update.php

include("connect.php");
session_start();

if (isset($_POST['Food_ID'])) {
	$ID = $_POST['Food_ID'];
	$NAME = $_POST['Food_name'];
	$COST = $_POST['Food_cost'];
	$STATUS = $_POST['Food_status'];

	$query = "
			UPDATE `menu_table` SET 
			`Food_name` = '$NAME',
			`Food_cost` = '$COST',			
			`Food_status` = '$STATUS'
			WHERE `Food_ID` = '$ID'
			";

	if (mysqli_query($connected, $query)) {
		header("location:FoodMenu.php?st=updated");
		$_SESSION['message'] = "<script>alert('Updated !');</script>";
	} else {
		$_SESSION['message'] = "<script>alert('Update failed. Try again.');</script>";
		header("location:FoodMenu.php?st=failure");
	}
} else {
	$_SESSION['message'] = "<script>alert('Connect failed. Try again.');</script>";
	header("location:FoodMenu.php?st=failure");
}
?>
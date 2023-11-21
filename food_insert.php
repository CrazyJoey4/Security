<?PHP
//food_insert.php

include('connect.php');
session_start();

if (isset($_POST["Food_ID"])) {
	$FOOD_ID = $_POST['Food_ID'];

	$query = mysqli_query($connected, "SELECT * FROM menu_table WHERE Food_ID = '$FOOD_ID'");

	if (mysqli_num_rows($query) == 1) {
		header("location:FoodMenu.php?st=failure");

		$_SESSION['message'] = "<script>alert('ID already exists! Please use another ID.')</script>";
	} else {
		$FOOD_name = $_POST['Food_name'];
		$FOOD_cost = $_POST['Food_cost'];
		$CATEGORY_name = $_POST['Category_name'];
		$FOOD_status = $_POST['Food_status'];

		$query = "
			INSERT INTO `menu_table`
			(`Food_ID`, `Food_name`, `Food_cost`, `Category_name`, `Food_status`) 
			VALUES ('$FOOD_ID', '$FOOD_name', '$FOOD_cost', '$CATEGORY_name', '$FOOD_status')";

		if (mysqli_query($connected, $query)) {
			header("location:FoodMenu.php?st=success");
			$_SESSION['message'] = "<script>alert('Added !');</script>";
		} else {
			$_SESSION['message'] = "<script>alert('Failed. Try again.');</script>";
			header("location:FoodMenu.php?st=failure");
		}
	}
} else {
	echo "<script>alert('Connect failed. Try again.')</script>";
	header("location:FoodMenu.php?st=allfailure");
}
?>
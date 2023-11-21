<?PHP
//order_insert.php

include('connect.php');
session_start();

if (isset($_POST["Table_ID"])) {
	$TABLE_ID = $_POST['Table_ID'];
	$FOOD_name = $_POST['Food_name'];
	$QUANTITY = $_POST['Food_quantity'];

	$query = "
		INSERT INTO `order_table`
		(`Table_ID`, `Food_name`, `Food_quantity`)
		VALUES ('$TABLE_ID', '$FOOD_name', '$QUANTITY');
		
		UPDATE `table_data` SET `Live_status` = 'Seated' WHERE Table_ID = '$TABLE_ID';
		";

	if (mysqli_multi_query($connected, $query)) {
		header("location:Order_Edit.php?id=" . $TABLE_ID);
		$_SESSION['message'] = "<script>alert('Added !');</script>";
	} else {
		$_SESSION['message'] = "<script>alert('Failed. Try again.');</script>";
		header("location:Order_Edit.php?st=failure");
	}
} else {
	echo "<script>alert('Connect failed. Try again.')</script>";
	header("location:Order_Edit.php?st=allfailure");
}
?>
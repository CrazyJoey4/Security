<?PHP
//tax_insert.php

include('connect.php');
session_start();

if (isset($_POST["Tax_name"])) {
	$TAX_name = $_POST['Tax_name'];
	$TAX_percent = $_POST['Tax_percent'];
	$TAX_status = $_POST['Tax_status'];

	$percent = $TAX_percent / 100;

	$query = "
		INSERT INTO `tax_table`
		(`Tax_name`, `Tax_percent`, `Tax_status`) 
		VALUES ('$TAX_name', '$percent', '$TAX_status')";

	if (mysqli_query($connected, $query)) {
		header("location:Tax.php?st=success");
		$_SESSION['message'] = "<script>alert('Added !');</script>";
	} else {
		$_SESSION['message'] = "<script>alert('Failed. Try again.');</script>";
		header("location:Tax.php?st=failure");
	}
} else {
	echo "<script>alert('Connect failed. Try again.')</script>";
	header("location:Tax.php?st=allfailure");
}
?>
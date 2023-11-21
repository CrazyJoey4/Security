<?PHP
//pay_insert.php

include('connect.php');
session_start();
$object = new Connect();

if (isset($_POST['Table_ID'])) {
	$TABLE_ID = $_POST['Table_ID'];
	$GROSS = $_POST['Gross_pay'];
	$TAX = $_POST['Tax_pay'];
	$NET = $_POST['Net_pay'];
	$PAYTYPE = $_POST['Pay_type'];
	$PAY = $_POST['Pay_amount'];
	$CARD = $_POST['Card_number'];
	$DATE = $object->get_datetime();
	$TIME = $object->get_datetime();

	$value2 = '';
	$query = "SELECT Order_ID from payment_table order by Order_ID DESC LIMIT 1";
	$stmt = mysqli_query($connected, $query);
	if (mysqli_num_rows($stmt) > 0) {
		if ($row = mysqli_fetch_assoc($stmt)) {
			$value2 = $row['Order_ID'];
			$value2 = substr($value2, 1, 5);
			$value2 = $value2 + 1;
			$value2 = sprintf('P%05u', $value2);
			$value = $value2;
		}
	} else {
		$value2 = "P00001";
		$value = $value2;
	}

	$query = "
		INSERT INTO `payment_table`
		(`Order_ID`, `Gross_pay`, `Tax_pay`, `Net_pay`, `Pay_type`, `Pay_amount`, `Card_number`, `Pay_date`, `Pay_time`)
		VALUES ('$value', '$GROSS', '$TAX', '$NET', '$PAYTYPE', '$PAY', '$CARD', '$DATE', '$TIME');
		
		DELETE FROM order_table WHERE Table_ID = '$TABLE_ID';
		
		UPDATE `table_data` SET `Live_status` = 'Available' WHERE Table_ID = '$TABLE_ID';
		";

	if (mysqli_multi_query($connected, $query)) {
		header("location:Payment.php?st=paid");
		$_SESSION['message'] = "<script>alert('Payment Successful !');</script>";
	} else {
		$_SESSION['message'] = "<script>alert('Failed. Try again.');</script>";
		header("location:Payment.php?st=failure");
	}
} else {
	echo "<script>alert('Connect failed. Try again.')</script>";
	header("location:Payment.php?st=allfailure");
}
?>
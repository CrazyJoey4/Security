<?PHP
//pay_insert.php

include('connect.php');
session_start();
$object = new Connect();

if (isset($_POST['Table_ID'])) {
	$TABLE_id = $_POST['Table_ID'];
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

	$query_insert = "INSERT INTO `payment_table`
					(`Order_ID`, `Gross_pay`, `Tax_pay`, `Net_pay`, `Pay_type`, `Pay_amount`, `Card_number`, `Pay_date`, `Pay_time`)
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
	$statement_insert = mysqli_prepare($connected, $query_insert);

	if ($statement_insert) {
		mysqli_stmt_bind_param($statement_insert, "sdddsdsss", $value, $GROSS, $TAX, $NET, $PAYTYPE, $PAY, $CARD, $DATE, $TIME);

		if (mysqli_stmt_execute($statement_insert)) {
			$query_delete = "DELETE FROM order_table WHERE Table_ID = ?";
			$statement_delete = mysqli_prepare($connected, $query_delete);

			if ($statement_delete) {
				mysqli_stmt_bind_param($statement_delete, "s", $TABLE_id);

				if (mysqli_stmt_execute($statement_delete)) {
					$query_update = "UPDATE `table_data` SET `Live_status` = 'Available' WHERE Table_ID = ?";
					$statement_update = mysqli_prepare($connected, $query_update);

					if ($statement_update) {
						mysqli_stmt_bind_param($statement_update, "s", $TABLE_id);

						if (mysqli_stmt_execute($statement_update)) {
							$_SESSION['message'] = "<script>alert('Payment successful!');</script>";
							header("location:Payment.php?st=paid");
						} else {
							$_SESSION['message'] = "<script>alert('Payment failed. Please try again.');</script>";
							header("location:Payment.php?st=failure");
						}

						// Close the prepared statement
						mysqli_stmt_close($statement_update);
					} else {
						$_SESSION['message'] = "<script>alert('Payment failed. Please try again.');</script>";
						header("location:Payment.php?st=failure");
					}

					// Close the prepared statement
					mysqli_stmt_close($statement_delete);
				} else {
					$_SESSION['message'] = "<script>alert('Payment failed. Please try again.');</script>";
					header("location:Payment.php?st=failure");
				}
			} else {
				$_SESSION['message'] = "<script>alert('Payment failed. Please try again.');</script>";
				header("location:Payment.php?st=failure");
			}

			// Close the prepared statement
			mysqli_stmt_close($statement_insert);
		} else {
			//echo "Error in preparing the statement: " . mysqli_error($connected);
			$_SESSION['message'] = "<script>alert('Payment failed. Please try again.');</script>";
			header("location:Payment.php?st=failure");
		}
	} else {
		//echo "Error in preparing the statement: " . mysqli_error($connected);
		$_SESSION['message'] = "<script>alert('Payment failed. Please try again.');</script>";
		header("location:Payment.php?st=failure");
	}
} else {
	echo "<script>alert('Connection failed. Please try again.')</script>";
	header("location:Payment.php?st=allfailure");
}
?>
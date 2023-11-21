<?PHP
//Payment_Page.php

session_start();

if (isset($_GET['id'])) {
	include('connect.php');
	$object = new Connect();
	$table = $_GET['id'];
}
?>

<html>

<head>
	<title>- Payment Details Page -</title>

	<link rel="icon" href="Money-icon.ico">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<style>
		.content {
			margin: 0;
			background-color: #B2D2FC;
			padding: 20px;
			font-size: 20px;
			font-family: georgia, garamond, serif;
			height: 100%;
		}

		h1 {
			text-align: center;
			font-style: italic;
			font-weight: bold;
		}

		h3 {
			margin-left: 20px;
			text-align: center;
			width: 150px;
			padding: 10px;
			font-family: Times New Roman;
			font-size: 25px;
			background-color: #85BAFF;
			color: white;
			border-radius: 10px 0 20px;
			border: none;
			font-weight: bold;
		}

		.span {
			text-align: center;
			display: block;
			float: right;
			width: 300px;
			padding: 5px;
			font-family: Times New Roman;
			font-size: 20px;
			background-color: #80FFCD;
			color: black;
			border-radius: 10px;
			border: none;
			font-weight: bold;
		}

		table,
		th,
		td {
			border: solid 2px silver;
			border-collapse: collapse;
			padding: 5px;
			text-align: center;
		}

		table {
			border: solid 2px silver;
			width: 100%;
			font-size: 20px;
		}

		th {
			text-align: center;
		}

		.wrap {
			margin-left: auto;
			margin-right: auto;
			background: snow;
			padding: 20px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
			border-radius: 10px;
		}

		.wrap .InputText {
			height: 70px;
			width: 50%;
			position: relative;
			margin-left: auto;
			margin-right: auto;
		}

		.wrap .InputText input {
			height: 100%;
			width: 100%;
			background: snow;
			border: none;
			border-bottom: 2px solid silver;
			font-size: 20px;
			outline: none;
			text-align: center;
		}

		.wrap .InputText input:focus~label,
		.wrap .InputText input:valid~label {
			transform: translateY(-40px);
			transition: all 0.3s ease;
			color: black;
			outline: none;
		}

		.wrap .InputText label {
			font-size: 20px;
			position: absolute;
			bottom: 10px;
			left: 0;
			color: grey;
			pointer-events: none;
		}

		.wrap .InputText .underline {
			position: absolute;
			bottom: 0px;
			height: 2px;
			width: 100%;
		}

		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
			display: none;
		}

		.submit,
		.cancel {
			background-color: white;
			color: black;
			display: block-inline;
			font-family: georgia, garamond, serif;
			font-size: 20px;
			text-align: center;
			text-decoration: none;
			padding: 10px 100px;
			border: none;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		}

		.submit:hover {
			background-color: #5199F9;
			color: white;
			transition: 0.3s;
		}

		.cancel:hover {
			background-color: red;
			color: white;
			transition: 0.3s;
		}

		#overlay {
			position: fixed;
			display: none;
			width: 80%;
			height: 90%;
			top: 10;
			left: 170px;
			border: 2px solid black;
			box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
			overflow: auto;
		}

		.back_btn {
			background-color: #5199F9;
			color: white;
			text-align: center;
			text-decoration: none;
			padding: 10px;
			border: none;
			border-radius: 50%;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		}

		.material-icons {
			font-size: 30px;
		}

		.back_btn:hover {
			background-color: white;
			color: black;
			transition: 0.3s;
		}

		.edit_btn {
			background-color: #5199F9;
			color: white;
			text-align: center;
			text-decoration: none;
			padding: 10px;
			border: none;
			border-radius: 30%;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		}

		.edit_btn .material-icons {
			font-size: 25px;
		}

		.edit_btn:hover {
			background-color: white;
			color: black;
			transition: 0.3s;
		}

		a {
			text-decoration: none;
		}

		.pay_btn {
			font-size: 25px;
			background-color: #5199F9;
			color: white;
			text-align: center;
			text-decoration: none;
			padding: 8px 70px;
			border: none;
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);

		}

		.pay_btn .material-icons {
			font-size: 30px;
			text-align: center;
		}

		.pay_btn:hover {
			background-color: white;
			color: black;
			transition: 0.3s;
		}

		.add_btn {
			position: fixed;
			bottom: 30;
			right: 30;
			background-color: #18FF23;
			font-size: 30px;
			color: silver;
			text-align: center;
			text-decoration: none;
			padding: 8px 70px;
			border: none;
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		}

		.add_btn:hover {
			color: black;
			transition: 0.3s;
			box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
		}
	</style>
</head>

<body>
	<div class="content">
		<div class="wrap">

			<span>
				<?PHP
				if (isset($_SESSION['message'])) {
					echo $_SESSION['message'];
				}
				unset($_SESSION['message']);
				?>
			</span>

			<a href="Payment.php">
				<button class="back_btn"><i class='material-icons'>arrow_back</i></button>
			</a>

			<center>
				<h1>Order Details<br></h1>
			</center>

			<h3>
				<?PHP echo $table; ?>
			</h3>

			<br>

			<?php
			echo "<table>
					<tr>
						<th width='10%'>Food ID</th>
						<th width='50%'>Food Name</th>
						<th width='15%'>Quantity</th>
					</tr>";

			$query = "SELECT * FROM order_table WHERE Table_ID = '$table'";
			$result = mysqli_query($connected, $query);

			while ($row = mysqli_fetch_array($result)) {
				$query2 = "SELECT * FROM menu_table WHERE Food_name = '" . $row['Food_name'] . "'";
				$result2 = mysqli_query($connected, $query2);
				$row2 = mysqli_fetch_array($result2);

				echo "<tr style = 'font-family:Times New Romans; font-weight:bold'>";
				echo "<td>" . $row2['Food_ID'] . "</td>";
				echo "<td>" . $row['Food_name'] . "</td>";
				echo "<td>" . $row['Food_quantity'] . "</td>";

				echo "</tr>";
			}

			echo "</table>";
			?>
		</div>

		<br>
		<button class='add_btn' onclick="on()">Make Payment</button>

		<div id="overlay" class="overlay">
			<div class="wrap" style="text-align:center;">

				<h3>
					<?PHP echo $table; ?>
				</h3>
				<h1>Receipt</h1>

				<hr style="border-bottom:2px solid grey;">
				<?php
				echo "<span class = 'span'>" . $object->get_datetime() . "</span>";

				echo "<br><br>";

				echo "<table>
							<tr>						
								<th width='10%'>Food ID</th>
								<th width='20%'>Food Name</th>
								<th width='15%'>Quantity</th>
								<th width='15%'>Price</th>
								<th width='15%'>Subtotal</th>
							</tr>";

				$query = "SELECT * FROM order_table WHERE Table_ID = '$table'";
				$result = mysqli_query($connected, $query);
				$Total = 0;

				while ($row = mysqli_fetch_array($result)) {
					$query2 = "SELECT * FROM menu_table WHERE Food_name = '" . $row['Food_name'] . "'";
					$result2 = mysqli_query($connected, $query2);

					while ($row2 = mysqli_fetch_array($result2)) {
						echo "<tr style = 'font-family:Times New Romans; font-weight:bold'>";
						echo "<td>" . $row2['Food_ID'] . "</td>";
						echo "<td>" . $row['Food_name'] . "</td>";
						echo "<td>" . $row['Food_quantity'] . "</td>";

						$result3 = mysqli_query($connected, "select res_currency FROM restaurant_master");
						$row3 = mysqli_fetch_array($result3);

						echo "<td>" . $row3['res_currency'] . " " . $row2['Food_cost'] . "</td>";
						$Qtt = $row['Food_quantity'];
						$Pri = $row2['Food_cost'];
						$sub = $Qtt * $Pri;

						$Total += $sub;
						echo "<td>" . number_format($sub, 2, '.', '') . "</td>";
						echo "</tr>";
					}
				}
				$query = "SELECT * FROM tax_table WHERE Tax_status = 'Able'";
				$result = mysqli_query($connected, $query);
				while ($row = mysqli_fetch_array($result)) {
					$tax = $row['Tax_percent'] * 100;

					echo "<tr style = 'font-family:Times New Romans; font-weight:bold'>";
					echo "<td colspan = '3'></td>";
					echo "<td>" . $row['Tax_name'] . " &nbsp;&nbsp; " . $tax . "%</td>";
					$taxcost = $Total * $row['Tax_percent'];
					echo "<td>" . number_format($taxcost, 2, '.', '') . "</td>";
					$Total += $taxcost;
					echo "</tr>";
				}
				echo "<tr style = 'font-family:Times New Romans; font-weight:bold'>";
				echo "<td colspan = '4'></td>";
				echo "<td>" . number_format($Total, 2, '.', '') . "</td>";
				echo "</tr>";

				$result3 = mysqli_query($connected, "select res_currency FROM restaurant_master");
				$row3 = mysqli_fetch_array($result3);

				echo "<tr style = 'font-family:Times New Romans; font-weight:bold'>";
				echo "<td colspan = '4' style = 'text-align:right;'>Total : </td>";
				echo "<td>" . $row3['res_currency'] . " &nbsp;&nbsp; " . number_format(round($Total, 1), 2, '.', '') . "</td>";
				echo "</tr>";
				echo "</table>";
				?>
				<br>
				<hr style="border-bottom:2px solid grey;">
				<h2>Payment Type</h2>
				<?PHP
				$query = "SELECT * FROM order_table WHERE Table_ID = '$table'";
				$result = mysqli_query($connected, $query);
				$row = mysqli_fetch_array($result);

				echo "<a href = 'Pay_Card.php?id=" . $row['Table_ID'] . "'><button class = 'pay_btn'><i class = 'material-icons'>credit_card</i> Card</button></a>";

				echo "&nbsp;&nbsp;&nbsp;";

				echo "<a href = 'Pay_Cash.php?id=" . $row['Table_ID'] . "'><button class = 'pay_btn'><i class = 'material-icons'>money</i> Cash</button></a>";
				?>

				<br><br>
				<button type="reset" class="cancel" onclick="off()">Cancel</button>
			</div>
		</div>
	</div>

	<script>
		function on() {
			document.getElementById("overlay").style.display = "block";
		}

		function off() {
			document.getElementById("overlay").style.display = "none";
		}		
	</script>
</body>

</html>
<?PHP
//Payment.php

include('header.php');

$object = new Connect();

if (!$object->isLogin()) {
	header("location:" . $object->base_url . "index.php");
}
?>

<html>

<head>
	<title> - Payment Page - </title>

	<style>
		.content {
			height: 100%;
			overflow: auto;
		}

		h1 {
			font-style: italic;
			font-weight: bold;
		}

		h3 {
			font-style: italic;
			text-align: center;
		}

		.wrap {
			width: 100%;
			background: white;
			padding: 30px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		}

		#overlay .wrap {
			width: 100%;
			background: snow;
			padding: 30px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		}

		.wrap .InputText {
			text-align: center;
			height: 70px;
			margin-left: auto;
			margin-right: auto;
			width: 50%;
			position: relative;
		}

		.wrap .InputText input {
			text-align: center;
			height: 100%;
			width: 100%;
			background: snow;
			border: none;
			border-bottom: 2px solid silver;
			font-size: 20px;
			outline: none;
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

		.add_btn {
			background-color: #18FF23;
			color: white;
			text-align: center;
			text-decoration: none;
			padding: 10px;
			border: none;
			border-radius: 50%;
			opacity: 50%;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		}

		.material-icons {
			font-size: 25px;
			font-weight: bold;
		}

		.add_btn:hover {
			box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
			opacity: 1;
			transition: 0.3s;
		}

		#overlay {
			position: fixed;
			display: none;
			width: 50%;
			top: 10;
			left: 400px;
			border: 2px solid black;
			box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
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

		.material-icons {
			font-size: 25px;
		}

		.edit_btn:hover {
			background-color: white;
			color: black;
			transition: 0.3s;
		}

		.tbl_btn {
			margin-left: 20px;
			margin-top: 20px;
			width: 150px;
			padding: 10px;
			font-family: Times New Roman;
			font-size: 25px;
			background-color: #85BAFF;
			color: snow;
			outline: none;
			border-radius: 10px 0 20px;
			border: none;
		}

		a {
			text-decoration: none;
		}

		.tbl_btn:hover {
			background-color: #C4DEFF;
			transition: 0.3s;
			box-shadow: 0 5px 10px rgba(0, 0, 0, 0.5);
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

			<h1>Make Payment</h1>


			<br>
			<?php
			$result = mysqli_query($connected, "select * FROM table_data WHERE Table_status = 'Able'");

			while ($row = mysqli_fetch_array($result)) {
				echo "<tr style = 'font-family:Times New Romans; font-weight:bold'>";

				$live = mysqli_query($connected, "select * FROM order_table WHERE Table_ID = '" . $row['Table_ID'] . "'");

				if (mysqli_num_rows($live) > 0) {
					echo "<a href = 'Payment_Page.php?id=" . $row['Table_ID'] . "'><button class = 'tbl_btn' style = 'background-color:#FFA1A1;'>" . $row['Table_ID'] . "<br><i class = 'material-icons'>room_service</i></button></a>";

					$ID = $row['Table_ID'];
					$query = "UPDATE `table_data` SET `Live_status` = 'Seated' WHERE `Table_ID` = '$ID'";
					mysqli_query($connected, $query);
				} else {
					echo "<button class = 'tbl_btn'>" . $row['Table_ID'] . "<br><i class = 'material-icons'>room_service</i></button>";
				}
			}
			?>
		</div>
	</div>
</body>

</html>
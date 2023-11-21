<?PHP
//Order_Edit.php

session_start();

if (isset($_GET['id'])) {
	include('connect.php');

	$table = $_GET['id'];
}
?>

<html>

<head>
	<title>- Order Details Page -</title>
	<link rel="icon" href="Restaurant-icon.png">

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

		select {
			height: 100%;
			width: 100%;
			color: grey;
			background: snow;
			border: none;
			border-bottom: 2px solid silver;
			font-size: 20px;
			outline: none;
		}

		select:valid {
			color: black;
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
			width: 50%;
			top: 10;
			left: 400px;
			border: 2px solid black;
			box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
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

		.material-icons {
			font-size: 25px;
		}

		.edit_btn:hover {
			background-color: white;
			color: black;
			transition: 0.3s;
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

			<a href="Order.php">
				<button class="back_btn"><i class='material-icons'>arrow_back</i></button>
			</a>

			<center>
				<h1>Order Details<br></h1>
			</center>

			<button class='add_btn' style="float:right;" onclick="on()"><i class='material-icons'>add</i></button>

			<h3>
				<?PHP echo $table; ?>
			</h3>

			<br>

			<?php
			echo "<table>
					<tr>						
						<th width='50%'>Food Name</th>
						<th width='15%'>Quantity</th>
						<th width='15%' colspan = '2'>Action</th>
					</tr>";

			$query = "SELECT * FROM order_table WHERE Table_ID = '$table'";
			$result = mysqli_query($connected, $query);

			while ($row = mysqli_fetch_array($result)) {
				echo "<tr style = 'font-family:Times New Romans; font-weight:bold'>";
				echo "<td>" . $row['Food_name'] . "</td>";
				echo "<td>" . $row['Food_quantity'] . "</td>";

				echo "<td><center><a href = 'Quantity_Edit.php?id=" . $row['ID'] . "'><button class = 'edit_btn'><i class = 'material-icons'>mode_edit</i></button></a></center></td>";

				echo "<td style = 'border-left:hidden;'><center><a href = 'order_delete.php?id=" . $row['ID'] . "'  onClick=\"javascript:return confirm('Are you sure you want to delete this?');\"><button class = 'edit_btn'><i class = 'material-icons'>delete</i></button></a></center></td>";

				echo "</tr>";
			}

			echo "</table>";
			?>
		</div>

		<div id="overlay" class="overlay">
			<div class="wrap" style="text-align:center;">
				<form method="post" action="order_insert.php">
					<h2>Create Order</h2>

					<div class="InputText" style="display:none;">
						<input type="text" id="Table_ID" name="Table_ID" value="<?PHP echo $table; ?>" required />
						<label>Table ID</label>
					</div>

					<hr style="border-bottom:2px solid grey;">

					<div class="InputText">
						<select name="Food_name" id="Food_name" required>
							<option value="">Select Food</option>
							<?php
							$query = "SELECT * FROM menu_table WHERE Food_status = 'Available' ORDER BY Category_name ASC";
							$result = mysqli_query($connected, $query);

							while ($row = mysqli_fetch_array($result)) {
								$CATEGORY = $row['Category_name'];

								$result2 = mysqli_query($connected, "select Category_status FROM category_table WHERE Category_name = '$CATEGORY'");
								$row2 = mysqli_fetch_array($result2);
								if ($row2['Category_status'] == "Able") {
									echo "<option value = '" . $row['Food_name'] . "'>" . $row['Food_name'] . "</option>";
								}
							}
							?>
						</select>
					</div>

					<br>

					<div class="InputText">
						<input type="number" id="Food_quantity" name="Food_quantity" required />
						<label>Quantity</label>
					</div>

					<br><br>

					<input type="submit" class="submit">
					<button type="reset" class="cancel" onclick="off()">Cancel</button>
				</form>
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
<?PHP
//Staff.php

include('header.php');

$object = new Connect();

if (!$object->isLogin()) {
	header("location:" . $object->base_url . "index.php");
}

$allowedRoles = ["Master"];

if (!$object->checkUserRole($position, $allowedRoles)) {
    header("Location: Dashboard.php");
    exit();
}
?>

<html>

<head>
	<title> - Staff Management - </title>


	<style>
		.tablink {
			background-color: #84FFFF;
			color: black;
			float: left;
			border: none;
			outline: none;
			padding: 10px;
			width: 50%;
		}

		.tablink:hover {
			background-color: #C4FFFF;
			transition: 0.3s;
		}

		/* Style the tab content */
		.tabcontent {
			display: none;
			background-color: snow;
			padding: 20px;
			padding-top: 70px;
			box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
		}

		h1 {
			text-align: center;
			font-style: italic;
			font-weight: bold;
		}

		/* Style the input */
		.wrap {
			width: 100%;
			background: white;
			padding: 30px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
			border-radius: 10px;
		}

		.wrap .InputText {
			height: 75px;
			width: 100%;
			position: relative;
		}

		.wrap .InputText input {
			height: 100%;
			width: 100%;
			border: none;
			background-color: white;
			border-bottom: 2px solid silver;
			font-size: 20px;
			outline: none;
		}

		.wrap .InputText input:focus~label,
		.wrap .InputText input:valid~label {
			transform: translateY(-40px);
			transition: all 0.3s ease;
			color: black;
		}

		.wrap .InputText label {
			font-size: 20px;
			position: absolute;
			bottom: 10px;
			left: 0;
			color: grey;
		}

		.disabled~label {
			transform: translateY(-40px);
			transition: all 0.3s ease;
			color: black;
			outline: none;
		}

		.wrap .InputText .underline {
			position: absolute;
			bottom: 0px;
			height: 2px;
			width: 100%;
		}

		/* Style the select */
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}

		[type="radio"]:checked,
		[type="radio"]:not(:checked) {
			position: absolute;
			visibility: hidden;
		}

		.checkbox-option:checked+label,
		.checkbox-option:not(:checked)+label {
			position: relative;
			display: inline-block;
			padding: 10px;
			width: 150px;
			font-size: 20px;
			line-height: 20px;
			letter-spacing: 1px;
			margin: 0 auto;
			margin-left: 5px;
			margin-right: 5px;
			margin-bottom: 10px;
			text-align: center;
			border-radius: 5px;
			overflow: hidden;
			cursor: pointer;
			text-transform: uppercase;
			color: #ffffff;
			transition: all 0.3s linear;
		}

		.checkbox-option:not(:checked)+label {
			background-color: #161B44;
			box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1);
		}

		.checkbox-option:checked+label {
			background-color: #9CC3FB;
			color: black;
			box-shadow: 0 5px 10px 0 rgba(0, 0, 0, 0.5);
		}

		.checkbox-option:not(:checked)+label::before,
		.checkbox-option:checked+label::before {
			border-radius: 4px;
			background-image: linear-gradient(298deg, #D09CFB, #9CC3FB);
			z-index: -1;
			transition: all 0.5s linear;
		}

		.checkbox-option:not(:checked)+label:hover {
			box-shadow: 0 5px 15px 0 rgba(0, 0, 0, 0.5);
		}

		/* End of style Select */


		.submit {
			background-color: white;
			color: black;
			font-family: georgia, garamond, serif;
			font-size: 20px;
			text-align: center;
			text-decoration: none;
			padding: 10px 120px;
			border: none;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		}

		.submit:hover {
			background-color: #5199F9;
			color: white;
			transition: 0.3s;
		}

		table,
		th,
		td {
			border: solid 2px silver;
			border-collapse: collapse;
			padding: 10px;
		}

		table {
			border: solid 2px silver;
			width: 100%;
		}

		th {
			text-align: center;
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

<body class="content">
	<button class="tablink" onclick="openPage('Show', this, 'snow')" id="defaultOpen">Staff List</button>
	<button class="tablink" onclick="openPage('Insert', this, 'snow')">Add Staff</button>

	<span>
		<?PHP
		if (isset($_SESSION['message'])) {
			echo $_SESSION['message'];
		}
		unset($_SESSION['message']);
		?>
	</span>

	<div id="Show" class="tabcontent">
		<div class="wrap">

			<h2>Waiter</h2>

			<?php
			$result = mysqli_query($connected, "SELECT * FROM user_table WHERE User_position = 'Waiter'");

			echo "<table class = 'shown'>
						<tr>
							<th width='5%'>ID</th>
							<th width='15%'>Name</th>
							<th width='15%'>Email</th>
							<th width='10%'>Start Work On</th>
							<th width='10%'>Contact Number</th>
							<th width='10%'>Date of Birth</th>
							<th width='10%'>Gender</th>
							<th width='5%' colspan = '2'>Action</th>
						</tr>";

			while ($row = mysqli_fetch_array($result)) {
				echo "<tr>";
				echo "<td width='20px'>" . $row['User_ID'] . "</td>";
				echo "<td>" . $row['User_name'] . "</td>";
				echo "<td>" . $row['User_email'] . "</td>";
				echo "<td style = 'text-align:center'>" . $row['User_start'] . "</td>";
				echo "<td>" . $row['User_contact'] . "</td>";
				echo "<td>" . $row['User_birthday'] . "</td>";
				echo "<td>" . $row['User_gender'] . "</td>";

				echo "<td><center><button class = 'edit_btn'><a href = 'Staff_Edit.php?id=" . $row['User_ID'] . "'><i class = 'material-icons'>mode_edit</i></a></button></center></td>";

				echo "<td style = 'border-left:hidden;'><center><button class = 'edit_btn'><a href = 'staff_delete.php?id=" . $row['User_ID'] . "' onClick=\"javascript:return confirm('Are you sure you want to delete this?');\"><i class = 'material-icons'>delete</i></a></button></center></td>";

				echo "</tr>";
			}
			echo "</table>";

			?>
		</div>

		<br><br>

		<div class="wrap">
			<h2>Cashier</h2>
			<?php
			$result = mysqli_query($connected, "SELECT * FROM user_table WHERE User_position = 'Cashier'");

			echo "<table class = 'shown'>
						<tr>
							<th width='5%'>ID</th>
							<th width='15%'>Name</th>
							<th width='15%'>Email</th>
							<th width='10%'>Start Work On</th>
							<th width='10%'>Contact Number</th>
							<th width='10%'>Date of Birth</th>
							<th width='10%'>Gender</th>
							<th width='5%' colspan = '2'>Action</th>
						</tr>";

			while ($row = mysqli_fetch_array($result)) {
				echo "<tr>";
				echo "<td>" . $row['User_ID'] . "</td>";
				echo "<td>" . $row['User_name'] . "</td>";
				echo "<td>" . $row['User_email'] . "</td>";
				echo "<td style = 'text-align:center'>" . $row['User_start'] . "</td>";
				echo "<td>" . $row['User_contact'] . "</td>";
				echo "<td>" . $row['User_birthday'] . "</td>";
				echo "<td>" . $row['User_gender'] . "</td>";

				echo "<td><center><button class = 'edit_btn'><a href = 'Staff_Edit.php?id=" . $row['User_ID'] . "'><i class = 'material-icons'>mode_edit</i></a></button></center></td>";

				echo "<td style = 'border-left:hidden;'><center><button class = 'edit_btn'><a href = 'staff_delete.php?id=" . $row['User_ID'] . "' onClick=\"javascript:return confirm('Are you sure you want to delete this?');\"><i class = 'material-icons'>delete</i></a></button></center></td>";

				echo "</tr>";
			}
			echo "</table>";
			?>
		</div>
		<br><br>



	</div>

	<div id="Insert" class="tabcontent">
		<div class="wrap">
			<form method="post" action="staff_insert.php">

				<h1>Account Details</h1>

				<hr style="border-bottom:2px solid grey;">

				<div class="InputText" style="display:none;">

					<?PHP
					$value2 = '';
					$query = "SELECT User_ID from user_table order by User_ID DESC LIMIT 1";
					$stmt = mysqli_query($connected, $query);
					if (mysqli_num_rows($stmt) > 0) {
						if ($row = mysqli_fetch_assoc($stmt)) {
							$value2 = $row['User_ID'];
							$value2 = substr($value2, 3, 5);
							$value2 = $value2 + 1;
							$value2 = sprintf('EMP%03u', $value2);
							$value = $value2;
						}
					} else {
						$value2 = "EMP001";
						$value = $value2;
					}
					?>

					<input type="text" id="User_ID" name="User_ID" value="<?PHP echo $value; ?>" required
						maxlength="6" />
					<label>ID (Once created will not be changed)</label>
				</div>

				<div class="InputText">
					<input class="disabled" type="text" value="<?PHP echo $value; ?>" disabled />
					<label style="color:black;">ID</label>
				</div>
				<br><br>

				<div class="InputText">
					<input type="text" id="User_name" name="User_name" required />
					<label>Name</label>
				</div>

				<br><br>

				<div class="InputText">
					<input type="password" id="User_pwd" name="User_pwd" required />
					<label>Password</label>
				</div>

				<br><br>

				<div class="InputText">
					<input type="email" id="User_email" name="User_email" required />
					<label>Email Address</label>
				</div>

				<br><br>

				<div class="option" style="text-align:left;">
					<label>Position</label>
					<br>
					<input class="checkbox-option" type="radio" name="User_position" id="Waiter" value="Waiter"
						required>
					<label class="for-checkbox-option" for="Waiter">Waiter</label>

					<input class="checkbox-option" type="radio" name="User_position" id="Cashier" value="Cashier"
						required>
					<label class="for-checkbox-option" for="Cashier">Cashier</label>
				</div>

				<br><br>

				<input type="submit" class="submit">
		</div>
		</form>
	</div>

	<script>
		function openPage(pageName, elmnt, color) {
			var i, tabcontent, tablinks;
			tabcontent = document.getElementsByClassName("tabcontent");

			for (i = 0; i < tabcontent.length; i++) {
				tabcontent[i].style.display = "none";
			}

			tablinks = document.getElementsByClassName("tablink");

			for (i = 0; i < tablinks.length; i++) {
				tablinks[i].style.backgroundColor = "";
			}

			document.getElementById(pageName).style.display = "block";
			elmnt.style.backgroundColor = color;
		}

		document.getElementById("defaultOpen").click();			
	</script>

</body>

</html>
<?PHP
//Staff_Edit.php
session_start();


if (isset($_GET['id'])) {
	include('connect.php');

	$ID = $_GET['id'];

	$query = "SELECT * FROM user_table WHERE User_ID = '$ID'";
	$result = mysqli_query($connected, $query);
	$row = mysqli_fetch_assoc($result);

	$ID = $row['User_ID'];
	$name = $row['User_name'];
	$email = $row['User_email'];
	$password = $row['User_pwd'];
	$position = $row['User_position'];
	$created = $row['User_start'];
	$contact = $row['User_contact'];
	$birthday = $row['User_birthday'];
	$gender = $row['User_gender'];
}
?>

<html>

<head>
	<title>- Staff Edit Page -</title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<style>
		.content {
			background-color: #B2D2FC;
			padding-top: 20px;
			font-size: 20px;
			font-family: georgia, garamond, serif;
			min-height: -webkit-fill-available;
		}

		h1 {
			text-align: center;
			font-style: italic;
			font-weight: bold;
		}

		.upperT {
			text-align: left;
			font-style: italic;
			border-bottom: 2px solid grey;
			font-weight: bold;
		}

		.wrap {

			margin-left: auto;
			margin-right: auto;
			background: snow;
			padding: 20px;
			width: 75%;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		}

		.wrap .InputText {
			text-align: center;
			height: 70px;
			width: 50%;
			position: relative;
		}

		.wrap .InputText input {
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

		.disabled~label {
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

		.submit:active {
			background-color: #3e8e41;
			box-shadow: 0 5px #666;
			transform: translateY(4px);
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

			<button class="back_btn">
				<a href="Staff.php"><i class='material-icons'>arrow_back</i></a>
			</button>


			<form method="post" action="staff_update.php">
				<h1>Change Roles</h1>
				<h3 class="upperT">Employee Details</h3>

				<div class="InputText" style="display:none;">
					<input type="text" name="User_ID" id="User_ID" value="<?PHP echo $ID; ?>" />
				</div>

				<div class="InputText">
					<input type="text" class="disabled" name="User_name" id="User_name" value="<?PHP echo $name; ?>" disabled />
					<label style="color:black;">Name</label>
				</div>

				<br>

				<div class="option">
					<label>Position</label>
					<br>
					<input class="checkbox-option" type="radio" name="User_position" id="Waiter" value="Waiter" />
					<label class="for-checkbox-option" for="Waiter">Waiter</label>

					<input class="checkbox-option" type="radio" name="User_position" id="Cashier" value="Cashier" />
					<label class="for-checkbox-option" for="Cashier">Cashier</label>
				</div>

				<br>

				<input type="submit" class="submit" name="submit" value="Update">
			</form>
		</div>
	</div>
</body>

</html>
<?PHP
//Food_Edit.php

session_start();

if (isset($_GET['id'])) {
	include('connect.php');

	$ID = $_GET['id'];

	$query = "SELECT * FROM menu_table WHERE Food_ID = '$ID'";
	$result = mysqli_query($connected, $query);
	$row = mysqli_fetch_assoc($result);

	$ID = $row['Food_ID'];
	$NAME = $row['Food_name'];
	$COST = $row['Food_cost'];
	$CATEGORY_name = $row['Category_name'];
	$STATUS = $row['Food_status'];
}
?>

<html>

<head>
	<title>- Food Edit Page -</title>

	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<style>
		.content {
			margin: 0;
			background-color: #B2D2FC;
			padding: 20px;
			font-size: 20px;
			font-family: georgia, garamond, serif;
			overflow: auto;
			height: 100%;
		}

		h1 {
			text-align: center;
			font-style: italic;
			font-weight: bold;
		}

		.wrap {

			margin-left: auto;
			margin-right: auto;
			background: snow;
			padding: 20px;
			width: 50%;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
			border-radius: 10px;
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

		.disabled~label {
			transform: translateY(-40px);
			transition: all 0.3s ease;
			color: black;
			outline: none;
		}

		select {
			width: 50%;
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

			<a href="FoodMenu.php">
				<button class="back_btn"><i class='material-icons'>arrow_back</i></button>
			</a>

			<form method="post" action="food_update.php">

				<h1>Food Details</h1>

				<hr style="border-bottom:2px solid grey;">

				<div class="InputText" style="display:none;">
					<input type="text" name="Food_ID" id="Food_ID" value="<?PHP echo $ID; ?>" required />
				</div>

				<div class="InputText">
					<input class="disabled" type="text" value="<?PHP echo $ID; ?>" disabled />
					<label style="color:black;">ID</label>
				</div>

				<br>

				<div class="InputText">
					<input type="text" name="Food_name" id="Food_name" required value="<?PHP echo $NAME; ?>" />
					<label>Name</label>
				</div>

				<br>

				<div class="InputText">
					<input type="number" id="Food_cost" name="Food_cost" value="<?PHP echo $COST; ?>" required
						step=".1" />
					<label>Cost</label>
				</div>



				<br>

				<div class="option" style="text-align:left;">
					<label>Status</label>
					<br>
					<input class="checkbox-option" type="radio" name="Food_status" id="Available" value="Available" />
					<label class="for-checkbox-option" for="Available">Available</label>

					<input class="checkbox-option" type="radio" name="Food_status" id="Sold Out" value="Sold Out" />
					<label class="for-checkbox-option" for="Sold Out">Sold Out</label>
				</div>

				<br><br>

				<input type="submit" class="submit" name="submit" value="Update">
			</form>
		</div>
	</div>
</body>

</html>
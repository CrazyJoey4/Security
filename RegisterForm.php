<?php
session_start();

include('connect.php');
$object = new Connect();

if ($object->SettedUp()) {
	header("location:" . $object->base_url . "index.php");
}

?>

<html>

<head>
	<title>RMS - Register Page</title>
	<link rel="icon" href="Register-icon.png">

	<style>
		body {
			background-color: #B2D2FC;
			padding-top: 10px;
			font-size: 20px;
			font-family: georgia, garamond, serif;
		}

		h1 {
			text-align: center;
			font-style: italic;
		}

		.upperT {
			text-align: left;
			font-style: italic;
			border-bottom: 2px solid grey;
		}

		.lowerT {
			text-align: left;
			font-style: italic;
			border-bottom: 2px solid grey;
		}

		.wrap {
			text-align: right;
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
	</style>
</head>

<body>
	<div class="wrap">
		<form method="post" action="register.php">

			<span id="message"></span>
			<span>
				<?PHP
				if (isset($_SESSION['message'])) {
					echo $_SESSION['message'];
				}
				unset($_SESSION['message']);
				?>
			</span>

			<h1>Set up Account</h1>

			<h3 class="upperT">Restaurant Details</h3>

			<div class="InputText">
				<input type="text" name="res_name" id="res_name" required />
				<label>Restaurant Name</label>
			</div>

			<br>

			<div class="InputText">
				<input type="text" name="res_location" id="res_location" required />
				<label>Restaurant Location</label>
			</div>

			<br>

			<div class="InputText">
				<input type="text" name="res_contact" id="res_contact" required />
				<label>Restaurant Contact Number</label>
			</div>

			<br>

			<div class="InputText">
				<?php
				echo $object->Currency_list();
				?>
			</div>

			<br>

			<div class="InputText">
				<?php
				echo $object->Timezone_list();
				?>
			</div>

			<br>

			<h3 class="lowerT">Master Register<h3>

					<div class="InputText">
						<input type="text" name="User_ID" id="User_ID" value="EMP000" required />
						<label>ID (Recommended : EMP000)</label>
					</div>

					<br>

					<div class="InputText">
						<input type="text" name="User_email" id="User_email" required />
						<label>Email Address</label>
					</div>

					<br>

					<div class="InputText">
						<input type="password" name="User_pwd" id="User_pwd" required />
						<label>Password</label>
					</div>

					<br><br>

					<input type="submit" class="submit" name="submit">
		</form>
	</div>
</body>

</html>
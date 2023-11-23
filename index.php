<?php
include("connect.php");

session_start();
$object = new Connect();

// Check if the 'action' parameter is set to 'logout'
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_unset();
    session_destroy();
	header("location:" . $object->base_url . "index.php");
    exit();
}


if (!$object->SettedUp()) {
	header("location:" . $object->base_url . "RegisterForm.php");
	exit();
}

// Initialize variables
$isRecaptchaVerified = false;
$recaptchaError = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Verify reCAPTCHA
	$recaptchaSecretKey = '6LdGKBgpAAAAANTTlv9EblGac0vE9TK2LTrSXH2h';
	$recaptchaResponse = $_POST['g-recaptcha-response'];

	$recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
	$recaptchaData = [
		'secret' => $recaptchaSecretKey,
		'response' => $recaptchaResponse,
	];

	$options = [
		'http' => [
			'header' => 'Content-type: application/x-www-form-urlencoded',
			'method' => 'POST',
			'content' => http_build_query($recaptchaData),
		],
	];

	$context = stream_context_create($options);
	$recaptchaResult = file_get_contents($recaptchaUrl, false, $context);
	$recaptchaResult = json_decode($recaptchaResult, true);

	if ($recaptchaResult['success']) {
		// reCAPTCHA verification passed
		$isRecaptchaVerified = true;

	} else {
		// reCAPTCHA verification failed
		$recaptchaError = 'reCAPTCHA verification failed. Please try again.';
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>RMS - Login</title>
	<link rel="icon" href="./media/Restaurant-icon.png">

	<style>
		body {
			background-color: #B2D2FC;
			padding-top: 5px;
			font-size: 20px;
			height: 100%;
			font-family: georgia, garamond, serif;
			font-style: italic;
		}

		.insertPic {
			text-align: center;
		}

		.wrap {
			text-align: center;
			margin-left: auto;
			margin-right: auto;
			width: 50%;
			background: snow;
			padding-top: 20px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		}

		.wrap .InputText {
			text-align: center;
			height: 70px;
			width: 40%;
			position: relative;
		}

		.wrap .InputText input {
			height: 100%;
			width: 100%;
			background: snow;
			border: none;
			padding-bottom: 0px;
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

		.submit {
			background-color: white;
			color: black;
			font-family: georgia, garamond, serif;
			font-size: 15px;
			text-align: center;
			text-decoration: none;
			padding: 10px 100px;
			border: none;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		}

		.submit:hover {
			background-color: #4CAF50;
			color: white;
			transition: 0.3s;
		}

		table {
			text-align: center;
			background-color: #FFB3B3;
			border: 1px solid green;
			color: green;
			padding: 10px 100px;
		}

		.recaptcha-container {
			margin-top: 5px;
		}

		center {
			height: 450px;
		}
	</style>

	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
	<div class="insertPic">
		<img src="./media/RMSLogo.jpg" width="370">
	</div>

	<br>

	<div class="wrap">
		<center>
			<?php
			if (isset($_SESSION['message'])) {
				$message = $_SESSION['message'];

				echo "<span>";
				echo "<table><th>" . $message . "</th></table>";
				echo "</span>";
			}

			unset($_SESSION['message']);
			?>
			<form method="post" id="LoginForm" action="LoginCheck.php">
				<div class="InputText">
					<input type="text" name="User_ID" id="User_ID" required>
					<label>ID</label>
				</div>

				<br><br>

				<div class="InputText">
					<input type="password" name="User_pwd" id="User_pwd" required>
					<label>Password</label>
				</div>

				<br>

				<!-- reCAPTCHA container -->
				<div class="recaptcha-container">
					<div class="g-recaptcha" data-sitekey="6LdGKBgpAAAAAMsydD7B6MPDVDHnFF66JP31kovI"></div>
				</div>

				<br><br>

				<input type="submit" name="Sign" id="Sign" value="Log In" class="submit">

			</form>
		</center>
	</div>
</body>

</html>

<?PHP
//header.php

session_start();
include('connect.php');

$ID = $_SESSION['User_ID'];

$query = "SELECT * FROM user_table WHERE User_ID = '$ID'";
$result = mysqli_query($connected, $query);
$row = mysqli_fetch_assoc($result);

$name = $row['User_name'];
$position = $row['User_position'];
$gender = $row['User_gender'];
?>
<html>

<head>
	<link rel="icon" href="./media/Restaurant-icon.png">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<style>
		body {
			background-color: snow;
		}

		.content {
			margin-left: 250px;
			padding: 20px;
			background-color: #B2D2FC;
			overflow: auto;
			padding-top: 20px;
			font-size: 20px;
			font-family: georgia, garamond, serif;
		}

		.Scrollbtn {
			opacity: 0;
			display: float;
			position: fixed;
			bottom: 20px;
			right: 30px;
			z-index: 99;
			font-size: 18px;
			border: none;
			outline: none;
			background-color: black;
			color: white;
			cursor: pointer;
			padding: 15px;
			border-radius: 100%;
		}

		.Scrollbtn:hover {
			background-color: white;
			color: black;
			opacity: 80%;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
		}

		.navbar {
			font-family: georgia, garamond, serif;
			top: 0;
			left: 0;
			text-align: center;
			background-color: #85FFFF;
			background-image: linear-gradient(0deg, #85FFFF, snow);
			position: fixed;
			height: 100%;
			width: 250px;
			font-size: 20px;
			margin-left: 0;
			padding-left: 0;
			overflow: auto;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
		}

		ul {
			float: center;
			list-style-type: none;
			padding: 5px;
			padding-left: 0;
			padding-right: 0;
			padding-bottom: 0;
		}

		li a {
			font-weight: bold;
			text-decoration: none;
			display: block;
			color: grey;
			text-align: left;
			padding: 5px;
			padding-left: 20px;
		}

		li a:hover {
			box-shadow: 0 0 10px #B2D2FC;
			text-shadow: -0.5px 1px black;
			background-color: snow;
			transition: 0.3s;
		}

		.logo {
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
			border-radius: 50%;
			opacity: 0.9;
		}

		.logo:hover {
			box-shadow: 0 0 50px #69FF64;
			opacity: 1;
			transition: 0.3s;
		}
	</style>
</head>

<body>
	<div class="navbar">
		<ul>
			<a href="Dashboard.php"><img class="logo" src="./media/Restaurant-icon.png" width="150"></a>

			<hr style="border:0.5px dashed grey;">

			<li>
				<a href="Profile.php"><i class="material-icons">insert_emoticon</i>
					<?PHP
					if ($name != null) {
						$user_name = $name;
					} else {
						$user_name = $ID;
					}
					echo $user_name;
					?>
				</a>
			</li>

			<?PHP
			if ($position == "Master") {
				echo '<li><a href = "Staff.php"><i class = "material-icons">	people</i>  Staff</a></li>';

				echo '<li><a href = "Table.php"><i class = "material-icons">		airline_seat_legroom_normal</i>  Table</a></li>';

				echo '<li><a href = "Category.php"><i class = "material-icons">	category</i>  Menu Category</a></li>';

				echo '<li><a href = "FoodMenu.php"><i class = "material-icons">	local_bar</i>  Food Menu</a></li>';

				echo '<li><a href = "Tax.php"><i class = "material-icons">attach_money</i>  Tax Management</a></li>';
			}

			if ($position == "Waiter" || $position == "Master" || $position == "Cashier") {
				echo '<li><a href = "Order.php"><i class = "material-icons">	border_color</i>  Order</a></li>';
			}

			if ($position == "Waiter" || $position == "Master") {
				echo '<li><a href = "Waitlist.php"><i class = "material-icons">	checklist</i>  Waitlist</a></li>';
			}

			if ($position == "Cashier" || $position == "Master") {
				echo '<li><a href = "Payment.php"><i class = "material-icons">	payment</i>  Payment</a></li>';
			}


			echo "<li><a href='index.php?action=logout' onclick=\"javascript:return confirm('Are you sure you want to logout?');\"><i class='material-icons'>logout</i>  Log Out</a></li>";
			?>


		</ul>
	</div>

	<a class="Scrollbtn" id="Scrollbtn" onclick="window.scrollTo({top: 0, behavior: 'smooth'});">
		<i class="material-icons"> publish</i>
	</a>


	<script>
		var Scrollbtn = document.getElementById("Scrollbtn");
		window.onscroll = function () {
			scrollFunction()
		};

		function scrollFunction() {
			if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
				Scrollbtn.style.opacity = "1";
				Scrollbtn.style.transition = "0.5s";
			}
			else {
				Scrollbtn.style.opacity = "0";
			}
		}
	</script>
</body>

</html>
<?PHP
	//showAttendance.php
	
	session_start();
	include('connect.php');

?>

<html>
	<head>
		<title>- Attendance Report Page -</title>
		<link rel = "icon" href = "SEO-icon.png">
		<link rel = "stylesheet" href = "https://www.w3schools.com/w3css/4/w3.css">
		<link rel = "stylesheet" href = "https://fonts.googleapis.com/icon?family=Material+Icons">		
		
		<style>
			.content
			{				
				margin:0;
				background-color:#B2D2FC;
				padding:10px;
				font-size:20px;				
				font-family:Times New Roman;
				height:100%;				
			}
			
			h1
			{
				text-align:center;
				font-style:italic;
				font-weight:bold;
			}
			
			.wrap
			{				
				margin-left:auto;
				margin-right:auto;
				background:snow;
				padding:20px;
				width:100%;				
				box-shadow:0 0 10px rgba(0,0,0,0.2);
				border-radius:10px;
			}
			
			table, th, td
			{
				border:solid 2px silver;
				border-collapse:collapse;
				padding:5px;
				text-align:center;
			}
			
			table
			{
				border:solid 2px silver;
				width:100%;
				font-size:20px;				
			}
			
			th
			{
				text-align:center;
				color:white;
				background-color:grey;
			}
			
			.back_btn
			{
				background-color: #5199F9;
				color: white;
				text-align: center;
				text-decoration: none;
				padding:10px;
				border:none;
				border-radius:50%;
				box-shadow:0 0 10px rgba(0,0,0,0.2);
			}
			
			.material-icons
			{
				font-size:30px;
			}
			
			.back_btn:hover
			{
				background-color:white;
				color: black;
				transition:0.3s;
			}
			
			.prntbtn
			{
				background-color: white;
				color: black;
				display: block-inline;
				font-family:georgia,garamond,serif;
				font-size:20px;
				text-align: center;
				text-decoration: none;
				padding: 10px 100px;
				border:none;
				box-shadow:0 0 10px rgba(0,0,0,0.2);
			}
			
			.prntbtn:hover
			{
				background-color:#5199F9;
				color: white;
				transition:0.3s;
			}
			
			@media print 
			{
				#noPrint
				{
					display:none;
				}
			}
		</style>
	</head>
	
	<body>
		<div class = "content">
			<div class = "wrap">
				
			<a href = "Dashboard.php" id = "noPrint">
				<button class = "back_btn"><i class = 'material-icons'>arrow_back</i></button>
			</a>
				
					<h1>Attendance Record</h1>
					
					<hr style = "border-bottom:2px solid grey;">
					
					<table>
						<tr>						
							<th>ID</th>
							<th>Staff ID</th>
							<th>Name</th>
							<th>Contact</th>
							<th>Day of Week</th>
							<th>Login Time</th>
						</tr>
					
				<?PHP
						$result = mysqli_query($connected,"select * FROM attendance_table WHERE Staff_ID != 'EMP000' ORDER BY Att_ID ASC");
						while($row = mysqli_fetch_array($result))
						{
							$query2 = "SELECT * FROM user_table WHERE User_ID = '".$row['Staff_ID']."'";
							$result2 = mysqli_query($connected, $query2);
							$row2 = mysqli_fetch_array($result2);
							echo "<tr style = 'font-family:Times New Romans; font-weight:bold'>";
								echo "<td>" . $row['Att_ID'] . "</td>";
								echo "<td>" . $row['Staff_ID'] . "</td>";
								echo "<td>" . $row2['User_name'] . "</td>";
								echo "<td>" . $row2['User_contact'] . "</td>";
								
								$day =  date("l", strtotime($row['LoginTime']));
								echo "<td>" .$day. "</td>";
								
								echo "<td>" . $row['LoginTime'] . "</td>";
							echo "</tr>";
						}
						
						echo "</table><br>";
				?>
				
					<br>
							
					<button class = "prntbtn" id = "noPrint" onclick = "window.print();return false;">Click here to print</button>
			</div>
		</div>
	</body>
</html>			
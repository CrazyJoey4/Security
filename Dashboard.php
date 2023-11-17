<?PHP
	//Dashboard.php
	
	
    include('header.php');
	
	$object = new Connect();
	
	if(!$object->isLogin())
	{
		header("location:".$object->base_url."index.php");
	}
	
	
?>
<html>
	<head>
		<title>- Dashboard -</title>

		<style>
			.content
			{
				margin-left:250px;
				padding:5px;
				background-color:#B2D2FC;
				height:100%;
				padding-top:20px;
				font-size:20px;				
				font-family:georgia,garamond,serif;
			}
			
			.wrap
			{
				margin-left:auto;
				margin-right:auto;
				background:snow;
				padding:20px;
				width:95%;				
				box-shadow:0 0 10px rgba(0,0,0,0.2);
				border-radius:10px;
			}
			
			h1
			{				
				font-style:italic;
				font-weight:bold;
			}
			
			h3
			{
				text-align:left;
				font-style:italic;
				font-weight:bold;				
			}
			
			.tbl_btn
			{
				margin-left:20px;
				margin-top:20px;
				width: 150px;
				padding:10px;
				font-family:Times New Roman;
				font-size:25px;
				background-color: #85BAFF;
				color:snow;
				outline:none;
				border-radius:10px 0 20px;
				border:none;	
				box-shadow:0 5px 10px rgba(0,0,0,0.5);
			}
			
			.span
			{
				width: 40%;
				text-align:center;
				padding:10px;
				font-family:georgia,garamond,serif;
				font-size:30px;
				font-weight:bold;
				color:snow;
				border-radius:20px 0 10px;
				border:none;	
				box-shadow:0 5px 10px rgba(0,0,0,0.5);
			}
			
			.dttm
			{
				background-color: #85BAFF;
				width: 30%;
				float:right;
				text-align:center;
				padding:5px;
				font-family:Times New Roman;
				font-size:15px;
				font-weight:italic;
				border-radius:20px 0 10px;
				border:none;	
				box-shadow:0 5px 10px rgba(0,0,0,0.5);
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
			
			.rpt_btn
			{
				margin-left:20px;
				margin-top:20px;
				width: 260px;
				padding:10px;
				font-family:Times New Roman;
				font-size:25px;
				background-color: #85BAFF;
				color:snow;
				outline:none;
				border-radius:10px 0 20px;
				border:none;	
				box-shadow:0 5px 10px rgba(0,0,0,0.5);
			}
			
			.rpt_btn:hover
			{
				background-color:#5199F9;
				color: white;
				transition:0.3s;
				box-shadow:0 5px 10px #0080FF;
			}
			
			.FRT, .SAT
			{
				text-align:center;
			}
			
		</style>
	</head>
	
	<body>
		<div class = "content">
			<div class = "wrap">
				<h1>Dashboard</h1>
				<?PHP
					$DATETIME = $object->get_datetime();
					$TodayTotal = 0;
					$YesterdayTotal = 0;
					$LastWeekTotal = 0;
					$AllTotal = 0;
					
					echo "<div class = 'dttm'>";
						echo "<span>Last Refresh : " .$DATETIME. "</span>";
					echo "</div>";
					
					if($gender == "Male")
					{
				?>					
						<div class = "span" style = "background-color: #68D6FF;">			
							<span>View as : <?PHP echo $position; ?></span>
						</div>
				<?PHP
					}
					else if($gender == "Female")
					{
				?>
						<div class = "span" style = "background-color: #BBBDFF;">
							<span>View as : <?PHP echo $position; ?></span>
						</div>
				<?PHP
					}else
					{
				?>	
						<div class = "span" style = "background-color: #B5B5B5;">
							<span>View as : <?PHP echo $position; ?></span>
						</div>
				<?PHP
					}
					
				?>
				
				<br>
				<hr style = "border:2px solid silver;">
				<h3>Live Table Status</h3>
			<?php				
				$result = mysqli_query($connected,"select * FROM table_data WHERE Table_status = 'Able'");
						
				while($row = mysqli_fetch_array($result))
				{		
					$live = mysqli_query($connected,"select * FROM order_table WHERE Table_ID = '".$row['Table_ID']."'");
						
					if(mysqli_num_rows($live) > 0)
					{
						echo "<button class = 'tbl_btn' style = 'background-color: #FFA1A1;' disabled >" . $row['Table_ID'] . "<br><i class = 'material-icons'>room_service</i></button>";
						
						$ID = $row['Table_ID'];
						$query = "UPDATE `table_data` SET `Live_status` = 'Seated' WHERE `Table_ID` = '$ID'";
						
						mysqli_query($connected,$query);
					}
					else
					{
						echo "<button class = 'tbl_btn' disabled >" . $row['Table_ID'] . "<br><i class = 'material-icons'>room_service</i></button>";
					}
				}
			?>
				
				<?PHP
					if($position == "Master")
					{
				?>			
						<hr style = "border:2px solid silver;">
						
						<h3>Financial Record Table</h3>
						<div class = "FRT">
				<?php
						$today = date("Y-m-d");
						$yesterday = date("Y-m-d", strtotime("-1 days"));
						$lastweek = date("Y-m-d", strtotime("-1 week +1 day"));
						
						$currency = mysqli_query($connected, "select * FROM restaurant_master");
						$sel = mysqli_fetch_array($currency);
						$symbol = $sel['res_currency'];
						
						$result = mysqli_query($connected,"select * FROM payment_table WHERE Pay_date = '$today'");
								
						while($row = mysqli_fetch_array($result))
						{								
							$TodayTotal += $row['Pay_amount'];
						}
						echo "<a href = 'showReport.php?id=".$today."'><button class = 'rpt_btn'><b>Today Sales</b><br>" .$symbol. " &nbsp; " . number_format($TodayTotal, 2, '.', ' ') . "&nbsp;<i class = 'material-icons'>library_books</i></button></a>";
						
						$result2 = mysqli_query($connected,"select * FROM payment_table WHERE Pay_date = '$yesterday'");
								
						while($row2 = mysqli_fetch_array($result2))
						{								
							$YesterdayTotal += $row2['Pay_amount'];
						}
						echo "<a href = 'showReport.php?id=".$yesterday."'><button class = 'rpt_btn'><b>Yesterday Sales</b><br>" .$symbol. " &nbsp; " . number_format($YesterdayTotal, 2, '.', ' ') . "&nbsp;<i class = 'material-icons'>library_books</i></button></a>";
						
						$result3 = mysqli_query($connected,"select * FROM payment_table WHERE Pay_date >= '$lastweek'");
								
						while($row3 = mysqli_fetch_array($result3))
						{								
							$LastWeekTotal += $row3['Pay_amount'];
						}
						echo "<a href = 'showReport.php?id=".$lastweek."'><button class = 'rpt_btn'><b>Last 7 Days Sales</b><br>" .$symbol. " &nbsp; " . number_format($LastWeekTotal, 2, '.', ' ') . "&nbsp;<i class = 'material-icons'>library_books</i></button></a>";
						
						$result4 = mysqli_query($connected,"select * FROM payment_table");
								
						while($row4 = mysqli_fetch_array($result4))
						{								
							$AllTotal += $row4['Pay_amount'];
						}
						echo "<a href = 'showReport.php?id='><button class = 'rpt_btn'><b>All Time Sales</b><br>" .$symbol. " &nbsp; " . number_format($AllTotal, 2, '.', ' ') . "&nbsp;<i class = 'material-icons'>library_books</i></button></a>";
					
				?>
						</div>
				<div class = "SAT">
				<hr style = "border:2px solid silver;">
					<h3>Staff Attendance Table (Only Today)</h3>
					<table>
						<tr>						
							<th width='15%'>Staff ID</th>
							<th width='15%'>Staff Name</th>
							<th width='15%'>Log In Time</th>
						</tr>
					
				<?PHP
						$today = date("Y-m-d");
						$result = mysqli_query($connected,"select * FROM attendance_table WHERE Staff_ID != 'EMP000' AND DATE(LoginTime) = '$today' ORDER BY Staff_ID ASC");
						while($row = mysqli_fetch_array($result))
						{
							$query2 = "SELECT * FROM user_table WHERE User_ID = '".$row['Staff_ID']."'";
							$result2 = mysqli_query($connected, $query2);
							$row2 = mysqli_fetch_array($result2);
							echo "<tr style = 'font-family:Times New Romans; font-weight:bold'>";
								echo "<td>" . $row['Staff_ID'] . "</td>";
								echo "<td>" . $row2['User_name'] . "</td>";
								echo "<td>" . $row['LoginTime'] . "</td>";
							echo "</tr>";
						}
						
						echo "</table><br>";
						
						echo "<a href = 'showAttendance.php'><button class = 'rpt_btn' style = 'width: 300px;'><b>Show All Attendance</b> &nbsp; <i class = 'material-icons'>library_books</i></button></a>";
				
					}
				?>
				</div>
			</div>
		</div>		
	<script>
		window.setInterval('refresh()', 30000);

		function refresh() 
		{
			window .location.reload();
		}
	</script>
	</body>
	
</html>
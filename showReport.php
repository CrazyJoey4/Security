<?PHP
	//showReport.php
	
	session_start();
	
	if(isset($_GET['id']))
	{
		include('connect.php');
	
		$date 	= $_GET['id'];
	}
?>

<html>
	<head>
		<title>- Financial Report Page -</title>
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
				overflow:auto;				
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
				
					<h1>Financial Report</h1>
					
					<hr style = "border-bottom:2px solid grey;">
					
					<table>
						<tr>						
							<th>ID</th>
							<th>Order No.</th>
							<th>Gross Pay</th>
							<th>Tax Pay</th>
							<th>Pay Amount</th>
							<th>Pay Method</th>
							<th>Card Number</th>
							<th>Date</th>
							<th>Time</th>
						</tr>
					
					<?PHP
						$result = mysqli_query($connected,"select * FROM payment_table WHERE Pay_date >= '$date' ORDER BY Pay_ID ASC");
						$grossttl = 0;
						$taxttl = 0;
						$netttl = 0;
						$cardcount = 0;
						$cashcount = 0;
						
						$currency = mysqli_query($connected, "select * FROM restaurant_master");
						$sel = mysqli_fetch_array($currency);
						$symbol = $sel['res_currency'];
												
						while($row = mysqli_fetch_array($result))
						{								
							echo "<tr style = 'font-family:Times New Romans; font-weight:bold'>";
								echo "<td>" . $row['Pay_ID'] . "</td>";
								echo "<td>" . $row['Order_ID'] . "</td>";
								echo "<td>" .$symbol. " &nbsp; " . $row['Gross_pay'] . "</td>";
								echo "<td>" .$symbol. " &nbsp; " . $row['Tax_pay'] . "</td>";
								echo "<td>" .$symbol. " &nbsp; " . $row['Pay_amount'] . "</td>";
								
								if($row['Pay_type'] == "Card")
								{
									echo "<td style = 'background-color: #A4EBFD;'>" . $row['Pay_type'] . "</td>";
									$cardcount++;
								}
								else
								{
									echo "<td style = 'background-color: #A4FDC8;'>" . $row['Pay_type'] . "</td>";
									$cashcount++;
								}
								
								
								if($row['Card_number'] != 0)
								{
									echo "<td style = 'background-color: #A4EBFD;'>" . $row['Card_number'] . "</td>";
								}
								else
								{
									echo "<td style = 'background-color: #A4FDC8;'> - </td>";
								}
								echo "<td>" . $row['Pay_date'] . "</td>";
								echo "<td>" . $row['Pay_time'] . "</td>";
							echo "</tr>";
							
							$grossttl 	+= $row['Gross_pay'];
							$taxttl 	+= $row['Tax_pay'];
							$netttl 	+= $row['Pay_amount'];
							
						}
					
					?>
						<tr>						
							<th colspan = "2">Total</th>
							<th><?PHP echo $symbol ." &nbsp; ". number_format($grossttl, 2, '.', ' '); ?></th>
							<th><?PHP echo $symbol ." &nbsp; ". number_format($taxttl, 2, '.', ' '); ?></th>
							<th><?PHP echo $symbol ." &nbsp; ". number_format($netttl, 2, '.', ' '); ?></th>
							<th><?PHP echo "Card Count : ".$cardcount. "<br>Cash Count : ".$cashcount; ?></th>
							<th colspan = "3"></th>
						</tr>
					
					</table>
					
					<br>
							
					<button class = "prntbtn" id = "noPrint" onclick = "window.print();return false;">Click here to print</button>
			</div>
		</div>
	</body>
</html>
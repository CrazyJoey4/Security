<?PHP
	//Pay_Cash.php
	
	session_start();

	if(isset($_GET['id']))
	{
		include('connect.php');
		$object = new Connect();
		$table 	= $_GET['id'];
	}
?>

<html>
	<head>
		<title>- Card Details Page -</title>
		
		<link rel = "icon" href = "Money-icon.ico">
		<link rel = "stylesheet" href = "https://www.w3schools.com/w3css/4/w3.css">
		<link rel = "stylesheet" href = "https://fonts.googleapis.com/icon?family=Material+Icons">
		
		<style>
			.content
			{				
				margin:0;
				background-color:#B2D2FC;
				padding:20px;
				font-size:20px;				
				font-family:georgia,garamond,serif;
				height:100%;
				overflow:auto;
			}
			
			h1
			{
				text-align:center;
				font-style:italic;
				font-weight:bold;
			}
			
			h3
			{
				margin-left:20px;
				text-align:center;
				width: 150px;
				padding:10px;
				font-family:Times New Roman;
				font-size:25px;
				background-color: #85BAFF;
				color:white;
				border-radius:10px 0 20px;
				border:none;
				font-weight:bold;
			}
			
			.span
			{
				text-align:center;
				display:block;
				float:right;
				width: 300px;
				padding:5px;
				font-family:Times New Roman;
				font-size:20px;
				background-color: #80FFCD;
				color:black;
				border-radius:10px;
				border:none;
				font-weight:bold;
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
			}
			
			.wrap
			{				
				margin-left:auto;
				margin-right:auto;
				background:snow;
				padding:20px;							
				box-shadow:0 0 10px rgba(0,0,0,0.2);
				border-radius:10px;				
			}
			
			.wrap .InputText 
			{
				height:70px;
				width:50%;
				position:relative;
				margin-left:auto;
				margin-right:auto;
			}
			
			.wrap .InputText input
			{
				height:100%;
				width:100%;
				background:snow;
				border:none;
				border-bottom:2px solid silver;
				font-size:20px;
				outline:none;
				text-align:center;
			}
			
			.wrap .InputText input:focus ~ label,
			.wrap .InputText input:valid ~ label
			{	
				transform: translateY(-40px);
				transition:all 0.3s ease;
				color:black;
				outline:none;
			}
			
			.wrap .InputText label
			{
				font-size:20px;
				position:absolute;
				bottom:10px;
				left:0;
				color:grey;
				pointer-events:none;
			}
			
			.wrap .InputText .underline 
			{
				position:absolute;
				bottom:0px;
				height:2px;
				width:100%;				
			}
			
			input::-webkit-outer-spin-button,
			input::-webkit-inner-spin-button 
			{
				display: none;
			}
			
			.submit, .cancel
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
			
			.submit:hover
			{
				background-color:#5199F9;
				color: white;
				transition:0.3s;
			}
			
			.cancel:hover
			{
				background-color:red;
				color: white;
				transition:0.3s;
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
			
			a
			{
				text-decoration:none;
			}
			
			.cal
			{
				text-align:center;
				width: 150px;
				padding:5px;
				font-family:Times New Roman;
				font-size:25px;
				background-color: #85BAFF;
				color:white;
				border-radius:10px 0 20px;
				border:none;
				font-weight:bold;
			}
			
			.cal:hover
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
			
			<span>
			<?PHP
				if(isset($_SESSION['message']))
				{
					echo $_SESSION['message'];
				}				
				unset($_SESSION['message']);
			?>
			</span>
			
			<a href = "Payment_Page.php?id=<?PHP echo $table;?>">
				<button class = "back_btn" id = "noPrint"><i class = 'material-icons'>arrow_back</i></button>
			</a>	
			
			<h3 id = "noPrint"><?PHP echo $table;?></h3>
			<h1>Receipt</h1>
										
					<hr style = "border-bottom:2px solid grey;">					
					<?php
					$DATETIME = $object->get_datetime();
					
						echo "<span class = 'span'>".$DATETIME."</span>";
						
						echo "<br><br>";
					
						echo "<table>
							<tr>						
								<th width='10%'>Food ID</th>
								<th width='20%'>Food Name</th>
								<th width='15%'>Quantity</th>
								<th width='15%'>Price</th>
								<th width='15%'>Subtotal</th>
							</tr>";
								
						$query = "SELECT * FROM order_table WHERE Table_ID = '$table'";
						$result = mysqli_query($connected, $query);
						$Total = 0;
						$TotalTax = 0;
						
						while($row = mysqli_fetch_array($result))
						{
							$query2 = "SELECT * FROM menu_table WHERE Food_name = '".$row['Food_name']."'";
							$result2 = mysqli_query($connected, $query2);
							
							while($row2 = mysqli_fetch_array($result2))
							{
								echo "<tr style = 'font-family:Times New Romans; font-weight:bold'>";
									echo "<td>" . $row2['Food_ID'] . "</td>";
									echo "<td>" . $row['Food_name'] . "</td>";
									echo "<td>" . $row['Food_quantity'] . "</td>";									
									
									$result3 = mysqli_query($connected,"select res_currency FROM restaurant_master");
									$row3 = mysqli_fetch_array($result3);
									
									echo "<td>" .$row3['res_currency']. " " . $row2['Food_cost'] . "</td>";
									$Qtt = $row['Food_quantity'];
									$Pri = $row2['Food_cost'];
									$sub = $Qtt * $Pri;
									
									$Total += $sub;
									echo "<td>" . number_format($sub, 2,'.','') . "</td>";
								echo "</tr>";								
							}								
						}
						$query = "SELECT * FROM tax_table WHERE Tax_status = 'Able'";
						$result = mysqli_query($connected, $query);
						while($row = mysqli_fetch_array($result))
						{
							$tax = $row['Tax_percent'] * 100;

							echo "<tr style = 'font-family:Times New Romans; font-weight:bold'>";
								echo "<td colspan = '3'></td>";
								echo "<td>" . $row['Tax_name'] . " &nbsp;&nbsp; " . $tax . "%</td>";
								$taxcost = $Total * $row['Tax_percent'];
								echo "<td>" . number_format($taxcost, 2,'.','') . "</td>";								
								$TotalTax += $taxcost;
								
							echo "</tr>";
						}
						$AllTotal = $Total + $taxcost;
						
						echo "<tr style = 'font-family:Times New Romans; font-weight:bold'>";
							echo "<td colspan = '4'></td>";
							echo "<td>" . number_format($AllTotal, 2,'.','') . "</td>";
						echo "</tr>";
						
						$result3 = mysqli_query($connected,"select res_currency FROM restaurant_master");
						$row3 = mysqli_fetch_array($result3);
						
						echo "<tr style = 'font-family:Times New Romans; font-weight:bold'>";
							echo "<td colspan = '4' style = 'text-align:right;'>Total : </td>";
							echo "<td>" .$row3['res_currency']. " &nbsp;&nbsp; " . number_format(round($AllTotal, 1), 2,'.','') . "</td>";
						echo "</tr>";
							echo "</table>";
					?>
						
					<br><br>
					
					<hr style = "border-bottom:2px solid grey;">
					
				<form method = "post" action = "pay_insert.php" id = "noPrint">
					<h2>Calculation</h2>
					
					<div class = "InputText" style = "display:none;">
						<input type = "text" id = "Table_ID" name = "Table_ID" value = "<?PHP echo $table; ?>" required />
						<label>Table ID</label>

						<input type = "text" id = "Gross_pay" name = "Gross_pay" value = "<?PHP echo $Total; ?>" required />
						<label>Gross Pay</label>

						<input type = "text" id = "Tax_pay" name = "Tax_pay" value = "<?PHP echo $TotalTax; ?>" required />
						<label>Tax Pay</label>

						<input type = "text" id = "Net_pay" name = "Net_pay" value = "<?PHP echo $AllTotal; ?>" required />
						<label>Net Pay</label>

						<input type = "text" id = "Pay_type" name = "Pay_type" value = "Cash" required />
						<label>Pay Type</label>

						<input type = "text" id = "Pay_amount" name = "Pay_amount" value = "<?PHP echo round($AllTotal, 1); ?>" required />
						<label>Paid</label>
					</div>
						<a onclick = "calculate()" class = "cal">Click Me to Calculate</a>
					
					<div class = "InputText">
						<input type = "text" id = "paying" disabled />
						<label>Change</label>						
					</div>
						
					<br><br>
					<input type = "submit" class = "submit" name = "submit">					
				</form>
				
				<button class = "prntbtn" id = "noPrint" onclick = "window.print();return false;">Click here to print</button>
			</div>
		</div>
		
	<script>
		window.onload('calculate');
		
		function calculate() 
		{
		  var answer;
		  var total = document.getElementById("Pay_amount").value;
		  var amount = prompt("Please enter the amount : ");
		  
          amount = Number(amount);
          
		  if(total < amount)
		  {
			  answer = amount - total;
              answer = answer.toFixed(2)
			  document.getElementById("paying").value = answer;
		  }
		  else
		  {
			  alert("Not enough ! ");
		  }
		}
	</script>
	</body>
</html>
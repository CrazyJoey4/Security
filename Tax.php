<?PHP
	//Tax.php
	
	include('header.php');
	
	$object = new Connect();
	
	if(!$object->isLogin())
	{
		header("location:".$object->base_url."index.php");
	}
?>

<html>
	<head>
		<title> - Tax Management - </title>
		
		<style>
			.content
			{
				height:100%;
				overflow:auto;				
			}
		
			h1
			{
				font-style:italic;
				font-weight:bold;
			}
			
			h3
			{
				font-style:italic;
				text-align:center;
			}
		
			.wrap
			{
				width:100%;
				background: white;
				padding:30px;
				box-shadow:0 0 10px rgba(0,0,0,0.2);				
			}
			
			#overlay .wrap
			{
				width:100%;				
				background: snow;
				padding:30px;
				box-shadow:0 0 10px rgba(0,0,0,0.2);				
			}
			
			.wrap .InputText 
			{
				text-align:center;
				height:70px;
				margin-left:auto;
				margin-right:auto;
				width:50%;
				position:relative;
			}
			
			.wrap .InputText input
			{
				text-align:center;
				height:100%;
				width:100%;
				background:snow;
				border:none;
				border-bottom:2px solid silver;
				font-size:20px;
				outline:none;
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
				text-align:center;
			}
			
			th
			{
				text-align:center;
			}
			
			.add_btn			
			{
				background-color: #18FF23;
				color: white;
				text-align: center;
				text-decoration: none;
				padding:10px;
				border:none;
				border-radius:50%;
				opacity:50%;
				box-shadow:0 0 10px rgba(0,0,0,0.2);
			}
			
			.material-icons
			{
				font-size:25px;
				font-weight:bold;
			}
			
			.add_btn:hover
			{
				box-shadow:5px 5px 10px rgba(0,0,0,0.2);
				opacity:1;
				transition:0.3s;
			}			
			
			#overlay 
			{
				position: fixed;
				display: none;
				width: 50%;
				top: 10;
				left: 400px;
				border: 2px solid black;
				box-shadow:5px 5px 10px rgba(0,0,0,0.2);
			}
			
			/* Style the select */
			input::-webkit-outer-spin-button,
			input::-webkit-inner-spin-button 
			{
				-webkit-appearance: none;
				margin: 0;
			}
			
			[type="radio"]:checked,
			[type="radio"]:not(:checked)
			{
				position: absolute;				
				visibility: hidden;
			}

			.checkbox-option:checked + label,
			.checkbox-option:not(:checked) + label
			{
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
				color:#ffffff;	
				transition: all 0.3s linear; 
			}

			.checkbox-option:not(:checked) + label
			{
				background-color:#161B44;
				box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1);
			}
			
			.checkbox-option:checked + label
			{
				background-color: #9CC3FB;
				color:black;
				box-shadow: 0 5px 10px 0 rgba(0, 0, 0, 0.5);
			}
			
			.checkbox-option:not(:checked) + label::before,
			.checkbox-option:checked + label::before
			{
				border-radius: 4px;
				background-image: linear-gradient(298deg, #D09CFB, #9CC3FB);
				z-index: -1;
				transition: all 0.5s linear; 
			}
			
			.checkbox-option:not(:checked) + label:hover
			{
				box-shadow: 0 5px 15px 0 rgba(0, 0, 0, 0.5);
			}
			/* End of style Select */
			
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
			
			.edit_btn			
			{
				background-color: #5199F9;
				color: white;
				text-align: center;
				text-decoration: none;
				padding:10px;
				border:none;
				border-radius:30%;
				box-shadow:0 0 10px rgba(0,0,0,0.2);
			}
			
			.material-icons
			{
				font-size:25px;
			}
			
			.edit_btn:hover
			{
				background-color:white;
				color: black;
				transition:0.3s;
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
			
					<th><h1>Tax Management</h1></th>
					<button class = 'add_btn' style = "float:right;" onclick = "on()"><i class = 'material-icons'>add</i></button>
					<br><br>
					<?php
						$result = mysqli_query($connected,"select * FROM tax_table");

						echo "<table class = 'shown'>
						<tr>
							<th width='30%'>Name</th>
							<th width='25%'>Percent</th>
							<th width='30%'>Status</th>
							<th width='20%' colspan = '2';>Action</th>
						</tr>";

						while($row = mysqli_fetch_array($result))
						{
							echo "<tr style = 'font-family:Times New Romans; font-weight:bold'>";
							echo "<td>" . $row['Tax_name'] . "</td>";
							
							$tax = $row['Tax_percent'] * 100;
							
							
							echo "<td>" . $tax . " %</td>";
							
							if($row['Tax_status'] == "Able")
							{
								echo "<td style = 'background-color:#94FF99'>" . $row['Tax_status'] . "</td>";
							}
							else
							{
								echo "<td style = 'background-color:#FF9494'>" . $row['Tax_status'] . "</td>";
							}
							
							echo "<td><center><button class = 'edit_btn'><a href = 'Tax_Edit.php?id=".$row['Tax_ID']."'><i class = 'material-icons'>mode_edit</i></a></button></center></td>";
														
							echo "<td style = 'border-left:hidden;'><center><button class = 'edit_btn'><a href = 'tax_delete.php?id=".$row['Tax_ID']."' onClick=\"javascript:return confirm('Are you sure you want to delete this?');\"><i class = 'material-icons'>delete</i></a></button></center></td>";
							
							echo "</tr>";
						}
						echo "</table>";				  
					?>					
			</div>
	
			<div id = "overlay" class = "overlay">
				<div class = "wrap" style = "text-align:center;">
					<form method = "post" action = "tax_insert.php">
						<h3>Tax Details</h3>
							
						<hr style = "border-bottom:2px solid grey;">
						
						<div class = "InputText">
							<input type = "text" id = "Tax_name" name = "Tax_name" required />
							<label>Name</label>
						</div>
							
						<br><br>
						
						<div class = "InputText">
							<input type = "number" id = "Tax_percent" name = "Tax_percent" required />
							<label>Tax Percent (%)</label>
						</div>
							
						<br><br>
						
						<div class = "option" style = "text-align:left;">
								<label>Status</label>
								<br>
								<input class = "checkbox-option" type = "radio" name = "Tax_status" id = "Able" value = "Able" required checked />
								<label class = "for-checkbox-option" for = "Able">Able</label>
									
								<input class = "checkbox-option" type = "radio" name = "Tax_status" id = "Disable" value = "Disable" required />
								<label class = "for-checkbox-option" for = "Disable">Disable</label>
						</div>
							
						<br><br>
							
						<input type = "submit" class = "submit">
						<button type = "reset" class = "cancel" onclick = "off()">Cancel</button>
					</form>
				</div>
			</div>
		</div>
		
	<script>
		function on() 
		{
			document.getElementById("overlay").style.display = "block";
		}

		function off() 
		{
			document.getElementById("overlay").style.display = "none";
		}
	</script>
	</body>
</html>
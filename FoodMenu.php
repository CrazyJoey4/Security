<?PHP
	//FoodMenu.php
	
	include('header.php');	
	
	$object = new Connect();
	
	if(!$object->isLogin())
	{
		header("location:".$object->base_url."index.php");
	}
?>

<html>
	<head>
		<title> - Food Menu - </title>
		
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
			
			.wrap .InputText number:focus ~ label,
			.wrap .InputText number:valid ~ label
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
			
			select
			{
				height:100%;
				width:100%;
				color:grey;
				background:snow;
				border:none;
				border-bottom:2px solid silver;
				font-size:20px;
				outline:none;
			}
			select:valid
			{
				color:black;
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
			
					<th><h1>Food Menu</h1></th>
					<button class = 'add_btn' style = "float:right;" onclick = "on()"><i class = 'material-icons'>add</i></button>
					<br><br>
					<?php
						$result = mysqli_query($connected,"select * FROM menu_table ORDER BY Category_name ASC");
						

						echo "<table class = 'shown'>
						<tr>
							<th width='10%'>ID</th>
							<th width='25%'>Name</th>
							<th width='15%'>Cost</th>
							<th width='20%'>Category</th>
							<th width='20%'>Status</th>
							<th width='10%' colspan = '2'>Action</th>
						</tr>";

						while($row = mysqli_fetch_array($result))
						{
							$CATEGORY = $row['Category_name'];
							
							$result2 = mysqli_query($connected,"select Category_status FROM category_table WHERE Category_name = '$CATEGORY'");
							$row2 = mysqli_fetch_array($result2);
							
							echo "<tr style = 'font-family:Times New Romans; font-weight:bold'>";
							echo "<td>" . $row['Food_ID'] . "</td>";
							echo "<td>" . $row['Food_name'] . "</td>";
							
							$result3 = mysqli_query($connected,"select res_currency FROM restaurant_master");
							$row3 = mysqli_fetch_array($result3);
							
							echo "<td>" .$row3['res_currency']. " " . $row['Food_cost'] . "</td>";
							echo "<td>" . $row['Category_name'] . "</td>";
								
							if($row['Food_status'] == "Available")
							{
								if($row2['Category_status'] == "Able")
								{	
									echo "<td style = 'background-color:#94FF99'>" . $row['Food_status'] . "</td>";
								}
								else
								{
									echo "<td style = 'background-color:#FF9494'> Currently Not Available</td>";
								}
							}
							else
							{
								echo "<td style = 'background-color:#FF9494'>" . $row['Food_status'] . "</td>";
							}
								
							echo "<td><center><a href = 'Food_Edit.php?id=".$row['Food_ID']."'><button class = 'edit_btn'><i class = 'material-icons'>mode_edit</i></button></a></center></td>";
															
							echo "<td style = 'border-left:hidden;'><center><a href = 'food_delete.php?id=".$row['Food_ID']."' onClick=\"javascript:return confirm('Are you sure you want to delete this?');\"><button class = 'edit_btn'><i class = 'material-icons'>delete</i></button></a></center></td>";
								
							echo "</tr>";
						}
						echo "</table>";				  
					?>					
			</div>
	
			<div id = "overlay" class = "overlay">
				<div class = "wrap" style = "text-align:center;">
					<form method = "post" action = "food_insert.php">
						<h3><b>Food Menu Details</b></h3>
							
						<hr style = "border-bottom:2px solid grey;">
						<div class = "InputText">
							<select name = "Category_name" id = "Category_name" required>
								<option value = "">Select Category</option>
								
								<?PHP
								$result = mysqli_query($connected, "select * FROM category_table WHERE Category_status = 'Able' ORDER BY Category_name ASC");
								
								while($row = mysqli_fetch_array($result))
								{
									echo '<option value = "' .$row['Category_name']. '">'.$row['Category_name'].'</option>';					
								}						
								
								?>							
							</select>
						</div>
						
						<br>
						
						<div class = "InputText">
							<input type = "text" id = "Food_ID" name = "Food_ID" maxlength = "4" required />
							<label>ID</label>
						</div>
						
						<br>
						
						<div class = "InputText">
							<input type = "text" id = "Food_name" name = "Food_name" required />
							<label>Name</label>
						</div>
						
						<br>
						
						<div class = "InputText">
							<input type = "number" id = "Food_cost" name = "Food_cost" required step = ".1" />
							<label>Cost</label>
						</div>
						
						<br>
						
						<div class = "option" style = "text-align:left;">
								<label>Status</label>
								<br>
								<input class = "checkbox-option" type = "radio" name = "Food_status" id = "Available" value = "Available" required checked />
								<label class = "for-checkbox-option" for = "Available">Available</label>
									
								<input class = "checkbox-option" type = "radio" name = "Food_status" id = "Sold Out" value = "Sold Out" required />
								<label class = "for-checkbox-option" for = "Sold Out">Sold Out</label>
						</div>
							
						<br>
							
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
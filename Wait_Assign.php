<?PHP
	//Wait_Assign.php
	
	session_start();
	
	if(isset($_GET['id']))
	{
		include('connect.php');
	
		$ID 	= $_GET['id'];
		
		$query = "SELECT * FROM waitlist_table WHERE Wait_ID = '$ID'";
		$result = mysqli_query($connected, $query);
		$row = mysqli_fetch_assoc($result);
		
		$ID 		= $row['Wait_ID'];
		$NAME 		= $row['Cus_name'];
		$PAX		= $row['Cus_Pax'];
		$CONTACT	= $row['Cus_contact'];
		$STATUS		= $row['Wait_time'];
	}
?>

<html>
	<head>
		<title>- Assign Page -</title>
		<link rel = "icon" href = "Restaurant-icon.png">
		
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
				overflow:auto;
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
				width:50%;				
				box-shadow:0 0 10px rgba(0,0,0,0.2);
			}
			
			.wrap .InputText 
			{
				margin-left:auto;
				margin-right:auto;
				text-align:center;
				height:70px;
				width:50%;
				position:relative;
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
			
			.disabled ~ label
			{
				transform: translateY(-40px);
				transition:all 0.3s ease;
				color:black;
				outline:none;				
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
			
			.submit
			{
				background-color: white;
				color: black;
				font-family:georgia,garamond,serif;
				font-size:20px;
				text-align: center;
				text-decoration: none;
				padding: 10px 120px;
				border:none;
				box-shadow:0 0 10px rgba(0,0,0,0.2);
			}
			
			.submit:hover
			{
				background-color:#5199F9;
				color: white;
				transition:0.3s;
			}
			
			.submit:active 
			{
				background-color: #3e8e41;
				box-shadow: 0 5px #666;
				transform: translateY(4px);
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
			
			.tbl_btn
			{
				margin-left:20px;
				width: 150px;
				padding:10px;
				font-family:Times New Roman;
				font-size:25px;
				background-color: #85BAFF;
				color:snow;
				outline:none;
				border-radius:10px 0 20px;
				border:none;				
			}
			
			a
			{
				text-decoration:none;
			}
			
			.tbl_btn:hover
			{
				background-color:#C4DEFF;
				color: black;
				transition:0.3s;
			}
		</style>
	</head>
	
	<body>
		<div class = "content">
			<div class = "wrap">
				
			<button class = "back_btn">
				<a href = "Waitlist.php"><i class = 'material-icons'>arrow_back</i></a>
			</button>
				<form method = "post" action = "wait_delete.php">
				
					<h1>Assign Table</h1>
					
					<hr style = "border-bottom:2px solid grey;">
					
					<div class = "InputText" style = "display:none;">
						<input type = "text" name = "Wait_ID" id = "Wait_ID"  value = "<?PHP echo $ID; ?>" required />
						<label>ID</label>
					</div>
					
					<div class = "InputText">
						<input class = "disabled" type = "text" value = "<?PHP echo $ID; ?>" disabled />
						<label style = "color:black;">ID</label>
					</div>

					<br>
					
					<div class = "InputText">
						<input type = "number" class = "disabled" value = "<?PHP echo $PAX; ?>" disabled />
						<label style = "color:black;">Pax</label>
					</div>
					
					<br>
					
					<div class = "InputText">
						<select name = "Table_ID" id = "Table_ID" required>
							<option value = "">Assign Table</option>
								
							<?PHP
							$result = mysqli_query($connected, "select * FROM table_data WHERE Table_status = 'Able' AND `Live_status` = 'Available' AND `Capacity` >= '$PAX' ORDER BY Table_ID ASC");
							
							while($row = mysqli_fetch_array($result))
							{
								echo '<option value = "' .$row['Table_ID']. '">'.$row['Table_ID'].'</option>';
							}						
							
							?>							
						</select>
					</div>
					
					<br>
					
					<input type = "submit" class = "submit" name = "submit" value = "Assign">
				</form>	
			</div>
		</div>
	</body>
</html>			
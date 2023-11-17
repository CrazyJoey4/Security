<?PHP
	//Staff_Edit.php
	session_start();
	
	
	if(isset($_GET['id']))
	{
		include('connect.php');
	
		$ID 		= $_GET['id'];
		
		$query = "SELECT * FROM user_table WHERE User_ID = '$ID'";
		$result = mysqli_query($connected, $query);
		$row = mysqli_fetch_assoc($result);
		
		$ID 		= $row['User_ID'];
		$name 		= $row['User_name'];
		$email 		= $row['User_email'];
		$password 	= $row['User_pwd'];
		$position 	= $row['User_position'];
		$created	= $row['User_start'];
		$contact	= $row['User_contact'];
		$birthday	= $row['User_birthday'];
		$gender		= $row['User_gender'];	
	}
?>

<html>
	<head>
		<title>- Staff Edit Page -</title>	
		<link rel = "stylesheet" href = "https://www.w3schools.com/w3css/4/w3.css">
		<link rel = "stylesheet" href = "https://fonts.googleapis.com/icon?family=Material+Icons">		
		
		<style>
			.content
			{				
				background-color:#B2D2FC;
				padding-top:20px;
				font-size:20px;				
				font-family:georgia,garamond,serif;
			}
			
			h1
			{
				text-align:center;
				font-style:italic;
				font-weight:bold;
			}
			
			.upperT
			{
				text-align:left;
				font-style:italic;
				border-bottom:2px solid grey;
				font-weight:bold;				
			}
			
			.lowerT
			{
				text-align:left;
				font-style:italic;
				border-bottom:2px solid grey;
				font-weight:bold;
			}
			
			.wrap
			{
				
				margin-left:auto;
				margin-right:auto;
				background:snow;
				padding:20px;
				width:75%;				
				box-shadow:0 0 10px rgba(0,0,0,0.2);
			}
			
			.wrap .InputText 
			{
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
			
			.disabled ~ label
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
		</style>
	</head>
	
	
	
	<body>
		<div class = "content">
			<div class = "wrap">
				
			<button class = "back_btn">
				<a href = "Staff.php"><i class = 'material-icons'>arrow_back</i></a>
			</button>

				
				<form method = "post" action = "staff_update.php">
					<h1>Account Details</h1>					
					<h3 class = "upperT">Personal Details</h3>	
					
					<div class = "InputText">
						<input type = "text" name = "User_name" id = "User_name"  value = "<?PHP echo $name; ?>"/>
						<label>Name</label>
					</div>     

					<br>
					
					<div class = "InputText">
						<input type = "text" name = "User_email" id = "User_email" required value = "<?PHP echo $email; ?>"/>
						<label>Email</label>
					</div>
					
					<br>
					
					<div class = "option">
							<label>Position</label>
							<br>
							<input class = "checkbox-option" type = "radio" name = "User_position" id = "Waiter" value = "Waiter" required />
							<label class = "for-checkbox-option" for = "Waiter">Waiter</label>
								
							<input class = "checkbox-option" type = "radio" name = "User_position" id = "Cashier" value = "Cashier" required />
							<label class = "for-checkbox-option" for = "Cashier">Cashier</label>
					</div>
										
					<br>
					
					<div class = "InputText">
						<input type = "text" class = "disabled" name = "User_start" id = "User_start" value = "<?PHP $created = date('Y-m-d'); echo  $created;?>" disabled />
						<label style = "color:black;">Account Created On</label>
					</div>
					
					<br>
					
					<div class = "InputText">
						<input type = "number" name = "User_contact" id = "User_contact" required value = "<?PHP echo $contact; ?>"/>
						<label>Contact</label>
					</div>
					
					<br>
					
					<div class = "InputText">
						<input type = "date" name = "User_birthday" id = "User_birthday" value = "<?PHP echo $birthday; ?>"/>
						<label>Date of Birth</label>
					</div>
					
					<br>
					
					<?PHP
						if($gender == null)
						{
					?>
						<div class = "option">
							<label>Gender</label>
							<br>
							<input class = "checkbox-option" type = "radio" name = "User_gender" id = "Male" value = "Male" required />
							<label class = "for-checkbox-option" for = "Male">Male</label>
								
							<input class = "checkbox-option" type = "radio" name = "User_gender" id = "Female" value = "Female" required />
							<label class = "for-checkbox-option" for = "Female">Female</label>
						</div>
					<?PHP
					
						}
						else
						{
					?>
						<div class = "InputText" style = "display:none;">
							<input type = "text" name = "User_gender" id = "User_gender" value = "<?PHP echo $gender; ?>" />
							<label style = "color:black;">Gender</label>
						</div>
						
						<div class = "InputText">
							<input type = "text" class = "disabled" value = "<?PHP echo $gender; ?>" disabled />
							<label style = "color:black;">Gender</label>
						</div>
					<?PHP
						}
					?>
					
					<br>
					
					<h3 class = "lowerT">Log In Details<h3>
					
					
					
					<div class = "InputText" style = "display:none;">
						<input type = "text" name = "User_ID" id = "User_ID" value = "<?PHP echo $ID; ?>" required  maxlength = "6"/>
						<label style = "color:black;">ID</label>
					</div>
					
					<div class = "InputText">
						<input class = "disabled" type = "text" value = "<?PHP echo $ID; ?>" disabled />
						<label style = "color:black;">ID</label>
					</div>
					
					<br>
					
					<div class = "InputText">
						<input type = "password" name = "User_pwd" id = "User_pwd" value = "<?PHP echo $password; ?>" required />
						<label>Password</label>
					</div>
					
					<br><br>
							
					<input type = "submit" class = "submit" name = "submit" value = "Update">
				</form>	
			</div>
		</div>
	</body>
</html>


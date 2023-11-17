<?PHP
	//Profile.php

	include('header.php');
	
	$object = new Connect();
	
	if(!$object->isLogin())
	{
		header("location:".$object->base_url."index.php");
	}
	
	$ID 		= $_SESSION['User_ID'];
	$name 		= $row['User_name'];
	$email 		= $row['User_email'];
	$password 	= $row['User_pwd'];
	$position 	= $row['User_position'];
	$created	= $row['User_start'];
	$contact	= $row['User_contact'];
	$birthday	= $row['User_birthday'];
	$gender		= $row['User_gender'];
?>

<html>
	<head>
		<title>- Profile Page -</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
		
		<style>
			.content
			{
				margin-left:250px;
				padding:10px;
				background-color:#B2D2FC;
				padding-top:20px;
				font-size:20px;				
				font-family:georgia,garamond,serif;
			}
			
			h1
			{
				text-align:left;
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
				text-align:right;
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
		</style>
	</head>
	
	
	
	<body>
		<div class = "content">
			<div class = "wrap">
				<form method = "post" action = "update.php">
					
					<span id = "message"></span>
					<span>
						<?PHP
							if(isset($_SESSION['message']))
							{
								echo $_SESSION['message'];
							}				
							unset($_SESSION['message']);
						?>
					</span>
					
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
					
					<div class = "InputText" >
						<input type = "text" class = "disabled" name = "User_position" id = "User_position" required value = "<?PHP echo $position; ?>" disabled />
						<label style = "color:black;">Position</label>
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
							<div class = "option" style = "text-align:left;">
								<label>Gender</label>
								<br>
								<input class = "checkbox-option" type = "radio" name = "User_gender" id = "Male" value = "Male"  />
								<label class = "for-checkbox-option" for = "Male">Male</label>
									
								<input class = "checkbox-option" type = "radio" name = "User_gender" id = "Female" value = "Female"  />
								<label class = "for-checkbox-option" for = "Female">Female</label>
							</div>
					<?PHP
						}
						else
						{
					?>
							<div class = "InputText" style = "display:none;">
								<input type = "text" name = "User_gender" id = "User_gender" value = "<?PHP echo $gender; ?>" />
								<label>Gender</label>
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
					
					<br>
					
					<div class = "InputText">
						<input type = "text" class = "disabled" name = "User_ID" id = "User_ID" value = "<?PHP echo $ID; ?>" disabled />
						<label style = "color:black;">ID</label>
					</div>
					
					<br>
					
					<div class = "InputText">						
						<i class="far fa-eye" onclick = "show()"></i>
						<input type = "password" name = "User_pwd" id = "User_pwd" value = "<?PHP echo $password; ?>" required />
						<label>Password</label>
					</div>
					<br><br>

					<input type = "submit" class = "submit" name = "submit" value = "Update" onClick = "return confirmSubmit()">
				</form>	
			</div>
		</div>
		
	<script>
		function show() 
		{
			var x = document.getElementById("User_pwd");
			if (x.type === "password") 
			{
				x.type = "text";
			} 
			else 
			{
				x.type = "password";
			}
		}
		
		function confirmSubmit()
		{
			var agree = confirm("Are you sure your details are correct?");
			if (agree)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	</script>
	</body>
</html>
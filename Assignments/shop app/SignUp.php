<?php // <--- do NOT put anything before this PHP tag
include('functions.php');
$cookieMessage = getCookieMessage();
?>
<!doctype html>
<html>

<head>
	<meta charset="UTF-8" />
	<title>Sign Up Page</title>
	<link rel="stylesheet" type="text/css" href="shopstyle.css" />
</head>

<body>
	<?php include "./includes/nav.php"; ?>
	<div class="main">

		<div class="sign-up-block">
		<h1>Sign Up!</h1>

			<form action='./AddNewCustomer.php' method='POST'>
				<!-- 
			TODO make a sign up <form>, don't forget to use <label> tags, <fieldset> tags and placeholder text. 
			all inputs are required.
			
			Make sure you <input> tag names match the names in AddNewCustomer.php
			
			your form tag should use the POST method. don't forget to specify the action attribute.
		-->
				<fieldset>
					<legend>Personnal Details:</legend>
					<label for="UserName">User name:</label>
					<input type="text" id="UserName" name="UserName" placeholder="pleace enter userName" required><br><br>
					<label for="FirstName">First name:</label>
					<input type="text" id="FirstName" name="FirstName" placeholder="please enter your first name" required><br><br>
					<label for="LastName">Last name:</label>
					<input type="text" id="LastName" name="LastName" placeholder="please enter your last name" required><br><br>
				</fieldset>
				<fieldset>
					<legend>Shipping Details:</legend>
					<label for="Address">Address</label>
					<input type="text" id="Address" name="Address" placeholder="please enter your address" required><br><br>
					<label for="City">City:</label>
					<input type="text" id="City" name="City" placeholder="please enter your city" required><br><br>
					<input type="submit" value="Submit">
				</fieldset>
			</form>
		</div>

	</div>
	<?php include "./includes/footer.php"; ?>
</body>

</html>
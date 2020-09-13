<!DOCTYPE html>
<html>
<head>
	<title>Create New Account</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width-device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Anton|Roboto|Courgette|Pacifico:400,700" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/signup.css">
</head>
<body>
	<div class="signup-form">
		<form action="" method=post>
			<div class="form-header">
				<h2>Sign Up</h2>
				<p>Fill out this form and start chating with your friends.</p>
			</div>
			<div class="form-group">
				<label>Username</label>
				<input type="text" class="form-control" name="user_name" placeholder="Example: Emil" autocomplete="off" required>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="Password" class="form-control" name="user_pass" placeholder="Password" autocomplete="off" required>
			</div>
			<div class="form-group">
				<label>Email Address</label>
				<input type="Email" class="form-control" name="user_email" placeholder="Someone@site.com" autocomplete="off" required>
			</div>
			<div class="form-group">
				<label>Country</label>
				<select class="form-control" name="user_country" required>
					<option disabled="">Select a Country</option>
					<option>Romania</option>
					<option>Unated States of America</option>
					<option>Canada</option>
					<option>UK</option>
				</select>
			</div>
			<div class="form-group">
				<label>Gender</label>
				<select class="form-control" name="user_gender" required>
					<option disabled="">Select your Gender</option>
					<option>Male</option>
					<option>Female</option>
					<option>Others</option>
				</select>
			</div>
			<div class="form-group">
				<label class="checkbox-inline"><input type="checkbox" required> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block btn-lg" name="sign_up">Sign Up</button>
			</div>
			<?php include("signup_user.php"); ?>
		</form>
		<div class="text-center small" style="color: white; background-color: #890ff1;">Already have an account? <a href="signin.php">Signin here</a></div>
	</div>
</body>
</html>
<!DOCTYPE html>
<?php 
session_start();
include("include/connection.php");
include("include/header.php");

if(!isset($_SESSION['user_email'])){
	header("location: signin.php");
}else{ ?>
<html>
<head>
	<title>Change Profile Picture</title>
	<meta charset="utf-8">

	<meta name="viewpoint" content="width=device-width", initial-scale=1>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	
</head>
<style>
	.card{
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
		max-width: 400px;
		margin:auto;
		text-align:center;
		font-family: arial;
	}
	.card img{
		height: 200px;
		width: 200px;
	}
	.title{
		color: grey;
		font-size: 18px;
	}
	button{
		border:none;
		outline:0;
		display: inline-block;
		padding: 9px;
		color:white;
		background-color: #000;
		text-align: center;
		cursor: pointer;
		width: 100%;
		font-size: 18px;
	}
	#update_profile{
		position: absolute;
		cursor: pointer;
		padding: 10px;
		border-radius: 4px;
		color: white;
		background-color: #000;
	}
	label{
		padding: 7px;
		display: table;
		color: #fff;
	}
	input[type="file"]{
		display: none;
	}

</style>
<body>
	<?php 

		$user = $_SESSION['user_email'];
		$get_user = "SELECT * FROM users where user_email='$user'";
		$run_user = mysqli_query($con, $get_user);
		$row = mysqli_fetch_array($run_user);

		$user_name = $row['user_name'];
		$user_profile = $row['user_profile'];

		echo "
			<div class='card'>
				<center><img src='$user_profile' width='400px' height='400px'></center>
				<h1>$user_name</h1>
				<form method='post' enctype='multipart/form-data'>
					<label id='update_profile'><i class='fa fa-circle-o' aria-hidden='true'></i>Select Profile
						<input type='file' name='u_image'>
					</label>
					<button id='button_profile' name='update'>&nbsp&nbsp&nbsp<i class='fa fa-heart' aria-hidden='true'></i>Update Profile</button>
				</form>
			</div><br><br>
		";

		if (isset($_POST['update'])){
			$u_image = $_FILES['u_image']['name'];
			$image_tmp = $_FILES['u_image']['tmp_name'];
			$random_number = rand(1,100);

			if($u_image == ''){
				echo "<script>alert('Please Select Profile')</script>";
				echo "<script>window.open('upload.php','_self')</script>";
				exit();
			}else{
				move_uploaded_file($image_tmp, "images/$u_image.$random_number");

				$update = "update users set user_profile='images/$u_image.$random_number' where user_email='$user'";

				$run = mysqli_query($con, $update);

				if($run){
					echo "<script>alert('Your Profile Updated!')</script>";
					echo "<script>window.open('upload.php','_self')</script>";
				}
			}
		}
	?>

</body>
</html>
<?php } ?>
<!DOCTYPE html>
<?php 
session_start();
include("include/connection.php");

if(!isset($_SESSION['user_email'])){
	header("location: signin.php");
}else{?>
<html>
<head>
	<title>My Chat - HOME</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="css/home.css">
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container main-section">
		<div class="row">
			<div class="col-md-3 col-sm-3 col-xs-3 left-sidebar">
				<div class="input-group searchbox">
					<div class="input-group-btn">
						<center><a href="include/find_friends.php"><button class="btn btn-default search-icon" name="search_user" type="submit">Add new user</button></a></center>
					</div>
				</div>
				<div class="left-chat"></div>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-9 right-sidebar">
				<div class="row">
					<!-- getting the user information who is logged in -->
					<?php
						$user = $_SESSION['user_email'];
						$get_user = "select * from users where user_email='$user'";
						$run_user = mysqli_query($con, $get_user);
						$row = mysqli_fetch_array($run_user);

						$user_id = $row['user_id'];
						$user_name = $row['user_name'];
					?>

					<!-- Getting the user data on which user click -->
					<?php
						if(isset($_GET['user_name'])){
							global $con;

							$get_username = $_GET['user_name'];
							$get_user = "select * from users where user_name='$get_username'";

							$run_user = mysqli_query($con, $get_user);

							$row_user = mysqli_fetch_array($run_user);

							$username = $row_user['user_name'];
							$user_profile_image = $row_user['user_profile'];
						}

						$total_messages = "select * from users_chats where (sender_username='$user_name' AND receiver_username='$username') OR (receiver_username='$user_name' AND sender_username='$username')";
						$run_messages = mysqli_query($con, $total_messages);
						$total = mysqli_num_rows($run_messages);
					
						$_SESSION['user_name'] = $_GET['user_name'];
					?>

					<div class="col-md-12 right-header">
						<div class="right-header-img">
							<img src="<?php echo"$user_profile_image"; ?>">
						</div>
						<div class="right-header-detail">
							<form method="post">
								<p><?php echo "$username"; ?></p>
								<span class="total_msg"><?php echo "$total"; ?> messages</span>&nbsp &nbsp
								<button name="logout" class="btn btn-danger">Logout</button>
							</form>
							<?php
								if(isset($_POST['logout'])){
									$update_msg = mysqli_query($con, "UPDATE users SET log_in='Offline' WHERE user_name='$user_name'");
									header("Location:logout.php");
									exit();
								}

							?>
						</div>
					</div>
				</div>
			
				<div class="row">
					<div id="scrooling_to_bottom" class="col-md-12 right-header-contentChat">
						<div class="update_msgs"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 right-chat-textbox">
						<form method="post" id="new_message">
							<input autocomplete="off" type="text" name="msg_content" placeholder="Write your message........">
							<button class="btn" name="submit"><i class="fa fa-telegram" aria-hidden="true"></i></button>
						</form>					
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<?php  
		if (isset($_POST['submit'])) {
			$msg = htmlentities($_POST['msg_content']);
			if($msg == ""){
				echo "
					<div class='alert alert-danger'>
						<strong><center>Message was unable to send</center></strong>
					</div>
				";
			}
			else if(strlen($msg) > 100){
				echo "
					<div class='alert alert-danger'>
						<strong><center>Message is too long. Use only 100 characters</center></strong>
					</div>
				";
			}
			else{
				$insert = "insert into users_chats(sender_username, receiver_username, msg_content, msg_status, msg_date) values('$user_name', '$username', '$msg', 'unread', NOW())";
				$run_insert = mysqli_query($con, $insert);
			}
		}
	?>

	<script>
		$('#scrooling_to_bottom').animate({
			scrollTop: $('#scrooling_to_bottom').get(0).scrollHeight
		}, 1000);
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			var height = $(window).height();
			$('.left-chat').css('height', (height - 92) + 'px');
			$('.right-header-contentChat').css('height', (height - 163) + 'px');
		});
	</script>
</body>
</html>
<?php } ?>
<script>  
	$(document).ready(function(){

		get_users_data();
		update_msgs();
		setInterval(function(){
			get_users_data();
			update_msgs();
		}, 5000);


		function get_users_data(){
			$.ajax({
				url:"include/get_users_data.php",
				method:"POST",
				success:function(data){
					$('.left-chat').html(data);
				}
			})
		}

		function update_msgs(){
			$.ajax({
				url:"include/update_msg.php",
				method:"POST",
				success:function(data){
					$('.update_msgs').html(data);
				}
			})
		}
	});  
</script>
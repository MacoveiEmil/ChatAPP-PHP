<?php

	$con = mysqli_connect("localhost", "root", "", "mychat");

	session_start();

	$user = $_SESSION['user_email'];
	$get_user = "select * from users where user_email='$user'";
	$run_user = mysqli_query($con, $get_user);
	$row = mysqli_fetch_array($run_user);

	$user_id = $row['user_id'];
	$user_name = $row['user_name'];

	$get_username = $_SESSION['user_name'];
	$get_user = "select * from users where user_name='$get_username'";

	$run_user = mysqli_query($con, $get_user);

	$row_user = mysqli_fetch_array($run_user);

	$username = $row_user['user_name'];
	$user_profile_image = $row_user['user_profile'];

	$total_messages = "select * from users_chats where (sender_username='$user_name' AND receiver_username='$username') OR (receiver_username='$user_name' AND sender_username='$username')";
	$run_messages = mysqli_query($con, $total_messages);
	$total = mysqli_num_rows($run_messages);

	$update_msg = mysqli_query($con, "UPDATE users_chats SET msg_status='read' WHERE sender_username='$username' AND receiver_username='$user_name'");
	$sel_msg = "select * from users_chats where (sender_username='$user_name' AND receiver_username='$username') OR (receiver_username='$user_name' AND sender_username='$username') ORDER by 1 ASC";
	$run_msg = mysqli_query($con, $sel_msg);

	while ($row = mysqli_fetch_array($run_msg)){
		$sender_username = $row['sender_username'];
		$receiver_username = $row['receiver_username'];
		$msg_content = $row['msg_content'];
		$msg_date = $row['msg_date'];
	?>
	<ul>
		<?php
			if ($user_name == $sender_username AND $username == $receiver_username) {
				
				echo "
					<li>
						<div class='rightside-right-chat'>
							<span> $user_name <small>$msg_date</small></span><br><br>
							<p>$msg_content</p>
						</div>
					</li>
				";
			}
			else if ($user_name == $receiver_username AND $username == $sender_username) {
				
				echo "
					<li>
						<div class='rightside-left-chat'>
							<span> $username <small>$msg_date</small></span><br><br>
							<p>$msg_content</p>
						</div>
					</li>
				";
			}
		?>
	</ul>
	<?php
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
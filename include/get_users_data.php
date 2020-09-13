<?php 

$con = mysqli_connect("localhost", "root", "", "mychat");

session_start();

$user = "select * from users";
$run_user = mysqli_query($con, $user);

echo "<ul>";
while ($row_user = mysqli_fetch_array($run_user)) {
	
	if(strtolower($_SESSION['user_email']) != strtolower($row_user['user_email'])){
		
		$user_id = $row_user['user_id'];
		$user_name = $row_user['user_name'];
		$user_profile = $row_user['user_profile'];
		$login = $row_user['log_in'];

		echo "
			<li>
				<div class='chat-left-img'>
					<img src='$user_profile'>
				</div>
				<div class='chat-left-detail'>
					<p><a href='home.php?user_name=$user_name'>$user_name</a></p>";
			if($login=='Online'){
				echo"<span><i class='fa fa-circle' aria-hidden='true'></i> <style='color:black;'>Online</style></span>";
			}else{
				echo"<span><i class='fa fa-circle-o' aria-hidden='true'></i> <style='color:black;'>Offline</style></span>";
			}
		echo "
				</div>
			</li>
			";
		}
	}
echo "</ul>";
?>
<?php
	include "../db/db_connect.inc.php";

	session_start();
	if (!isset($_SESSION['username'])) {
		header("Location: ../login/login.php");
	}elseif($_SESSION['type'] != "superadmin"){
		if($_SESSION['type'] == "admin"){
			header("Location: ../adminpage/main.php");
		}elseif($_SESSION['type'] == "user"){
			header("Location: ../mainpage/main.php");
		}
	} else {
		$uname = $utype = $ufname = "";
		$uname = $_SESSION['username'];
		$sql = "SELECT * FROM login WHERE username='$uname'";
		$result = mysqli_query($conn, $sql);
	
		while ($row = mysqli_fetch_assoc($result)) {
			$utype = $row['type'];
			$ufname = $row['firstname'];
		}
		
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="common.css">
		<script src="https://kit.fontawesome.com/a076d05399.js"></script>
	</head>
	<body>
		<input type="checkbox" id="check">
		<label for="check">
		<i class="fas fa-bars" id="btn"></i>
		<i class="fas fa-times" id="cancel"></i>
		</label>
		<nav class="sidebar">
			<header>Ticket Booking System</header>
			<ul class="pop">
				<li><a href="#"><i class="fas fa-user-circle"></i>Profile<span class="sub_arrow"></span></a>
					<ul>
						<li><a href="../superadminpage/showprofile.php"><i class="fas fa-address-card"></i>Show Profile</a></li>
						<li><a href="../superadminpage/editprofile.php"><i class="fas fa-user-edit"></i>Edit Profile</a></li>
						<li><a href="../superadminpage/changepassword.php"><i class="fas fa-key"></i>Change Password</a></li>
						<li><a href="../superadminpage/addadmin.php"><i class="fas fa-user-plus"></i>Add Admin</a></li>
						<li><a href="../superadminpage/logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
					</ul>
				</li>
				<li><a href="../superadminpage/manageuser.php"><i class="fas fa-user-edit"></i>Manage User</a></li>
				<li><a href="../superadminpage/bus.php"><i class="fas fa-bus"></i>Bus</a></li>
				<li><a href="../superadminpage/train.php"><i class="fas fa-train"></i>Train</a></li>
				<li><a href="../superadminpage/launch.php"><i class="fas fa-ship"></i>Launch</a></li>

				<li><a href="#"><i class="fas fa-history"></i>History<span class="sub_arrow"></span></a>
					<ul>
						<li><a href="../superadminpage/bushistory.php"><i class="fas fa-bus"></i>Bus History</a></li>
						<li><a href="../superadminpage/trainhistory.php"><i class="fas fa-train"></i>Train History</a></li>
						<li><a href="../superadminpage/launchhistory.php"><i class="fas fa-ship"></i>Launch History</a></li>
					</ul>
				
				</li>
			</ul>
			<div class="social_media">
				<a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
				<a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
				<a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
			</div>
		</nav>
		<div class="unknown" class="boxp">
			<p>Hello, <?php echo strtoupper($uname); ?></p>
			<p>Username: <?php echo $uname; ?></p>
			<p>User Type: <?php echo $utype; ?></p>
		</div>
	</body>
</html>
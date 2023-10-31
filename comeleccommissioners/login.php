<?php
	session_start();
	include 'includes/conn.php';
	date_default_timezone_set("Asia/Singapore");

	if(isset($_POST['login'])){
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);

		$sql = "SELECT * FROM admin WHERE username = '$username'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'Cannot find account with the username';
		}
		else{
			$row = $query->fetch_assoc();
			if(password_verify($password, $row['password'])){
				$_SESSION['admin'] = $row['id'];
			}
			else{
				$_SESSION['error'] = 'Incorrect password';
			}
		}
	} else {
		$_SESSION['error'] = 'Input admin credentials first';
	}

	header('location: index.php');

?>
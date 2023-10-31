<?php
	session_start();
	include 'includes/conn.php';

	if (isset($_POST['login'])) {
		//Get time
		date_default_timezone_set("Asia/Singapore");
		$mainTime = date('H:i:s',strtotime("7:30 AM"));
		$maryTime = date('H:i:s',strtotime("8 AM"));
		$check = date('H:i:s');
		$getHour = date("H");

		$sql = $conn -> prepare("SELECT * FROM voters WHERE idnumber = ?");
		$sql -> bind_param('i', $idnumber);

		$idnumber = mysqli_real_escape_string($conn, $_POST['idnumber']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);

		$sql -> execute();
		$getSqlResult = $sql->get_result();

		$row = mysqli_fetch_assoc($getSqlResult);
		execLogin($getSqlResult, $row, $password);
	} else {
		$_SESSION['error'] = 'Input voter credentials first';
	}

	function execLogin($getSqlResult, $row, $password) {
		$countRows = mysqli_num_rows($getSqlResult);
		if ((password_verify($password, $row['password'])) && ($countRows>=1)) {
			$_SESSION['idnumber'] = $row['id'];
		} else {
			$_SESSION['error'] = 'Incorrect credentials! Please try again.';
		}
	}

	header('location: home.php');
?>
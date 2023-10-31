<?php
	include 'includes/conn.php';
	session_start();

	if(isset($_SESSION['idnumber'])){
		$query = $conn -> prepare("SELECT * FROM voters WHERE id = ? ");
		$query -> bind_param("s", $variable);
		$variable = $_SESSION['idnumber'];
		$query -> execute();
		$result = $query->get_result();
		$voter = mysqli_fetch_assoc($result);
	}
	else{
		header('location: index.php');
		exit();
	}

?>
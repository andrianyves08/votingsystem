<?php
	$conn = mysqli_connect('localhost', 'root', '', 'votesystem');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>
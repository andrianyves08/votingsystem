<?php
	$conn = new mysqli('localhost', 'root', 'mn7hsry123', 'votesystem');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>
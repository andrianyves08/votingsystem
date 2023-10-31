<?php
	
	include 'includes/session.php';
	include 'includes/slugify.php';

	$output = array('error'=>false,'list'=>'');

	$sql = $conn -> prepare("SELECT * FROM positions");
	$sql -> execute();
	$query = $sql->get_result();

	while($row = mysqli_fetch_assoc($query)){
		$position = slugify($row['description']);
		$pos_id = $row['id'];
		if(isset($_POST[$position])){
			$sql = $conn -> prepare("SELECT * FROM candidates WHERE id = ?");
			$sql -> bind_param("s", $candidate);
			$candidate = $_POST[$position];
			$sql -> execute();
			$csquery = $sql->get_result();

			$csrow = mysqli_fetch_assoc($csquery);
			$output['list'] .= "
			<div class='row votelist'>
	            <span class='col-sm-7'><span class='pull-left'><b>".$row['title']." :</b></span></span> 
	            <span class='col-sm-5'>".$csrow['firstname']." ".$csrow['lastname']."</span>
	        </div>";
		}
		$_SESSION['title'] = $row['title'];
	}

	echo json_encode($output);

				//	<div class='row votelist'>
                  //    	<span class='col-sm-7'><b>".$row['title']." :</b></span></span> 
                  //    	<span class='col-sm-5'>".$csrow['firstname']." ".$csrow['lastname']."</span>
                 //   </div>
?>


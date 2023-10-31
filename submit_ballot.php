<?php
	include 'includes/session.php';
	include 'includes/slugify.php';

	$stmt = $conn -> prepare("SELECT * FROM systemstatus where department= ? ");
    $stmt -> bind_param("s", $variable);
    $variable = "MAIN";
    $stmt -> execute();
    $result = $stmt->get_result();

    while ($row = mysqli_fetch_array($result)) {
        $status = $row['status'];
    }

    if($status == 'START'){
		if(isset($_POST['vote'])){
			//Get time
			date_default_timezone_set("Asia/Singapore");
			$mainTime = date('H:i:s',strtotime("8:00 PM"));
			$maryTime = date('H:i:s',strtotime("7 PM"));
			$check = date('H:i:s');

			//Get school where the voter belongs
			$sql = $conn -> prepare("SELECT * FROM voters WHERE idnumber = ?");
		    $sql -> bind_param("i", $idnumber);
		    $idnumber = $_SESSION['idnumber'];
		    $sql -> execute();
		    $result = $sql->get_result();
			$row = mysqli_fetch_assoc($result);
			
	
					executeVote($voter, $conn);
			
		} else {
			$_SESSION['error'][] = 'Select candidates to vote first';
		}
    } else if ($status == 'STOP') {
    	$_SESSION['error'][] ="green";
        header('location: end.php');
    } else {
        header('location: paused.php');
        session_destroy();
    }

function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function executeVote($voter, $conn) {
	if (count($_POST) == 1) {
		$_SESSION['error'][] = 'Please vote atleast one candidate';
	} else {

		$sql = $conn -> prepare("SELECT * FROM votes WHERE voters_id = ?");
		$sql -> bind_param("i", $variable);
		$variable = $voter['id'];
		$sql -> execute();
		$vquery = $sql->get_result();

        if(mysqli_num_rows($vquery) > 0){
         	$_SESSION['error'][] = 'Submission of vote denied. Our records show that you have already voted.';
        } else {

			$_SESSION['post'] = $_POST;

			$sql = $conn -> prepare("SELECT * FROM positions WHERE department = ? or department = ?");
			$sql -> bind_param("ss", $varDept, $varDeptSec);
			$varDept = 'Executive Committee';
			$varDeptSec = $voter['school'];
			$sql -> execute();
			$query = $sql->get_result();

			$error = false;
			$sql_array = array();
			while ($row = mysqli_fetch_assoc($query)) {
				$position = mysqli_real_escape_string($conn, slugify($row['description']));
				$pos_id = mysqli_real_escape_string($conn, $row['id']);
				if (isset($_POST[$position])) {
					$candidate = mysqli_real_escape_string($conn, $_POST[$position]);
					$voterId = mysqli_real_escape_string($conn, $voter['id']);
					$sql_array[] = "INSERT INTO votes (voters_id, candidate_id, position_id) VALUES ('$voterId', '$candidate', '$pos_id')";
				}
			}

			$result = $conn -> prepare("UPDATE voters set precinct= ?, timestamp= ? where id= ?");
			$result -> bind_param("isi", $ipadd, $timestamp, $varVoteId);
			$ipadd = getUserIpAddr();
			$timestamp = date('Y-m-d H:i:s');
			$varVoteId = $voter['id'];
			$result -> execute();

			if(!$error){
				foreach($sql_array as $sql_row){
					$conn->query($sql_row);
				}
				unset($_SESSION['post']);
				$_SESSION['success'] = 'Ballot Submitted';
			}
		}
	}
}

	header('location: home.php');

?>
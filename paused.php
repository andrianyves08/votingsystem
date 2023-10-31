<?php
    include 'includes/conn.php';

    session_start();

    $stmt = $conn -> prepare("SELECT * FROM systemstatus where department= ? ");
    $stmt -> bind_param("s", $variable);
    $variable = "MAIN";
    $stmt -> execute();
    $result = $stmt->get_result();
    
    while ($row = mysqli_fetch_array($result)) {
        $status = $row['status'];
    }

    if($status == 'START'){
            header('location: index.php');
    } else if ($status == 'STOP') {
          session_destroy();
          header('location: end.php');
    } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Voting System</title>
  <!-- Font Awesome -->
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">
</head>

<body>

<!--Main layout-->
<main class="animated fadeInDown delay-1s">
  <!--Grid container-->
  <div class="container">
    <!--Grid row-->
    <div class="row py-5">
      <div class="jumbotron card card-image">
  <div class="text-white text-center py-5 px-4">
    <div>
      <div class="alert alert-warning" role="alert"><h1>Sorry but the system is currently paused. If you're voting, Your vote is not recorded. Come back later.</h1></div>
    </div>
  </div>
</div>

      </div><!--Row--> 
  </div><!--Container-->
</main><!--/Main layout-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
</body>

</html>
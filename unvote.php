<!DOCTYPE html>
<html lang="en">
<?php 
include 'includes/conn.php'; 
session_start();
$result = mysqli_query($conn, "SELECT * FROM systemstatus where department='MAIN'");
while ($row = mysqli_fetch_array($result)) {
  $status = $row['status'];
}
if ($status == 'START') {
  header('location: index.php');
}
$_SESSION['error'][] = '123';
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Voting System</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
</head>
<body>

  <!--Main layout-->
  <main class="animated fadeInDown delay-1s">
    <!--Grid container-->
    <div class="container">
      <!--Grid row-->
      <div class="row py-5">
        <div class="jumbotron card card-image">
          <?php
          if(isset($_SESSION['error'])){
                  ?> 
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php
                        foreach($_SESSION['error'] as $error){
                          echo "
                            ".$error."
                          ";
                        }
                      ?>
                  </div>
                  <?php
                  unset($_SESSION['error']);

                }
          ?>
          <div class="text-white text-center py-5 px-4">
            <div>
              <div class="alert alert-danger" role="alert">
                <h1>Your vote is invalidated since the election has ended.</h1>
              </div>
            </div>
          </div>
        </div>
      </div><!--Row-->
    </div><!--Container-->
  </main><!--/Main layout-->
  <!-- SCRIPTS -->

  <!-- Charts to show results -->
  <!-- <?php
  $queryMaxPos = "select Max(id) as number from positions";
  $result = mysqli_query($conn, $queryMaxPos);
  $row = mysqli_fetch_assoc($result);
  $getNum = $row['number'];

  for ($i=1; $i < $getNum; $i++) { 
    
    $queryPres = $conn -> prepare("SELECT CONCAT(firstname, ' ',lastname) as name, title, COUNT(*) FROM votesystem.votes 
      JOIN candidates ON candidates.id=votes.candidate_id
      JOIN positions ON positions.id=votes.position_id
      where votes.position_id = (?) 
      group by candidate_id");
    $queryPres -> bind_param("i", $variable);
    $variable = $i;
    $queryPres -> execute();
    $result = $queryPres->get_result();

    $storePres = array();
    $storeVotes = array();
    while ($row = mysqli_fetch_assoc($result)) {
      array_push($storePres, $row['name']);
      array_push($storeVotes, $row['COUNT(*)']);
      echo "<div class='col-sm-6'>
      <div class='card'>
        <div class='card-body'>
          <canvas id='".$row['title']."'></canvas>
        </div>
      </div>
    </div>";
    }
    $convPres = json_encode($storePres);
    $convVotes = json_encode($storeVotes);
    ?>

    <script type="text/javascript">
      window.onload = function() {
      new Chart(document.getElementById("<?php echo $row['title']; ?>"), {
        "type": "horizontalBar",
        "data": {
          "labels": (<?php echo $convPres; ?>),
          "datasets": [{
            "label": "Votes",
            "data": (<?php echo $convVotes; ?>),
            "fill": false,
            "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)",
            "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)",
            "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"
            ],
            "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
            "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"
            ],
            "borderWidth": 1
          }]
        },
        "options": {
          "scales": {
            "xAxes": [{
              "ticks": {
                "beginAtZero": true
              }
            }]
          }
        }
      });
    }
    </script>
    <?php
  }
  ?> -->

  
  <!-- End of custom styles or whatever -->
</body>
</html>
<?php 
include 'includes/conn.php';
include 'includes/slugify.php';
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<?php
$result = mysqli_query($conn, "SELECT * FROM systemstatus where department='MAIN'");
while ($row = mysqli_fetch_array($result)) {
  $status = $row['status'];
}
if ($status == 'START') {
  header('location: index.php');
}
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
          
          <div class="text-white text-center py-5 px-4">
            <div>
              <div class="alert alert-danger" role="alert">
                <h1>The election has ended you can view the results below.</h1>
              </div>
            </div>
          </div>
        </div>
      </div><!--Row-->
    </div><!--Container-->
  </main><!--/Main layout-->
  <!-- SCRIPTS -->

</body>
</html>
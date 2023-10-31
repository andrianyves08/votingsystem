<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>

<body class="grey lighten-3">

  <?php 
  $current = "results";
  include 'includes/navbar.php'; ?>

  <!--Main layout-->
  <main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

      <!-- Heading -->
      <div class="card mb-4 wow fadeIn">

        <!--Card content-->
        <div class="card-body d-sm-flex justify-content-between">

          <h4 class="mb-2 mb-sm-0 pt-1">
            <a href="home.php">Home Page</a>
            <span>/</span>
            <span>Results</span>
            <span>/</span>
            <a href="results_2.php">Table Version</a>
          </h4>


        </div>

      </div>
      <!-- Heading -->

            <!-- Heading -->
      <div class="card mb-4 wow fadeIn">

        <!--Card content-->
        <div class="card-body d-sm-flex justify-content-between">

          <h4 class="mb-2 mb-sm-0 pt-1">
            <a href="execomm.php">ExeComm</a>
            <span>/</span>
            <a href="samcis.php">SAMCIS</a>
            <span>/</span>
            <a href="sea.php">SEA</a>
            <span>/</span>
            <a href="sns.php">SNS</a>
            <span>/</span>
            <a href="sol.php">SoL</a>
            <span>/</span>
            <a href="som.php">SoM</a>
            <span>/</span>
            <a href="son.php">SoN</a>
            <span>/</span>
            <a href="stela.php">STELA</a>
          </h4>


        </div>

      </div>
      <!-- Heading -->

      <?php
        $sql = "SELECT * FROM positions ORDER BY priority ASC";
        $query = mysqli_query($conn, $sql);
        $inc = 2;
        while($row = mysqli_fetch_assoc($query)){
          $inc = ($inc == 2) ? 1 : $inc+1; 
          if($inc == 1) echo "<div class='row'>";
          echo "<div class='col-md-6 mb-4'>
                    <div class='card'>
                    <h2 class='card-title text-center'>".$row['description']."</h2>
                      <div class='card-body'>
                        <canvas id='".slugify($row['description'])."'></canvas>
                      </div>
                    </div>
                  </div> ";
          if($inc == 2) echo "</div>";  
        }
        if($inc == 1) echo "<div class='col-sm-6'></div></div>";
      ?>


    </div>
  </main>
  <!--Main layout-->

<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>

  <!-- Charts -->
<?php
  $sql = "SELECT * FROM positions ORDER BY priority ASC";
  $query = mysqli_query($conn, $sql);
  while($row = $query->fetch_assoc()){
    $sql = "SELECT * FROM candidates WHERE position_id = '".$row['id']."'";
    $cquery = mysqli_query($conn, $sql);
    $carray = array();
    $varray = array();
    while($crow = mysqli_fetch_assoc($cquery)){
      array_push($carray, $crow['firstname']);
      $sql = "SELECT * FROM votes WHERE candidate_id = '".$crow['id']."'";
      $vquery = mysqli_query($conn, $sql);
      array_push($varray, $vquery->num_rows);
    }
    $carray = json_encode($carray);
    $varray = json_encode($varray);
    ?>
<script>
    // Line
    var ctx = document.getElementById('<?php echo slugify($row['description']); ?>').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?php echo $carray; ?>,
        datasets: [{
          label: '# of Votes',
          data: <?php echo $varray; ?>,
          backgroundColor: [
          ],
          borderColor: [

          ],
          borderWidth: 1
        }]
      },
    });
  </script>
    <?php
  }
?>
</body>

</html>

<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>

<body class="grey lighten-3">

  <?php 
  $current = "home";
  include 'includes/navbar.php'; ?>

  <!--Main layout-->
  <main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

      <!-- Heading -->
      <div class="card mb-4 wow fadeIn">

        <!--Card content-->
        <div class="card-body d-sm-flex justify-content-between">

          <h4 class="mb-2 mb-sm-0 pt-1">
            <a href="https://mdbootstrap.com/docs/jquery/" target="_blank">Home Page</a>
            <span>/</span>
            <span>Dashboard</span>
          </h4>


        </div>

      </div>
      <!-- Heading -->

      <!-- DASHBOARD -->
      <div class="row">
              <div class="col-lg-3 col-xs-6">
                <div class="inner">
                  <div class="card p-3 purple-gradient">
                    <div class="inner">
                      <?php
                        $sql = "SELECT * FROM positions";
                        $query = mysqli_query($conn, $sql);

                        echo "<h3><strong>".mysqli_num_rows($query)."</strong></h3>";
                      ?>
                      <p>No. of Positions</p>
                    </div>
                    <div class="card-footer">
                      <strong><a href="positions.php" class="small-box-footer white-text">More info </a></strong>
                    </div>
                    </div>
                </div>
              </div>
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="card p-3 blue-gradient">
                  <div class="inner">
                    <?php
                      $sql = "SELECT * FROM candidates";
                      $query = mysqli_query($conn, $sql);

                      echo "<h3><strong>".mysqli_num_rows($query)."</strong></h3>";
                    ?>
                    <p>No. of Candidates</p>
                  </div>
                  <div class="card-footer">
                    <strong><a href="candidates.php" class="small-box-footer white-text">More info </a></strong>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="card p-3 aqua-gradient">
                  <div class="inner">

                    <?php
                      $sql = "SELECT * FROM voters";
                      $query = mysqli_query($conn, $sql);

                      echo "<h3><strong>".mysqli_num_rows($query)."</strong></h3>";
                    ?>
                    <p>Total Voters</p>
                  </div>
                  <div class="card-footer">
                    <strong><a href="voters.php" class="small-box-footer white-text">More info </a></strong>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="card p-3 peach-gradient">
                  <div class="inner">
                    <?php
                      $sql = "SELECT * FROM votes GROUP BY voters_id";
                      $query = mysqli_query($conn, $sql);

                      $total = round((($query->num_rows / 19525) * 100), 2);
                      echo "<h3><strong>".$query->num_rows."</strong></h3>";

                    ?>
                    <p>Total Voted = <?php echo $total; ?>%</p>
                  </div>
                  <div class="card-footer">
                    <strong><a href="votes.php" class="small-box-footer white-text">More info </a></strong>
                  </div>
                </div>
              </div>
              <!-- ./col -->
      </div>
<br>
       <!-- DASHBOARD -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="inner">
            <div class="card p-3 yellow">
              <div class="inner">
                <?php
                  $sql = "SELECT * FROM votes join voters on votes.voters_id = voters.id where school='SAMCIS' GROUP BY voters_id";
                  $query = mysqli_query($conn, $sql);

                  $total = round((($query->num_rows / 19525) * 100), 2);
                  echo "<h3><strong>".mysqli_num_rows($query)."</strong></h3>";
                ?>
                <p>SAMCIS VOTED = <?php echo $total; ?>%</p>
              </div>
              <div class="card-footer">
                <strong><a class="small-box-footer">Total Voters: 3900 </a></strong>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="inner">
            <div class="card p-3 grey">
              <div class="inner">
                <?php
                  $sql = "SELECT * FROM votes join voters on votes.voters_id = voters.id where school='SAS' GROUP BY voters_id";
                  $query = mysqli_query($conn, $sql);

                  $total = round((($query->num_rows / 19525 ) * 100), 2);
                  echo "<h3><strong>".mysqli_num_rows($query)."</strong></h3>";
                ?>
                <p>SAS VOTED = <?php echo $total; ?>%</p>
              </div>
              <div class="card-footer">
                <strong><a class="small-box-footer">Total Voters: 1021 </a></strong>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="inner">
            <div class="card p-3 red darken-4">
              <div class="inner">
                <?php
                  $sql = "SELECT * FROM votes join voters on votes.voters_id = voters.id where school='SEA' GROUP BY voters_id";
                  $query = mysqli_query($conn, $sql);

                  $total = round((($query->num_rows / 19525 ) * 100), 2);
                  echo "<h3><strong>".mysqli_num_rows($query)."</strong></h3>";
                ?>
                <p>SEA VOTED = <?php echo $total; ?>%</p>
              </div>
              <div class="card-footer">
                <strong><a class="small-box-footer">Total Voters: 7193 </a></strong>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="inner">
            <div class="card p-3 green">
              <div class="inner">
                <?php
                  $sql = "SELECT * FROM votes join voters on votes.voters_id = voters.id where school='SNS' GROUP BY voters_id";
                  $query = mysqli_query($conn, $sql);

                  $total = round((($query->num_rows / 19525 ) * 100), 2);
                  echo "<h3><strong>".mysqli_num_rows($query)."</strong></h3>";
                ?>
                <p>SNS VOTED = <?php echo $total; ?>%</p>
              </div>
              <div class="card-footer">
                <strong><a class="small-box-footer">Total Voters: 3461 </a></strong>
              </div>
            </div>
          </div>
        </div>
             
      </div>

      <br>
       <!-- DASHBOARD -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="inner">
            <div class="card p-3 red">
              <div class="inner">
                <?php
                  $sql = "SELECT * FROM votes join voters on votes.voters_id = voters.id where school='SoL' GROUP BY voters_id";
                  $query = mysqli_query($conn, $sql);

                 $total = round((($query->num_rows / 19525 ) * 100), 2);
                  echo "<h3><strong>".mysqli_num_rows($query)."</strong></h3>";
                ?>
                <p>SoL VOTED = <?php echo $total; ?>%</p>
              </div>
              <div class="card-footer">
                <strong><a class="small-box-footer">Total Voters: 397 </a></strong>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="inner">
            <div class="card p-3">
              <div class="inner">
                <?php
                  $sql = "SELECT * FROM votes join voters on votes.voters_id = voters.id where school='SoM' GROUP BY voters_id";
                  $query = mysqli_query($conn, $sql);

                  $total = round((($query->num_rows / 19525 ) * 100), 2);
                  echo "<h3><strong>".mysqli_num_rows($query)."</strong></h3>";
                ?>
                <p>SoM VOTED = <?php echo $total; ?>%</p>
              </div>
              <div class="card-footer">
                <strong><a class="small-box-footer">Total Voters: 659 </a></strong>
              </div>
            </div>
          </div> 
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="inner">
            <div class="card p-3 pink">
              <div class="inner">
                <?php
                  $sql = "SELECT * FROM votes join voters on votes.voters_id = voters.id where school='SoN' GROUP BY voters_id";
                  $query = mysqli_query($conn, $sql);

                  $total = round((($query->num_rows / 19525 ) * 100), 2);
                  echo "<h3><strong>".mysqli_num_rows($query)."</strong></h3>";
                ?>
                <p>SoN VOTED = <?php echo $total; ?>%</p>
              </div>
              <div class="card-footer">
                <strong><a class="small-box-footer">Total Voters: 983 </a></strong>
              </div>
            </div>
          </div> 
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="inner">
            <div class="card p-3 blue">
              <div class="inner">
                <?php
                  $sql = "SELECT * FROM votes join voters on votes.voters_id = voters.id where school='STELA' GROUP BY voters_id";
                  $query = mysqli_query($conn, $sql);

                  $total = round((($query->num_rows / 19525 ) * 100), 2);
                  echo "<h3><strong>".mysqli_num_rows($query)."</strong></h3>";
                ?>
                <p>STELA VOTED = <?php echo $total; ?>%</p>
              </div>
              <div class="card-footer">
                <strong><a class="small-box-footer">Total Voters: 1911 </a></strong>
              </div>
            </div>
          </div>
        </div>
             
      </div>



    </div>
  </main>
  <!--Main layout-->

<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>


</body>

</html>

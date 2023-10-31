<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>

<body class="grey lighten-3">

  <?php 
  $current = "votes";
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
            <span>Votes</span>
          </h4>


        </div>

      </div>
      <!-- Heading -->

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <!--Card content-->
            <div class="card-body">

              <table id="dtBasicExample" class="table table-bordered" cellspacing="0" width="100%">
                <thead>
                  <th>Position</th>
                  <th>Candidate</th>
                  <th>Data ID</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, candidates.firstname AS canfirst, candidates.lastname AS canlast, voters.idnumber AS votfirst, voters.lastname AS votlast FROM votes LEFT JOIN positions ON positions.id=votes.position_id LEFT JOIN candidates ON candidates.id=votes.candidate_id LEFT JOIN voters ON voters.id=votes.voters_id ORDER BY positions.priority ASC";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                          <td>".$row['description']."</td>
                          <td>".$row['canfirst'].' '.$row['canlast']."</td>
                          <td>".$row['id']."</td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>


    </div><!--Container-->
  </main>
  <!--Main layout-->

<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>
</body>

</html>
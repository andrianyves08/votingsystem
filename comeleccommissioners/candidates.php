<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>

<body class="grey lighten-3">

  <?php 
  $current = "candidates";
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
            <span>Candidates</span>
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
                  <th>Photo</th>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Party</th>
                  <th>School</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, candidates.id AS canid FROM candidates LEFT JOIN positions ON positions.id=candidates.position_id ORDER BY positions.priority ASC";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $image = (!empty($row['photo'])) ? '../img/'.$row['photo'] : '../images/profile.jpg';
                      echo "
                        <tr>
                          <td>".$row['title']."</td>
                          <td>
                            <img src='".$image."' width='30px' height='30px'>
                            <a href='#edit_photo' data-toggle='modal' class='pull-right photo' data-id='".$row['canid']."'></a>
                          </td>
                          <td>".$row['firstname']."</td>
                          <td>".$row['lastname']."</td>
                          <td>".$row['party']."</td>
                          <td>".$row['school']."</td>
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
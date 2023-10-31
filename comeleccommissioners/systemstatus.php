<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>

<body class="grey lighten-3">

  <?php 
  $current = "systemstatus";
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
            <span>System Status</span>
          </h4>
        </div>
      </div>
      <!-- Heading -->
<?php
      if(isset($_POST['update'])){ 
         $department = $_POST['department'];
        $status = $_POST['status'];

        $result = mysqli_query($conn, "UPDATE systemstatus SET status='$status' where department='$department'");
      }
    ?>

      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"><strong>MAIN</strong></h4>
              <form method="POST" action="systemstatus.php" enctype="multipart/form-data">
                               <input class="form-check-input" type="hidden" name="department" id="department" value="MAIN" style="visibility: hidden;">
                    <select class="browser-default custom-select" name="status" id="status">
                      <option value="START">START</option>
                      <option value="PAUSE">PAUSE</option>
                      <option value="STOP">STOP</option>
                    </select>
                    <button class="btn btn-primary" name="update">Submit</button>
               </form>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"><strong>Status</strong></h4>
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Department</th>
                  <th>Status</th>
                </thead>
                <tbody>
                  <?php
                      $result1 = mysqli_query($conn, "SELECT * FROM `systemstatus` where department = 'MAIN'");
                      while ($row = mysqli_fetch_array($result1)) {
                      echo "
                        <tr>
                          <td>".$row['department']."</td>
                          <td>".$row['status']."</td>
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

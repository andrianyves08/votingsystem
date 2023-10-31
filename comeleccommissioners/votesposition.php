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

            <div class="row">
        <div class="col-md-12">
          <div class="card">
            <!--Card content-->
            <div class="card-body">
<h2 clas="text-center">Breakdown of Votes</h2>
<table class="table table-bordered table-hover" cellspacing="0" width="100%">
          <thead class="blue white-text">
            <tr>
              <th>Total Votes</th>
              <th>Position</th>
              <th>Department</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $result3 = mysqli_query($conn, "SELECT * FROM positions");
            while ($row = mysqli_fetch_array($result3)) { 
                $result4 = mysqli_query($conn, "SELECT count(votes.position_id) from positions join votes on positions.id = votes.position_id  where positions.id = '".$row['id']."'");
                while ($row1 = mysqli_fetch_array($result4)) { ?>
            <tr>
              <td><?php echo $row1[0]; ?></td>
              <td><?php echo $row['title'];?></td>
              <td><?php echo $row['department'];?></td>
            </tr>
    
            <?php   } } ?>
          </tbody>
        </table>
            </div>
          </div>
        </div>
      </div>



<button class="noprint btn btn-primary btn-rounded" onclick="myFunction()">Print this page</button>
    </div>
  </main>
  <!--Main layout-->

<script>
function myFunction() {
  window.print();
}
</script>
<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>

  <!-- Charts -->

</body>

</html>

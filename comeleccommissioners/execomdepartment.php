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
              <h2 clas="text-center">Executive Committee</h2>
<table class="table table-bordered table-hover" cellspacing="0" width="100%">
          <thead class="blue white-text">
            <tr>
              <th>Full Name</th>
              <th>Position</th>
              <th>SAMCIS</th>
              <th>SAS</th>
              <th>SEA</th>
              <th>SNS</th>
              <th>SoL</th>
              <th>SoM</th>
              <th>SoN</th>
              <th>STELA</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM positions join candidates on candidates.position_id = positions.id where department = 'Executive Committee'");
            while ($row = mysqli_fetch_array($result)) { 
                $result1 = mysqli_query($conn, "SELECT count(votes.voters_id) from candidates join votes on candidates.id = votes.candidate_id join voters on voters.id = votes.voters_id where candidates.id = '".$row['id']."' and voters.school = 'SAMCIS'");
                $row1 = mysqli_fetch_array($result1);

                $result2 = mysqli_query($conn, "SELECT count(votes.voters_id) from candidates join votes on candidates.id = votes.candidate_id join voters on voters.id = votes.voters_id where candidates.id = '".$row['id']."' and voters.school = 'SAS'");
                $row2 = mysqli_fetch_array($result2);

                $result3 = mysqli_query($conn, "SELECT count(votes.voters_id) from candidates join votes on candidates.id = votes.candidate_id join voters on voters.id = votes.voters_id where candidates.id = '".$row['id']."' and voters.school = 'SEA'");
                $row3 = mysqli_fetch_array($result3);

                $result4 = mysqli_query($conn, "SELECT count(votes.voters_id) from candidates join votes on candidates.id = votes.candidate_id join voters on voters.id = votes.voters_id where candidates.id = '".$row['id']."' and voters.school = 'SoL'");
                $row4 = mysqli_fetch_array($result4);

                $result5 = mysqli_query($conn, "SELECT count(votes.voters_id) from candidates join votes on candidates.id = votes.candidate_id join voters on voters.id = votes.voters_id where candidates.id = '".$row['id']."' and voters.school = 'SoM'");
                $row5 = mysqli_fetch_array($result5);

                $result6 = mysqli_query($conn, "SELECT count(votes.voters_id) from candidates join votes on candidates.id = votes.candidate_id join voters on voters.id = votes.voters_id where candidates.id = '".$row['id']."' and voters.school = 'SoN'");
                $row6 = mysqli_fetch_array($result6);

                $result7 = mysqli_query($conn, "SELECT count(votes.voters_id) from candidates join votes on candidates.id = votes.candidate_id join voters on voters.id = votes.voters_id where candidates.id = '".$row['id']."' and voters.school = 'STELA'");
                $row7 = mysqli_fetch_array($result7);

                $result8 = mysqli_query($conn, "SELECT count(votes.voters_id) from candidates join votes on candidates.id = votes.candidate_id join voters on voters.id = votes.voters_id where candidates.id = '".$row['id']."' and voters.school = 'SNS'");
                $row8 = mysqli_fetch_array($result8);

                ?>
            <tr>
              <td><?php echo $row['lastname'];?><?php echo ", ";echo $row['firstname'];?></td>
              <td><?php echo $row['title'];?></td>
              <td><?php echo $row1[0]; ?></td>
              <td><?php echo $row2[0]; ?></td>
              <td><?php echo $row3[0]; ?></td>
              <td><?php echo $row8[0]; ?></td>
              <td><?php echo $row4[0]; ?></td>
              <td><?php echo $row5[0]; ?></td>
              <td><?php echo $row6[0]; ?></td>
              <td><?php echo $row7[0]; ?></td>
            </tr>
    
            <?php   } ?>
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

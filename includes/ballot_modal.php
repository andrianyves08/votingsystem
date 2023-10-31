<!-- Preview -->
<div class="modal fade" id="preview_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-info" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <p class="heading lead">Vote Review</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body">
        <div class="text-center">
          <img src="comelec.jpg" class="center mb-3 animated rotateIn rounded-circle" style="width: 150px; height: 150px;"> </div>
          <div id="preview_body"></div>
       
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
        <a type="button" class="btn btn-primary" data-dismiss="modal">Close</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>

<!-- View Ballot -->
<div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-info" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <p class="heading lead">Your Votes</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body">
        <div class="text-center">
          <img src="comelec.jpg" class="center mb-3 animated rotateIn rounded-circle" style="width: 150px; height: 150px;"> </div>
          <p>
            <?php

            $sql = $conn -> prepare("SELECT *, candidates.firstname AS canfirst, candidates.lastname AS canlast FROM votes LEFT JOIN candidates ON candidates.id=votes.candidate_id LEFT JOIN positions ON positions.id=votes.position_id WHERE voters_id = ?  ORDER BY positions.priority ASC");
            $sql -> bind_param("i", $id);
            $id = $voter['id'];
            $sql -> execute();
            $result = $sql->get_result();

              while($row = mysqli_fetch_assoc($result)){
                echo "
                    <div class='row votelist'>
                      <span class='col-sm-7'><b>".$row['title']." :</b></span> 
                      <span class='col-sm-5'>".$row['canfirst']." ".$row['canlast']."</span>
                    </div>
                  ";
              }
            ?>
          </p>
       
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
        <a type="button" class="btn btn-primary" data-dismiss="modal">Close</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!-- Central Modal Medium Info-->
<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body aria-busy="true">
  <?php include 'includes/navbar.php'; ?>

<?php
$stmt = $conn -> prepare("SELECT * FROM systemstatus where department=?");
$stmt -> bind_param("s", $variable);
$variable = "MAIN";
$stmt -> execute();
$result = $stmt->get_result();

    while ($row = mysqli_fetch_assoc($result)) {
        $status = $row['status'];
    }

    if($status == 'STOP'){
      session_destroy();
      header('location: end.php');
    } elseif ($status == 'PAUSE'){
      header('location: paused.php');
    }
?>

<?php
function getToken(){
    $user_session = $_SESSION['idnumber'];
    $ip = null;
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return md5($ip. ":" . $user_session);
}

if(empty($_SESSION['tokenHeader'])){
  $_SESSION['tokenHeader'] = getToken();
} else {
    if($_SESSION['tokenHeader'] != getToken()) {
        header('location: logout.php');
        die("Access Denied!");
        
    }
}

?>
<!--Main layout-->
  <main class="mt-5 pt-5 animated fadeInDown delay-1s">
<!--Grid container-->
  <div class="container">

    <div class="row">
      <div class="col-md-12 text-center animated fadeInUp delay-1s">
        <h2>KASAMA/SSC ELECTION</h2>

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
                if(isset($_SESSION['success'])){
                    echo "
                      <div class='alert alert-success alert-dismissible'>
                          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                          <h4><i class='icon fa fa-check'></i> Success!</h4>
                        ".$_SESSION['success']."
                      </div>
                    ";
                    unset($_SESSION['success']);
                }

            ?>

            <div class='alert alert-danger' id="alert" style="display:none;">
              <span class="message"></span>
            </div>
      </div>
    </div>



      
            <?php
              $checkVoterStmt = $conn -> prepare("SELECT * FROM votes WHERE voters_id = ?");
              $checkVoterStmt -> bind_param("i", $varVote);
              $varVote = $voter['id'];
              $checkVoterStmt -> execute();
              $vquery = $checkVoterStmt->get_result();

              if(mysqli_num_rows($vquery) > 0){
                ?>
                    <div class="row">
                <div class="col-md-12 lg-12 animated bounceInUp delay-1s">
                <div class="text-center">
                  <h3>You have submitted your vote.</h3>
                  <a href="#view" data-toggle="modal" class="btn btn-flat btn-primary btn-lg">View Ballot</a>
                </div>
              </div>
                </div>
                <?php
              }
              else{
                ?>

                <!-- Voting Ballot -->
                <form method="POST" id="viewBallotForm" action="submit_ballot.php">
                    <?php
                      include 'includes/slugify.php';

  // define the path and name of cached file
  $cachefile = 'cached/'.$voter['school'].','.$voter['year'].'.php';
  // Check if the cached file is still fresh. If it is, serve it up and exit.
  if (file_exists($cachefile)) {
    include($cachefile);
      exit;
  }
  // if there is either no file OR the file to too old, render the page and capture the HTML.
  ob_start();

                      $candidate = '';
                      $viewBallotStmt = $conn -> prepare("SELECT * FROM positions join yearlevel on positions.id = yearlevel.position_id WHERE department = ? or department = ? and year in (?, 0) group by positions.id ORDER BY priority ASC");

                      $viewBallotStmt -> bind_param("ssi", $varDept, $getSchool, $getYear);
                      $varDept = 'Executive Committee';
                      $getSchool = $voter['school'];
                      $getYear = $voter['year'];

                      $viewBallotStmt -> execute();
                      $getBallotResult = $viewBallotStmt->get_result();

                  while($row = mysqli_fetch_array($getBallotResult, MYSQLI_ASSOC)){

                    $sql = $conn -> prepare("SELECT * FROM candidates WHERE position_id= ?");
                    $sql -> bind_param('i', $setPos);
                    $setPos = $row['id'];
                    $sql -> execute();
                    $getSqlResult = $sql->get_result();

                    while($crow = mysqli_fetch_array($getSqlResult, MYSQLI_ASSOC)){
                      $slug = slugify($row['description']);
                      $checked = '';
                      if(isset($_SESSION['post'][$slug])){
                        $value = $_SESSION['post'][$slug];

                        if(is_array($value)){
                          foreach($value as $val){
                            if($val == $crow['id']){
                              $checked = 'checked';
                            }
                          }
                        }
                        else{
                          if($value == $crow['id']){
                            $checked = 'checked';
                          }
                        }
                      }

                      if ($crow['party'] == 'DASIG'){
                            $color = 'red';
                      }else if($crow['party'] == 'REPORMA-ACS'){
                            $color = 'yellow';
                      } else if($crow['party'] == 'RIGHTS'){
                            $color = 'blue';
                      } else {
                        $color = 'grey';
                      }

                      if ($crow['party'] == 'DASIG' || $crow['party'] == 'Independent') {
                          $align = 'start';
                      } else if($crow['party'] == 'REPORMA-ACS' ) {
                          $number=mysqli_num_rows($getSqlResult);
                          if ($number == 1) {
                            $align = 'center';
                           } else {
                            $align = 'start';
                           }
                      } else {
                        $align = 'end';
                      }
                      
                      $input = '<div><input type="radio" id="'.$crow['id'].'" class="'.$slug.' radioButton" name="'.slugify($row['description']).'" value="'.$crow['id'].'" '.$checked.'><label for="'.$crow['id'].'"><h4 class="card-title"><strong>Vote</strong></h4></label></div> ';
                      
                      $image = (!empty($crow['photo'])) ? 'img/'.$crow['photo'] : 'img/profile.jpg';
                      
                      $candidate .= '
                    <div class="col-md-4 text-center">
                      <label class="voteMe material-tooltip-main" data-toggle="tooltip"
                      data-placement="left" title="Click me to vote">
                          <div class="row" style="height: 160px;">
                            <div class="col-5">
                              <img class="img-fluid img-thumbnail" src="'.$image.'">
                            </div>

                            <div class="col-7">
                              <h4 class="text-left"><strong>'.$crow['firstname'].' '.$crow['lastname'].'</strong></h4>
                              <h5 class="text-left font-weight-bold grey-text">"'.strtoupper($crow['nickname']).'"</h5>
                              <h5 class="text-left h5 font-weight-bold '.$color.'-text py-2">'.$crow['party'].'</h5>
                              
                            </div>
                          </div>
                          '.$input.'
                      </label>
                    </div>';


                    }
                    
                    echo "<hr style='height:1px;border:none;color:#333;background-color:#333;'>";
                    echo '<br>
                      <h3 class="text-center"><b>'.$row['title'].'</b></h3>
                      <div class="row justify-content-'.$align.'">
                        '.$candidate.'
                      </div><br>
                    ';
                    $candidate = '';
                  }
                    ?>
                    <div class="text-center"> 
                      <button type="button" class="btn btn-success btn-flat" data-toggle="modal" id="preview"><i class="fa fa-file-text"></i> Preview</button> 
                      <button type="submit" class="btn btn-primary btn-flat" data-toggle="modal" id="submit" name="vote"><i class="fa fa-check-square-o"></i> Submit</button>
                    </div>
                  <!-- End Voting Ballot -->
                <?php
              }

            ?>

  </div><!--Container-->
</main>
<!--/Main layout-->

<!-- Are you sure -->
<div class="modal fade" id="submit_vote" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-info" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <p class="heading lead">Are you sure to submit vote?</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body">
        <div class="text-center">
          <img src="comelec.jpg" class="center mb-3 animated rotateIn rounded-circle" style="width: 150px; height: 150px;"> </div>
          <div id="final_body"></div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
        <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">No</a>
        <button type="submit" class="btn btn-primary waves-effect" name="vote"><i class="fa fa-check-square-o"></i>Yes</button>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<?php include 'includes/ballot_modal.php'; ?>
<?php include 'includes/footer.php'; ?>
<script type="text/javascript">
// Tooltips Initialization
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})</script>
<script type="text/javascript">
  var timeleft = 900; // 15 mins of active time
  var downloadTimer = setInterval(function(){
      timeleft -= 1; //countdown
      if (timeleft <= 0) {
        clearInterval(downloadTimer);
      window.location.replace("logout.php"); // login page
      }
  }, 1000);
</script>
<?php include 'includes/scripts.php'; ?>
<script>
(function($) {
  $.fn.uncheckableRadio = function() {
    var $root = this;
    $root.each(function() {
      var $radio = $(this);
      if ($radio.prop('checked')) {
        $radio.data('checked', true);
      } else {
        $radio.data('checked', false);
      }
      $radio.click(function() {
        var $this = $(this);
        if ($this.data('checked')) {
          $this.prop('checked', false);
          $this.data('checked', false);
          $this.trigger('change');
        } else {
          $this.data('checked', true);
          $this.closest('form').find('[name="' + $this.prop('name') + '"]').not($this).data('checked', false);
        }
      });
    });
    return $root;
  };
}(jQuery));
$('[type=radio]').uncheckableRadio();
$('button').click(function() {
  $('[value=V2]').prop('checked', true).trigger('change').trigger('click');
});

$(function(){
  $(document).on('click', '.reset', function(e){
    e.preventDefault();
    var desc = $(this).data('desc');
    $('.'+desc).iCheck('uncheck');
  });

  //Preview
  $('#preview').click(function(e){
    e.preventDefault();
    var form = $('#viewBallotForm').serialize();
      $.ajax({
        type: 'POST',
        url: 'preview.php',
        data: form,
        dataType: 'json',
        success: function(response){
          if(response.error){
            var errmsg = '';
            var messages = response.message;
            for (i in messages) {
              errmsg += messages[i]; 
            }
            $('.message').html(errmsg);
            $('#alert').show();
          }
          else{
            $('#preview_modal').modal('show');
            $('#preview_body').html(response.list);
          }
        }
      });
    
  });

  //Are you sure
  $('#submit').click(function(e){
    e.preventDefault();
    var form = $('#viewBallotForm').serialize();
      $.ajax({
        type: 'POST',
        url: 'preview.php',
        data: form,
        dataType: 'json',
        success: function(response){
          if(response.error){
            var errmsg = '';
            var messages = response.message;
            for (i in messages) {
              errmsg += messages[i]; 
            }
            $('.message').html(errmsg);
            $('#alert').show();
          }
          else{
            $('#submit_vote').modal('show');
            $('#final_body').html(response.list);
          }
        }
      });
    
  });
});
</script>


<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
  // We're done! Save the cached content to a file
  $fp = fopen($cachefile, 'w');
  fwrite($fp, ob_get_contents());
  fclose($fp);
  // finally send browser output
  ob_end_flush();

?>
</form>

</body>
</html>
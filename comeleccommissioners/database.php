<!DOCTYPE html>
<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="grey lighten-3">
	<?php
  $current = "database";
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
		            <span>Database</span>
		          </h4>
		        </div>
	      	</div>
	    </div>
	    <?php
	    if(isset($_SESSION['importStatus'])){
        	?>
          	<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php
                echo $_SESSION['importStatus'];
                ?>
            </div>
            <?php
            unset($_SESSION['importStatus']);
        }
        ?>

        <div class="container-fluid mt-5">
        <!-- Heading -->
          <div class="card mb-4 wow fadeIn">
            <!--Card content-->
            <div class="card card-header">
              <h2>Import database</h2>
            </div>
            <div class="card-body d-sm-flex justify-content-between">
              <form action="upload.php" method="post" enctype="multipart/form-data">
                Select SQL file to import:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Import" class="btn btn-primary btn-rounded" name="submit">
            </div>
          </div>
          <!-- <input type="button" class="btn btn-primary btn-rounded" name="truncateDB" id="truncateDB" value="Truncate database"> -->
          </form>
      </div>
      
  </main>
<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>
</body>

</html>
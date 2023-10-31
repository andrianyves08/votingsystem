<?php
    session_start();
    if(isset($_SESSION['admin'])){
      header('location:home.php');
    }
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition login-page">

<main class="animated fadeInDown delay-1s">
<!--Grid container-->
<div class="container">
<!--Grid row-->
<div class="row py-5">


<!-- Default form login -->
<form class="text-center border border-light p-5" action="login.php" method="POST">
  <div class="card-title">
      <b>Voting System</b>
    </div>

    <p class="h4 mb-4">Sign in</p>

    <!-- Email -->
    <input type="text" id="username" name="username" class="form-control mb-4" placeholder="Username" required>

    <!-- Password -->
    <input type="password" id="password" name="password" class="form-control mb-4" placeholder="Password" required>
      <div class="d-flex justify-content-around">
   
   
    <!-- Sign in button -->
    <button class="btn btn-info btn-block my-4" name="login" id="login">Sign in</button> 
</div>
    <?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='alert alert-danger alert-dismissible'>
            ".$_SESSION['error']." 
          </div>
        ";
        unset($_SESSION['error']);
      }
    ?>

</form>
<!-- Default form login -->



</div><!--Row--> 
</div><!--Container-->
</main><!--/Main layout-->

<?php include 'includes/scripts.php' ?>
</body>
</html>
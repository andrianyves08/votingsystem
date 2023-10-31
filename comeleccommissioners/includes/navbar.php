<header>
  <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
      <div class="container-fluid">

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Left -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link waves-effect" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link waves-effect" href="https://mdbootstrap.com/docs/jquery/" target="_blank">About
                MDB</a>
            </li>
            <li class="nav-item">
              <a class="nav-link waves-effect" href="https://mdbootstrap.com/docs/jquery/getting-started/download/"
                target="_blank">Free</a>
            </li>
          </ul>

          <!-- Right -->
          <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item">
              <a href="logout.php">
                <i class="fas fa-sign-out-alt"></i><span class="clearfix d-none d-sm-inline-block">Sign-out</span>
              </a>
            </li>
          </ul>

        </div>

      </div>
    </nav>
    <!-- Navbar -->

    <!-- Sidebar -->
    <div class="sidebar-fixed position-fixed">

      <!-- Logo -->
        <div class="text-center">
            <img src="images/avatar.jpg" style="height:100px;width:100px" alt="">
        </div>

      <div class="list-group list-group-flush">
          <strong class="mt-2 mb-2">REPORTS</strong>
          <a href="home.php" class="list-group-item list-group-item-action waves-effect <?php if($current == 'home') {echo 'active';} ?>">
            Dashboard</a>
          <a href="results.php" class="list-group-item list-group-item-action waves-effect <?php if($current == 'results') {echo 'active';} ?>">
           </i>Results</a>
          <a href="votes.php" class="list-group-item list-group-item-action waves-effect <?php if($current == 'votes') {echo 'active';} ?>">
           </i>Votes</a>
          <strong class="mt-2 mb-2">MANAGE</strong>
          <a href="voters.php" class="list-group-item list-group-item-action waves-effect <?php if($current == 'voters') {echo 'active';} ?>">
            Voters</a>
          <a href="candidates.php" class="list-group-item list-group-item-action waves-effect <?php if($current == 'candidates') {echo 'active';} ?>">
            Candidates</a>
          <a href="systemstatus.php" class="list-group-item list-group-item-action waves-effect <?php if($current == 'systemstatus') {echo 'active';} ?>">
            System Status</a>
          <a href="database.php" class="list-group-item list-group-item-action waves-effect <?php if($current == 'database') {echo 'active';} ?>">
            Database</a>
        </div>
      </div>

    </div>
    <!-- Sidebar -->

  </header>
  <!--Main Navigation-->
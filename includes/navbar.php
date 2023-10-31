<header>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
      <div class="container">

        <!-- Brand -->
        <a class="navbar-brand waves-effect" target="_blank">
          <strong class="blue-text">Saint Louis University</strong>
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Left -->
          <ul class="navbar-nav mr-auto">
            
          </ul>

          <!-- Right -->
          <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light"><i class="fa fa-graduation-cap" aria-hidden="true"></i> <span class="clearfix d-none d-sm-inline-block"><?php echo $voter['courseandyear'];?></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light"><i class="fa fa-user" aria-hidden="true"></i> <span class="clearfix d-none d-sm-inline-block"><?php echo $voter['firstname']. ' '.$voter['lastname']; ?></span></a>
            </li>
            <li class="nav-item">
                        <a class="nav-link waves-effect waves-light" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> <span class="clearfix d-none d-sm-inline-block">Sign Out</span></a>
                    </li>
          </ul>

        </div>

      </div>
    </nav>
    <!-- Navbar -->

  </header>
  <!--Main Navigation-->
<nav role="navigation">
    <div class="nav-wrapper"><a id="logo-container" href="index.php" class="brand-logo">&nbsp&nbspTravelSphere</a>
      <ul class="right hide-on-med-and-down">
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="offers.php"> Offers </a></li>
            <li><a href="index.php#faq"> FAQ’s </a></li>

            <?php if (! isset($_SESSION['privileges']) || $_SESSION['privileges'] == 0) 
            {
                echo <<< a
                <li><a href="query.php"> Contact Us </a></li>
                a;
            } ?>

            <?php if (isset($_SESSION['privileges']) && $_SESSION['privileges'] == 1) 
            {
              echo <<< a
              <li><a href="dummy.php">manage package</a></li>
              <li><a href="dummy.php">Manage hotels</a></li>
              <li><a href="messages.php">See messages</a></li>
              <li><a href="manageusers.php">Registered users</a></li>
              a;
            } ?>
            
            <?php if (isset($_SESSION['privileges'])) 
            {
              echo <<< a
              <li><a class="waves-effect waves-light btn" href="logout.php">Logout </a></li>
              a;
            } 
            else if (! isset($_SESSION['loggedin'])) 
            {
                echo <<< a
                <li><a class="waves-effect waves-light btn" href="login.php">Log in</a></li>
                a;
            } 
            ?>
      </ul>

      <ul id="nav-mobile" class="sidenav">

            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="offers.php"> Offers </a></li>
            <li><a href="index.php#faq"> FAQ’s </a></li>

            <?php if (! isset($_SESSION['privileges']) || $_SESSION['privileges'] == 0) {
                echo <<< a
                <li><a href="query.php"> Contact Us </a></li>
                a;
            } ?>

            <?php if (isset($_SESSION['privileges']) && $_SESSION['privileges'] == 1) {
              echo <<< a
              <li><a href="managepackage.php">manage package</a></li>
              <li><a href="managehotels.php">Manage hotels</a></li>
              <li><a href="messages.php">See messages</a></li>
              <li><a href="managesusers.php">Registered users</a></li>
              a;
            } ?>
            
            <?php if (isset($_SESSION['privileges'])) 
            {
                echo <<< a
                <li><a class="waves-effect waves-light btn" href="logout.php">Logout </a></li>
                a;
            } else if (! isset($_SESSION['loggedin'])) {
                echo <<< a
                <li><a class="waves-effect waves-light btn" href="login.php">Log in</a></li>
                a;
            } 
            ?>
      </ul>
      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
  </nav>
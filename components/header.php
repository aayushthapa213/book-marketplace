<?php
session_start();
$authenticated = false;
if (isset($_SESSION["email"])) {
  $authenticated = true;
}
?>

<header>
  <nav>
    <!-- Left: Main Logo -->
    <div class="logo">
      <a href="#">BookSell</a>
    </div>

    <!-- Middle: Navigation Menu -->
    <ul class="nav-menu">
      <li><a href="index.php">Home</a></li>
      <li><a href="../about.php">About</a></li>
      <li><a href="../shop.php">Shop</a></li>
      <li><a href="#">Categories</a></li>
      <li><a href="#">Cart</a></li>
    </ul>

    <!-- Right: Login Icon -->
    <div class="login-icon">
      <?php if ($authenticated) { ?>
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?= $_SESSION["first_name"] ?>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/booksell/profile.php">Profile</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="/booksell/logout.php">Log Out</a></li>
            </ul>
          </li>
        </ul>
      <?php } else { ?>
        <div class="log_in">
          <a href="/bookSell/register.php">
            <img src="/bookSell/images/icons/he.png" alt="Login">
          </a>
        </div>
      <?php } ?>
    </div>
  </nav>
</header>
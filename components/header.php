<?php
include('dashbase.php');
session_start();
$authenticated = false;
if (isset($_SESSION["email"])) {
  $authenticated = true;
};
if ($authenticated) {
  $user_id = $_SESSION['id'];
}
?>

<header>
  <nav>
    <div class="logo">
      <a href="index.php">BookSell</a>
    </div>

    <ul class="nav-menu">
      <li><a href="index.php">Home</a></li>
      <li><a href="../booksell/about.php">About</a></li>
      <li><a href="../booksell/shop.php">Shop</a></li>
      <li><a href="../booksell/category.php">Categories</a></li>

      <li><a href="../booksell/cart.php">Cart
          <?php
          if ($authenticated) {
            $select_rows = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'");
            $row_count = mysqli_num_rows($select_rows); ?> <span><?= $row_count ?></span>
          <?php } ?>
        </a></li>
    </ul>

    <div class="login-icon">
      <?php if ($authenticated) { ?>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Hi! <?= $_SESSION["first_name"] ?>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/booksell/dashboard.php">Dashboard</a></li>

              <li><a class="dropdown-item" href="/booksell/logout.php">Log Out</a></li>
            </ul>
          </li>
        </ul>
      <?php } else { ?>
        <div class="log_in">
          <a href="/bookSell/login.php">
            <i class="fa-solid fa-user"></i>
          </a>
        </div>
      <?php } ?>
    </div>
  </nav>
</header>
<?php

// session_start();
$authenticated = false;
if (isset($_SESSION["email"])) {
  $authenticated = true;
}

?>

<footer>
  <div class="footer-container">
    <!-- Upper Box -->
    <div class="footer-box">
      <!-- Box 1 -->
      <div class="footer-box-item">
        <h2>Book Sell</h2>
        <p>Your favorite place to buy and sell books</p>
      </div>
      <!-- Box 2 -->
      <div class="footer-box-item">
        <h3>Navigation</h3>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="shop.php">Shop</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
      <!-- Box 3 -->
      <div class="footer-box-item">
        <h3>Categories</h3>
        <ul>
          <li><a href="category_page.php?category=Fiction">Fiction</a></li>
          <li><a href="category_page.php?category=Non-Fiction">Non-Fiction</a></li>
          <li><a href="category_page.php?category=Science">Science</a></li>
          <li><a href="category_page.php?category=History">History</a></li>
        </ul>
      </div>
      <!-- Box 4 -->
      <div class="footer-box-item">
        <h3>Follow Us</h3>
        <div class="social-icons">
          <a href="#" class="social-icon">
            <i class="fa-brands fa-facebook"></i>
          </a>
          <a href="#" class="social-icon">
            <i class="fa-brands fa-instagram"></i> </a>
          <a href="#" class="social-icon">
            <i class="fa-brands fa-twitter"></i> </a>
          <a href="#" class="social-icon">
            <i class="fa-brands fa-youtube"></i> </a>
        </div>
        <?php
        if ($authenticated) {
        ?><a href="dashboard.php">
            <button class="sell-books-btn">Sell Books</button>
          </a>
        <?php } ?>
      </div>
    </div>
    <!-- Bottom Box -->
    <div class="footer-bottom">
      <p>&copy; 2024 All rights reserved by Book Sell</p>
    </div>
  </div>
</footer>
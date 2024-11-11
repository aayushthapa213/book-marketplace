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
          <li><a href="#">Home</a></li>
          <li><a href="#">Shop</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
      <!-- Box 3 -->
      <div class="footer-box-item">
        <h3>Categories</h3>
        <ul>
          <li><a href="#">Fiction</a></li>
          <li><a href="#">Non-Fiction</a></li>
          <li><a href="#">Science</a></li>
          <li><a href="#">History</a></li>
        </ul>
      </div>
      <!-- Box 4 -->
      <div class="footer-box-item">
        <h3>Follow Us</h3>
        <div class="social-icons">
          <a href="#" class="social-icon">
            <img src="images/facebook.png" alt="" />
          </a>
          <a href="#" class="social-icon">
            <img src="images/instagram.png" alt="" />
          </a>
          <a href="#" class="social-icon">
            <img src="images/twitter.png" alt="" />
          </a>
          <a href="#" class="social-icon">
            <img src="images/twitch.png" alt="" />
          </a>
        </div>
        <?php
        if ($authenticated) {
        ?>
          <button class="sell-books-btn">Sell Books</button>
        <?php } ?>
      </div>
    </div>
    <!-- Bottom Box -->
    <div class="footer-bottom">
      <p>&copy; 2024 All rights reserved by Book Sell</p>
    </div>
  </div>
</footer>
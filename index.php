<?php
include('./components/header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/header.css" />
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="./css/footer.css" />
  <title>BuySellBooks</title>
</head>

<body>
  <!-- Hero Section -->
  <section class="hero-section">
    <div class="home_img">
      <img src="images/books/Design.jpeg" alt="Hero Image">
      <div class="div_container">
        <div class="div_1">
          <p>Discover, Buy, and Sell Your Favorite Books</p>
        </div>
        <div class="div_2">
          <p>Connecting readers and sellers in Nepal and beyond.</p>
        </div>
        <div class="div_3">
          <input type="text" placeholder="Search for books...">
        </div>
      </div>
    </div>
  </section>

  <!-- Best Seller Section -->
  <section class="best-seller">
    <h2>Best Seller</h2>
    <div class="card-container">
      <a href="">
        <div class="card">
          <img src="images/karnali_blues.jpg" alt="Book 1">
          <h3>Karnali Blues</h3>
          <p>$19.99</p>
        </div>
      </a>
      <a href="">
        <div class="card">
          <img src="images/palpasa_cafe.jpg" alt="Book 2">
          <h3>Palpasa Cafe</h3>
          <p>$14.99</p>
        </div>
      </a>
      <a href="">
        <div class="card">
          <img src="images/seto_dharti.jpg" alt="Book 3">
          <h3>Seto Dharti</h3>
          <p>$24.99</p>
        </div>
      </a>
      <a href="">
        <div class="card">
          <img src="images/radha.jpg" alt="Book 4">
          <h3>Radha</h3>
          <p>$9.99</p>
        </div>
      </a>
    </div>
  </section>

  <!-- Video Hero Section -->
  <section class="video-hero-section">
    <div class="video-container">
      <video autoplay muted loop>
        <source src="images/vid.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video>
      <div class="video-overlay">
        <div class="text-content">
          <h2>About Us</h2>
          <p>We are dedicated to connecting readers and book lovers with quality books, making it easier to buy and sell new and used books. Explore our vast collection and support the local book community.</p>
          <a href="#" class="visit-shop-btn">Visit Shop</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Featured section -->

  <section class="featured-section">
    <h2>Featured Books</h2>
    <div class="carousel-container">
      <!-- Left Arrow -->
      <button class="carousel-btn left-btn">❮</button>

      <!-- Carousel Items -->
      <div class="carousel-wrapper">
        <div class="carousel-item"><a href="#">
            <img src="images/Shirish_ko_Phool.jpg" alt="Book 1">
            <h3>Shirish ko Phool</h3>
            <p>$19.99</p>
          </a></div>
        <div class="carousel-item"><a href="#">
            <img src="images/Sumnima.jpg" alt="Book 2">
            <h3>Sumnima</h3>
            <p>$14.99</p>
          </a></div>
        <div class="carousel-item"><a href="#">
            <img src="images/pagal_basti.jpg" alt="Book 3">
            <h3>Pagal Basti</h3>
            <p>$24.99</p>
          </a></div>
        <div class="carousel-item"><a href="#">
            <img src="images/Muna_Madan.jpg" alt="Book 4">
            <h3>Muna Madan</h3>
            <p>$9.99</p>
          </a></div>
        <div class="carousel-item"><a href="#">
            <img src="images/Damini_bhir.jpg" alt="Book 5">
            <h3>Damini Bhir</h3>
            <p>$12.99</p>
          </a></div>
        <div class="carousel-item"><a href="#">
            <img src="images/Jiwan_Kada_Ki_Phool.jpg" alt="Book 6">
            <h3>Jiwan Kada Ki Phool</h3>
            <p>$12.99</p>
          </a></div>
      </div>

      <!-- Right Arrow -->
      <button class="carousel-btn right-btn">❯</button>
    </div>
  </section>



  <!-- Category Section -->
  <section class="category-section">
    <h2>Categories</h2>
    <div class="category-container">
      <div class="category">
        <img src="images/fiction.jpg" alt="Category 1">
        <h3>Fiction</h3>
      </div>
      <div class="category">
        <img src="images/non-fiction.jpg" alt="Category 2">
        <h3>Non-Fiction</h3>
      </div>
      <div class="category">
        <img src="images/educational.jpg" alt="Category 3">
        <h3>Educational</h3>
      </div>
      <div class="category">
        <img src="images/children.jpg" alt="Category 4">
        <h3>Children</h3>
      </div>
    </div>
  </section>
  <script src="./js/custom.js"></script>

</body>

</html>


<?php
include('./components/footer.php');
?>
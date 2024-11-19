<?php
include('./components/header.php');
include('dashbase.php');

if (isset($_POST['add_to_cart'])) {
  if ($authenticated) {
    $user_id = $_SESSION['id'];
    $book_id = $_POST['product_id'];
    $book_price = $_POST["product_price"];
    $book_name = $_POST["product_name"];
    $book_image = $_POST["product_image"];
    $book_quantity = 1;

    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$book_name' AND user_id = '$user_id'");

    if (mysqli_num_rows($select_cart) > 0) {
      $message[] = "Book Already Exists!";
    } else {
      $insert_book = mysqli_query($conn, "INSERT INTO `cart` (user_id, book_id, name, price, image, quantity) VALUES ('$user_id','$book_id','$book_name','$book_price','$book_image','$book_quantity')");
      $message[] = "Book Added Successfully!";
    }
  } else {
    echo "<script>alert('Please log in to access the cart.'); window.location.href = 'login.php';</script>";
  }
}
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

  <!-- Recently Added -->
  <section class="best-seller">
    <h2>Recently Added</h2>
    <div class="card-container">
      <?php
      $query = "SELECT * FROM books ORDER BY book_id DESC LIMIT 4;";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
      ?>
          <form action="" method="post">
            <a href="book_landing.php?book_id=<?= $row['book_id']; ?>">
              <div class="card">
                <img src="images/books/<?= $row['image_path']; ?>" alt="Image Not Found">
                <h3><?= $row['book_name']; ?></h3>
                <p> <?= $row['price']; ?></p>
                <input type="submit" class="btn" value="Add to Cart" name="add_to_cart">
              </div>
            </a>
          </form>
      <?php }
      } ?>



      <a href="shop.php"><button class="view_more">View More</button></a>
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

      <?php
      $query = "SELECT * FROM books ORDER BY book_id LIMIT 7;";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
      ?>

          <!-- Carousel Items -->
          <form action="" method="post">
            <div class="carousel-item">
              <a href="book_landing.php?book_id=<?= $row['book_id']; ?>">
                <img src="images/books/<?= $row['image_path']; ?>" alt="Book 1">
                <h3><?= $row['book_name']; ?></h3>
                <p> <?= $row['price']; ?></p>
                <input type="submit" class="btn" value="Add to Cart" name="add_to_cart">
              </a>
            </div>
          </form>
      <?php }
      } ?>

<a href="shop.php"><button class="view_more">View More</button></a>



      <!-- <div class="carousel-item"><a href="#">
          <img src="images/books/car.jpg" alt="Book 2">
          <h3>Sumnima</h3>
          <p>$14.99</p>
        </a></div>
      <div class="carousel-item"><a href="#">
          <img src="images/books/phone-call.png" alt="Book 3">
          <h3>Pagal Basti</h3>
          <p>$24.99</p>
        </a></div>
      <div class="carousel-item"><a href="#">
          <img src="images/books/muna_madan.jpg" alt="Book 4">
          <h3>Muna Madan</h3>
          <p>$9.99</p>
        </a></div>
      <div class="carousel-item"><a href="#">
          <img src="images/books/karnali blues.jpg" alt="Book 5">
          <h3>Damini Bhir</h3>
          <p>$12.99</p>
        </a></div>
      <div class="carousel-item"><a href="#">
          <img src="images/books/children.jpg" alt="Book 6">
          <h3>Jiwan Kada Ki Phool</h3>
          <p>$12.99</p>
        </a></div> -->



    </div>
    <button class="prev" onclick="prevSlide();">❮</button>
    <button class="next" onclick="nextSlide();">❯</button>
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
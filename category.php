<?php
include('./components/header.php');
include('dashbase.php'); // Contains your $conn database connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/head.css">
  <link rel="stylesheet" href="./css/category.css">
  <link rel="stylesheet" href="./css/foot.css">
  <script src="https://kit.fontawesome.com/9c08634970.js" crossorigin="anonymous"></script>
  <title>Categories</title>
</head>

<body>
  <section class="category-section">
    <h2>Book Categories</h2>
    <div class="category-container">
      <!-- Category Boxes -->
      <a href="category_page.php?category=Fiction" class="category-box">
        <h3>Fiction</h3>
      </a>
      <a href="category_page.php?category=Non-Fiction" class="category-box">
        <h3>Non-Fiction</h3>
      </a>
      <a href="category_page.php?category=Science" class="category-box">
        <h3>Science</h3>
      </a>
      <a href="category_page.php?category=History" class="category-box">
        <h3>History</h3>
      </a>
      <a href="category_page.php?category=Fantasy" class="category-box">
        <h3>Fantasy</h3>
      </a>
      <a href="category_page.php?category=Romance" class="category-box">
        <h3>Romance</h3>
      </a>
      <a href="category_page.php?category=Mystery" class="category-box">
        <h3>Mystery</h3>
      </a>
      <a href="category_page.php?category=Biography" class="category-box">
        <h3>Biography</h3>
      </a>
    </div>
  </section>


</body>

</html>

<?php
include('./components/footer.php');
?>
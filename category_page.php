<?php
include('./components/header.php');
include('dashbase.php'); // Contains your $conn database connection

// Get category name from the URL
if (isset($_GET['category'])) {
  $category = mysqli_real_escape_string($conn, $_GET['category']); // Sanitize input for security

  // Fetch books for the selected category
  $query = "SELECT * FROM books WHERE category = '$category'";
  $result = mysqli_query($conn, $query);
} else {
  echo "Category not specified!";
  exit;
}

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
  <link rel="stylesheet" href="./css/category_page.css">
  <link rel="stylesheet" href="./css/head.css">
  <link rel="stylesheet" href="./css/footer.css">
  <title><?= htmlspecialchars($category); ?> </title>
</head>

<body>
  <section class="category-page">
    <h2><?= htmlspecialchars($category); ?></h2>
    <div class="books-container">
      <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <div class="book-card">
            <a href="book_landing.php?book_id=<?= $row['book_id']; ?>">
              <img src="images/books/<?= $row['image_path']; ?>" alt="<?= htmlspecialchars($row['book_name']); ?>">
              <h3><?= htmlspecialchars($row['book_name']); ?></h3>
              <p>Author: <?= htmlspecialchars($row['author_name']); ?></p>
              <p>Price: $<?= htmlspecialchars($row['price']); ?></p>
              <input type="submit" class="btn" value="Add to Cart" name="add_to_cart">
            </a>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No books found in this category.</p>
      <?php endif; ?>
    </div>
  </section>
</body>

</html>

<?php
include('./components/footer.php');
?>
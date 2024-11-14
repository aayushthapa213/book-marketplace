<?php
include('./components/header.php');
include('dashbase.php'); // Contains your $conn database connection

if (isset($_POST['add_to_cart'])) {
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
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/shop.css"> <!-- Add a link to your CSS file -->
  <link rel="stylesheet" href="./css/head.css" />
  <title>Book Shop</title>
</head>

<body>
  <?php
  if (isset($message)) {
    foreach ($message as $message) {
      echo '<span class="message">' . $message . '</span>';
    }
  }
  ?>

  <div class="container">
    <section class="products">
      <h1>Available Books</h1>
      <div class="shop_container">
        <?php
        $query = "SELECT * FROM books";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <form action="" method="post">
              <div class="box">
                <img src="images/books/<?= $row['image_path']; ?>" alt="">
                <h3><?= $row['book_name']; ?></h3>
                <div class="price"><?= $row['price']; ?></div>
                <input type="hidden" name="product_id" value="<?= $row['book_id']; ?>">
                <input type="hidden" name="product_name" value="<?= $row['book_name']; ?>">
                <input type="hidden" name="product_price" value="<?= $row['price']; ?>">
                <input type="hidden" name="product_image" value="<?= $row['image_path']; ?>">
                <input type="submit" class="btn" value="Add to Cart" name="add_to_cart">
              </div>
            </form>
        <?php }
        } ?>

      </div>
    </section>
  </div>
</body>

</html>
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
  <link rel="stylesheet" href="./css/head.css" />
  <link rel="stylesheet" href="./css/foot.css" />
  <link rel="stylesheet" href="css/shop.css">
  <script src="https://kit.fontawesome.com/9c08634970.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/9c08634970.js" crossorigin="anonymous"></script>

  <title>Shop</title>
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
              <a href="book_landing.php?book_id=<?= $row['book_id']; ?>">
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
              </a>
            </form>
        <?php }
        } ?>

      </div>
    </section>
  </div>
</body>

</html>

<?php
include('./components/footer.php');
?>
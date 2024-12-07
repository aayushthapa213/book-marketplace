<?php
include('./components/header.php');
include('dashbase.php');
$user_id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/dashboard.css" />
  <link rel="stylesheet" href="./css/head.css">
  <link rel="stylesheet" href="./css/foot.css">
  <script src="https://kit.fontawesome.com/9c08634970.js" crossorigin="anonymous"></script>
  <title><?= $_SESSION['first_name'] ?></title>
</head>

<body>
  <?php
  $query = "SELECT * FROM books WHERE user_id = '$user_id'";
  $result = mysqli_query($conn, $query);

  $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'");


  if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM books WHERE book_id = '$delete_id'");
    header("Location: " . $_SERVER['PHP_SELF']);
  }

  if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM books WHERE cart_id = '$remove_id' AND user_id = '$user_id'");
    header("Location: " . $_SERVER['PHP_SELF']);
  }
  ?>

  <main>
    <!-- Shopping Cart Section -->
    <section id="shopping-cart">
      <h2>Shopping Cart</h2>
      <?php if (mysqli_num_rows($select_cart) > 0): ?>
        <div class="cart-items-container">
          <?php while ($cart_item = mysqli_fetch_assoc($select_cart)): ?>
            <div class="cart-item-card">
              <img src="images/books/<?= htmlspecialchars($cart_item['image']); ?>" alt="<?= htmlspecialchars($cart_item['name']); ?>" class="cart-item-image">
              <div class="cart-item-details">
                <h3><?= htmlspecialchars($cart_item['name']); ?></h3>
                <p>Price: $<?= number_format($cart_item['price']); ?></p>
                <p>Quantity: <?= htmlspecialchars($cart_item['quantity']); ?></p>
                <a href="cart.php?remove=<?= $cart_item['cart_id']; ?>" onclick="return confirm('Remove item from cart?')" class="btn remove-btn">Remove</a>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      <?php else: ?>
        <p>No items in your cart yet.</p>
      <?php endif; ?>
    </section>

    <!-- User Uploaded Books Section -->
    <section id="uploaded-books">
      <h2>Your Uploaded Books</h2>
      <a href="upload_book.php">
        <button class="add-book-button" onclick="window.location.href='/booksell/addBook.php'">Add New Book</button>
      </a>
      <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="book-display">
          <table class="book-display-table">
            <thead>
              <tr>
                <th>Book Image</th>
                <th>Book Name</th>
                <th>Author</th>
                <th>Price</th>
                <th>Category</th>
                <th>Description</th>
                <th>Upload Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                  <td><img src="images/books/<?= htmlspecialchars($row['image_path']) ?>" height="100"></td>
                  <td><?= htmlspecialchars($row['book_name']) ?></td>
                  <td><?= htmlspecialchars($row['author_name']) ?></td>
                  <td>$<?= htmlspecialchars($row['price']) ?></td>
                  <td><?= htmlspecialchars($row['category']) ?></td>
                  <td><?= htmlspecialchars($row['description']) ?></td>
                  <td><?= htmlspecialchars($row['upload_date']) ?></td>
                  <td> 
                    <a href="update_book.php?edit=<?= $row['book_id']; ?>" class="btn">
                      <i class="fas fa-edit">edit</i>
                    </a>
                    <a href="dashboard.php?delete=<?= $row['book_id']; ?>" class="btn">
                      <i class="fas fa-trash">delete</i>
                    </a>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <p>You haven't uploaded any books yet.</p>
      <?php endif; ?>
    </section>
  </main>


</body>

</html>

<?php
include('./components/footer.php');
?>
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
  <title><?= $_SESSION['first_name'] ?></title>
</head>

<body>
  <?php
  $query = "SELECT * FROM books WHERE user_id = '$user_id'";
  $result = mysqli_query($conn, $query);

  if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM books WHERE book_id = $delete_id");
    header("Location: " . $_SERVER['PHP_SELF']);
  }
  ?>

  <main>
    <!-- Shopping Cart Section -->
    <section id="shopping-cart">
      <h2>Shopping Cart</h2>
      <p>No items in your cart yet.</p>
      <!-- Dynamically display items added to the cart -->
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
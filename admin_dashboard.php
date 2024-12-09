<?php
session_start();
$authenticated = false;
if (isset($_SESSION["email"])) {
  $authenticated = true;
};
if ($authenticated) {
  $user_id = $_SESSION['id'];
}

include('dashbase.php');

if (!$authenticated) {
  echo "<script>alert('Please log in to access the admin dashboard.'); window.location.href = 'login.php';</script>";
  exit();
}

$revenue = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="./css/admin_dashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
  <?php

  $query = "SELECT * FROM cart INNER JOIN users ON cart.user_id = users.id";
  $result = mysqli_query($conn, $query);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart_id = $_POST['cart_id'];
    $query = "DELETE FROM cart WHERE cart_id = $cart_id";
    $result1 = mysqli_query($conn, $query);

    if ($result1) {
      header("Location: admin_dashboard.php?message=Order+shipped+successfully");
      exit();
    } else {
      header("Location: admin_dashboard.php?error=Failed+to+mark+order+as+shipped");
      exit();
    }
  }

  if (isset($_GET['message'])): ?>
    <p style="color: green;"><?= htmlspecialchars($_GET['message']) ?></p>
  <?php endif;

  if (isset($_GET['error'])): ?>
    <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
  <?php endif;

  ?>

  <div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="logo">
        <h1>Admin Panel</h1>
      </div>
      <ul class="nav-links">
        <li><a href="admin_dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="manage_books.php"><i class="fas fa-book"></i> Manage Books</a></li>
        <li><a href="manage_users.php"><i class="fas fa-users"></i> Users</a></li>
        <li><a href="upload_book.php"><i class="fa fa-plus"></i>Add Book</a></li>
        <li class="settings-container">
          <a href="#"><i class="fas fa-cog"></i> Settings</a>
          <div class="setting-hidden">
            <ul>
              <li><a href="index.php">Home</a></li>
              <li><a href="about.php">About</a></li>
              <li><a href="shop.php">Shop</a></li>
              <li><a href="category.php">Category</a></li>
              <li><a href="logout.php">Log Out</a></li>
            </ul>
          </div>
        </li>

      </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <header class="header">
        <h2>Welcome, Admin!</h2>
        <p>Manage your dashboard efficiently</p>
      </header>

      <section class="stats">
        <?php
        $query_book = "SELECT * FROM books";
        $result_book = mysqli_query($conn, $query_book);
        $total_books = mysqli_num_rows($result_book);

        $query_user = "SELECT * FROM users";
        $result_user = mysqli_query($conn, $query_user);
        $total_user = mysqli_num_rows($result_user);

        $query_revenue = "SELECT SUM(price * quantity) AS total_revenue FROM cart";
        $result_revenue = mysqli_query($conn, $query_revenue);
        $row_revenue = mysqli_fetch_assoc($result_revenue);
        $revenue = $row_revenue['total_revenue'] ?? 0; // Fallback to 0 if no revenue

        ?>
        <div class="stat-card">
          <h3>Books <i class="fas fa-book"></i></h3>
          <p> <?= $total_books ?></p>
        </div>
        <div class="stat-card">
          <h3>Users <i class="fas fa-users"></i></h3>
          <p> <?= $total_user ?></p>
        </div>
        <div class="stat-card">
          <h3>Revenue <i class="fas fa-dollar-sign"></i></h3>
          <p> <?= number_format($revenue, 2) ?></p>
        </div>
      </section>

      <section class="table-section">
        <h2>Total Orders</h2>
        <?php if (mysqli_num_rows($result) > 0): ?>
          <table>
            <thead>
              <tr>
                <th>#</th>
                <th>Book Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Ordered By</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              while ($row = mysqli_fetch_assoc($result)):
              ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= $row['name'] ?></td>
                  <td><?= $row['price'] ?></td>
                  <td><?= $row['quantity'] ?></td>
                  <td><?= $row["first_name"] . " " . $row["last_name"] ?></td>
                  <td>
                    <form action="admin_dashboard.php" method="POST">
                      <input type="hidden" name="cart_id" value="<?= $row['cart_id'] ?>"> 
                      <button type="submit" onclick="return confirm('Mark this order as shipped?');">Shipped</button>
                    </form>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        <?php else: ?>
          <p>No orders found.</p>
        <?php endif; ?>
      </section>
    </main>
  </div>
</body>

</html>
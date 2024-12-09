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
  $query = "SELECT * FROM users";
  $result = mysqli_query($conn, $query);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'delete') {
      // Handle delete logic
      $user_id = $_POST['user_id'];

      // Delete associated cart items, books, and user
      $query_cart_books = "DELETE FROM cart WHERE book_id IN (SELECT book_id FROM books WHERE user_id = $user_id)";
      mysqli_query($conn, $query_cart_books);

      $query_cart_user = "DELETE FROM cart WHERE user_id = $user_id";
      mysqli_query($conn, $query_cart_user);

      $query_books = "DELETE FROM books WHERE user_id = $user_id";
      mysqli_query($conn, $query_books);

      $query_user = "DELETE FROM users WHERE id = $user_id";
      $result_user = mysqli_query($conn, $query_user);

      if ($result_user) {
        header("Location: manage_users.php?message=User+and+their+books+deleted+successfully!");
        exit();
      } else {
        die("Error deleting user: " . mysqli_error($conn));
      }
    }

    if ($_POST['action'] === 'edit') {
      // Handle edit logic (update user role)
      $user_id = $_POST['user_id'];
      $current_role = $_POST['current_role'];

      // Toggle role between 'user' and 'admin'
      $new_role = ($current_role === 'admin') ? 'user' : 'admin';

      $query_update_role = "UPDATE users SET role = '$new_role' WHERE id = $user_id";
      $result_role = mysqli_query($conn, $query_update_role);

      if ($result_role) {
        header("Location: manage_users.php?message=User+role+updated+successfully!");
        exit();
      } else {
        die("Error updating role: " . mysqli_error($conn));
      }
    }
  }

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
      <section class="table-section">
        <h2>Users</h2>
        <?php if (mysqli_num_rows($result) > 0): ?>
          <table>
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= $row["first_name"] . " " . $row["last_name"] ?></td>
                  <td><?= $row['email'] ?></td>
                  <td><?= $row['role'] ?></td>
                  <td><?= $row['created_at'] ?></td>
                  <td>
                    <!-- Edit Form -->
                    <form action="manage_users.php" method="post" style="display:inline;">
                      <input type="hidden" name="action" value="edit">
                      <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                      <input type="hidden" name="current_role" value="<?= $row['role'] ?>">
                      <button type="submit">Change Role</button>
                    </form>

                    <!-- Delete Form -->
                    <form action="manage_users.php" method="post" style="display:inline;">
                      <input type="hidden" name="action" value="delete">
                      <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                      <button type="submit" onclick="return confirm('Do you want to delete the user and all the data related to the user?');">Delete</button>
                    </form>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        <?php else: ?>
          <p>No users found.</p>
        <?php endif; ?>
      </section>
    </main>
  </div>
</body>

</html>
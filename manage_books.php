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
  $query = "SELECT * FROM books";
  $result = mysqli_query($conn, $query);
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
    <h2>Books</h2>
    <?php if (mysqli_num_rows($result) > 0): ?> 
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Book Name</th>
                    <th>Category</th>
                    <th>Uploaded By</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $i++ ?></td> 
                        <td><?= htmlspecialchars($row['book_name']) ?></td> <!-- Use htmlspecialchars for security -->
                        <td><?= htmlspecialchars($row['category']) ?></td>
                        <td><?= htmlspecialchars($row['author_name']) ?></td>
                        <td><?= htmlspecialchars($row['upload_date']) ?></td>
                        <td>
                            <button>Edit</button>
                            <button>Delete</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No books found.</p>
    <?php endif; ?>
</section>


    </main>
  </div>
</body>

</html>
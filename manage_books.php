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
        <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
        <div class="setting-hidden">
            <li><a href="">home</a></li>
            <li><a href="">about</a></li>
            <li><a href="">shop</a></li>
            <li><a href="">category</a></li>
            <li><a href="">log out</a></li>
          </div>
  </ul>
  </aside>

  <!-- Main Content -->
  <main class="main-content">
    <section class="table-section">
      <h2>Books</h2>
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
          <tr>
            <td>1</td>
            <td>The Great Gatsby</td>
            <td>Fiction</td>
            <td>John Doe</td>
            <td>2024-12-01</td>
            <td>
              <button>Edit</button>
              <button>Delete</button>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>To Kill a Mockingbird</td>
            <td>Drama</td>
            <td>Jane Smith</td>
            <td>2024-12-02</td>
            <td>
              <button>Edit</button>
              <button>Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </section>
  </main>
  </div>
</body>

</html>
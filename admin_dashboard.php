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
        <li><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="#"><i class="fas fa-book"></i> Manage Books</a></li>
        <li><a href="#"><i class="fas fa-users"></i> Users</a></li>
        <li><a href="#"><i class="fa fa-plus"></i>Add Book</a></li>
        <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
      </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <header class="header">
        <h2>Welcome, Admin!</h2>
        <p>Manage your dashboard efficiently</p>
      </header>

      <section class="stats">
        <div class="stat-card">
          <h3>Books <i class="fas fa-book"></i></h3>
          <p> 120</p>
        </div>
        <div class="stat-card">
          <h3>Users <i class="fas fa-users"></i></h3>
          <p> 80</p>
        </div>
        <div class="stat-card">
          <h3>Revenue <i class="fas fa-dollar-sign"></i></h3>
          <p> $5,000</p>
        </div>
      </section>

      <section class="table-section">
        <h2>Recent Orders</h2>
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
              <td><button>Delete</button></td>
            </tr>
            <tr>
              <td>2</td>
              <td>To Kill a Mockingbird</td>
              <td>Drama</td>
              <td>Jane Smith</td>
              <td>2024-12-02</td>
              <td><button>Delete</button></td>
            </tr>
          </tbody>
        </table>
      </section>
    </main>
  </div>
</body>

</html>
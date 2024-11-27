<?php
include('./components/header.php');
include('dashbase.php');

if (isset($_POST['submit_contact'])) {
  $contact_email = $_POST['email'];
  $contact_description = $_POST['description'];
  $timestamp = date("Y-m-d H:i:s");

  if (empty($contact_email) || empty($contact_description)) {
    $message[] = "All Fields Must Be Filled!";
  } else {
    $insert = "INSERT INTO contacts( email, description, created_at) 
        VALUES ('$contact_email' , '$contact_description', '$timestamp')";
  }
  $contact = mysqli_query($conn, $insert);

  if ($contact) {
    $message[] = 'New Product Added Successfully!';
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
  } else {
    $message[] = 'Failed to add new product!';
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
  <link rel="stylesheet" href="./css/about.css" />
  <script src="https://kit.fontawesome.com/9c08634970.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/9c08634970.js" crossorigin="anonymous"></script>

  <title>About Us</title>
</head>

<body>
  <?php
  if (isset($message)) {
    foreach ($message as $message) {
      echo '<span class="message">' . $message . '</span>';
    }
  }
  ?>
  <!-- About Section -->
  <section class="about-section">
    <div class="about-container">
      <h1>About Us</h1>
      <p>Welcome to Book Sale and Buy, where book lovers unite! We help you easily sell or buy books, creating a thriving community around books and reading.</p>

      <div class="mission">
        <h2>Our Mission</h2>
        <p>We aim to make books accessible to everyone by offering a simple, affordable way to exchange books, foster reading habits, and contribute to environmental sustainability by reusing books.</p>
      </div>

      <div class="team">
        <h2>Meet the Team</h2>
        <p>We are a passionate team dedicated to building a community for book lovers.</p>
        <ul>
          <li><strong>Aayush Thapa</strong> - Founder & CEO</li>
          <li><strong>Aayush Thapa</strong> - Developer</li>
          <li><strong>Aayush Thapa</strong> - Designer</li>
        </ul>
      </div>

      <!-- Contact Us Section -->
      <div class="contact-us">
        <h2>Get in Touch</h2>
        <p>Have any questions or suggestions? Feel free to reach out to us. We'd love to hear from you!</p>

        <form action="" method="POST" class="contact-form">
          <label for="email">Your Gmail:</label>
          <input type="email" id="email" name="email" placeholder="Your email address" required>

          <label for="description">Your Message:</label>
          <textarea id="description" name="description" rows="5" placeholder="Tell us something" required></textarea>

          <button type="submit" class="btn" name="submit_contact">Send Message</button>
        </form>
      </div>
    </div>
  </section>
</body>

</html>

<?php
include('./components/footer.php');
?>
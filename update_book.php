<?php
include("dashbase.php");

session_start();
$authenticated = false;
if (isset($_SESSION["email"])) {
  $authenticated = true;
}

$id = $_GET['edit'];

if (isset($_POST["bupdate"])) {
  $user_id = $_SESSION['id'];
  $book_name = $_POST["bname"];
  $author_name = $_POST['aname'];
  $book_price = $_POST["bprice"];
  $category = $_POST['category'];
  $book_image = $_FILES["bimage"]["name"];
  $book_image_temp = $_FILES['bimage']['tmp_name'];
  $book_image_folder = 'images/books/' . $book_image;
  $description = $_POST['bdescription'];
  $timestamp = date("Y-m-d H:i:s");

  if (empty($book_name) || empty($book_price) || empty($author_name)) {
    $message[] = "All Fields Must Be Filled!";
  } else {
    $update = "UPDATE  books SET book_name = '$book_name', author_name = '$author_name', price = '$book_price', category = '$category' , image_path = '$book_image' , description = '$description' , upload_date = '$timestamp' WHERE book_id = $id";
    $upload = mysqli_query($conn, $update);
    if ($upload) {
      move_uploaded_file($book_image_temp, $book_image_folder);
      $message[] = 'New Product Added Successfully!';
      header("Location: dashboard.php");
      exit();
    } else {
      $message[] = 'Failed to add new product!';
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/upload_book.css" />
  <title>Document</title>
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
    <div class="inner_container">
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <h1>Add New Book</h1>
        <div class="box">
          <label for="bname">Name</label>
          <input type="text" placeholder="Enter book name" name="bname">
        </div>
        <div class="box">
          <label for="aname">Author</label>
          <input type="text" placeholder="Enter author name" name="aname">
        </div>
        <div class="box">
          <label for="bprice">Price</label>
          <input type="number" placeholder="Enter the price" name="bprice">
        </div>
        <div class="box">
          <label for="category">Choose a category:</label>
          <select id="category" name="category">
            <option value="fiction">Fiction</option>
            <option value="non-fiction">Non-Fiction</option>
            <option value="mystery">Mystery</option>
            <option value="science">Science</option>
            <option value="history">History</option>
            <option value="biography">Biography</option>
            <option value="fantasy">Fantasy</option>
            <option value="romance">Romance</option>
          </select>
        </div>
        <div class="box">
          <label for="bimage">Image</label>
          <input type="file" accept="image/png, image/jpeg, image/jpg" name="bimage">
        </div>
        <div class="box">
          <label for="bdescription">Description</label>
          <textarea id="bdescription" name="bdescription" placeholder="Enter a brief synopsis or key details" rows="4"></textarea>
        </div>
        <input type="submit" class="sub" value="Update" name="bupdate">
        <button type="button" class="cancel-btn" onclick="redirectToDashboard()">Cancel</button>
      </form>
    </div>

    <!-- Link to the external JS file -->
    <script src="./js/upload_book.js"></script>
</body>

</html>
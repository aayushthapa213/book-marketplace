<?php

include('./components/header.php');
include('dashbase.php');

if (isset($_GET['search_query']) && !empty($_GET['search_query'])) {
  $search_query = mysqli_real_escape_string($conn, $_GET['search_query']);
  $query = "SELECT * FROM books WHERE book_name LIKE '%$search_query%' OR description LIKE '%$search_query%' ORDER BY book_id";
  $result = mysqli_query($conn, $query); 

  if (mysqli_num_rows($result) > 0) {
      echo "<div class='container'>";
      echo "<h2>Search Results for '{$search_query}':</h2>";
      echo "<div class='search-results'>";
      while ($row = mysqli_fetch_assoc($result)) {
          echo "
          <form action='' method='post'>
            <a href='book_landing.php?book_id={$row['book_id']}'>
              <div class='card'>
                <img src='images/books/{$row['image_path']}' alt='Book Image'>
                <div class='details'>
                  <h3>{$row['book_name']}</h3>
                  <p>{$row['price']}</p>
                  <input type='hidden' name='product_id' value='{$row['book_id']}'>
                  <input type='hidden' name='product_name' value='{$row['book_name']}'>
                  <input type='hidden' name='product_price' value='{$row['price']}'>
                  <input type='hidden' name='product_image' value='{$row['image_path']}'>
                  <input type='submit' class='btn' value='Add to Cart' name='add_to_cart'>
                </div>
              </div>
            </a>
          </form>
          ";
      }
      echo "</div>";
      echo "</div>";
  } else {
      echo "<h2>No results found for '{$search_query}'</h2>";
  }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/header.css" />
  <link rel="stylesheet" href="./css/search.css" />
  <link rel="stylesheet" href="./css/foot.css" />
  <script src="https://kit.fontawesome.com/9c08634970.js" crossorigin="anonymous"></script>
  <title>Document</title>
</head>
<body>
  
</body>
</html>


<?php
include('./components/footer.php');
?>